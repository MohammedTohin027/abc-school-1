@extends('layouts.admin-layout')

@section('title')
    ABC School | Monthly/Yearly Profit
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Monthly/Yearly Profit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Monthly/Yearly Profit</a></li>
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
                                    Select Criteria
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            {{-- <a href="{{ route('accounts.employee.salary.add') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Add/Edit Employee Salary</a> --}}
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
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

                                        <div class="form-group col-md-2" style="padding-top: 30px">
                                            <a class="btn btn-primary btn-sm" name="search" id="search">Search</a>
                                        </div>
                                    </div>
                            </div>

                            <div class="card-body">
                                <div id="DocumentResults"></div>
                                <script id="document-template" type="text/x-handlebars-template">
                                    <table class="table-sm table-bordered table-sprited dt-responsive" style="width: 100%">
                                        <thead>
                                            <tr>
                                                @{{{thsource}}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>
                                        </tbody>
                                    </table>
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
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            $('.notifyjs-corner').html('');

            if (start_date == '') {
                $.notify("Start Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (end_date == '') {
                $.notify("End Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('roports.profit.datewise.get') }}",
                type: "GET",
                data: {
                    'start_date': start_date,
                    'end_date': end_date,
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
