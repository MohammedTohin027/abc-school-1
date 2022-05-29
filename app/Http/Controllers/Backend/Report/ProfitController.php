<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use App\Models\ExanType;
use App\Models\MarksGrade;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\Year;
use Illuminate\Http\Request;
use PDF;

class ProfitController extends Controller
{
    //  view
    public function view(){
        return view('backend.report.profit-view');
    }

    //  profit
    public function profit(Request $request){
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $student_fee = AccountStudentFee::whereBetween('date',[$start_date, $end_date] )->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date',[$sdate, $edate] )->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date, $end_date] )->sum('amount');
        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource']  = '<th>Student Fee</th>';
        // $html['thsource'] .= '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource']  = '<td>'.$student_fee.' Tk'.'</td>';
        $html['tdsource'] .= '<td>'.$other_cost.' Tk'.'</td>';
        $html['tdsource'] .= '<td>'.$emp_salary.' Tk'.'</td>';
        $html['tdsource'] .= '<td>'.$total_cost.' Tk'.'</td>';
        $html['tdsource'] .= '<td>'.$profit.' Tk'.'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PDF" href="'.route("roports.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'"><i
        class="fa fa-print"></i></a>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-info'.'" title="Details" href="'.route("roports.profit.details").'?start_date='.$sdate.'&end_date='.$edate.'"><i
        class="fa fa-eye"></i></a>';
        $html['tdsource'] .= '</td>';
        return response()->json(@$html);
    }

    public function pdf(Request $request){
        $data['sdate'] = date('Y-m', strtotime($request->start_date));
        $data['edate'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));

        $pdf = PDF::loadView('backend.pdf.report.monthly-profit-report', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
    }
    public function details(Request $request){
        $data['sdate'] = date('Y-m', strtotime($request->start_date));
        $data['edate'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));

        $data['student_fee'] = AccountStudentFee::whereBetween('date',[$data['sdate'], $data['edate']] )->sum('amount');
        $data['other_cost'] = AccountOtherCost::whereBetween('date',[$data['start_date'], $data['end_date']] )->sum('amount');
        $data['emp_salary'] = AccountEmployeeSalary::whereBetween('date',[$data['sdate'], $data['edate']] )->sum('amount');
        $data['total_cost'] = $data['other_cost'] + $data['emp_salary'];
        $data['profit'] = $data['student_fee'] - $data['total_cost'];
	    return view('backend.report.profit-details', $data);
    }

    public function markSheetView(){
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        $data['examTypes'] = ExanType::all();
        return view('backend.report.marksheet-view', $data);
    }

    public function markSheetGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get()->count();
        $singleStudent = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();
        if ($singleStudent == true) {
            $allMarks = StudentMarks::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            $allGrades = MarksGrade::all();
            // dd($allMarks);
            return view('backend.report.marksheet-get', compact('count_fail','allMarks','allGrades'));
        } else {
            return redirect()->back()->with('error', 'Sorry! These criteria does not match!');
        }

        // dd($request->all());
    }
}