<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student.class.view', $data);
    }

    //create
    public function create(){
        return view('backend.setup.student.class.create');
    }

    //  store
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);
        StudentClass::create($request->all());
        return redirect()->route('setup.student.class.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        $data['editData'] = StudentClass::findOrFail($id);
        return view('backend.setup.student.class.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:student_classes,name,'.$id,
        ]);
        StudentClass::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.class.view')->with('success', 'Data updated successfully!');
    }

    //  delete
    public function delete($id){
        StudentClass::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data deleted successfully!');
    }
    //  delete
    // public function delete(Request $request){
    //     $id = $request->id;
    //     dd($id);
    //     exit();
    //     StudentClass::findOrFail()->delete();
    //     return redirect()->back()->with('success', 'Data deleted successfully!');
    // }
}