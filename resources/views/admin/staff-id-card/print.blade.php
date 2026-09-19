<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ID Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style type="text/css" media="print">
        @media print {
            @page {
                margin: 0;
            }

            body {
                /* display: block !important; */
                background: none !important;
                margin: 0;
                padding: 0;
            }

            .printable {
                page-break-after: always;
                width: 300px;
                height: 480px;
            }
        }
    </style>


    <style>
        /* ====== SCREEN + PRINT COMMON ====== */
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* ====== ID CARD ====== */
        .id-card {
            width: 300px;
            height: 480px;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
        }

        /* ====== TOP DESIGN ====== */
        .top-design {
            height: 110px;
            background: linear-gradient(135deg, #1e5799, #2989d8);
            clip-path: polygon(0 0, 100% 0, 100% 70%, 50% 100%, 0 70%);
        }

        .company {
            position: absolute;
            top: 12px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;

            /* logo + text gap */
            color: white;
            z-index: 3;
            /* padding-right: 20px;
            padding-left: 5px; */

        }

        .company img {
            width: 44px;
            /* logo size */
            height: 44px;
            object-fit: cover;
            border-radius: 100%;
            margin-left: 10px;
            /* 🔥 circular */
        }

        .company-text {
            line-height: 1.1;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin-left: 0px;
            align-items: center;
        }

        .company-text .college-name {
            font-size:18px;
            font-weight: 500;
            /* letter-spacing: 2px; */
            /* color: #36013F; */
            margin-bottom: 3px;
        }

        .company small {
            display: block;
            font-size: 11px;
            font-weight: normal;
            /* color: black; */
        }

        /* ====== PHOTO ====== */
        .photo {
            width: 110px;
            height: 110px;
            border-radius: 10px;
            overflow: hidden;
            margin: -35px auto 3px;
            border: 4px solid white;
            background: #ddd;
            position: relative;
            z-index: 2;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ====== CONTENT ====== */
        .name {
            font-size: 16px;
            font-weight: 600
        }

        .role {
            font-size: 12px;
            /* color: #555; */
            margin-bottom: 10px;
            font-weight: 500;
            color: black;
        }

        .details {
            font-size: 13px;
            line-height: 12px;
            padding: 0 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* 🔥 center */
            text-align: center;
        }

        .staff-pro {
            color: black;
            font-weight: 500;
        }

        .details div {
            margin-bottom: 6px;
        }

        /* ====== QR ====== */
        .qr {
            margin: 12px 0;
        }

        .qr img {
            width: 50px;
        }

        /* ====== FOOTER ====== */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #1e5799;
            color: white;
            font-size: 12px;
            padding: 8px 0;
            cursor: pointer;
        }

        /* ====== AUTHORISED SIGNATURE ====== */
        .signature {
            position: absolute;
            bottom: 70px;
            /* footer se upar */
            right: 20px;
            text-align: center;
            font-size: 11px;
            color: #333;

        }

        .signature img {
            width: 80px;
            /* signature size */
            height: auto;
        }



        .signature .sign-text {
            font-weight: 600;
            color: black;
            font-size: 12px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    @foreach ($rows as $row)
        <div class="printable">
            <div class="id-card ">
                <div class="top-design"></div>

                <div class="company">

                    <img src="{{ asset('uploads/setting/rsrgoi_logo.png') }}" alt="College Logo">
                    <div class="company-text">
                        <div class="college-name">RSR Group of Institutions</div>

                        <small>A Unit of Ram Sharan Roy Memorial Educational and Social Welfare Trust, Vaishali, Bihar</small>
                    </div>
                </div>

                <div class="photo">

                    @if (is_file(public_path('uploads/user/' . $row->photo)))
                        <img src="{{ asset('uploads/user/' . $row->photo) }}" alt="Staff Photo">
                    @else
                        <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" alt="Staff Photo">
                    @endif

                </div>

                <div class="name">{{ $row->first_name }} {{ $row->last_name }}</div>
                <div class="role">{{$row->designation->title}}</div>

                <div class="details">
                    <div><strong>Employee ID :</strong> <span class="staff-pro">{{ $row->staff_id }}</span> </div>
                    <div><strong>Branch :</strong> <span class="staff-pro">RBSRDR College</span> </div>
                    <div><strong>Department :</strong> <span class="staff-pro">{{ $row->department->title  }}</span></div>
                    <div><strong>Date of joining :</strong> <span class="staff-pro">{{ \Carbon\Carbon::parse($row->joining_date)->format('d-m-Y') }}</span></div>
                    <div><strong>Blood group :</strong> <span class="staff-pro">{{ $row->blood_group }}</span></div>
                </div>

                <div class="qr">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=example">
                </div>

                <div class="signature">
                    <img src="{{ asset('uploads/signature/signature2.png') }}" alt="Authorized Signature">
                    <div class="sign-text">Auth. Signature</div>
                </div>

                <div class="footer">
                    <div>
                        Add: Saraipur, P.O.-Raghopur, P.S.-Hajipur, Dist.-Vaishali, Pin-844102 (Bihar)
                    </div>
                    <div>
                        📞 +91-87574 07598 | 🌐 <a href="https://rbsrdr.com/" target="_blank">www.rbsrdr.com</a>
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

    {{-- <script>
        $(window).on('load', function() {
            setTimeout(function() {
                window.print();
            }, 1500);
        });
    </script> --}}


</body>

</html>
