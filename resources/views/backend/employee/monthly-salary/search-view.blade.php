@extends('layouts.admin-layout')

@section('title')
    ABC School | Employee Monthly Salary View
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Monthly Salary</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight:bold">
                                    Select Date
                                </h3>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form method="GET" action="{{ route('employees.monthly.salary.get') }}" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" class="control-label">Date</label>
                                            <input type="date" name="date" id="date" value="{{ @$date }}" class="form-control form-control-sm"
                                                >
                                        </div>
                                        <div class="form-group col-md-2" style="margin-top: 30px; color:white">
                                            <button type="submit" class="btn btn-sm btn-success" id="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">

                                <table id="example1" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>ID No</th>
                                            <th>Employee Name</th>
                                            <th>Basic Salary</th>
                                            <th>Salary (This month)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            @php
                                                $totalattend = App\Models\EmployeeAttendance::with(['user'])->where($getDate)->where('employee_id', $item->employee_id)->get();
                                                $absentcount = count($totalattend->where('attend_status', 'Absent'));

                                                $salary = (float)$item['user']['salary'];
                                                $salaryperday = (float)$salary/30;
                                                $totalsalaryminus = (int)$absentcount * (float)$salaryperday;
                                                $totalsalary = (float)$salary - (float)$totalsalaryminus;
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->user->id_no }}</td>
                                                <td>{{ ucwords($item->user->name) }}</td>
                                                <td>{{ $salary.' TK.' }}</td>
                                                <td>{{ round($totalsalary).' TK.' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm" title="Pay Slip">Pay Slip</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.Left col -->

                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


@endsection
