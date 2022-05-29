<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\Year;
use App\Models\Designation;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\EmployeeSalaryLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeSalaryController extends Controller
{
    //  view
    public function view(){
        // dd('ok');       
        $data['allData'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee-salary.view', $data);
    }

    //  edit
    public function increment($id){
        $data['editData'] = User::findOrFail($id);
        return view('backend.employee.employee-salary.increment',$data);
    }

    //  store
    public function store(Request $request,$id){
        $user = User::findOrFail($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();
        
        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_date = date('Y-m-d', strtotime($request->effected_date));
        $salaryData->save();
        return redirect()->route('employees.salary.view')->with('success', 'Salary incremented successfully');
    }

    //  details
    public function details($id){
        $data['details'] = User::findorFail($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id', $data['details']->id)->get();
        return view('backend.employee.employee-salary.details',$data);
    }
}