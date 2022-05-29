@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Student Registration
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
                                    Student List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('students.registration.create') }}"
                                                class="btn btn-success btn-sm"> <i class="fa fa-plus-circle"></i> Add
                                                Student</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form method="GET" action="{{ route('students.year.class.wies') }}" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Year <font style="color: red">*</font> </label>
                                            <select class="form-control form-control-sm" name="year_id">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}"
                                                        {{ @$year_id == $year->id ? 'selected' : '' }}>
                                                        {{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Class <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="class_id">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ @$class_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                name="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                @if (!@search)
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="7%">SL.</th>
                                                <th width="10%">Image</th>
                                                <th>Name</th>
                                                <th>Id No</th>
                                                <th>Roll</th>
                                                @if (Auth::user()->role == 'admin')
                                                    <th>Code</th>
                                                @endif
                                                <th>Year</th>
                                                <th>Class</th>

                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img src="{{ !empty($item->student->image) ? url('public/upload/student_images/' . $item->student->image) : url('public/upload/avater_1.png') }}"
                                                            style="width: 60px; height:70px; border:1px solid #666;" alt="">
                                                    </td>
                                                    <td>{{ ucwords($item->student->name) }}</td>
                                                    <td>{{ $item->student->id_no }}</td>
                                                    <td>{{ $item->roll }}</td>
                                                    @if (Auth::user()->role == 'admin')
                                                        <td>{{ $item->student->code }}</td>
                                                    @endif
                                                    <td>{{ $item->year->name }}</td>
                                                    <td>{{ $item->student_class->name }}</td>

                                                    <td>
                                                        {{-- <a href="{{ route('students.registration.edit', $item->free_category_id) }}" class="btn btn-success btn-sm" title="Edit"><i
                                                        class="fa fa-eye"></i></a> --}}
                                                        {{-- <a href="{{ route('students.registration.edit', $item->free_category_id) }}" class="btn btn-primary btn-sm" title="Edit"><i
                                                            class="fa fa-edit"></i></a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="7%">SL.</th>
                                                <th width="10%">Image</th>
                                                <th>Name</th>
                                                <th>Id No</th>
                                                <th>Roll</th>
                                                @if (Auth::user()->role == 'admin')
                                                    <th>Code</th>
                                                @endif
                                                <th>Year</th>
                                                <th>Class</th>

                                                <th width="12%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img src="{{ !empty($item->student->image) ? url('public/upload/student_images/' . $item->student->image) : url('public/upload/avater_1.png') }}"
                                                            style="width: 60px; height:70px; border:1px solid #666;" alt="">
                                                    </td>
                                                    <td>{{ ucwords($item->student->name) }}</td>
                                                    <td>{{ $item->student->id_no }}</td>
                                                    <td>{{ $item->roll }}</td>
                                                    @if (Auth::user()->role == 'admin')
                                                        <td>{{ $item->student->code }}</td>
                                                    @endif
                                                    <td>{{ $item->year->name }}</td>
                                                    <td>{{ $item->student_class->name }}</td>

                                                    <td width="17%">

                                                        <a href="{{ route('students.registration.edit', $item->student_id) }}"
                                                            class="btn btn-primary btn-sm" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="{{ route('students.registration.promotion', $item->student_id) }}"
                                                            class="btn btn-success btn-sm" title="Promotion"><i
                                                                class="fa fa-check"></i></a>
                                                        <a href="{{ route('students.registration.details', $item->student_id) }}"
                                                            class="btn btn-info btn-sm" title="Details"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a href="{{ route('students.registration.download', $item->student_id) }}"
                                                            class="btn btn-danger btn-sm" title="Details"><i
                                                                class="fa fa-download"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

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
                    "year_id": {
                        required: true,
                    },
                    "class_id": {
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
