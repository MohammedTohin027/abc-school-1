@extends('layouts.admin-layout')

@section('title')
    @if (isset($editData))
    ABC School | Employee Salary Increment
    @else
    ABC School | Employee Salary Increment
    @endif

@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Salary</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employee Salary</a></li>
                            @if(isset($editData))
                            <li class="breadcrumb-item active">Increment</li>
                            @else
                            <li class="breadcrumb-item active">Create</li>
                            @endif

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
                                    @if(isset($editData))
                                        Employee Salary Increment
                                    @else
                                        Add New Exam Type
                                    @endif

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('setup.student.examtype.view') }}"> <i
                                                    class="fa fa-list"></i> Employee List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('employees.salary.increment.store', $editData->id) }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="increment_salary">Salary Amount</label>
                                            <input id="increment_salary" class="form-control" type="text" name="increment_salary" value="{{ old('increment_salary') }}">
                                            
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="effected_date">Effected Date</label>
                                            <input id="effected_date" class="form-control" type="date" name="effected_date" value="{{ old('effected_date') }}">
                                            
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 35px">
                                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </form>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    increment_salary: {
                        required: true,
                    },
                    effected_date: {
                        required: true,
                    },
                },
                messages: {
                    
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

@endsection
