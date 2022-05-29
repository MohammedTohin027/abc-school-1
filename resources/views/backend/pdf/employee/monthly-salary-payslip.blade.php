<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Registration Fee</title>
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
                    $date = date('Y-m', strtotime($details['0']->date));
                    if ($date != '') {
                        $where[] = ['date', 'like', $date . '%'];
                    }
                    $totalattend = App\Models\EmployeeAttendance::with(['user'])
                        ->where($where)
                        ->where('employee_id', $details['0']['employee_id'])
                        ->get();
                    // dd($totalattend);
                    $salary = (float) $details['0']['user']['salary'];
                    $salaryperday = (float) $salary / 30;
                    $absentcount = count($totalattend->where('attend_status', 'Absent'));
                    // dd($absentcount);
                    $leavecount = count($totalattend->where('attend_status', 'Leave'));
                    $totalsalaryminus = (float) $absentcount * (float) $salaryperday;
                    $totalsalary = (float)$salary - (float)$totalsalaryminus;
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
                            <img src="{{ url('public/upload/employee_images/' . $details['0']['user']['image']) }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: 5px;">Employee Monthly Salary</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 50%">ID No</td>
                            <td>{{ $details['0']['user']['id_no'] }}</td>
                        </tr>

                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $details['0']['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $salary }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total absend for this month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total leave for this month</td>
                            <td>{{ $leavecount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Month</td>
                            <td>{{ date("M - Y", strtotime($details['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Salary for this month</td>
                            <td>{{ round($totalsalary) }} TK.</td>
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
                    $date = date('Y-m', strtotime($details['0']->date));
                    if ($date != '') {
                        $where[] = ['date', 'like', $date . '%'];
                    }
                    $totalattend = App\Models\EmployeeAttendance::with(['user'])
                        ->where($where)
                        ->where('employee_id', $details['0']['employee_id'])
                        ->get();
                    // dd($totalattend);
                    $salary = (float) $details['0']['user']['salary'];
                    $salaryperday = (float) $salary / 30;
                    $absentcount = count($totalattend->where('attend_status', 'Absent'));
                    // dd($absentcount);
                    $leavecount = count($totalattend->where('attend_status', 'Leave'));
                    $totalsalaryminus = (float) $absentcount * (float) $salaryperday;
                    $totalsalary = (float)$salary - (float)$totalsalaryminus;
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
                            <img src="{{ url('public/upload/employee_images/' . $details['0']['user']['image']) }}" alt=""
                                style="width: 80px; height: 80px;">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: 5px;">Employee Monthly Salary</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td style="width: 50%">ID No</td>
                            <td>{{ $details['0']['user']['id_no'] }}</td>
                        </tr>

                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $details['0']['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $salary }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total absend for this month</td>
                            <td>{{ $absentcount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Total leave for this month</td>
                            <td>{{ $leavecount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Month</td>
                            <td>{{ date("M - Y", strtotime($details['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Salary for this month</td>
                            <td>{{ round($totalsalary) }} TK.</td>
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
    </div>
</body>

</html>
