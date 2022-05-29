@extends('layouts.admin-layout')

@section('title')
    ABC School | Student-Monthly-Fee-Details
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Monthly Fee Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                    Student Details
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('students.monthly.fee.view') }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-list"></i> Monthly Fee List
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-8 m-auto">
                                    <h5 class="text-center"
                                        style="font-weight: bold; padding-top: 10px;padding-bottom: 10px;">Student
                                        Monthly Fee</h5>
                                    @php
                                        $registrationfee = App\Models\FreeAmount::where('free_category_id', '2')
                                            ->where('class_id', $stu->class_id)
                                            ->first();
                                        $originalfee = $registrationfee->amount;
                                        $discount = $stu['discount']['discount'];
                                        $discountablefee = ($discount / 100) * $originalfee;
                                        $finalfee = (int) $originalfee - (int) $discountablefee;

                                    @endphp
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">ID No</td>
                                                <td>{{ $stu['student']['id_no'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Roll No</td>
                                                <td>{{ $stu['roll'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Student Name</td>
                                                <td>{{ $stu['student']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Father's Name</td>
                                                <td>{{ $stu['student']['fname'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Mother's Name</td>
                                                <td>{{ $stu['student']['mname'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Year</td>
                                                <td>{{ $stu['year']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Class</td>
                                                <td>{{ $stu['student_class']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Monthly Fee</td>
                                                <td>{{ $originalfee }} TK.</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Discount Fee</td>
                                                <td>{{ $discount }} %</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Fee (This Student) of {{ $month }}</td>
                                                <td>{{ $finalfee }} TK.</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <i style="font-size: 12px; ">Print Date : {{ date('d M Y') }}</i>
                                    <table border="0">
                                        <tbody>
                                            <tr>
                                                <td class="text-right" style="padding-left: 500px; padding-top:20px;">
                                                    <hr style="border:1px solid; width:100%; margin-bottom:0px;">
                                                    <p style="text-align: center">Principal / Headmaster</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
