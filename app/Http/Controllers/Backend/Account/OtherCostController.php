<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = AccountOtherCost::orderBy('id', 'desc')->get();
        // dd($data);
        return view('backend.accounts.cost.other-cost-view', $data);
    }

    //  add
    public function add(){
        return view('backend.accounts.cost.other-cost-add');
    }

    //  Store
     public function store(Request $request){
        // dd($request->all());
        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        if ($request->file('image')) {
            $file = $request->file('image');
            $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/cost_images'),$file_name);
            $cost['image'] = $file_name;
        }
        $cost->save();
        return redirect()->route('accounts.cost.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($id){
        $editData = AccountOtherCost::findOrFail($id);
        return view('backend.accounts.cost.other-cost-add',compact('editData'));
    }

    //  update
    public function update(Request $request, $id){
        // dd($request->all());
        $cost =AccountOtherCost::findOrFail($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        $cost->description = $request->description;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$cost->image));
            $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/cost_images'),$file_name);
            $cost['image'] = $file_name;
        }
        $cost->save();
        return redirect()->route('accounts.cost.view')->with('success', 'Data updated successfully!');
    }
}