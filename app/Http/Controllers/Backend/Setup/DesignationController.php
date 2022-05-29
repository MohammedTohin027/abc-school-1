<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        return view('backend.setup.designation.create');
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:designations,name',
        ]);
        Designation::create($request->all());
        return redirect()->route('setup.designation.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = Designation::findOrFail($id);
        return view('backend.setup.designation.create', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:designations,name,'.$id,
        ]);
        Designation::findOrFail($id)->update($request->all());
        return redirect()->route('setup.designation.view')->with('success', 'Data updated successfully!');
    }
}