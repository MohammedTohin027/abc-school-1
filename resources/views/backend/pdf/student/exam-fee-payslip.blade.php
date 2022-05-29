<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Exam Fee</title>
    <style>
        table {
            border-collapse: collapse;
        }

        h2 h3 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #ffffff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table tr td {
            padding: 5px;
        }

        .table-bordered thead th,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black !important
        }

        .table-bordered thead th {
            background-color: #cacaca
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @php
                    $registrationfee = App\Models\FreeAmount::where('free_category_id', '3')
                        ->where('class_id', $stu->class_id)
                        ->first();
                    $originalfee = $registrationfee->amount;
                    $discount = $stu['discount']['discount'];
                    $discountablefee = ($discount / 100) * $originalfee;
                    $finalfee = (int) $originalfee - (int) $discountablefee;

                @endphp
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{ url('public/upload/school_image/abc_school.png') }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                        <td class="text-center" width="63%">
                            <h4><strong>ABC School</strong></h4>
                            <h5><strong>Dhaka, Notun Bazar</strong></h5>
                            <h6><strong>www.domain.com</strong></h6>
                        </td>
                        <td class="text-center">
                            <img src="{{ url('public/upload/student_images/' . $stu['student']['image']) }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: 5px;">Student Exam Fee</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 50%">ID No</td>
                            <td>{{ $stu['student']['id_no'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Roll No</td>
                            <td>{{ $stu['roll'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Student Name</td>
                            <td>{{ $stu['student']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Father's Name</td>
                            <td>{{ $stu['student']['fname'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mother's Name</td>
                            <td>{{ $stu['student']['mname'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Year</td>
                            <td>{{ $stu['year']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Class</td>
                            <td>{{ $stu['student_class']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Exam Fee</td>
                            <td>{{ $originalfee }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Discount Fee</td>
                            <td>{{ $discount }} %</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Fee (This Student) of {{ $exam_type_id }}</td>
                            <td>{{ $finalfee }} TK.</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px; margin-top:15px;">Print Date : {{ date('d M Y') }}</i>
            </div> <br>
            <div class="col-md-12">
                <table border="0" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 30%"></td>
                            <td style="width: 30%"></td>
                            <td style="width: 40%; text-align:center">
                                <hr style="border:1px solid; width:50%; margin-bottom:0px;">
                                <p style="text-align: center"></p>Principal / Headmaster</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr style="border: dashed 1px; width: 96%; color: #ddd; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                @php
                    $registrationfee = App\Models\FreeAmount::where('free_category_id', '3')
                        ->where('class_id', $stu->class_id)
                        ->first();
                    $originalfee = $registrationfee->amount;
                    $discount = $stu['discount']['discount'];
                    $discountablefee = ($discount / 100) * $originalfee;
                    $finalfee = (int) $originalfee - (int) $discountablefee;

                @endphp
                <table width="80%">
                    <tr>
                        <td width="33%" class="text-center">
                            <img src="{{ url('public/upload/school_image/abc_school.png') }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                        <td class="text-center" width="63%">
                            <h4><strong>ABC School</strong></h4>
                            <h5><strong>Dhaka, Notun Bazar</strong></h5>
                            <h6><strong>www.domain.com</strong></h6>
                        </td>
                        <td class="text-center">
                            <img src="{{ url('public/upload/student_images/' . $stu['student']['image']) }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: 5px;">Student Exam Fee</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 50%">ID No</td>
                            <td>{{ $stu['student']['id_no'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Roll No</td>
                            <td>{{ $stu['roll'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Student Name</td>
                            <td>{{ $stu['student']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Father's Name</td>
                            <td>{{ $stu['student']['fname'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Mother's Name</td>
                            <td>{{ $stu['student']['mname'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Year</td>
                            <td>{{ $stu['year']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Class</td>
                            <td>{{ $stu['student_class']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Exam Fee</td>
                            <td>{{ $originalfee }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Discount Fee</td>
                            <td>{{ $discount }} %</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Fee (This Student) of {{ $exam_type_id }}</td>
                            <td>{{ $finalfee }} TK.</td>
                        </tr>
                    </tbody>
                </table>
                <i style="font-size: 10px;">Print Date : {{ date('d M Y') }}</i>
            </div> <br>
            <div class="col-md-12">
                <table border="0" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 30%"></td>
                            <td style="width: 30%"></td>
                            <td style="width: 40%; text-align:center">
                                <hr style="border:1px solid; width:40%; margin-bottom:0px;">
                                <p style="text-align: center"></p>Principal / Headmaster</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
