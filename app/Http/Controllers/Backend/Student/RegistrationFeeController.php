<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\Year;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use App\Models\FreeAmount;

class RegistrationFeeController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        return view('backend.student.registration_fee.view', $data);
    }

    //  get student ajax
    public function getStudent(Request $request){
        // dd($request->all());
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::with(['discount','student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.registration_fee.search-view', $data);
    }

}