<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student.group.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.student.group.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_groups,name',
        ]);
        StudentGroup::create($request->all());
        return redirect()->route('setup.student.group.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = StudentGroup::findOrFail($id);
        return view('backend.setup.student.group.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_groups,name,'.$id,
        ]);
        StudentGroup::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.group.view')->with('success', 'Data updated successfully!');
    }
}