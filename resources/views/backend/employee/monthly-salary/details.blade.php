@extends('layouts.admin-layout')

@section('title')
    ABC School | Employee-Monthly-Salary-Details
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Employee Monthly Salary Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employee</a></li>
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
                                    Employee Monthly Salary Details
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('students.monthly.fee.view') }}"
                                                class="btn btn-success btn-sm">
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
                                        $date = date('Y-m', strtotime($details['0']->date));
                                        if ($date != '') {
                                            $where[] = ['date', 'like', $date . '%'];
                                        }
                                        $totalattend = App\Models\EmployeeAttendance::with(['user'])
                                            ->where($where)
                                            ->where('employee_id', $details['0']['employee_id'])
                                            ->get();
                                        // dd($totalattend);
                                        $salary = (float) $details['0']['user']['salary'];
                                        $salaryperday = (float) $salary / 30;
                                        $absentcount = count($totalattend->where('attend_status', 'Absent'));
                                        // dd($absentcount);
                                        $leavecount = count($totalattend->where('attend_status', 'Leave'));
                                        $totalsalaryminus = (float) $absentcount * (float) $salaryperday;
                                        $totalsalary = (float)$salary - (float)$totalsalaryminus;
                                    @endphp
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">ID No</td>
                                                <td>{{ $details['0']['user']['id_no'] }}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-bold" style="width: 40%">Employee Name</td>
                                                <td>{{ $details['0']['user']['name'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Basic Salary</td>
                                                <td>{{ $salary }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Total absend for this month</td>
                                                <td>{{ $absentcount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Total leave for this month</td>
                                                <td>{{ $leavecount }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Month</td>
                                                <td>{{ date("M - Y", strtotime($details['0']->date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold" style="width: 40%">Salary for this month</td>
                                                <td>{{ round($totalsalary) }}</td>
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
