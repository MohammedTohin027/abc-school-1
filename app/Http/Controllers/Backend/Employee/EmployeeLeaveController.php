<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;

class EmployeeLeaveController extends Controller
{
     //  view
     public function view(){
        // dd('ok');
        $data['allData'] = EmployeeLeave::orderBy('id','desc')->get();
        return view('backend.employee.employee-leave.view', $data);
    }

    //  create
    public function create(){
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee-leave.crate', $data);
    }
    //  store
    public function store(Request $request){
        // dd($request->all());

        if ($request->leave_purpose_id == 0) {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }
        else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $employee_leave = new EmployeeLeave();
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->save();

        return redirect()->route('employees.leave.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($id){
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        $data['editData'] = EmployeeLeave::findOrFail($id);
        return view('backend.employee.employee-leave.crate',$data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());

        if ($request->leave_purpose_id == 0) {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }
        else{
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $employee_leave = EmployeeLeave::findOrFail($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->save();

        return redirect()->route('employees.leave.view')->with('success', 'Data Updated successfully!');
    }
}