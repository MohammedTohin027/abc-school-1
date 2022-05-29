<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\StudentFreeCategory;
use App\Http\Controllers\Controller;
use App\Models\FreeAmount;
use App\Models\StudentClass;

class FreeAmountController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['allData'] = FreeAmount::select('free_category_id')->groupBy('free_category_id')->get();
        return view('backend.setup.student.free-amount.view', $data);
    }

    //create
    public function create(){
        // dd('ok');
        $data['fee_categoies'] = StudentFreeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.student.free-amount.create', $data);
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'free_category_id' => 'required',
        //     'class_id[]' => 'required',
        //     'amount[]' => 'required',
        // ]);
        $countClass = count($request->class_id);
        if($countClass != null){
            for($i= 0 ; $i <  $countClass; $i++ ){
                $fee_amount = new FreeAmount();
                $fee_amount->free_category_id = $request->free_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        return redirect()->route('setup.student.free.amount.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($id){
        // dd($id);
        $data['editData'] = FreeAmount::where('free_category_id', $id)->get();
        // dd($data['editData'])->toArray();
        $data['fee_categoies'] = StudentFreeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.student.free-amount.edit', $data);
    }

    //  update
    public function update(Request $request, $id){
        // dd($id);
        // exit();
        // dd($request->all());

        if ($request->class_id != null) {
            FreeAmount::where('free_category_id', $id)->delete();
            $countClass = count($request->class_id);
            for ($i=0; $i < $countClass ; $i++) {
                $fee_amount = new FreeAmount();
                $fee_amount->free_category_id = $request->free_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        else{
            return redirect()->back()->with('error', 'Sorry, you do not select any item!');
        }
        return redirect()->route('setup.student.free.amount.view')->with('success', 'Data updated successfully!');
    }
    
    //  details
    public function details($id){
        $data['details'] = FreeAmount::where('free_category_id', $id)->get();
        return view('backend.setup.student.free-amount.details', $data);
    }
}