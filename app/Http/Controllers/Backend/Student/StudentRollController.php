<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\Year;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;

class StudentRollController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.roll.view', $data);
    }

    //  get student ajax
    public function getStudent(Request $request){
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return response()->json($allData);
    }

    //  roll store
    public function store(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($request->student_id != null){
            for ($i=0; $i <count($request->student_id) ; $i++) {
                AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        }
        else{
            return redirect()->back()->with('success', 'Sorry! There are no Student');
        }
        return redirect()->back()->with('success', 'Successfully roll generated');
    }



}