<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\Year;
use App\Models\Subject;
use App\Models\ExanType;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use App\Models\StudentMarks;

class MarksController extends Controller
{
    //  create
    public function create(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExanType::all();
        return view('backend.marks.crate', $data);
   }

   public function store(Request $request){
       $sutdentcount = count($request->student_id);
        if($sutdentcount){
            for ($i=0; $i < count($request->student_id) ; $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }

        }
        return redirect()->back()->with('success', 'Marks inserted Successfully!');
    }

    public function edit(){
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExanType::all();
        return view('backend.marks.edit', $data);
    }

    public function getMarks(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $getStudent = StudentMarks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();
        return response()->json($getStudent);
    }

    public function update(Request $request){
        StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();
        $sutdentcount = count($request->student_id);
        if($sutdentcount){
            for ($i=0; $i < count($request->student_id) ; $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }

        }
        return redirect()->back()->with('success', 'Marks upsated Successfully!');
    }
}