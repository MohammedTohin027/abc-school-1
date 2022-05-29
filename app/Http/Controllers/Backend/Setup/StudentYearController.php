<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = Year::all();
        return view('backend.setup.student.year.view', $data);
    }

    //create
    public function create(){
        return view('backend.setup.student.year.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:years,name',
        ]);
        Year::create($request->all());
        return redirect()->route('setup.student.year.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = Year::findOrFail($id);
        return view('backend.setup.student.year.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:years,name,'.$id,
        ]);
        Year::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.year.view')->with('success', 'Data updated successfully!');
    }

    //  delete
    // public function delete($id){
    //     dd($id);
    //     Year::findOrFail($id)->delete();
    //     return redirect()->back()->with('success', 'Data deleted successfully!');
    // }
}