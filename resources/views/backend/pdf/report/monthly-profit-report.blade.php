<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly/Yearly Profit</title>
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
                            {{-- <img src="{{ url('public/upload/employee_images/' . $details['0']['user']['image']) }}" alt=""
                                style="width: 80px; height: 80px;"> --}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: 5px;">Monthly/Yearly Profit</h5>
            </div>
            @php
                $student_fee = App\Models\AccountStudentFee::whereBetween('date',[$sdate, $edate] )->sum('amount');
                $other_cost = App\Models\AccountOtherCost::whereBetween('date',[$start_date, $end_date] )->sum('amount');
                $emp_salary = App\Models\AccountEmployeeSalary::whereBetween('date',[$sdate, $edate] )->sum('amount');
                $total_cost = $other_cost + $emp_salary;
                $profit = $student_fee - $total_cost;
            @endphp
            <div class="col-md-12">
                <table border="1" width="100%" style="font-size: 12px">
                    <tbody>
                        <tr>
                            <td colspan="2"  style="text-align: center;">
                                <h4>Reporting Date : {{ date('d M Y', strtotime($start_date)) }} - {{ date('d M Y', strtotime($end_date)) }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%"><h4>Purpose</h4></td>
                            <td><h4>Amount</h4></td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Student Fee</td>
                            <td>{{ $student_fee }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Employee Salary</td>
                            <td>{{ $emp_salary }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Other Cost</td>
                            <td>{{ $other_cost }} TK.</td>
                        </tr>
                        <tr>
                            <td style="width: 50%"><h4>Total Cost</h4></td>
                            <td><h4>{{ $total_cost }} TK.</h4></td>
                        </tr>
                        <tr>
                            <td style="width: 50%"><h4>Profit</h4></td>
                            <td><h4>{{ $profit }} TK.</h4></td>
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
