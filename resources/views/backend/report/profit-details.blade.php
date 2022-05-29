@extends('layouts.admin-layout')

@section('title')
    ABC School | Monthly/Yearly Profit
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Monthly/Yearly Profit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Monthly/Yearly Profit</a></li>
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
                                    Select Criteria
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

                            <div class="col-md-8 m-auto">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <h5 class="text-bold">Reporting Date : {{ date('d M Y', strtotime($start_date)) }} - {{ date('d M Y', strtotime($end_date)) }}</h5>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td><h6 class="text-bold">Purpose</h6></td>
                                            <td><h6 class="text-bold">Amount</h6></td>
                                        </tr>
                                        <tr>
                                            <td>Student Fee</td>
                                            <td>{{ $student_fee }} TK.</td>
                                        </tr>
                                        <tr>
                                            <td>Employee Salary</td>
                                            <td>{{ $emp_salary }} TK.</td>
                                        </tr>
                                        <tr>
                                            <td>Other Cost</td>
                                            <td>{{ $other_cost }} TK.</td>
                                        </tr>
                                        <tr>
                                            <td><h6 class="text-bold">Total Cost</h6></td>
                                            <td><h6 class="text-bold">{{ $total_cost }} TK.</h6></td>
                                        </tr>
                                        <tr>
                                            <td><h6 class="text-bold">Profit</h6></td>
                                            <td><h6 class="text-bold">{{ $profit }} TK.</h6></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <i style="font-size: 10px; margin-top:15px;">Print Date : {{ date('d M Y') }}</i>
                            </div> <br>

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
