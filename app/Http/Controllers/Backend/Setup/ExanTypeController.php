<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExanType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExanTypeController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = ExanType::all();
        return view('backend.setup.student.exam-type.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.student.exam-type.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:exan_types,name',
        ]);
        ExanType::create($request->all());
        return redirect()->route('setup.student.examtype.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = ExanType::findOrFail($id);
        return view('backend.setup.student.exam-type.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:exan_types,name,'.$id,
        ]);
        ExanType::findOrFail($id)->update($request->all());
        return redirect()->route('setup.student.examtype.view')->with('success', 'Data updated successfully!');
    }
}