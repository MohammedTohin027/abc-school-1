@extends('layouts.admin-layout')

@section('title')
    @if (isset($editData))
    ABC School | Employee Leave Edit
    @else
    ABC School | Employee Leave Create
    @endif

@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Leave</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employee Leave</a></li>
                            @if(isset($editData))
                            <li class="breadcrumb-item active">Edit</li>
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
                                        Employee Leave Edit
                                    @else
                                        Employee Leave Create
                                    @endif

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('employees.leave.view') }}"> <i
                                                    class="fa fa-list"></i> Employee Leave List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ (@$editData) ? route('employees.leave.update', $editData->id) : route('employees.leave.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Employee Name <font style="color: red">*</font></label>
                                            <select class="form-control form-control-sm" name="employee_id">
                                                <option value="">Select Employee</option>
                                                @foreach ($employees as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ @$editData->employee_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Start Date <font style="color: red">*</font></label>
                                            <input id="start_date" class="form-control form-control-sm"
                                                autocomplete="off" type="date" name="start_date"
                                                value="{{ @$editData ? $editData->start_date : old('start_date') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>End Date <font style="color: red">*</font></label>
                                            <input id="end_date" class="form-control form-control-sm"
                                                autocomplete="off" type="date" name="end_date"
                                                value="{{ @$editData ? $editData->end_date : old('end_date') }}">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Leave Purpose <font style="color: red">*</font></label>
                                            <select class="form-control form-control-sm" id="leave_purpose_id" name="leave_purpose_id">
                                                <option value="">Select Employee</option>
                                                @foreach ($leave_purpose as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ @$editData->leave_purpose_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                                @endforeach
                                                <option value="0">New Purpose</option>
                                            </select>
                                            <input type="text" name="name" class="form-control form-control-sm" placeholder="Wirte Purpose" id="add_others" style="display: none">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData) ? 'Update' : 'Submit' }}</button>
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
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter Group name!",
                    },
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

    <script>
        $(document).ready(function(){
            $(document).on('click', '#leave_purpose_id', function(){
                var leave_purpose_id = $(this).val();
                if(leave_purpose_id == '0'){
                    $('#add_others').show();
                }
                else{
                    $('#add_others').hide();
                }
            });
        });
    </script>

@endsection
