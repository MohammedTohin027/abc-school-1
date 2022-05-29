@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Student Fee
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Student Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Fee</li>
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
                                   Seach Students
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('accounts.student.fee.view') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Student Fee List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form method="GET" action="{{ route('accounts.student.fee.getStudent') }}" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Year <font style="color: red">*</font> </label>
                                            <select class="form-control form-control-sm" name="year_id">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ? 'selected' : '' }}>{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Class <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="class_id">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $item)
                                                        <option value="{{ $item->id }}" {{ (@$class_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Fee Category <font style="color: red">*</font> </label>
                                            <select class="form-control form-control-sm" name="fee_category_id">
                                                <option value="">Select Fee Category</option>
                                                @foreach ($fee_categories as $item)
                                                    <option value="{{ $item->id }}" {{ (@$fee_category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Date <font style="color: red">*</font> </label>
                                            <input type="date" name="date" class="form-control form-control-sm" value="{{ $date }}">
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 15px">
                                            <button type="submit"
                                        class="btn btn-primary btn-sm" name="search" value="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('accounts.student.fee.store') }}" method="POST" id="myForm">
                                    @csrf
                                    <table id="example1" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father's Name</th>
                                                <th>Original Fee</th>
                                                <th>Discount Fee</th>
                                                <th>Fee (This student)</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($searchdata as $key => $item)
                                            @php
                                                // @dd($item)
                                                // @dd($date)

                                            @endphp
                                                @php
                                                    $student_fee = App\Models\FreeAmount::where('free_category_id', $fee_category_id)->where('class_id', $item->class_id)->first();
                                                    $accountstudentfees = App\Models\AccountStudentFee::where('student_id', $item->student_id)->where('year_id', $item->year_id)->where('class_id', $item->class_id)->where('fee_category_id', $fee_category_id)->where('date', $date)->first();

                                                    // @dd($accountstudentfees);
                                                    if ($accountstudentfees != null){
                                                        $checked = 'checked';
                                                    }
                                                    else{
                                                        $checked = '';
                                                    }
                                                    $originalfee = $student_fee->amount;
                                                    $discount = $item['discount']['discount'];
                                                    $discountablefee = $discount / 100 * $originalfee;
                                                    $finalfee = (int)$originalfee - (int)$discountablefee;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $item->student->id_no }}
                                                        <input type="hidden" name="fee_category_id" value="{{ $fee_category_id }}">
                                                    </td>
                                                    <td>
                                                        {{ ucwords($item->student->name) }}
                                                        <input type="hidden" name="year_id" value="{{ $item->year_id }}">
                                                    </td>
                                                    <td>
                                                        {{ ucwords($item->student->fname) }}
                                                        <input type="hidden" name="class_id" value="{{ $item->class_id }}">
                                                    </td>
                                                    <td>
                                                        {{ $originalfee.' TK' }}
                                                        <input type="hidden" name="date" value="{{ $date }}">
                                                    </td>
                                                    <td>
                                                        {{ $discount.' %' }}
                                                    </td>
                                                    <td>
                                                        <input type="text" name="amount[]" value="{{ $finalfee }}" class="form-control form-control-sm" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="student_id[]" value="{{ $item->student_id }}">
                                                        {{-- <input type="text" name="student_id[]" value="{{ $item->student_id }}"> --}}
                                                        <input type="checkbox" name="checkmanage[]" style="transform: scale(1.5); margin-left: 10px;" value="{{ $key.$checked }}" {{ $accountstudentfees == null? '' : 'checked' }}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-2" style="padding-top: 15px">
                                        <button type="submit"
                                    class="btn btn-primary btn-sm" name="submit" value="submit">Submit</button>
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
