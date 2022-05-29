<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;

class EmployeeRegController extends Controller
{
    //  view
    public function view(){
        // dd('ok');       
        $data['allData'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee-reg.view', $data);
    }
    
    //  create
    public function create(){
        $data = Designation::all();
        return view('backend.employee.employee-reg.create',compact('data'));
    }
    //  store
    public function store(Request $request){
        // dd($request->all());
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            // dd($checkYear);
            $employee = User::where('usertype', 'employee')->orderBy('id','DESC')->first();
            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg + 1;
                if ($employeeId < 10 ) {
                   $id_no = '000'. $employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '00'. $employeeId;
                }
                elseif($employeeId < 1000){
                    $id_no = '0'. $employeeId;
                }
            }
            else{
                $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee + 1;
                if ($employeeId < 10 ) {
                   $id_no = '000'. $employeeId;
                }
                elseif($employeeId < 100){
                    $id_no = '00'. $employeeId;
                }
                elseif($employeeId < 1000){
                    $id_no = '0'. $employeeId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $code = rand(000000, 999999);

            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'employee';
            $user->role = 'employee';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->salary = $request->salary;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));
            if ($request->file('image')) {
                $file = $request->file('image');
                $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/employee_images'),$file_name);
                $user['image'] = $file_name;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = $request->effected_date;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->increment_salary = 0;
            $employee_salary->save();
            // dd($final_id_no);
        });
        return redirect()->route('employees.registration.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($id){
        $editData = User::findOrFail($id);
        $data = Designation::all();
        return view('backend.employee.employee-reg.create',compact('data', 'editData'));
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $user =User::findOrFail($id);
        $user->name = $request->name;
        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->religion = $request->religion;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->designation_id = $request->designation_id;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_images/'.$user->image));
            $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/employee_images'),$file_name);
            $user['image'] = $file_name;
        }
        $user->save();     
        return redirect()->route('employees.registration.view')->with('success', 'Data updated successfully!');
    }

}