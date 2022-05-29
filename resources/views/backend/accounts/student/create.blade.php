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
                                    Add / Edit Student Fee
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('accounts.student.fee.view') }}"
                                                class="btn btn-success btn-sm"> <i class="fa fa-plus-circle"></i> Student Fee List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Year <font style="color: red">*</font> </label>
                                        <select class="form-control form-control-sm" id="year_id" name="year_id">
                                            <option value="">Select Year</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ? 'selected' : '' }}>{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Class <font style="color: red">*</font></label>
                                            <select class="form-control form-control-sm" id="class_id" name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{ $item->id }}" {{ (@$class_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Fee Category <font style="color: red">*</font> </label>
                                        <select class="form-control form-control-sm" id="fee_category_id" name="fee_category_id">
                                            <option value="">Select Fee Category</option>
                                            @foreach ($fee_categories as $item)
                                                <option value="{{ $item->id }}" {{ (@$fee_category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date">Date <font style="color: red">*</font> </label>
                                        <input type="date" id="date" name="date" class="form-control form-control-sm">
                                    </div>

                                    <div class="form-group col-md-2" style="padding-top: 30px">
                                        <a class="btn btn-primary btn-sm" name="search" id="search">Search</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <form action="{{ route('accounts.student.fee.store') }}" method="post">
                                        @csrf
                                        <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    @{{{thsource}}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @{{#each this}}
                                                <tr>
                                                    @{{{tdsource}}}
                                                </tr>
                                                @{{/each}}
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
                                    </form>
                                </script>
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
        $(document).on('click', '#search', function() {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var fee_category_id = $('#fee_category_id').val();
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (year_id == '') {
                $.notify("Year required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (class_id == '') {
                $.notify("Class required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (fee_category_id == '') {
                $.notify("Fee Category_id required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }

            $.ajax({
                url: "{{ route('accounts.student.fee.getStudent') }}",
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'fee_category_id': fee_category_id,
                    'date': date,
                },
                beforeSend: function () {

                },
                success:function(data){
                   var source = $("#document-template").html();
                   var template = Handlebars.compile(source);
                   var html = template(data);
                   $('#DocumentResults').html(html);
                   $('[data-toggle = "tooltip"]').tooltip();
                }
            });

        });
    </script>

@endsection
