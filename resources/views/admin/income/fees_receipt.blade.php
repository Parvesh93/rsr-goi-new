<!DOCTYPE html>
<html>

<head>
    <title>Fees Receipt</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
        }

        .receipt-box {
            width: 95%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            /* border: 2px solid #2b7cff; */
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #2b7cff;
            padding-bottom: 12px;
            margin-bottom: 15px;
            position: relative;
        }


        .logo {
            position: absolute;
            left: 0;
        }

        .logo img {
            height: 70px;
            /* logo size control */
            width: auto;
        }

        .header-text {
            text-align: center;
        }

        .header h2 {
            margin: 0;
            color: #2b7cff;
            letter-spacing: 1px;
        }

        .header h3 {
            margin: 3px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .student-details td {
            padding: 7px;
            border: none;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th {
            background: #2b7cff;
            color: white;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        .section-title {
            margin-top: 20px;
            font-size: 18px;
            color: #2b7cff;
            font-weight: bold;
            border-left: 5px solid #2b7cff;
            padding-left: 10px;
        }

        /* TOTAL SECTION */
        .total-section {
            margin-top: 20px;
            border: 2px dashed #2b7cff;
            padding: 15px;
            background: #f8fbff;
        }

        .amount-grid {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .amount-box {
            width: 32%;
            background: #eef4ff;
            border: 2px solid #2b7cff;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .amount-box span {
            font-size: 14px;
            color: #555;
        }

        .amount-box h3 {
            margin: 6px 0 0;
            color: #2b7cff;
        }

        .final-total {
            margin-top: 18px;
            padding: 12px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            background: #2b7cff;
            color: white;
            border-radius: 6px;
        }

        /* PRINT FIX */
        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .receipt-box {
                width: 100%;
                /* border: 2px solid #2b7cff; */
                margin: 0;
                padding: 15px;
                box-sizing: border-box;
            }

            table {
                width: 100%;
            }

            /* 🔥 IMPORTANT PART */
            .printable {
                page-break-after: always;
                break-after: page;
            }

            .printable:last-child {
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>
    @foreach ($rows as $row)
        @php
            $totalAmount = ($row->cashTotal ?? 0) + ($row->bankTotal ?? 0);
             $enroll = \App\Models\Student::enroll($row->id);

        @endphp
        <div class="printable">
            <div class="receipt-box">

                <div class="header">
                    <div class="logo">
                        <img src="{{ asset('uploads/setting/rbs_logo.png') }}" alt="College Logo">
                    </div>

                    <div class="header-text">
                        <h2>RBSRDR COLLEGE (NURSING)</h2>
                        <h3>FEES RECEIPT</h3>
                    </div>
                </div>

                <!-- Student Details -->
                <table class="student-details">
                    <tr>
                        <td><b>Name :</b> {{ $row->first_name }} {{ $row->last_name }}</td>
                        <td><b>Roll No :</b> {{ $row->student_id }}</td>
                    </tr>
                    <tr>
                        <td><b>Registration No :</b> {{ $row->registration_no }}</td>
                        <td><b>Father Name :</b> {{ $row->father_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Course :</b> {{ $row->program->title }}</td>
                        <td><b>Session :</b> {{ $enroll->session->title }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Address :</b> {{ $row->present_address }}</td>
                    </tr>
                </table>

                <div class="section-title">Reference Amount's</div>

                @if ($row->refrences->isNotEmpty())
                    <table>
                        <tr>
                            <th>Receipt No</th>
                            <th>Date</th>
                            <th>REF Name</th>
                            <th>REF Amount (₹)</th>
                        </tr>

                        @foreach ($row->refrences as $refrence)
                            <tr>
                                <td>{{ $refrence->utr_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($refrence->ref_date)->format('d-m-Y') }}</td>
                                <td>{{ $refrence->ref_name }}</td>
                                <td>{{ $refrence->ref_amount }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div
                        style="padding:10px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; margin-top:10px;">
                        No Reference Amount Found
                    </div>
                @endif

                <div class="section-title">Cash Amount's</div>

                @if ($row->cashReceived->isNotEmpty())
                    <table>
                        <tr>

                            <th>Receipt No</th>
                            <th>Date</th>
                            <th>Receiver Name</th>
                            <th>Cash Amount (₹)</th>
                        </tr>

                        @foreach ($row->cashReceived as $cash)
                            <tr>

                                <td>{{ $cash->utr_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($cash->cash_date)->format('d-m-Y') }}</td>
                                <td>{{ $cash->cash_name }}</td>
                                <td>{{ $cash->cash_amount }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div
                        style="padding:10px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; margin-top:10px;">
                        No Cash Amount Received
                    </div>
                @endif

                <div class="section-title">Bank Amount's</div>

                @if ($row->bankReceived->isNotEmpty())
                    <table>
                        <tr>
                            <th>Receipt No</th>
                            <th>UTR No</th>
                            <th>Date</th>
                            <th>Bank Name</th>
                            <th>Received Amount (₹)</th>
                        </tr>
                        @foreach ($row->bankReceived as $bank)
                            <tr>
                                <td>{{ $bank->receipt_no }}</td>
                                <td>{{ $bank->utr_no }}</td>
                                <td>{{ \Carbon\Carbon::parse($bank->bank_date)->format('d-m-Y') }}</td>
                                <td>{{ $bank->bank_name }}</td>
                                <td>{{ $bank->bank_amount }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div
                        style="padding:10px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; margin-top:10px;">
                        No Bank Amount Received
                    </div>
                @endif




                <div class="section-title">Any Deduction Amount's</div>

                @if ($row->deductions->isNotEmpty())
                    <table>
                        <tr>
                            <th>Receipt No</th>
                            <th>UTR No</th>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Received Amount (₹)</th>
                        </tr>
                        @foreach ($row->deductions as $deduction)
                            <tr>
                                <td>{{ $deduction->deduction_id }}</td>
                                <td>{{ $deduction->utr_no }}</td>

                                <td>{{ \Carbon\Carbon::parse($deduction->deduction_date)->format('d-m-Y') }}</td>
                                <td>{{ $deduction->purpose }}</td>
                                <td>{{ $deduction->deduction_amount }}</td>
                            </tr>
                        @endforeach

                    </table>
                @else
                    <div
                        style="padding:10px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; margin-top:10px;">
                        No Deduction Amount Received
                    </div>
                @endif


                <!-- TOTAL AMOUNT RECEIVED -->
                <div class="total-section">

                    <div class="section-title" style="margin-top:0;">Total Amount Received</div>

                    <div class="amount-grid">

                        <div class="amount-box">
                            <span>Total Reference Amount</span>
                            <h3>₹ {{ $row->refTotal }}</h3>
                        </div>

                        <div class="amount-box">
                            <span>Total Cash Amount</span>
                            <h3>₹ {{ $row->cashTotal }}</h3>
                        </div>

                        <div class="amount-box">
                            <span>Total Bank Amount</span>
                            <h3>₹ {{ $row->bankTotal }}</h3>
                        </div>
                        <div class="amount-box">
                            <span>Total Any Deduction</span>
                            <h3>₹ {{ $row->deductionTotal }}</h3>
                        </div>

                    </div>

                    <div class="final-total">
                        Grand Total Received : ₹ {{ $row->total_amounts }}
                    </div>

                </div>

            </div>
        </div>
    @endforeach




    <script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>


    <script type="text/javascript">
        $(window).on('load', function() {
            setTimeout(function() {
                $.print(".printable");
            }, 1500); // images fully load hone do
        });
    </script>

</body>

</html>
