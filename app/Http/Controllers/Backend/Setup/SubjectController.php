<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExanType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Subject::all();
        return view('backend.setup.subject.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.subject.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:subjects,name',
        ]);
        Subject::create($request->all());
        return redirect()->route('setup.subject.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = Subject::findOrFail($id);
        return view('backend.setup.subject.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:subjects,name,'.$id,
        ]);
        Subject::findOrFail($id)->update($request->all());
        return redirect()->route('setup.subject.view')->with('success', 'Data updated successfully!');
    }
}