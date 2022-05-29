@extends('layouts.admin-layout')

@section('title')
    @if (isset($editData))
    ABC School | Grade Point View Edit
    @else
    ABC School | Grade Point View Create
    @endif

@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Grade Point</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Grade Point</a></li>
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
                                        Edit Grade Point
                                    @else
                                        Add Grade Point
                                    @endif

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('marks.grade.view') }}"> <i
                                                    class="fa fa-list"></i> Grade Point List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ (@$editData) ? route('marks.grade.update', $editData->id) : route('marks.grade.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="grade_name">Grade Name</label>
                                            <input id="grade_name" class="form-control form-control-sm" type="text" name="grade_name" value="{{ (@$editData) ? $editData->grade_name : old('grade_name') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="grade_point">Grade Point</label>
                                            <input id="grade_point" class="form-control form-control-sm" type="text" name="grade_point" value="{{ (@$editData) ? $editData->grade_point : old('grade_point') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="start_marks">Start Marks</label>
                                            <input id="start_marks" class="form-control form-control-sm" type="text" name="start_marks" value="{{ (@$editData) ? $editData->start_marks : old('start_marks') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="end_marks">End Marks</label>
                                            <input id="end_marks" class="form-control form-control-sm" type="text" name="end_marks" value="{{ (@$editData) ? $editData->end_marks : old('end_marks') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="start_point">Start Point</label>
                                            <input id="start_point" class="form-control form-control-sm" type="text" name="start_point" value="{{ (@$editData) ? $editData->start_point : old('start_point') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="end_point">End  Point</label>
                                            <input id="end_point" class="form-control form-control-sm" type="text" name="end_point" value="{{ (@$editData) ? $editData->end_point : old('end_point') }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="remarks">Remarks</label>
                                            <input id="remarks" class="form-control form-control-sm" type="text" name="remarks" value="{{ (@$editData) ? $editData->remarks : old('remarks') }}">
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 31px">
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
                    grade_name: {
                        required: true,
                    },
                    grade_point: {
                        required: true,
                    },
                    start_marks: {
                        required: true,
                    },
                    end_marks: {
                        required: true,
                    },
                    start_point: {
                        required: true,
                    },
                    end_point: {
                        required: true,
                    },
                    remarks: {
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
