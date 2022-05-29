<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\Subject;
use App\Models\FreeAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssignSubjectController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign-subject.view', $data);
    }

    //create
    public function create(){
        $data['classes'] = StudentClass::all();
        $data['subjects'] = Subject::all();
        return view('backend.setup.assign-subject.create', $data);
    }

    //  store
    public function store(Request $request){
        // dd($request->all());
        $countSubject = count($request->subject_id);
        if($countSubject != null){
            for($i= 0 ; $i <  $countSubject; $i++ ){
                $assign_sub = new AssignSubject();
                $assign_sub->class_id = $request->class_id;
                $assign_sub->subject_id = $request->subject_id[$i];
                $assign_sub->full_mark = $request->full_mark[$i];
                $assign_sub->pass_mark = $request->pass_mark[$i];
                $assign_sub->subjective_mark = $request->subjective_mark[$i];
                $assign_sub->save();
            }
        }
        return redirect()->route('setup.assignsubject.view')->with('success', 'Data inserted Successfully!');
    }

    //  edit
    public function edit($class_id){
        $data['editData'] = AssignSubject::where('class_id', $class_id)->get();
        $data['classes'] = StudentClass::all();
        $data['subjects'] = Subject::all();
        return view('backend.setup.assign-subject.edit', $data);
    }

    //  update
    public function update(Request $request, $class_id){
        // dd($id);
        // exit();
        // dd($request->all());

        if ($request->subject_id != null) {

            AssignSubject::whereNotIn('subject_id', $request->subject_id)->where('class_id', $request->class_id)->delete();


            foreach ($request->subject_id as $key => $value) {
                $assign_subject_exist = AssignSubject::where('subject_id', $request->subject_id[$key])->where('class_id',$request->class_id)->first();
                if ($assign_subject_exist) {
                    $assignSujects = $assign_subject_exist;
                }
                else{
                    $assignSujects = new AssignSubject();
                }
                    $assignSujects->class_id = $request->class_id;
                    $assignSujects->subject_id = $request->subject_id[$key];
                    $assignSujects->full_mark = $request->full_mark[$key];
                    $assignSujects->pass_mark = $request->pass_mark[$key];
                    $assignSujects->subjective_mark = $request->subjective_mark[$key];
                    // $assignSujects->updated_by = Auth::user()->id;
                    $assignSujects->save();
                }
            }
            else{
                return redirect()->back()->with('error', 'Sorry, you do not select any item!');
            }
    return redirect()->route('setup.assignsubject.view')->with('success', 'Data updated successfully!');
    }

    // details
    public function details($class_id){
    // dd($class_id);
    $data['details'] = AssignSubject::where('class_id', $class_id)->get();
    return view('backend.setup.assign-subject.details', $data);
    }
    }