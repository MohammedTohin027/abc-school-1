<?php

namespace App\Http\Controllers\Bacckend\Accounts;

use App\Models\Year;
use App\Models\FreeAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\AccountStudentFee;
use App\Models\StudentFreeCategory;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    //  view
    public function view(){
        $data['allData'] = AccountStudentFee::orderBy('id', 'desc')->get();
        return view('backend.accounts.student.view', $data);
    }
    //  create
    public function create(){
        // dd('ok');
        $data['years'] = Year::orderBy('name', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = StudentFreeCategory::all();
        return view('backend.accounts.student.create', $data);
        // return view('backend.accounts.student.search-view', $data);
    }

    //  getstudent
    public function getstudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));
        $data = AssignStudent::with(['discount'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        // dd($data);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        // $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $v) {
            $student_fee = FreeAmount::where('free_category_id', $fee_category_id)->where('class_id', $v->class_id)->first();
            // dd($student_fee);
            $accountStudentFees = AccountStudentFee::where('student_id', $v->student_id)->where('year_id', $v->year_id)->where('class_id', $v->class_id)->where('fee_category_id', $fee_category_id)->where('date', $date)->first();
            // dd($accountStudentFees);
            if ($accountStudentFees != null) {
               $checked = 'checked';
            } else {
                $checked = '';
            }
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'<input type="hidden" name="year_id" value="'.$v->year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['fname'].'<input type="hidden" name="class_id" value="'.$v->class_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student_fee->amount.'TK.'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';
            $originalfee = $student_fee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount / 100 * $originalfee;
            $finalfee = (int)$originalfee - (int)$discountablefee;
            $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-control" readonly>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$v->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;">'.'</td>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    //  Store
    public function store(Request $request){
        // dd($request->all());
        $date = date('Y-m', strtotime($request->date));
        AccountStudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('fee_category_id', $request->fee_category_id)->where('date', $date)->delete();
        $checkdata = $request->checkmanage;
        // dd($checkdata);
        if ($checkdata != null) {
            for ($i=0; $i < count($checkdata); $i++) {
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkdata)) {
            return redirect()->route('accounts.student.fee.view')->with('success', 'Well done! Successfully updated.');
        }
        else {
            return redirect()->back('error', 'Sorry! Data not save.');
        }
    }


}