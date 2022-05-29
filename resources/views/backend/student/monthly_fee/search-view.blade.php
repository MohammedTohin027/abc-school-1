@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Monthly Fee
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Monthly Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Monthly Fee</li>
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
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form method="GET" action="{{ route('students.monthly.fee.get-student') }}" id="myForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Year <font style="color: red">*</font> </label>
                                            <select class="form-control form-control-sm" name="year_id">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ? "selected" : "" }}>{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Class <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="class_id">
                                                    <option value="">Select Class</option>
                                                    @foreach ($classes as $item)
                                                        <option value="{{ $item->id }}" {{ (@$class_id == $item->id) ? "selected" : "" }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Month <font style="color: red">*</font></label>
                                                <select class="form-control form-control-sm" name="month" id="month">
                                                    <option value="">Select Month</option>
                                                    <option value="January" {{ ($month == 'January') ? 'selected' : '' }}>January</option>
                                                    <option value="February" {{ ($month == 'February') ? 'selected' : '' }}>February</option>
                                                    <option value="March" {{ ($month == 'March') ? 'selected' : '' }}>March</option>
                                                    <option value="April" {{ ($month == 'April') ? 'selected' : '' }}>April</option>
                                                    <option value="May" {{ ($month == 'May') ? 'selected' : '' }}>May</option>
                                                    <option value="June" {{ ($month == 'June') ? 'selected' : '' }}>June</option>
                                                    <option value="July" {{ ($month == 'July') ? 'selected' : '' }}>July</option>
                                                    <option value="August" {{ ($month == 'August') ? 'selected' : '' }}>August</option>
                                                    <option value="September" {{ ($month == 'September') ? 'selected' : '' }}>September</option>
                                                    <option value="October" {{ ($month == 'October') ? 'selected' : '' }}>October</option>
                                                    <option value="November" {{ ($month == 'November') ? 'selected' : '' }}>November</option>
                                                    <option value="December" {{ ($month == 'December') ? 'selected' : '' }}>December</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2" style="padding-top: 30px">
                                            <button type="submit"
                                        class="btn btn-primary btn-sm" name="search" value="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">

                                <table id="example1" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>ID No</th>
                                            <th>Student Name</th>
                                            <th>Roll No</th>
                                            <th>Monthlt Fee</th>
                                            <th>Discount Amount</th>
                                            <th>Fee (This student)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($allData as $key => $item)
                                            @php
                                                $registrationfee = App\Models\FreeAmount::where('free_category_id', '2')->where('class_id', $item->class_id)->first();

                                                // @dd($registrationfee);
                                                $originalfee = $registrationfee->amount;
                                                $discount = $item['discount']['discount'];
                                                $discountablefee = $discount / 100 * $originalfee;
                                                $finalfee = (int)$originalfee - (int)$discountablefee;
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->student->id_no }}</td>
                                                <td>{{ ucwords($item->student->name) }}</td>
                                                <td>{{ $item->roll }}</td>
                                                <td>{{ $registrationfee->amount.' TK' }}</td>
                                                <td>
                                                    {{ ($item['discount']['discount'] != null) ? $item['discount']['discount'].' %' : '' }}
                                                </td>
                                                <td>{{ $finalfee.' TK' }}</td>

                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm" title="Pay Slip">Pay Slip</a>
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
                    "month": {
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
