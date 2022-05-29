@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Roll Generate
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Student Roll Gentrate</h1>
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
                                    Roll List
                                    {{-- <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-plus-circle"></i>Add New</a> --}}
                                </h3>

                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('student.roll.store') }}" method="POST" id="myForm">
                                    @csrf
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
                                    </div> <br>
                                    <div class="">
                                        <div class="row d-none" id="roll-generate">
                                            <div class="col-md-12">
                                                <table class="table table-bordered table-sprited dt-responsive" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ID No</th>
                                                            <th>Student Name</th>
                                                            <th>Father's Name</th>
                                                            <th>Gender</th>
                                                            <th>Roll No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="roll-generate-tr">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                   <button class="btn btn-success btn-sm" type="submit">Roll Generate</button>

                                </form>
                            </div>

                            <div class="card-body">


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
        $(document).on('click', '#search', function(){
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            $('.notifyjs-corner').html('');

            if(year_id == ''){
                $.notify("Year required", {globalPosition: 'top right', className: 'success'});
                return false;
            }
            if(class_id == ''){
                $.notify("Class required", {globalPosition: 'top right', className: 'success'});
                return false;
            }

            $.ajax({
                url: "{{ route('students.roll.get-student') }}",
                type: "GET",
                data: { 'year_id':year_id, 'class_id':class_id },
                success:function(response){
                    $('#roll-generate').removeClass('d-none');
                    // var data = '';
                    var html = '';
                    $.each(response, function(key, v){
                        // data = data + "<tr>"
                        // data = data + "<td>"+v.student.id_no+"</td>"
                        // data = data + "<td>"+v.student.name+"</td>"
                        // data = data + "<td>"+v.student.fname+"</td>"
                        // data = data + "<td>"+v.student.gender+"</td>"
                        // data = data + "</tr>"

                        // console.log(v.student.name);
                        // console.log(v.student.fname);
                        // console.log(v.student.gender);

                        html +=
                        '<tr>'+
                        '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                        '<td>'+v.student.name+'</td>'+
                        '<td>'+v.student.fname+'</td>'+
                        '<td>'+v.student.gender+'</td>'+
                        '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
                        '</tr>';
                    });
                    // $('tbody').html(data);
                    html = $('#roll-generate-tr').html(html);
                }
            });

        });
    </script>


    <!-- Page specific script -->
<script>
    $(function () {
      $('#myForm').validate({
        rules: {
          "roll[]": {
            required: true,
          },

        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>


@endsection
