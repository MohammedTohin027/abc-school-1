@extends('layouts.admin-layout')

@section('title')
    ABC School | Manage Other Cost
@endsection

@section('dashboard-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Other Cost</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Other Cost</li>
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
                                    @if (isset($editData))
                                        Edit Cost
                                    @else
                                        Add Cost
                                    @endif
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a href="{{ route('accounts.cost.view') }}" class="btn btn-success btn-sm"> <i
                                                    class="fa fa-plus-circle"></i> Other Cost List</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <form
                                    action="{{ @$editData ? route('accounts.cost.update', $editData->id) : route('accounts.cost.store') }}"
                                    method="POST" role="form" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="add_item">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Date <font style="color: red">*</font></label>
                                                <input id="date" class="form-control form-control-sm" autocomplete="off"
                                                    type="date" name="date"
                                                    value="{{ @$editData ? $editData->date : old('date') }}">
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label>Amount </label>
                                                <input id="amount" class="form-control form-control-sm" autocomplete="off"
                                                    type="text" name="amount"
                                                    value="{{ @$editData ? $editData->amount : old('amount') }}">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="image">Image</label>
                                                <input id="image" class="form-control form-control-sm" type="file"
                                                    name="image">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <img id="showImage"
                                                    src="{{ !empty($editData->image) ? url('public/upload/cost_images/' . $editData->image) : url('public/upload/avater_1.png') }}"
                                                    style="width: 150px; height:90px; border:1px solid #666;" alt="">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Description </label>
                                                <textarea name="description" id="description" class="form-control form-control-sm" cols="15"
                                                    rows="3">{{ @$editData ? $editData->description : old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-sm">{{ @$editData ? 'Update' : 'Submit' }}</button>
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
                    "date": {
                        required: true,
                    },
                    "amount": {
                        required: true,
                    },
                    "description": {
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
