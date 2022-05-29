<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;

class StudentRegController extends Controller
{
    //  view
    public function view(){
        // dd('ok');
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = Year::orderBy('id', 'DESC')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'ASC')->first()->id;
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student-reg.view', $data);
    }

    //  year class wise search
    public function yearClassWise(Request $request){
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.student-reg.view', $data);
    }

    //  create
    public function create(){
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student-reg.create', $data);
    }
    //  store
    public function store(Request $request){
        DB::transaction(function() use($request){
            $checkYear = Year::findOrFail($request->year_id)->name;
            $student = User::where('usertype', 'student')->orderBy('id','DESC')->first();
            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId < 10 ) {
                   $id_no = '000'. $studentId;
                }
                elseif($studentId < 100){
                    $id_no = '00'. $studentId;
                }
                elseif($studentId < 1000){
                    $id_no = '0'. $studentId;
                }
            }
            else{
                $student = User::where('usertype', 'student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;
                if ($studentId < 10 ) {
                   $id_no = '000'. $studentId;
                }
                elseif($studentId < 100){
                    $id_no = '00'. $studentId;
                }
                elseif($studentId < 1000){
                    $id_no = '0'. $studentId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $code = rand(000000, 999999);

            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'student';
            $user->role = 'student';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            if ($request->file('image')) {
                $file = $request->file('image');
                $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/student_images'),$file_name);
                $user['image'] = $file_name;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->discount = $request->discount;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

            // dd($final_id_no);
        });
        return redirect()->route('students.registration.view')->with('success', 'Data inserted successfully!');
    }

    //  edit
    public function edit($student_id){
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] = AssignStudent::with('discount')->where('student_id',$student_id)->first();
        return view('backend.student.student-reg.create', $data);
    }

    //  update
    public function update(Request $request, $student_id){
        DB::transaction(function() use($request, $student_id){
            $user =User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/student_images'),$file_name);
                $user['image'] = $file_name;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();

            // dd($final_id_no);
        });
        return redirect()->route('students.registration.view')->with('success', 'Data updated successfully!');

    }

    //  promotion
    public function promotion($student_id){
        $data['years'] = Year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        $data['editData'] = AssignStudent::with('discount', 'student', 'student_class', 'year')->where('student_id',$student_id)->first();
        return view('backend.student.student-reg.promotion', $data);
    }

    //  promotion store
    public function promotionStore(Request $request, $student_id){
        DB::transaction(function() use($request, $student_id){
            $user =User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $file_name = date('YmdHi').'.'.$file->getClientOriginalExtension();
                $file->move(public_path('upload/student_images'),$file_name);
                $user['image'] = $file_name;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

            // dd($final_id_no);
        });
        return redirect()->route('students.registration.view')->with('success', 'Student promotion successfully!');
    }

    public function details($student_id){
        $allStudent['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->first();
        return view("backend.student.student-reg.reg-details", $allStudent);
    }
    public function download($student_id){
        $allStudent['stu'] = AssignStudent::with(['discount','student'])->where('student_id', $student_id)->first();
        $pdf = PDF::loadView('backend.pdf.student.reg-student-details', $allStudent);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
    }

}