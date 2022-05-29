<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.student.shift.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.student.shift.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_shifts,name',
        ]);
        StudentShift::create($request->all());
        return redirect()->route('setup.student.shift.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = StudentShift::findOrFail($id);
        return view('backend.setup.student.shift.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$id,
        ]);
        StudentShift::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.shift.view')->with('success', 'Data updated successfully!');
    }
}