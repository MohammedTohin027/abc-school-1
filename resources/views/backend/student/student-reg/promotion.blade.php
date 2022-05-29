@extends('layouts.admin-layout')

@section('title')
        ABC School | Student Promotion
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Student</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Promotion</li>
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
                                        Promotion Student
                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('setup.student.free.amount.view') }}"> <i
                                                    class="fa fa-list"></i> Student List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form
                                    action="{{ route('students.promotion.store', $editData->student_id) }}" method="POST" role="form" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ @$editData->id }}" id="">
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Year <font style="color: red">*</font> </label>
                                                <select class="form-control form-control-sm" name="year_id">
                                                    <option value="">Select Year</option>
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year->id }}" {{ (@$editData->year_id == $year->id) ? "selected" : "" }}>{{ $year->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Class <font style="color: red">*</font></label>
                                                    <select class="form-control form-control-sm" name="class_id">
                                                        <option value="">Select Class</option>
                                                        @foreach ($classes as $item)
                                                            <option value="{{ $item->id }}" {{ (@$editData->class_id == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Group</label>
                                                    <select class="form-control form-control-sm" name="group_id">
                                                        <option value="">Select Group</option>
                                                        @foreach ($groups as $item)
                                                            <option value="{{ $item->id }}" {{ (@$editData->group_id == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Shift</label>
                                                    <select class="form-control form-control-sm" name="shift_id">
                                                        <option value="">Select Shift</option>
                                                        @foreach ($shifts as $item)
                                                            <option value="{{ $item->id }}" {{ (@$editData->shift_id == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Student Name <font style="color: red">*</font></label>
                                                <input id="name" class="form-control form-control-sm" type="text" name="name"
                                                    value="{{ @$editData ? $editData->student->name : old('name') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Father's Name <font style="color: red">*</font></label>
                                                <input id="fname" class="form-control form-control-sm" type="text" name="fname"
                                                    value="{{ @$editData ? $editData->student->fname : old('fname') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mother's Name <font style="color: red">*</font></label>
                                                <input id="mname" class="form-control form-control-sm" type="text" name="mname"
                                                    value="{{ @$editData ? $editData->student->mname : old('mname') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mobile Number <font style="color: red">*</font></label>
                                                <input id="mobile" class="form-control form-control-sm" type="text" name="mobile"
                                                    value="{{ @$editData ? $editData->student->mobile : old('mobile') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Address <font style="color: red">*</font></label>
                                                <input id="address" class="form-control form-control-sm" type="text" name="address"
                                                    value="{{ @$editData ? $editData->student->address : old('address') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Gender <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" {{ (@$editData->student->gender == "Male" ) ? "selected" : "" }}>Male</option>
                                                    <option value="Female" {{ (@$editData->student->gender == "Female" ) ? "selected" : "" }}>Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Religion <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="religion">
                                                    <option value="">Select Religion</option>
                                                    <option value="Islam" {{ (@$editData->student->religion == "Islam" ) ? "selected" : "" }}>Islam</option>
                                                    <option value="Hindu" {{ (@$editData->student->religion == "Hindu" ) ? "selected" : "" }}>Hindu</option>
                                                    <option value="Other" {{ (@$editData->student->religion == "Other" ) ? "selected" : "" }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Date of Birth <font style="color: red">*</font></label>
                                                <input id="dob" class="form-control form-control-sm" autocomplete="off" type="date" name="dob"
                                                    value="{{ @$editData ? $editData->student->dob : old('dob') }}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Discount </label>
                                                <input id="discount" class="form-control form-control-sm" autocomplete="off" type="text" name="discount"
                                                    value="{{ @$editData ? $editData->discount->discount : old('discount') }}">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="image">Image</label>
                                                <input id="image" class="form-control form-control-sm" type="file" name="image">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <img id="showImage" src="{{ (!empty($editData->student->image)) ? url('public/upload/student_images/'.$editData->student->image) : url('public/upload/avater_1.png') }}" style="width: 100px; height:110px; border:1px solid #666;" alt="">
                                            </div>



                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm">Promotion</button>
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Class</label>
                        <select class="form-control" name="class_id[]">
                            <option value="">Select Class</option>
                            @foreach ($classes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Amount</label>
                        <input class="form-control" type="text" name="amount[]">
                    </div>

                    <div class="form-group col-md-1" style="padding-top: 30px">
                        <div class="form-row">
                            <span class="btn btn-success addEvenMore"> <i class="fa fa-plus-circle"> </i> </span>
                            <span class="btn btn-danger removeEvenMore"> <i class="fa fa-minus-circle"> </i> </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addEvenMore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeEvenMore", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    "year_id": {
                        required: true,
                    },
                    "class_id": {
                        required: true,
                    },
                    // "group_id": {
                    //     required: true,
                    // },
                    // "shift_id": {
                    //     required: true,
                    // },
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
                    // "discount": {
                    //     required: true,
                    // },
                    // "image": {
                    //     required: true,
                    // },
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
