@extends('layouts.admin-layout')

@section('title')
    ABC School | Employee View
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                    Employee List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('employees.registration.create') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Add Employee</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Join Date</th>
                                            <th>Salary</th>
                                            @if (Auth::user()->role == "admin")
                                            <th>Code</th>
                                            @endif                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ ucwords($item->name) }}</td>
                                                <td>{{ $item->id_no }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->gender }}</td>
                                                <td>{{ $item->join_date }}</td>
                                                <td>{{ $item->salary }}</td>
                                                @if (Auth::user()->role == "admin")
                                                <td>{{ $item->code }}</td>
                                                @endif    
                                                <td>
                                                    <a href="{{ route('employees.registration.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    {{-- <a href="{{ route('setup.student.class.delete', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete"><i
                                                            class="fa fa-trash"></i></a> --}}
                                                </td>
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
