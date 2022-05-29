@extends('layouts.admin-layout')

@section('title')
    @if (isset($editData))
        ABC School | Employee Edit
    @else
        ABC School | Employee Create
    @endif

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
                            <li class="breadcrumb-item"><a href="#">Employee</a></li>
                            @if (isset($editData))
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
                                <h3 class="card-title" style="font-weight:bold; font-size:20px">
                                    @if (isset($editData))
                                        Edit Employee
                                    @else
                                        Add Employee
                                    @endif

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('employees.registration.view') }}"> <i
                                                    class="fa fa-list"></i> Employee List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form
                                    action="{{ @$editData ? route('employees.registration.update', $editData->id) : route('employees.registration.store') }}"
                                    method="POST" role="form" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Employee Name <font style="color: red">*</font></label>
                                                <input id="name" class="form-control form-control-sm" type="text"
                                                    name="name" value="{{ @$editData ? $editData->name : old('name') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Father's Name <font style="color: red">*</font></label>
                                                <input id="fname" class="form-control form-control-sm" type="text"
                                                    name="fname"
                                                    value="{{ @$editData ? $editData->fname : old('fname') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mother's Name <font style="color: red">*</font></label>
                                                <input id="mname" class="form-control form-control-sm" type="text"
                                                    name="mname"
                                                    value="{{ @$editData ? $editData->mname : old('mname') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mobile Number <font style="color: red">*</font></label>
                                                <input id="mobile" class="form-control form-control-sm" type="text"
                                                    name="mobile"
                                                    value="{{ @$editData ? $editData->mobile : old('mobile') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Address <font style="color: red">*</font></label>
                                                <input id="address" class="form-control form-control-sm" type="text"
                                                    name="address"
                                                    value="{{ @$editData ? $editData->address : old('address') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Gender <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"
                                                        {{ @$editData->gender == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ @$editData->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Religion <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="religion">
                                                    <option value="">Select Religion</option>
                                                    <option value="Islam"
                                                        {{ @$editData->religion == 'Islam' ? 'selected' : '' }}>Islam
                                                    </option>
                                                    <option value="Hindu"
                                                        {{ @$editData->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                                    </option>
                                                    <option value="Other"
                                                        {{ @$editData->religion == 'Other' ? 'selected' : '' }}>Other
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Date of Birth <font style="color: red">*</font></label>
                                                <input id="dob" class="form-control form-control-sm" autocomplete="off"
                                                    type="date" name="dob"
                                                    value="{{ @$editData ? $editData->dob : old('dob') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Designation <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="designation_id">
                                                    <option value="">Select Designation</option>
                                                    @foreach ($data as $item)                                   
                                                    <option value="{{ $item->id }}"
                                                        {{ @$editData->designation_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if (!@$editData)                                             
                                            
                                            <div class="form-group col-md-3">
                                                <label>Join Date <font style="color: red">*</font></label>
                                                <input id="join_date" class="form-control form-control-sm"
                                                    autocomplete="off" type="date" name="join_date"
                                                    value="{{ @$editData ? $editData->join_date : old('join_date') }}">
                                            </div>
                                            
                                            <div class="form-group col-md-3">
                                                <label>Salary </label>
                                                <input id="salary" class="form-control form-control-sm" autocomplete="off"
                                                    type="text" name="salary"
                                                    value="{{ @$editData ? $editData->salary : old('salary') }}">
                                            </div>
                                            @endif
                                            <div class="form-group col-md-3">
                                                <label for="image">Image</label>
                                                <input id="image" class="form-control form-control-sm" type="file"
                                                    name="image">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <img id="showImage"
                                                    src="{{ !empty($editData->image) ? url('public/upload/employee_images/' . $editData->image) : url('public/upload/avater_1.png') }}"
                                                    style="width: 100px; height:110px; border:1px solid #666;" alt="">
                                            </div>



                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm">{{ @$editData ? 'Update' : 'Submit' }}</button>
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
                    "name": {
                        required: true,
                    },
                    "fname": {
                        required: true,
                    },
                    "mname": {
                        required: true,
                    },
                    "mobile": {
                        required: true,
                    },
                    "address": {
                        required: true,
                    },
                    "gender": {
                        required: true,
                    },
                    "religion": {
                        required: true,
                    },
                    "dob": {
                        required: true,
                    },
                    "designation_id": {
                        required: true,
                    },
                    "join_date": {
                        required: true,
                    },
                    "salary": {
                        required: true,
                    },
                },
                messages: {},
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
