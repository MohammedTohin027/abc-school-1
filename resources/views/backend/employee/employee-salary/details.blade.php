@extends('layouts.admin-layout')

@section('title')
    ABC School | Employee Salary Details
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Employee Salary Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employee Salary</a></li>
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
                                    Employee Salary Details Info
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('employees.salary.view') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-list"></i> Employee List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <strong>Employee Name: </strong>{{ $details->name }} <br>
                                <strong>ID No: </strong>{{ $details->id_no }}  <p></p>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Present Salary</th>
                                            <th>Increment Salary</th>
                                            <th>Previous Salary</th>
                                            <th>Effected Date</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salary_log as $key => $item)
                                            <tr>
                                                @if ($key==0)
                                                    <td class="text-center" colspan="5"><strong>Joining Salary: </strong>{{ $item->previous_salary }}</td>
                                                @else                                                
                                                <td>{{ $key + 1 }}</td>                                                
                                                <td>{{ $item->present_salary }}</td>
                                                <td>{{ $item->increment_salary }}</td>
                                                <td>{{ $item->previous_salary }}</td>
                                                <td>{{ date('d-m-Y',strtotime($item->effected_date)) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
