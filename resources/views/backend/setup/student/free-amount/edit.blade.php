@extends('layouts.admin-layout')

@section('title')
    ABC School | Setup-Free-Category-Amount-Edit
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Free Category Amount</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Setup</a></li>
                            <li class="breadcrumb-item"><a href="#">Student</a></li>
                            <li class="breadcrumb-item"><a href="#">Free Category Amount</a></li>

                            <li class="breadcrumb-item active">Edit</li>


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

                                        Edit Free Category Amount

                                    {{-- <a href="" class="btn btn-primary btn-sm"> <i class=""></i>Add New</a> --}}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="btn btn-success btn-sm" href="{{ route('setup.student.free.amount.view') }}"> <i
                                                    class="fa fa-list"></i> Free Category Amount List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form action="{{ route('setup.student.free.amount.update', $editData[0]->free_category_id) }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Fee Category</label>
                                                <select class="form-control @error('free_category_id') is-invalid @enderror" name="free_category_id">
                                                    <option value="">Select Fee Category</option>
                                                    @foreach ($fee_categoies as $item)
                                                        <option value="{{ $item->id }}" {{ ($editData[0]->free_category_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('free_category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @foreach ($editData as $value)
                                        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>Class</label>
                                                    <select class="form-control @error('class_id[]') is-invalid @enderror" name="class_id[]">
                                                        <option value="">Select Class</option>
                                                        @foreach ($classes as $item)
                                                            <option value="{{ $item->id }}" {{ ($value->class_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('class_id[]')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Amount</label>
                                                    <input class="form-control @error('amount[]') is-invalid @enderror" type="text" name="amount[]" value="{{ $value->amount }}">
                                                    @error('amount[]')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-2" style="padding-top: 30px">
                                                    <span class="btn btn-success addEvenMore"> <i class="fa fa-plus-circle"> </i> </span>
                                                    <span class="btn btn-danger removeEvenMore"> <i class="fa fa-minus-circle"> </i> </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData) ? 'Update' : 'Submit' }}</button>
                                </form>

                                {{-- <form action="{{ (@$editData) ? route('setup.student.free.category.update', $editData->id) : route('setup.student.free.category.store') }}" method="POST" role="form" id="myForm">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-4">
                                            <label for="name">Free Category Name</label>
                                            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ (@$editData) ? $editData->name : old('name') }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 35px">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ (@$editData) ? 'Update' : 'Add New' }}</button>
                                        </div>
                                    </div>
                                </form> --}}
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label>Class</label>
                        <select class="form-control" name="class_id[]">
                            <option value="">Select Class</option>
                            @foreach ($classes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Amount</label>
                        <input class="form-control" type="text" name="amount[]">
                    </div>

                    <div class="form-group col-md-1" style="padding-top: 30px">
                        <div class="form-row">
                            <span class="btn btn-success addEvenMore"> <i class="fa fa-plus-circle"> </i> </span>
                            <span class="btn btn-danger removeEvenMore"> <i class="fa fa-minus-circle"> </i> </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click", ".addEvenMore", function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter ++;
            });
            $(document).on("click", ".removeEvenMore", function(event){
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    "free_category_id": {
                        required: true,
                    },
                    "class_id[]": {
                        required: true,
                    },
                    "amount[]": {
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
