<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\Year;
use App\Models\ExanType;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use PDF;

class MonthlySalaryController extends Controller
{
    //  view
    public function view()
    {
        // dd('ok');
        return view('backend.employee.monthly-salary.view');
    }

    //  get student ajax
    // public function getSutent(Request $request){
    //     dd($request->all());
    //     $date = date('Y-m',strtotime($request->date));
    //     if($date != ''){
    //         $where[] = ['date', 'like', $date.'%'];
    //     }
    //     $data['date'] = $request->date;
    //     $data['getDate'] = $where;
    //     $data['allData'] = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
    //     dd($data);
    //     return view('backend.employee.monthly-salary.search-view', $data);
    // }

    public function getSalary(Request $request){
        $date = date('Y-m',strtotime($request->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($data);
        // $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($data);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach ($data as $key => $attend) {
            // dd($attend->employee_id);
            $totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            // dd($totalattend);
            $absentcount = count($totalattend->where('attend_status', 'Absent'));
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount * (float)$salaryperday;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;
            $html[$key]['tdsource'] .= '<td>'.round($totalsalary).'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" href="'.route("employees.monthly.salary.payslip",$attend->employee_id).'"><i
            class="fa fa-download"></i></a>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-info'.'" title="Details" href="'.route("employees.monthly.salary.details",$attend->employee_id).'"><i
            class="fa fa-eye"></i></a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);

    }

    //  playslip
    public function payslip(Request $request, $employee_id){
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();
        // dd($data);
        $pdf = PDF::loadView('backend.pdf.employee.monthly-salary-payslip', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
        // dd($data);
    }

    //  Details
    public function details(Request $request, $employee_id){

        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();
        // dd($data);

        return view('backend.employee.monthly-salary.details', $data);
    }


}