@extends('layouts.admin-layout')

@section('title')
    ABC School | Marksheet Generate
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Marksheet Generate</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Marksheet Generate</a></li>
                            <li class="breadcrumb-item active">View</li>
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
                                    Student Marksheet
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            {{-- <a href="{{ route('accounts.employee.salary.add') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Add/Edit Employee Salary</a> --}}
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <br>

                            <div class="card-body">
                                <div class="row" style="border: 1px solid #666666">
                                    <table width="80%">
                                        <tr>
                                            <td width="33%" class="text-center">
                                                <img src="{{ url('public/upload/school_image/abc_school.png') }}" alt=""
                                                    style="width: 80px; height: 80px;">
                                            </td>
                                            <td class="text-center" width="63%">
                                                <h4><strong>ABC School</strong></h4>
                                                <h6><strong>Dhaka, Notun Bazar</strong></h6>
                                                <h6><strong><u><i>Academic Transcript</i></u></strong></h6>
                                                <h6>
                                                    {{-- <strong>
                                                        {{ $allMarks }}
                                                    </strong> --}}
                                                </h6>
                                            </td>
                                            <td class="text-center">
                                                {{-- <img src="{{ url('public/upload/student_images/' . $stu['student']['image']) }}" alt=""
                                                    style="width: 80px; height: 80px;"> --}}
                                            </td>
                                        </tr>
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
