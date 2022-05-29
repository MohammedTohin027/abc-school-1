<?php

namespace App\Http\Controllers\Backend\Student;

use PDF;
use App\Models\Year;
use App\Models\FreeAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;

class MonthlyFeeController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.monthly_fee.view-monthly-fee', $data);
        // return view('backend.student.monthly_fee.view', $data);
    }

    //  get student ajax
    // public function getStudent(Request $request){
    //     // dd($request->all());
    //     $data['years'] = Year::orderBy('id', 'DESC')->get();
    //     $data['classes'] = StudentClass::all();
    //     $data['year_id'] = $request->year_id;
    //     $data['class_id'] = $request->class_id;
    //     $data['month'] = $request->month;
    //     $data['allData'] = AssignStudent::with(['discount','student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
    //     return view('backend.student.monthly_fee.search-view', $data);
    // }

    //  getStudent
    public function getStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $month = $request->month;
        if($year_id != ''){
            $where[] = ['year_id', 'like', $year_id.'%'];
        }
        if($class_id != ''){
            $where[] = ['class_id', 'like', $class_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            $registrationfee = FreeAmount::where('free_category_id', '2')->where('class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount / 100 * $originalfee;
            $finalfee = (int)$originalfee - (int)$discountablefee;

            $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("students.monthly.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'"><i
            class="fa fa-download"></i></a>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-info'.'" title="Payslip" href="'.route("students.month.fee.details").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&month='.$request->month.'"><i
            class="fa fa-eye"></i></a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    //  playslip
    public function payslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;
        $data['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->where('class_id', $class_id)->first();
        $pdf = PDF::loadView('backend.pdf.student.monthly-fee-payslip', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
        // dd($data);
    }

    //  Details
    public function details(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;
        $data['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->where('class_id', $class_id)->first();
        return view('backend.student.monthly_fee.monthly-fee-details', $data);
    }

}