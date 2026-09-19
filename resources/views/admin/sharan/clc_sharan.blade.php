<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,maximum-scale=1.0">
	<title>{{ $title }}</title>

	<style type="text/css" media="print">
	@media print {
      @page { size: auto; margin: 10px; }  
      @page :footer { display: none }
      @page :header { display: none }
      body { margin: 15mm 15mm 15mm 15mm; }
      .page-break { page-break-before: auto; }
      table, tbody, tr, .template-inner, .template-container {page-break-inside: avoid;}
	}
	table, img, svg {
      break-inside: avoid;
	}
	.template-container {
      -webkit-transform: scale(1.0);  /* Saf3.1+, Chrome */
      -moz-transform: scale(1.0);  /* FF3.5+ */
      -ms-transform: scale(1.0);  /* IE9 */
      -o-transform: scale(1.0);  /* Opera 10.5+ */
      transform: scale(1.0);
    }
	</style>

	<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_id_card.css') }}" media="screen, print">

  @php 
  $version = App\Models\Language::version(); 
  @endphp
  @if($version->direction == 1)
  <!-- RTL css -->

  
  @endif
  
  <style>
   

       body {
        font-family: "Times New Roman", serif;
        background: white;
        margin: 0;
        padding: 20px;
      }

      .certificate {
        max-width: 900px;
        margin: 30px auto;
        background: white;
        border: 1px solid #ccc;
        padding: 30px 40px;
        background-image: url("/images/watermark.png");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 55%;
      }

      .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
      }

      .logo {
        width: 100px;
        height: auto;
      }

      .college-details {
        text-align: center;
        flex: 1;
      }

      .college-details h1 {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
        text-transform: uppercase;
        color: rgb(10, 111, 10);
      }

      .college-details h2,
      .college-details h3 {
        margin: 2px 0;
        font-size: 14px;
      }

      h4.title {
        text-align: center;
        text-transform: uppercase;
        font-size: 18px;
        text-decoration: underline;
        margin: 20px 0 6px;
      }

      .subtext {
        text-align: center;
        font-size: 13px;
        margin-bottom: 20px;
        color: #444;
      }

      .row {
        margin: 10px 0;
        font-size: 15px;
      }

      .label {
        font-weight: bold;
        display: inline-block;
        width: 180px;
      }

      p {
        font-size: 15px;
        line-height: 1.6;
      }

      a {
        color: rgb(11, 133, 255);
      }

      .signature-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-top: 40px;
      }

      .signature-box {
        text-align: center;
      }

      .signature-box img {
        height: 40px;
        margin-bottom: 5px;
      }

      .bold {
        font-weight: bold;
      }

      .divider {
        border-top: 2px dashed #999;
        margin: 60px 0 30px;
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

  </style>
</head>
<body>

@foreach($rows as $row)

<div class="printable">
<div class="">

    <!-- College Leaving Certificate -->
    <div class="certificate">
      <div class="header">
        <img src="{{asset('uploads/setting/rsr_logo.png')}}" alt="Logo" class="logo" />
        <div class="college-details">
          <h1>RAM SHARAN ROY COLLEGE OF PHARMACY</h1>
          <h2>Recognized by Pharmacy Council of India (PCI), New Delhi</h2>
          <h2>Approved by Health Department Govt. of Bihar</h2>
          <h3>
            <a href="">Email: rsrcpjandha@gmail.com </a>| Phone: ‪+91 7323018025‬
          </h3>
        </div>
      </div>

      <h4 class="title">College Leaving Certificate</h4>
      <div class="subtext">(This is not in lieu of Transfer Certificate)</div>

      <div class="row"><span class="label">Sl. No.:</span>{{$row->clc_no}}</div>
      <div class="row"><span class="label">Date:</span>{{$row->date}}</div>

      <p>
        This is to certify that Mr./Ms. <span class="bold">{{ $row->name }}</span>,
        son/daughter of <span class="bold">{{ $row->father_name }}</span> and
        <span class="bold">{{$row->mother_name}}</span>, was a student of this
        college, enrolled in the course
        <span class="bold">{{$row->program->shortcode}}</span>, for the session
        <span class="bold">{{$row->session->title}}</span>.
      </p>

      <p>
        He/She was registered under the Board/University
        <span class="bold">{{$row->college_name}}</span>,
        bearing University Registration No. <span class="bold">RSR/{{$row->program->shortcode}}/{{$row->session->title}}/{{$row->registration_no}}</span>,
        and passed with <span class="bold">{{$row->division}}</span> Division. His/Her
        Examination Roll Number is <span class="bold">{{$row->student_id}}</span>, and
        M.R. No. is <span class="bold">{{$row->mr_no}}</span>, dated
        <span class="bold">{{$row->mr_date}}</span>.
      </p>

      <p>
        During his/her period of study, he/she maintained good conduct and
        satisfactory academic performance. He/She has completed all necessary
        formalities for the issuance of this Leaving Certificate.
      </p>

      <div class="signature-row">
        <div class="signature-box">
          {{-- <img src="/images/sign1.png" alt="Assistant Signature" /> --}}
          <div class="bold">ASSISTANT</div>
        </div>
        <div class="signature-box">
          {{-- <img src="/images/sign2.png" alt="Principal Signature" /> --}}
          <div class="bold">PRINCIPAL</div>
        </div>
      </div>

      <!-- Divider -->
      <div class="divider"></div>

      <!-- Character Certificate -->
      <div class="header">
        <img src="{{asset('uploads/setting/rsr_logo.png')}}" alt="Logo" class="logo" />
        <div class="college-details">
          <h1>RAM SHARAN ROY COLLEGE OF PHARMACY</h1>
          <h2>Recognized by Pharmacy Council of India (PCI), New Delhi</h2>
          <h2>Approved by Health Department Govt. of Bihar</h2>
          <h3>
            <a href="">Email: rsrcpjandha@gmail.com</a> | Phone: +91 7323018025
          </h3>
        </div>
      </div>

      <h4 class="title">Character Certificate</h4>

      <div class="row"><span class="label">Sl. No.:</span> {{$row->clc_no}}</div>
      <div class="row"><span class="label">Date:</span>{{$row->date}}</div>

      <p>
        This is to certify that Mr./Ms. <span class="bold">{{ $row->name }}</span>,
        son/daughter of <span class="bold">{{ $row->father_name }}</span> and
        <span class="bold">{{$row->mother_name}}</span>, was a student of this
        college, enrolled in the course
        <span class="bold">{{$row->program->shortcode}}</span>, for the session
        <span class="bold">{{$row->session->title}}</span>.
      </p>

      <p>
        He/She was registered under the
        <span class="bold">{{$row->college_name}}</span>. He/she
        bears <span class="bold">GOOD MORAL CHARACTER</span>. I wish him/her all
        success in future.
      </p>

      <div class="signature-row">
        <div class="signature-box">
          {{-- <img src="/images/sign1.png" alt="Assistant Signature" /> --}}
          <div class="bold">ASSISTANT</div>
        </div>
        <div class="signature-box">
          {{-- <img src="/images/sign2.png" alt="Principal Signature" /> --}}
          <div class="bold">PRINCIPAL</div>
        </div>
      </div>
    </div>

</div>
 
 
 <!--<h1>Ram</h1>-->
<div class="page-break"></div>
</div>
@endforeach
     <!--<div>Ram</div>-->

	<!-- Print Js -->
	<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
	<script src="{{ asset('dashboard/plugins/print/js/jQuery.print.min.js') }}"></script>

	<script type="text/javascript">
	$( document ).ready(function() {
        "use strict";
	   $.print(".printable");
	});
	</script>

</body>
</html>