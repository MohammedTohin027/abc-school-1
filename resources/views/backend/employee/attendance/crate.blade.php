@extends('layouts.admin-layout')

@section('title')
    @if (isset($editData))
    ABC School | Employee Attendance Edit
    @else
    ABC School | Employee Attendance Create
    @endif

@endsection

@section('dashboard-content')

<link rel="stylesheet" href="{{ asset("public/common/attend/attend.css") }}">
<style>
    .switch-toggle{
        width: auto;
    }
    .switch-toggle label:not(.disabled){
        cursor: pointer;
    }
    .switch-candy a{
        border: 1px solid #333;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.45);
        background-color: white;
        background-image: -webkit-linear-gradient(to top, rgba(255, 255, 255, 0.2), transparent);
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
    }
    .switch-toggle.switch-candy, .switch-light.switch-candy > span{
        background-color: #5a6268;
        border-radius: 3px;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2)
    }

</style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Attendance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Employee Attendance</a></li>
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
                                        Edit Employee Attendance
                                    @else
                                        Add Employee Attendance
                                    @endif

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('employees.attendance.view') }}"> <i
                                                    class="fa fa-list"></i> Employee Attendance List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('employees.attendance.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    @if (isset($editData))
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Attendance Date <font style="color: red">*</font></label>
                                            <input id="date" class="form-control form-control-sm"
                                                autocomplete="off" type="date" name="date"
                                                value="{{ $editData['0']['date'] }}" readonly>
                                        </div>
                                        <table class="table-sm table-bordered table-striped db-responsive" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
                                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                                                    <th colspan="3" class="text-center" style="vertical-align: middle; width:25%">Attendance status</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center btn persent_all" style="display: table-cell; background: #114190">Present</th>
                                                    <th class="text-center btn leave_all" style="display: table-cell; background: #114190">Leave</th>
                                                    <th class="text-center btn absent_all" style="display: table-cell; background:#114190">Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($editData as $key => $data)
                                                    <tr id="div{{ $data->id }}" class="text-center">
                                                        <input type="hidden" name="employee_id[]" value="{{ $data->employee_id }}" class="employee_id">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $data->user->name }}</td>
                                                        <td colspan="3">
                                                            <div class="switch-toggle switch-3 switch-candy">

                                                                <input class="present" id="present{{ $key }}" name="attend_status{{ $key }}" value="Present" type="radio" {{ ($data->attend_status == 'Present') ? 'checked' : '' }}>
                                                                <label for="present{{ $key }}">Present</label>

                                                                <input class="leave" id="leave{{ $key }}" name="attend_status{{ $key }}" value="Leave" type="radio" {{ ($data->attend_status == 'Leave') ? 'checked' : '' }}>
                                                                <label for="leave{{ $key }}">Leave</label>

                                                                <input class="absent" id="absent{{ $key }}" name="attend_status{{ $key }}" value="Absent" type="radio" {{ ($data->attend_status == 'Absent') ? 'checked' : '' }}>
                                                                <label for="absent{{ $key }}">Absent</label>
                                                                <a></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="form-group col-md-4" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData) ? 'Update' : 'Submit' }}</button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Attendance Date <font style="color: red">*</font></label>
                                            <input id="date" class="form-control form-control-sm"
                                                autocomplete="off" type="date" name="date"
                                                value="{{ old('date') }}">
                                        </div>
                                        <table class="table-sm table-bordered table-striped db-responsive" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
                                                    <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                                                    <th colspan="3" class="text-center" style="vertical-align: middle; width:25%">Attendance status</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center btn persent_all" style="display: table-cell; background: #114190">Present</th>
                                                    <th class="text-center btn leave_all" style="display: table-cell; background: #114190">Leave</th>
                                                    <th class="text-center btn absent_all" style="display: table-cell; background:#114190">Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $key => $employee)
                                                    <tr id="div{{ $employee->id }}" class="text-center">
                                                        <input type="hidden" name="employee_id[]" value="{{ $employee->id }}" class="employee_id">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td colspan="3">
                                                            <div class="switch-toggle switch-3 switch-candy">

                                                                <input class="present" id="present{{ $key }}" name="attend_status{{ $key }}" value="Present" type="radio" checked="checked">
                                                                <label for="present{{ $key }}">Present</label>

                                                                <input class="leave" id="leave{{ $key }}" name="attend_status{{ $key }}" value="Leave" type="radio">
                                                                <label for="leave{{ $key }}">Leave</label>

                                                                <input class="absent" id="absent{{ $key }}" name="attend_status{{ $key }}" value="Absent" type="radio">
                                                                <label for="absent{{ $key }}">Absent</label>
                                                                <a></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="form-group col-md-4" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData) ? 'Update' : 'Submit' }}</button>
                                        </div>
                                    </div>
                                    @endif

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

    <script>
        $(document).on('click', '.present', function(){
            $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6').css('color','#495057');
        });
        $(document).on('click', '.leave', function(){
            $(this).parents('tr').find('.datetime').css('pointer-events', '').css('background-color', 'white').css('color','#495057');
        });
        $(document).on('click', '.absent', function(){
            $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6').css('color','#495057');
        });
    </script>
    <script>
        $(document).on('click', '.persent_all', function(){
            $("input[value=Present]").prop('checked', true);
            $('.datetime').css('pointer-events', 'none').css('background-color','#dee2e6').css('color','#495057');
        });
        $(document).on('click', '.leave_all', function(){
            $("input[value=Leave]").prop('checked', true);
            $('.datetime').css('pointer-events', '').css('background-color','white').css('color','#495057');
        });
        $(document).on('click', '.absent_all', function(){
            $("input[value=Absent]").prop('checked', true);
            $('.datetime').css('pointer-events', 'none').css('background-color','#dee2e6').css('color','#495057');
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    date: {
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
