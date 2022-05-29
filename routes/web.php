<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Marks\GradeController;
use App\Http\Controllers\Backend\Setup\SubjectController;
use App\Http\Controllers\Backend\Student\MarksController;
use App\Http\Controllers\Backend\Setup\ExanTypeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Setup\FreeAmountController;
use App\Http\Controllers\Backend\Setup\StudentRegController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Bacckend\Accounts\StudentFeeController;
use App\Http\Controllers\Backend\Account\AccountEmployeeSalaryController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Student\StudentRegFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendController;
use App\Http\Controllers\Backend\Report\ProfitController;
// use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Setup\StudentFreeCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    //  manage user route
    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'view'])->name('user.view');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });
    //  manage profile route
    Route::prefix('profiles')->group(function () {
        Route::get('/view', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
    });
    //  student class route
    Route::prefix('setup/student')->group(function () {
        Route::get('class/create', [StudentClassController::class, 'create'])->name('setup.student.class.create');
        Route::get('class/view', [StudentClassController::class, 'view'])->name('setup.student.class.view');
        Route::post('class/store', [StudentClassController::class, 'store'])->name('setup.student.class.store');
        Route::get('class/edit/{id}', [StudentClassController::class, 'edit'])->name('setup.student.class.edit');
        Route::post('class/update/{id}', [StudentClassController::class, 'update'])->name('setup.student.class.update');
        Route::get('class/delete/{id}', [StudentClassController::class, 'delete'])->name('setup.student.class.delete');
        // Route::post('delete', [StudentClassController::class, 'delete'])->name('setup.student.class.delete');
    });
    //  student year route
    Route::prefix('setup/student')->group(function () {
        Route::get('/year/view', [StudentYearController::class, 'view'])->name('setup.student.year.view');
        Route::get('/year/create', [StudentYearController::class, 'create'])->name('setup.student.year.create');
        Route::post('/year/store', [StudentYearController::class, 'store'])->name('setup.student.year.store');
        Route::get('/year/edit/{id}', [StudentYearController::class, 'edit'])->name('setup.student.year.edit');
        Route::post('/year/update/{id}', [StudentYearController::class, 'update'])->name('setup.student.year.update');
        // Route::get('/year/delete/{id}', [StudentYearController::class, 'delete'])->name('setup.student.year.delete');
    });
    //  student group route
    Route::prefix('setup/student')->group(function () {
        Route::get('/group/view', [StudentGroupController::class, 'view'])->name('setup.student.group.view');
        Route::get('/group/create', [StudentGroupController::class, 'create'])->name('setup.student.group.create');
        Route::post('/group/store', [StudentGroupController::class, 'store'])->name('setup.student.group.store');
        Route::get('/group/edit/{id}', [StudentGroupController::class, 'edit'])->name('setup.student.group.edit');
        Route::post('/group/update/{id}', [StudentGroupController::class, 'update'])->name('setup.student.group.update');
        // Route::get('/group/delete/{id}', [StudentGroupController::class, 'delete'])->name('setup.student.group.delete');
    });
    //  student shift  route
    Route::prefix('setup/student')->group(function () {
        Route::get('/shift/view', [StudentShiftController::class, 'view'])->name('setup.student.shift.view');
        Route::get('/shift/create', [StudentShiftController::class, 'create'])->name('setup.student.shift.create');
        Route::post('/shift/store', [StudentShiftController::class, 'store'])->name('setup.student.shift.store');
        Route::get('/shift/edit/{id}', [StudentShiftController::class, 'edit'])->name('setup.student.shift.edit');
        Route::post('/shift/update/{id}', [StudentShiftController::class, 'update'])->name('setup.student.shift.update');
        // Route::get('/shift/delete/{id}', [StudentShiftController::class, 'delete'])->name('setup.student.shift.delete');
    });
    //  student free category  route
    Route::prefix('setup/student')->group(function () {
        Route::get('/free-category/view', [StudentFreeCategoryController::class, 'view'])->name('setup.student.free.category.view');
        Route::get('/free-category/create', [StudentFreeCategoryController::class, 'create'])->name('setup.student.free.category.create');
        Route::post('/free-category/store', [StudentFreeCategoryController::class, 'store'])->name('setup.student.free.category.store');
        Route::get('/free-category/edit/{id}', [StudentFreeCategoryController::class, 'edit'])->name('setup.student.free.category.edit');
        Route::post('/free-category/update/{id}', [StudentFreeCategoryController::class, 'update'])->name('setup.student.free.category.update');
        // Route::get('/free-category/delete/{id}', [StudentFreeCategoryController::class, 'delete'])->name('setup.student.free.category.delete');
    });
    //  free amount  route
    Route::prefix('setup/student')->group(function () {
        Route::get('/free-amount/view', [FreeAmountController::class, 'view'])->name('setup.student.free.amount.view');
        Route::get('/free-amount/create', [FreeAmountController::class, 'create'])->name('setup.student.free.amount.create');
        Route::post('/free-amount/store', [FreeAmountController::class, 'store'])->name('setup.student.free.amount.store');
        Route::get('/free-amount/edit/{id}', [FreeAmountController::class, 'edit'])->name('setup.student.free.amount.edit');
        Route::post('/free-amount/update/{id}', [FreeAmountController::class, 'update'])->name('setup.student.free.amount.update');
        Route::get('/free-amount/details/{id}', [FreeAmountController::class, 'details'])->name('setup.student.free.amount.details');
    });
    //  exam type  route
    Route::prefix('setup/student')->group(function () {
        Route::get('/exam-type/view', [ExanTypeController::class, 'view'])->name('setup.student.examtype.view');
        Route::get('/exam-type/create', [ExanTypeController::class, 'create'])->name('setup.student.examtype.create');
        Route::post('/exam-type/store', [ExanTypeController::class, 'store'])->name('setup.student.examtype.store');
        Route::get('/exam-type/edit/{id}', [ExanTypeController::class, 'edit'])->name('setup.student.examtype.edit');
        Route::post('/exam-type/update/{id}', [ExanTypeController::class, 'update'])->name('setup.student.examtype.update');
    });
    //  subject route
    Route::prefix('setup/student')->group(function () {
        Route::get('/subject/view', [SubjectController::class, 'view'])->name('setup.subject.view');
        Route::get('/subject/create', [SubjectController::class, 'create'])->name('setup.subject.create');
        Route::post('/subject/store', [SubjectController::class, 'store'])->name('setup.subject.store');
        Route::get('/subjecte/edit/{id}', [SubjectController::class, 'edit'])->name('setup.subject.edit');
        Route::post('/subject/update/{id}', [SubjectController::class, 'update'])->name('setup.subject.update');
    });
    //  assign subject route
    Route::prefix('setup/student')->group(function () {
        Route::get('/assign-subject/view', [AssignSubjectController::class, 'view'])->name('setup.assignsubject.view');
        Route::get('/assign-subject/create', [AssignSubjectController::class, 'create'])->name('setup.assignsubject.create');
        Route::post('/assign-subject/store', [AssignSubjectController::class, 'store'])->name('setup.assignsubject.store');
        Route::get('/assign-subject/edit/{class_id}', [AssignSubjectController::class, 'edit'])->name('setup.assignsubject.edit');
        Route::post('/assign-subject/update/{class_id}', [AssignSubjectController::class, 'update'])->name('setup.assignsubject.update');
        Route::get('/assign-subject/details/{class_id}', [AssignSubjectController::class, 'details'])->name('setup.assignsubject.details');
    });
    //  subject route
    Route::prefix('setup/student')->group(function () {
        Route::get('/designation/view', [DesignationController::class, 'view'])->name('setup.designation.view');
        Route::get('/designation/create', [DesignationController::class, 'create'])->name('setup.designation.create');
        Route::post('/designation/store', [DesignationController::class, 'store'])->name('setup.designation.store');
        Route::get('/designation/edit/{id}', [DesignationController::class, 'edit'])->name('setup.designation.edit');
        Route::post('/designation/update/{id}', [DesignationController::class, 'update'])->name('setup.designation.update');
    });
    //  Student Registration route
    Route::prefix('students')->group(function () {
        Route::get('/reg/view', [StudentRegController::class, 'view'])->name('students.registration.view');
        Route::get('/year-class-wise', [StudentRegController::class, 'yearClassWise'])->name('students.year.class.wies');
        Route::get('/reg/create', [StudentRegController::class, 'create'])->name('students.registration.create');
        Route::post('/reg/store', [StudentRegController::class, 'store'])->name('students.registration.store');
        Route::get('/reg/edit/{student_id}', [StudentRegController::class, 'edit'])->name('students.registration.edit');
        Route::post('/reg/update/{student_id}', [StudentRegController::class, 'update'])->name('students.registration.update');
        Route::get('/reg/promotion/{student_id}', [StudentRegController::class, 'promotion'])->name('students.registration.promotion');
        Route::post('/reg/promotion/{student_id}', [StudentRegController::class, 'promotionStore'])->name('students.promotion.store');
        Route::get('/reg/details/{student_id}', [StudentRegController::class, 'details'])->name('students.registration.details');
        Route::get('/reg/download/{student_id}', [StudentRegController::class, 'download'])->name('students.registration.download');

        //  Student Roll Generate
        Route::get('/roll/view', [StudentRollController::class, 'view'])->name('student.roll.view');
        Route::get('/roll/get-student', [StudentRollController::class, 'getStudent'])->name('students.roll.get-student');
        Route::post('/roll/store', [StudentRollController::class, 'store'])->name('student.roll.store');

        //  Student Roll Generate
        Route::get('/reg/fee/view', [StudentRegFeeController::class, 'view'])->name('student.reg.fee.view');
        Route::get('/reg/get-student', [StudentRegFeeController::class, 'getStudent'])->name('student.reg.get-student');
        Route::get('/reg/fee/pay-slip', [StudentRegFeeController::class, 'payslip'])->name('students.reg.fee.payslip');
        Route::get('/reg/fee/details', [StudentRegFeeController::class, 'details'])->name('students.reg.fee.details');

        //  student registration fee
        // Route::get('/reg/fee/view', [RegistrationFeeController::class, 'view'])->name('students.reg.fee.view');
        // Route::get('/reg/get-student', [RegistrationFeeController::class, 'getStudent'])->name('students.reg.fee.get-student');
        // Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'payslip'])->name('students.reg.fee.payslip');

        //  student monthly fee
        Route::get('/month/fee/view', [MonthlyFeeController::class, 'view'])->name('students.monthly.fee.view');
        Route::get('/month/get-student', [MonthlyFeeController::class, 'getStudent'])->name('students.monthly.fee.get-student');
        Route::get('/month/fee/payslip', [MonthlyFeeController::class, 'payslip'])->name('students.monthly.fee.payslip');
        Route::get('/month/fee/details', [MonthlyFeeController::class, 'details'])->name('students.month.fee.details');

        //  student exam fee
        Route::get('/exam/fee/view', [ExamFeeController::class, 'view'])->name('students.exam.fee.view');
        Route::get('/exam/get-student', [ExamFeeController::class, 'getStudent'])->name('students.exam.fee.get-student');
        Route::get('/exam/fee/payslip', [ExamFeeController::class, 'payslip'])->name('students.exam.fee.payslip');
        Route::get('/exam/fee/details', [ExamFeeController::class, 'details'])->name('students.exam.fee.details');

    });

    //  employees route
    Route::prefix('employees')->group(function () {
        // employees registration
        Route::get('/reg/view', [EmployeeRegController::class, 'view'])->name('employees.registration.view');
        Route::get('/reg/create', [EmployeeRegController::class, 'create'])->name('employees.registration.create');
        Route::post('/reg/store', [EmployeeRegController::class, 'store'])->name('employees.registration.store');
        Route::get('/reg/edit/{id}', [EmployeeRegController::class, 'edit'])->name('employees.registration.edit');
        Route::post('/reg/update/{id}', [EmployeeRegController::class, 'update'])->name('employees.registration.update');
        Route::get('/reg/promotion/{student_id}', [EmployeeRegController::class, 'promotion'])->name('employees.registration.promotion');
        Route::post('/reg/promotion/{student_id}', [EmployeeRegController::class, 'promotionStore'])->name('employees.promotion.store');
        // employees salary
        Route::get('/salary/view', [EmployeeSalaryController::class, 'view'])->name('employees.salary.view');
        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'increment'])->name('employees.salary.increment');
        Route::post('/salary/store/{id}', [EmployeeSalaryController::class, 'store'])->name('employees.salary.increment.store');
        Route::get('/salary/details/{id}', [EmployeeSalaryController::class, 'details'])->name('employees.salary.details');
        // Route::post('/salary/promotion/{student_id}', [EmployeeSalaryController::class, 'promotionStore'])->name('employees.salary.store');

        // employees Leave
        Route::get('/leave/view', [EmployeeLeaveController::class, 'view'])->name('employees.leave.view');
        Route::get('/leave/create', [EmployeeLeaveController::class, 'create'])->name('employees.leave.create');
        Route::post('/leave/store', [EmployeeLeaveController::class, 'store'])->name('employees.leave.store');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'edit'])->name('employees.leave.edit');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'update'])->name('employees.leave.update');

        // employees attendance
        Route::get('/attend/view', [EmployeeAttendController::class, 'view'])->name('employees.attendance.view');
        Route::get('/attend/create', [EmployeeAttendController::class, 'create'])->name('employees.attendance.create');
        Route::post('/attend/store', [EmployeeAttendController::class, 'store'])->name('employees.attendance.store');
        Route::get('/attend/edit/{date}', [EmployeeAttendController::class, 'edit'])->name('employees.attendance.edit');
        Route::get('/attend/details/{date}', [EmployeeAttendController::class, 'details'])->name('employees.attendance.details');

        // employees monthly salary
        Route::get('/monthly/salary/view', [MonthlySalaryController::class, 'view'])->name('employees.monthly.salary.view');
        Route::get('/monthly/salary/get', [MonthlySalaryController::class, 'getSalary'])->name('employees.monthly.salary.get');
        // Route::get('/monthly/salary/get', [MonthlySalaryController::class, 'getSutent'])->name('employees.monthly.salary.get');
        Route::get('/monthly/salary/payslip/{employee_id}', [MonthlySalaryController::class, 'paySlip'])->name('employees.monthly.salary.payslip');
        Route::get('/monthly/salary/details/{employee_id}', [MonthlySalaryController::class, 'details'])->name('employees.monthly.salary.details');

    });

    //  Marks Route
    Route::prefix('marks')->group(function () {
        Route::get('/create', [MarksController::class, 'create'])->name('marks.create');
        Route::post('/store', [MarksController::class, 'store'])->name('marks.store');
        Route::get('/edit', [MarksController::class, 'edit'])->name('marks.edit');
        Route::post('/update', [MarksController::class, 'update'])->name('marks.update');
        Route::get('/get-student-marks', [MarksController::class, 'getMarks'])->name('get-student-marks');

        // grade point
        Route::get('/grade/view', [GradeController::class, 'view'])->name('marks.grade.view');
        Route::get('/grade/create', [GradeController::class, 'create'])->name('marks.grade.create');
        Route::post('/grade/store', [GradeController::class, 'store'])->name('marks.grade.store');
        Route::get('/grade/edit/{id}', [GradeController::class, 'edit'])->name('marks.grade.edit');
        Route::post('/grade/update/{id}', [GradeController::class, 'update'])->name('marks.grade.update');

    });

    //  Accounts Route
    Route::prefix('accounts')->group(function () {
        // Student Fee
        Route::get('/student/fee/view', [StudentFeeController::class, 'view'])->name('accounts.student.fee.view');
        Route::get('/student/fee/create', [StudentFeeController::class, 'create'])->name('accounts.student.fee.create');
        Route::post('/student/fee/store', [StudentFeeController::class, 'store'])->name('accounts.student.fee.store');
        Route::get('/student/fee/getstudent', [StudentFeeController::class, 'getstudent'])->name('accounts.student.fee.getStudent');
        // Employee Salary
        Route::get('/employee/salary/view', [AccountEmployeeSalaryController::class, 'view'])->name('accounts.employee.salary.view');
        Route::get('/employee/salary/add', [AccountEmployeeSalaryController::class, 'add'])->name('accounts.employee.salary.add');
        Route::post('/employee/salary/store', [AccountEmployeeSalaryController::class, 'store'])->name('accounts.employee.salary.store');
        Route::get('/employee/get-employee', [AccountEmployeeSalaryController::class, 'getEmployee'])->name('accounts.employee.get-employee');
        // Other Cost
        Route::get('/cost/view', [OtherCostController::class, 'view'])->name('accounts.cost.view');
        Route::get('/cost/add', [OtherCostController::class, 'add'])->name('accounts.cost.add');
        Route::post('/cost/store', [OtherCostController::class, 'store'])->name('accounts.cost.store');
        Route::get('/cost/edit/{id}', [OtherCostController::class, 'edit'])->name('accounts.cost.edit');
        Route::post('/cost/update/{id}', [OtherCostController::class, 'update'])->name('accounts.cost.update');

    });

    Route::get('/get-student', [DefaultController::class, 'getStudent'])->name('get-student');
    Route::get('/get-subject', [DefaultController::class, 'getSubject'])->name('get-subject');

     //  Accounts Route
    Route::prefix('reports')->group(function () {
        // Student Fee
        Route::get('/profit/view', [ProfitController::class, 'view'])->name('roports.profit.view');
        Route::get('/profit/get', [ProfitController::class, 'profit'])->name('roports.profit.datewise.get');
        Route::get('/profit/pdf', [ProfitController::class, 'pdf'])->name('roports.profit.pdf');
        Route::get('/profit/details', [ProfitController::class, 'details'])->name('roports.profit.details');
        // Mark Sheet
        Route::get('/marksheet/view', [ProfitController::class, 'markSheetView'])->name('roports.marksheet.view');
        Route::post('/marksheet/get', [ProfitController::class, 'markSheetGet'])->name('roports.marksheet.get');
    });





});