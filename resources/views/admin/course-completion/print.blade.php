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
  @if($version->direction == 1)
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
      position: relative;
      overflow: hidden;
      isolation: isolate;
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
      position: relative;
      overflow: hidden;
      isolation: isolate;
    }


    .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      flex-wrap: wrap;
    }

    .logo {
    width: 150px !important;
    height: auto !important;
    max-width: none !important;
    object-fit: contain;
    flex-shrink: 0;
    margin-top: -45px;
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
      color:#76037c ;
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
      margin: 13px 0 12px;
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
      width: auto;
      min-width: 78px;
      white-space: nowrap;
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
  
  .left{
      width: 80%;
  }
  
  .right {
  width: 30%;
   font-size: 21px;
   margin-right: -35px;

}

.spacer {
  width: 0%; /* center space */
}

    p {
      font-size: 18px;
      line-height: 1.9;
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
        display: inline-block;
        margin-bottom: 0;
        white-space: nowrap;
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
    
   
    

    .certificate-page {
      page-break-after: always;
      break-after: page;
    }

    .certificate-page:last-child {
      page-break-after: auto;
      break-after: auto;
    }

    .course-completion-title {
      text-transform: none !important;
      margin-top: 35px !important;
    }

  </style>
  <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/certificate-watermark.css') }}" media="screen, print" />
</head>

<body>
@php
    $batch = $row->batch;
    $program = $row->program;

    $programTitle = optional($program)->title ?? '';
    $programShortcode = strtoupper(optional($program)->shortcode ?? '');
    $serial = str_pad((int) $row->serial_no, 4, '0', STR_PAD_LEFT);
    $issueDate = optional($row->date)->format('d-m-Y');
    $startDate = optional($row->course_start_date)->format('d/m/Y');
    $endDate = optional($row->course_end_date)->format('d/m/Y');
    $relievingDate = optional($row->relieving_date)->format('d/m/Y');

    $serialDisplay = $serial;
    $courseTitle = $programTitle;

    if ($type === 'nursing') {
        $code = $programShortcode;
        if ($programShortcode === 'ANM' || str_contains(strtoupper($programTitle), 'AUXILIARY')) {
            $code = 'ANM';
            $courseTitle = 'Auxiliary Nurse Midwifery (ANM)';
        } elseif ($programShortcode === 'GNM' || str_contains(strtoupper($programTitle), 'GENERAL NURSING')) {
            $code = 'GNM';
            $courseTitle = 'General Nursing Midwifery (GNM)';
        } elseif (in_array($programShortcode, ['BSN', 'BSCN', 'BSC'], true) || str_contains(strtoupper($programTitle), 'B.SC')) {
            $code = 'BSN';
            $courseTitle = 'B.Sc NURSING';
        }
        $serialDisplay = 'RSR/NSG/' . $code . '/' . $serial;
    }
@endphp

<div class="printable">
    <div class="certificate" style="{!! \App\Support\CertificateWatermark::style($row->batch) !!}">
        <div class="header">
            <div class="college-details change-font-heading">
                @if(!empty(optional($batch)->cc_logo_img))
                    <img src="{{ asset('uploads/batch/' . $batch->cc_logo_img) }}" alt="Logo" class="logo" />
                @endif
                <h1>{{ optional($batch)->cc_college }}</h1>
                <h1 id="add1">{{ optional($batch)->cc_college_add }}</h1>
                <h2 class="run">{{ optional($batch)->cc_college_run }}</h2>
                <h2 class="mb-3">{{ optional($batch)->cc_college_reco }}</h2>
                <h2>{{ optional($batch)->cc_college_app }}</h2>
                <h3 class="mb-3"><a href="">Email: {{ optional($batch)->cc_college_email }}</a></h3>
            </div>
        </div>

        <div class="row1 change-font-heading">
            <div class="left"><span class="label">SL. No.:</span>&nbsp; {{ $serialDisplay }}</div>
            <div class="spacer"></div>
            <div class="right row"><span class="label">Date:</span>{{ $issueDate }}</div>
        </div>

        <h4 class="title change-font-heading course-completion-title">Course Completion Certificate</h4>

        @if($type === 'nursing')
            <p class="change-font" style="text-align:center;">
                This is to certify that Mr./Ms.
                <span class="bold change-font-heading-imp">{{ $row->name }}</span> son/daughter of
                <span class="bold change-font-heading-imp">{{ $row->father_name }}</span> has completed
                <span class="bold change-font-heading-imp">{{ $courseTitle }}</span> course as per the curriculum of
                Indian Nursing Council, New Delhi, Bihar Nurses Registration council, Patna from
                <span class="bold change-font-heading-imp">{{ optional($batch)->cc_college }}</span>
                starting from <span class="bold change-font-heading-imp">{{ $startDate }}</span>
                to <span class="bold change-font-heading-imp">{{ $endDate }}</span>.
            </p>
        @else
            <p class="change-font" style="text-align:center;">
                This is to certify that Mr./Ms.
                <span class="bold change-font-heading-imp">{{ $row->name }}</span> son/daughter of
                <span class="bold change-font-heading-imp">{{ $row->father_name }}</span> has successfully completed
                <span class="bold change-font-heading-imp">{{ $courseTitle }}</span> course from
                <span class="bold change-font-heading-imp">{{ optional($batch)->cc_college }}</span>
                starting from <span class="bold change-font-heading-imp">{{ $startDate }}</span>
                to <span class="bold change-font-heading-imp">{{ $endDate }}</span>.
            </p>
        @endif

        <p class="change-font">
            He/she was relieved from this institution in the afternoon of
            <span class="bold change-font-heading-imp">{{ $relievingDate }}</span> his/her character was
            <span class="bold change-font-heading-imp">Good</span> during the study period.<br>
            Institution has no objection if he/she joins anywhere.<br>
            I wish him/her for a bright future.
        </p>

        <div class="signature-row">
            <div class="signature-box"><div class="bold change-font-heading">HEAD CLERK</div></div>
            <div class="signature-box"><div class="bold change-font-heading">PRINCIPAL</div></div>
        </div>
    </div>
</div>

<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    "use strict";
    $.print(".printable");
});
</script>
</body>
</html>