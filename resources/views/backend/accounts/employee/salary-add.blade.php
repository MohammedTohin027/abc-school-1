@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Employee Salary
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Employee Salary</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Salary</li>
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
                                    Add / Edit Employee Salary
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('accounts.employee.salary.view') }}"
                                                class="btn btn-success btn-sm"> <i class="fa fa-plus-circle"></i> Employee Salary List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">

                                <div class="form-row">
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
                                    <form action="{{ route('accounts.employee.salary.store') }}" method="post">
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
                url: "{{ route('accounts.employee.get-employee') }}",
                type: "GET",
                data: {
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
