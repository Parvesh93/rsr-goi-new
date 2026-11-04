@php
$img = '';
foreach ($rows as $row) {
    $img = optional($row->batch)->clc_college_img ?? '';
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
      background-image: url("{{asset('uploads/batch/'.$img)}}");
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
      background-image: url("{{asset('uploads/batch/'.$img)}}");
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
</head>

<body>
  @foreach($rows as $row)
    @php
      $batch = $row->batch;
      $program = $row->program;
      $session = $row->session;

      $programShortcode = strtoupper(optional($program)->shortcode ?? '');
      $programTitle = optional($program)->title ?? '';
      $sessionTitle = optional($session)->title ?? '';

      $serialProgramCode = $programShortcode;
      $courseCertificateTitle = $programTitle;
      $courseCompletionTitle = $programTitle;

      if ($programShortcode === 'ANM' || str_contains(strtoupper($programTitle), 'AUXILIARY')) {
          $serialProgramCode = 'ANM';
          $courseCertificateTitle = 'Auxiliary Nursing Midwifery (ANM)';
          $courseCompletionTitle = 'Auxiliary Nurse Midwifery (ANM)';
      } elseif ($programShortcode === 'GNM' || str_contains(strtoupper($programTitle), 'GENERAL NURSING')) {
          $serialProgramCode = 'GNM';
          $courseCertificateTitle = 'General Nursing Midwifery (GNM)';
          $courseCompletionTitle = 'General Nursing Midwifery (GNM)';
      } elseif (in_array($programShortcode, ['BSN', 'BSCN', 'BSC'], true) || str_contains(strtoupper($programTitle), 'B.SC')) {
          $serialProgramCode = 'BSN';
          $courseCertificateTitle = 'B.Sc NURSING';
          $courseCompletionTitle = 'B.Sc NURSING';
      }

      $serial = str_pad((int) $row->serial_no, 4, '0', STR_PAD_LEFT);
      $issueDate = \Carbon\Carbon::parse($row->date)->format('d-m-Y');
      $relievingDate = !empty($row->relieving_date)
          ? \Carbon\Carbon::parse($row->relieving_date)->format('d/m/Y')
          : \Carbon\Carbon::parse($row->date)->format('d/m/Y');
    @endphp

    <div class="printable">

      <div class="certificate-page">
        <div class="certificate">
          <div class="header">
            <div class="college-details change-font-heading">
              @if(!empty(optional($batch)->clc_logo_img))
                <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}" alt="Logo" class="logo" />
              @endif
              <h1>{{ optional($batch)->clc_college }}</h1>
              <h1 id="add1">{{ optional($batch)->clc_college_add }}</h1>
              <h2 class="run">{{ optional($batch)->clc_college_run }}</h2>
              <h2 class="mb-3">{{ optional($batch)->clc_college_reco }}</h2>
              <h2>{{ optional($batch)->clc_college_app }}</h2>
              <h3 class="mb-3"><a href="">Email: {{ optional($batch)->college_email }}</a></h3>
            </div>
          </div>

          <h4 class="title change-font-heading">College Leaving Certificate</h4>

          <div class="row1 change-font-heading">
            <div class="left">
              <span class="label">SL. No.:</span>&nbsp; RSR/NSG/{{ $serialProgramCode }}/{{ $serial }}
            </div>
            <div class="spacer"></div>
            <div class="right row"><span class="label">Date:</span>{{ $issueDate }}</div>
          </div>

          <p class="change-font">
            This is to certify that Mr./Ms.
            <span class="bold change-font-heading-imp">{{ $row->name }}</span>, son/daughter of
            <span class="bold change-font-heading-imp">{{ $row->father_name }}</span> was a
            regular student of the
            <span class="bold change-font-heading-imp">{{ $courseCertificateTitle }}</span>
            course under the department of Nursing in this institution during the academic session
            <span class="bold change-font-heading-imp">{{ $sessionTitle }}</span>.
          </p>

          <p class="change-font">
            He/ She was registered under the Board/University
            <span class="bold change-font-heading-imp">{{ $row->college_name }}</span>, he/she bears
            University Registration No
            <span class="bold change-font-heading-imp">{{ $row->registration_no }}</span>, &amp; his/her
            College Roll Number is
            <span class="bold change-font-heading-imp">{{ $row->student_id }}</span>. and passed with
            <span class="bold change-font-heading-imp">{{ $row->division }}</span> Division.
          </p>

          <p class="change-font">
            During his/her period of study, he/she maintained good conduct and satisfactory academic
            performance. He/ She has completed all necessary formalities for the issuance of this College
            Leaving Certificate.
          </p>

          <div class="signature-row">
            <div class="signature-box"><div class="bold change-font-heading">HEAD CLERK</div></div>
            <div class="signature-box"><div class="bold change-font-heading">PRINCIPAL</div></div>
          </div>
        </div>
      </div>

      <div class="certificate-page">
        <div class="certificate">
          <div class="header">
            <div class="college-details change-font-heading">
              @if(!empty(optional($batch)->clc_logo_img))
                <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}" alt="Logo" class="logo" />
              @endif
              <h1>{{ optional($batch)->clc_college }}</h1>
              <h1 id="add1">{{ optional($batch)->clc_college_add }}</h1>
              <h2 class="run">{{ optional($batch)->clc_college_run }}</h2>
              <h2 class="mb-3">{{ optional($batch)->clc_college_reco }}</h2>
              <h2>{{ optional($batch)->clc_college_app }}</h2>
              <h3 class="mb-3"><a href="">Email: {{ optional($batch)->college_email }}</a></h3>
            </div>
          </div>

          <h4 class="title change-font-heading">Character Certificate</h4>

          <div class="row1 change-font-heading">
            <div class="left">
              <span class="label">SL. No.:</span>&nbsp; RSR/NSG/{{ $serialProgramCode }}/{{ $serial }}
            </div>
            <div class="spacer"></div>
            <div class="right row"><span class="label">Date:</span>{{ $issueDate }}</div>
          </div>

          <p class="change-font">
            This is to certify that Mr./Ms.
            <span class="bold change-font-heading-imp">{{ $row->name }}</span>, son/daughter of
            <span class="bold change-font-heading-imp">{{ $row->father_name }}</span> was a
            regular student of the
            <span class="bold change-font-heading-imp">{{ $courseCertificateTitle }}</span>
            course under the department of Nursing in this institution during the academic session
            <span class="bold change-font-heading-imp">{{ $sessionTitle }}</span>.
          </p>

          <p class="change-font">
            He/ She was registered under
            <span class="bold change-font-heading-imp">{{ $row->college_name }}</span><br>
            He/she bears <span class="bold change-font-heading-imp">GOOD MORAL CHARACTER</span>.
            I wish him/her all success in future.
          </p>

          <p class="change-font">
            During his/her period of study, he/she maintained good conduct and satisfactory academic
            performance. He/ She has completed all necessary formalities for the issuance of this College
            Character Certificate.
          </p>

          <div class="signature-row">
            <div class="signature-box"><div class="bold change-font-heading">HEAD CLERK</div></div>
            <div class="signature-box"><div class="bold change-font-heading">PRINCIPAL</div></div>
          </div>
        </div>
      </div>

      <div class="certificate-page">
        <div class="certificate">
          <div class="header">
            <div class="college-details change-font-heading">
              @if(!empty(optional($batch)->clc_logo_img))
                <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}" alt="Logo" class="logo" />
              @endif
              <h1>{{ optional($batch)->clc_college }}</h1>
              <h1 id="add1">{{ optional($batch)->clc_college_add }}</h1>
              <h2 class="run">{{ optional($batch)->clc_college_run }}</h2>
              <h2 class="mb-3">{{ optional($batch)->clc_college_reco }}</h2>
              <h2>{{ optional($batch)->clc_college_app }}</h2>
              <h3 class="mb-3"><a href="">Email: {{ optional($batch)->college_email }}</a></h3>
            </div>
          </div>

          <div class="row1 change-font-heading">
            <div class="left">
              <span class="label">SL. No.:</span>&nbsp; RSR/NSG/{{ $serialProgramCode }}/{{ $serial }}
            </div>
            <div class="spacer"></div>
            <div class="right row"><span class="label">Date:</span>{{ $issueDate }}</div>
          </div>

          <h4 class="title change-font-heading course-completion-title">Course Completion Certificate</h4>

          <p class="change-font" style="text-align:center;">
            This is to certify that Mr./Ms.
            <span class="bold change-font-heading-imp">{{ $row->name }}</span> son/daughter of
            <span class="bold change-font-heading-imp">{{ $row->father_name }}</span> has completed
            <span class="bold change-font-heading-imp">{{ $courseCompletionTitle }}</span> course as per
            the curriculum of Indian Nursing Council, New Delhi, Bihar Nurses Registration council, Patna
            from Ram Saran Roy College starting from………………...to…………...……
          </p>

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

    </div>
  @endforeach

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