<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentFreeCategory;

class StudentFreeCategoryController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = StudentFreeCategory::all();
        return view('backend.setup.student.free-category.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.student.free-category.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_free_categories,name',
        ]);
        StudentFreeCategory::create($request->all());
        return redirect()->route('setup.student.free.category.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = StudentFreeCategory::findOrFail($id);
        return view('backend.setup.student.free-category.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:student_free_categories,name,'.$id,
        ]);
        StudentFreeCategory::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.free.category.view')->with('success', 'Data updated successfully!');
    }
}