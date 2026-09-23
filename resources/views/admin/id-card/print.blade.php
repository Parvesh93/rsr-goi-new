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
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
      }

      .id-card {
        width: 430px;
        height: 270px;
        background-color: #f0f8ff;
        border-radius: 8px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        position: relative;
        transition: transform 0.3s ease;
      }

      .id-card:hover {
        transform: scale(1.02);
      }
      
        .header {
        height: 52px;
        background: linear-gradient(135deg, #0066cc, #004a99);
        display: flex;
        align-items: center;
        padding: 0 12px;
        border-bottom: 4px solid #ffd700;
        margin-bottom: 0;
      }

      .logo {
        width: 42px;
        height: 42px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-right: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        border: 2px solid #ffd700;
      }

      .logo img {
        width: 36px;
        height: 36px;
      }
     
      .college-info {
        flex: 1;
      }

      .college-name {
        color: white;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
      }

      .college-address {
        color: rgba(255, 255, 255, 0.9);
        font-size: 9px;
        line-height: 1;
        text-transform: uppercase;
      }
    
     .info-bar {
        height: 24px;
        background: #ffd700;
        display: flex;
        align-items: center;
        font-size: 12px;
        font-weight: 600;
        padding: 0 10px;
        justify-content: space-between;
      }

      .info-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
      }

      .info-item:last-child {
        margin-right: 0;
        margin-left: auto;
      }

      .info-label {
        margin-right: 5px;
      }

     
       .code-section {
        background: #ff6666;
        padding: 0 8px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .content {
        display: flex;
        padding: 12px 8px;
        position: relative;
        background: linear-gradient(to bottom, #f0f8ff, #e6f2ff);
      }

      .photo-container {
        position: relative;
        margin-right: 15px;
      }

      .photo {
        width: 85px;
        height: 120px;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0);
        border: 1px solid #ddd;
      }
     
       .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .session {
        position: absolute;
        top: 8%;
        right: 25px;
        background: #32cd32;
        color: white;
        padding: 4px 8px;
        font-size: 10px;
        transform: rotate(-90deg);
        transform-origin: top right;
        white-space: nowrap;
        font-weight: bold;
        border-radius: 0;
        z-index: 10;
        width: 85px;
        text-align: center;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      .signature-container {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2px 0;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 0 0 5px 5px;
        backdrop-filter: blur(2px);
      }

      .signature img {
        width: 85px;
        height: 20px;
      }

      .signature-text {
        font-size: 7px;
        color: #0066cc;
        font-weight: bold;
        margin-top: 1px;
      }
      
        .details {
        flex: 1;
        font-size: 11px;
        padding-left: 5px;
      }

      .detail-row {
        display: flex;
        margin-bottom: 4px;
        line-height: 1.3;
        position: relative;
      }

      .detail-row:after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(
          to right,
          transparent,
          rgba(200, 200, 200, 0.5),
          transparent
        );
      }
     
     detail-row:last-child:after {
        display: none;
      }

      .detail-label {
        width: 90px;
        font-weight: 600;
        color: #333;
      }

      .detail-value {
        flex: 1;
        color: #444;
      }

      .student-name {
        color: #e60000;
        font-weight: bold;
        position: relative;
        display: inline-block;
      }
      .info-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
      }

          .student-name:after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 1px;
        background-color: rgba(230, 0, 0, 0.3);
      }

  </style>
</head>
<body>

@foreach($rows as $row)
@php
    $enroll = \App\Models\Student::enroll($row->id);
    $batch = $row->batch;
    $program = optional($enroll)->program ?: $row->program;
    $session = optional($enroll)->session;

    $collegeName = optional($batch)->clc_college ?: 'Ram Sharan Roy Group of Institutions';
    $collegeAddress = optional($batch)->clc_college_add ?: '';
    $courseCode = optional($program)->shortcode ?: optional($program)->title ?: 'N/A';
    $sessionTitle = optional($session)->title ?: 'N/A';
@endphp
<div class="printable">
<div class="">
   <div class="id-card">
      <div class="header">
        <div class="logo">
          <img src="{{asset('uploads/setting/rsr_logo.png')}}" alt="College Logo" />
        </div>
        <div class="college-info">
          <div class="college-name">{{ $collegeName }}</div>
          <div class="college-address">
            {{ $collegeAddress }}
          </div>
        </div>
      </div>

      <div class="info-bar">
        <div class="info-item">
          <span class="info-label">Course:</span>
          <span>{{ $courseCode }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Reg No:</span>
          <span>RSR/{{ $courseCode }}/{{ $sessionTitle }}/{{ $row->registration_no }}</span>
        </div>
        <!--<div class="info-item" style="margin-left: auto">-->
        <!--  <span class="info-label">Code:</span>-->
        <!--  <span>4474</span>-->
        <!--</div>-->
      </div>
       <div class="content">
        <div class="photo-container">
          <div class="photo">
            
            @if(is_file('uploads/student/'.@$row->photo))
            <img src="{{ asset('uploads/student/'.$row->photo) }}" alt="Student Photo" />
            @else
            <!--<img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">-->
            <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" alt="Student Photo" />
           @endif
          </div>
          <div class="signature-container">
            <div class="signature">
            @if(is_file('uploads/student/'.@$row->signature))
            <img src="{{ asset('uploads/student/'.$row->signature) }}" alt="Signature" />
            @else
            <!--<img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">-->
            <img src="{{asset('uploads/setting/signature.jpg')}}" alt="Signature" />
           @endif
              
            </div>
            <div class="signature-text">SIGNATURE</div>
          </div>
        </div>

        <div class="details">
          <div class="detail-row">
            <div class="detail-label">Student's Name:</div>
            <div class="detail-value">
              <span class="student-name">{{ $row->first_name }} {{ $row->last_name }}</span>
            </div>
          </div>
           <div class="detail-row">
            <div class="detail-label">Father's Name:</div>
            <div class="detail-value">{{ $row->father_name }}</div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Mother's Name:</div>
            <div class="detail-value">{{$row->mother_name}}</div>
          </div>

          <div class="detail-row">
            <div class="detail-label">DOB:</div>
            <div class="detail-value">{{$row->dob}}</div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Roll No.:</div>
            <div class="detail-value">{{$row->student_id}}</div>
          </div>
         <div class="detail-row">
            <div class="detail-label">Contact:</div>
            <div class="detail-value">{{$row->phone}}</div>
          </div>
          <div class="detail-row">
            <div class="detail-label">Category:</div>
            <div class="detail-value">{{$row->caste}}</div>
          </div>

          <div class="detail-row">
            <div class="detail-label">Address:</div>
            <div class="detail-value" style="white-space: normal; word-wrap: break-word;">{{$row->present_address}}</div>
          </div>
        </div>
        <div class="session">SESSION {{ $sessionTitle }}</div>
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