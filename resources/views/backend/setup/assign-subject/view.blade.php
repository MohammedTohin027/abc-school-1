@extends('layouts.admin-layout')

@section('title')
    ABC School | Setup Assign Subject
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Assign Subject</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Setup</a></li>
                            <li class="breadcrumb-item"><a href="#">Assign Subject</a></li>
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
                                    Assign Subject List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('setup.assignsubject.create') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Add Assign Subject</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Class Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->stdent_class->name }}</td>
                                                {{-- <td>{{ ucwords($item->name) }}</td> --}}
                                                <td>
                                                    <a href="{{ route('setup.assignsubject.details', $item->class_id) }}" class="btn btn-success btn-sm" title="Edit"><i
                                                        class="fa fa-eye"></i></a>
                                                    <a href="{{ route('setup.assignsubject.edit', $item->class_id) }}" class="btn btn-primary btn-sm" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
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