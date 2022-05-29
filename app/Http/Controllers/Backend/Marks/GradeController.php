<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Models\MarksGrade;

class GradeController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = MarksGrade::all();
        return view('backend.marks.grade.view', $data);
    }

    //  create
    public function create(){
        // dd('ok');
        return view('backend.marks.grade.create');
    }
    //  store
    public function store(Request $request){
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();
        return redirect()->route('marks.grade.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($id){
        $data['editData'] = MarksGrade::findOrFail($id);
        return view('backend.marks.grade.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        MarksGrade::findOrFail($id)->update($request->all());
        return redirect()->route('marks.grade.view')->with('success', 'Data updated successfully!');
    }
}