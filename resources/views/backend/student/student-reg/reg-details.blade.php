@extends('layouts.admin-layout')

@section('title')
    ABC School | Student-Reg-Details
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Registration Details</h1>
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
                                            <a href="{{ route('students.registration.view') }}"
                                                class="btn btn-success btn-sm"> <i class="fa fa-list"></i> Student List
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-8 m-auto">
                                    <h5 class="text-center"
                                        style="font-weight: bold; padding-top: 10px;padding-bottom: 10px;">Student
                                        Registration Card</h5>
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">ID No</td>
                                                <td>{{ $stu['student']['id_no'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Student Name</td>
                                                <td>{{ $stu['student']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Father's Name</td>
                                                <td>{{ $stu['student']['fname'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Mother's Name</td>
                                                <td>{{ $stu['student']['mname'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Year</td>
                                                <td>{{ $stu['year']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Class</td>
                                                <td>{{ $stu['student_class']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Roll No</td>
                                                <td>{{ $stu['roll'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Mobile No</td>
                                                <td>{{ $stu['student']['mobile'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Address</td>
                                                <td>{{ $stu['student']['address'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Gender</td>
                                                <td>{{ $stu['student']['gender'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Religion</td>
                                                <td>{{ $stu['student']['religion'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 35%">Birthday</td>
                                                <td>{{ $stu['student']['dob'] }}</td>
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
