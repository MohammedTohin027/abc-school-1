<?php

namespace App\Http\Controllers\Backend\Student;

use PDF;
use App\Models\Year;
use App\Models\ExanType;
use App\Models\FreeAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;

class ExamFeeController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExanType::all();
        return view('backend.student.exam-fee.view-exam-fee', $data);
        // return view('backend.student.monthly_fee.view', $data);
    }

    //  getStudent
    public function getStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
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
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            $registrationfee = FreeAmount::where('free_category_id', '3')->where('class_id', $v->class_id)->first();
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
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" href="'.route("students.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'"><i
            class="fa fa-download"></i></a>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-info'.'" title="Payslip" href="'.route("students.exam.fee.details").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'"><i
            class="fa fa-eye"></i></a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    //  playslip
    public function payslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['exam_type_id'] = ExanType::where('id', $request->exam_type_id)->first()['name'];
        $data['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->where('class_id', $class_id)->first();
        $pdf = PDF::loadView('backend.pdf.student.exam-fee-payslip', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
        // dd($data);
    }

    //  Details
    public function details(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['exam_type_id'] = ExanType::where('id', $request->exam_type_id)->first()['name'];
        $data['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->where('class_id', $class_id)->first();
        return view('backend.student.exam-fee.exam-fee-details', $data);
    }
}