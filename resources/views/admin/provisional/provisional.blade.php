@php
    $img = '';
    foreach ($rows as $row) {
        $img = $row->batch->clc_college_img;
    }
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,maximum-scale=1.0" />
    <title>{{ $title }}</title>

    <style type="text/css" media="print">
        @media print {
            @page {
                size: auto;
                margin: 10px;
            }

            @page :footer {
                display: none;
            }

            @page :header {
                display: none;
            }

            body {
                margin: 15mm 15mm 15mm 15mm;
            }

            .page-break {
                page-break-before: auto;
            }

            table,
            tbody,
            tr,
            .template-inner,
            .template-container {
                page-break-inside: avoid;
            }
        }

        table,
        img,
        svg {
            break-inside: avoid;
        }

        .template-container {
            -webkit-transform: scale(1);
            /* Saf3.1+, Chrome */
            -moz-transform: scale(1);
            /* FF3.5+ */
            -ms-transform: scale(1);
            /* IE9 */
            -o-transform: scale(1);
            /* Opera 10.5+ */
            transform: scale(1);
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_id_card.css') }}"
        media="screen, print" />

    @php $version = App\Models\Language::version(); @endphp
    @if ($version->direction == 1)
        <!-- RTL css -->
    @endif

    <style>
        body {

            background: white;
            margin: 0;
            padding: 20px;
        }


        .change-font {
            text-align: justify;
            text-justify: inter-word;
            font-family: "Times-Roman" !important;
            font-style: italic !important;
        }



        .change-font-heading-imp {
            font-family: "Times-Roman" !important;
            font-style: normal !important;
        }

        .change-font-heading {
            font-family: "Times New Roman", serif;
        }



        .certificate {
            max-width: 1000px;
            margin: 25px auto;
            background: white;
            border: 3px solid #76037c;
            outline: 4px solid #76037c;
            outline-offset: 5px;
            padding: 50px 10px;
            background-image: url("{{ asset('uploads/batch/' . $img) }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        /*.border-color {*/
        /*padding: 2px;*/
        /*  margin-top: -2px;*/
        /*  border: 1px solid rgb(231, 14, 36);*/
        /*}*/

        .certificate1 {
            max-width: 1000px;
            margin: 50px auto;
            background: white;
            border: 3px solid #76037c;
            outline: 4px solid #76037c;
            outline-offset: 5px;

            padding: 50px 10px;
            background-image: url("{{ asset('uploads/batch/' . $img) }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }


        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
        }

        .logo {
            width: 120px;
            height: auto;
            margin-top: -40px;
            /* 👈 Moves logo slightly up */
            /*margin-left: -14px;*/
        }

        .college-details {
            text-align: center;
            flex: 1;
        }

        /*.college-details .adde{*/
        /*    font-size: 16px*/
        /*}*/

        .college-details h1 {
            margin: 0px;
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
            color: rgb(10, 111, 10);
        }

        #add1 {
            margin-top: 3px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: rgb(10, 111, 10);
        }

        .college-details .run {

            font-size: 14px;
            color: #76037c;
        }

        .college-details h2,
        .college-details h3 {
            margin: 4px 0;
            font-size: 17px;
        }

        h4.title {
            text-align: center;
            text-transform: uppercase;
            font-size: 24px;
            text-decoration: underline;
            margin: 13px 0 20px;
        }

        .subtext {
            text-align: center;
            font-size: 13px;
            margin-bottom: 20px;
            color: #444;
        }

        .row {
            margin: 10px 0;
            font-size: 18px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 60px;
            font-size: 21px;
        }


        .row1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            padding: 3px 11px;
            font-size: 21px;
        }

        .left {
            margin-top: -30px;
            width: 35%;
        }

        /*.right {*/
        /*    width: 40%;*/
        /*    font-size: 21px;*/
        /*}*/

        /*.spacer {*/
        /*    width: 40%;*/
            /* center space */
        /*}*/

        p {
            
            font-size: 18px;
            line-height: 1.9;
            margin-top: -5px;
        }

        a {
            color: rgb(11, 133, 255);
        }

        .signature-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 80px;
        }

        .signature-box {
            text-align: center;
            padding: 0px 75px;
        }

        .signature-box img {
            height: 40px;
            margin-bottom: 0px;
        }

        .bold {
            font-weight: bold;
        }

        .divider {
            /*border-top: 2px dashed #999;*/

            margin-top: 200px;



        }

        @media (max-width: 600px) {
            .label {
                display: block;
                margin-bottom: 5px;
            }

            .header {
                flex-direction: column;
                align-items: center;
            }

            .logo {

                margin-bottom: 10px;
            }
        }

        .space-update {
            padding-top: 15px;
        }

        .space-update1 {
            padding-top: 15px;
        }


        .remove-space {
            margin-top:-10px;
        }
    </style>
</head>

<body>
    @foreach ($rows as $row)
      

        <div class="printable">
          
            <!-- College Leaving Certificate -->

            <div class="space-update1">
                

                <div class="border-color">
                   
                    <div class="certificate ">
                         <div class="left ">
                                <span class="label change-font-heading">SL.No.: </span><span  class="label change-font-heading"> &nbsp;&nbsp;&nbsp;{{ $row->provisional_serial_no }}</span> 
                            </div>
                        
                        
                        <div class="header">
                          
                            <div class="college-details change-font-heading ">
                                
                                <img src="{{asset('uploads/batch/'.$row->batch->clc_logo_img)}}" alt="Logo" class="logo" />
                                <h1>{{ $row->batch->clc_college }}</h1>
                                <h1 id="add1">{{ $row->batch->clc_college_add }}</h1>
                                <h2 class="run">{{ $row->batch->clc_college_run }}</h2>
                                <h2 class="mb-3">
                                    {{ $row->batch->clc_college_reco }}
                                </h2>
                                <h2>{{ $row->batch->clc_college_app }}</h2>
                                
                                <h3 class="mb-3">
                                    <a href="">Email: {{ $row->batch->college_email }} </a>
                                    ‪
                                </h3>
                            </div>
                        </div>

                        <h4 class="title change-font-heading">Provisional Certificate</h4>


                        <!--<div class="row1 change-font-heading">-->
                        <!--    <div class="left ">-->
                        <!--        <span class="label">SL.No.: </span> &nbsp;{{ $row->provisional_serial_no }}-->
                        <!--    </div>-->
                        <!--    <div class="spacer"></div>-->
                        <!--    <div class="right row">-->
                        <!--        <span class="label">Date:-->
                        <!--        </span>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="row"><span class="label">Date:</span>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</div>-->

                        <p class="change-font ">
                            This is to certify that Mr./Ms.
                            <span class="bold change-font-heading-imp">{{ $row->name }}</span>, Son/Daughter of 
                            <span class="bold change-font-heading-imp">&nbsp;{{ $row->father_name }}</span> was a regular student of
                            this college, enrolled in the Diploma in Pharmacy course for the session
                            <span class="bold change-font-heading-imp">&nbsp;{{ $row->session->title }}.</span>
                        </p>

                        <p class="change-font ">
                            He/She has successfully passed the Final Year Examination conducted by the Diploma in
                            Pharmacy Examination Committee, Health Department(Medical Education), Govt. of Bihar, NMCH
                            Campus,Patna in the Month of <span class="bold change-font-heading-imp">{{ \Carbon\Carbon::parse($row->passing_date)->format('F Y') }}.</span>
                            
                        </p>

                        <p class="change-font ">
                            His/Her College Roll Number is <span
                                class="bold change-font-heading-imp">{{ $row->student_id }}</span> and
                            University Registration No. is <span
                                class="bold change-font-heading-imp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $row->registration_no }}.</span>
                        </p>

                        <p class="remove-space"><span class="change-font">Result</span> - <span class="bold change-font-heading-imp">{{ $row->result }}</span></p>
                        <p class="remove-space"><span class="change-font">Date of issue</span> - <span class="bold change-font-heading-imp">{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</span></p>

                        <div class="signature-row">
                            <div class="signature-box">
                                
                                <div class="bold change-font-heading">CLERK</div>
                            </div>
                            <div class="signature-box">
                                
                                <div class="bold change-font-heading">PRINCIPAL</div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
        </div>
    @endforeach
    <!--<div>Ram</div>-->

  
    
</body>
   <!--Print Js -->
    <script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            "use strict";
            $.print(".printable");
        });
    </script>
    

</html>
