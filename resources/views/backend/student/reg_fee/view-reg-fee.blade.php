@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Reg Fee
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Registration Fee</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item active">Reg Fee</li>
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
                                    Search Criteria
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Year <font style="color: red">*</font> </label>
                                        <select class="form-control form-control-sm" name="year_id" id="year_id">
                                            <option value="">Select Year</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Class <font style="color: red">*</font></label>
                                            <select class="form-control form-control-sm" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                            @{{#each this}}
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>
                                            @{{/each}}
                                        </tbody>
                                    </table>
                                </script>
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

            $.ajax({
                url: "{{ route('student.reg.get-student') }}",
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id
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
