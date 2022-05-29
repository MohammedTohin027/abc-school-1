@extends('layouts.admin-layout')

@section('title')
    ABC School | Employee Monthly Salary View
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Monthly Salary</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight:bold">
                                Search Criteria
                            </h3>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" class="control-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-2" style="padding-top: 30px">
                                    <a class="btn btn-primary btn-sm" name="search" id="search">Search</a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" class="control-label">Date</label>
                                    <input type="date" name="date" id="date" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-md-2" style="margin-top: 30px; color:white">
                                    <button type="submit" class="btn btn-sm btn-success" id="search">Search</button>
                                </div>
                            </div>
                        </div> --}}
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
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                    </tbody>
                                </table>
                            </script>
                        </div>

                        {{-- <div class="card-body">
                                <form method="GET" action="{{ route('employees.monthly.salary.get') }}" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" class="control-label">Date</label>
                                            <input type="date" name="date" id="date" class="form-control form-control-sm"
                                                >
                                        </div>
                                        <div class="form-group col-md-2" style="margin-top: 30px; color:white">
                                            <button type="submit" class="btn btn-sm btn-success" id="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.Left col -->

            </div>
            <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <script>
        $(document).on('click', '#search', function() {
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }

            $.ajax({
                url: "{{ route('employees.monthly.salary.get') }}",
                type: "GET",
                data: {
                    'date': date
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


    {{-- <script>
        $(document).on('click', '#search', function() {
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('employees.monthly.salary.get') }}",
                type: "GET",
                data: {
                    'date': date,
                },
                beforeSend: function() {

                },
                success: function(data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle = "tooltip"]').tooltip();
                }
            });

        });
    </script> --}}

    {{-- <script>
        $(document).on('click', '#search', function() {
            var date = $('#date').val();
            $('.notifyjs-corner').html('');
            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('employees.monthly.salary.get') }}",
                type: "get",
                data: {
                    'date': date
                },
                beforeSend: function() {

                },
                success: function(data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script> --}}
@endsection
