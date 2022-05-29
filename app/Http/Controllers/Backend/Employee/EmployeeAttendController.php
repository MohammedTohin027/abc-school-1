<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;

class EmployeeAttendController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date','DESC')->get();
        return view('backend.employee.attendance.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.attendance.crate', $data);
    }
    //  store
    public function store(Request $request){
        EmployeeAttendance::where('date', date('Y-m-d',strtotime($request->date)))->delete();
        // dd($request->all());
        $contemployee = count($request->employee_id);
        // dd($contemployee);
        for ($i=0; $i < $contemployee; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        return redirect()->route('employees.attendance.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($date){

        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        // dd($data['editData']);
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.attendance.crate', $data);
    }

    //  update
    public function details($date){
        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.attendance.details', $data);
    }
}