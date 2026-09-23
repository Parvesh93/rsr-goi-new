<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    
    @include('admin.layouts.common.header_script')

    <!--<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/admit_card.css') }}" media="screen, print">-->
     <!--<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_application.css') }}" media="screen, print">-->

    @php 
    $version = App\Models\Language::version(); 
    @endphp
    @if($version->direction == 1)
    <!-- RTL css -->
    <style type="text/css" media="screen, print">
      .template-container {
        direction: rtl;
      }
    </style>
    @endif
    
<style>
    
    
body {
  font-family: Arial, sans-serif;
  background: #f7f7f7;
  padding: 11px;
 
  margin: 0px;
}

.container {
  background: white;
  max-width: 850px;
  width: 95%;
  margin: auto;
  padding: 20px;
  border: 4px solid #76037c;
  
  box-shadow: 2px 2px 8px #ddd;
  position: relative;
}



.header {
  text-align: center;
  border-bottom: 2px solid #36013f;
  padding-bottom: 0px;
  margin-bottom: 0px;
  position: relative;
}

.logo-section {
  position: absolute;
  left: 0px;
  top: 4px;
  margin-left:-10px;
  margin-top:-3px;
}

.college-logo {
  width: 130px;
  height: 130px;
  border-radius: 50%;
  object-fit: contain;
  padding: 5px;
}

h1 {
  color: #36013f;
  font-size: clamp(20px, 4vw, 28px);
  margin: 0 0 3px 0;
  padding-top: 5px;
}

.recognition,
.affiliation,
.address {
   font-size: 15px;
  margin-top:0px;
  margin-bottom: 0px;
  /*color: #333;*/
  /*font-weight: bold;*/
}

.subtitle{
 color: #ec720e;
  /*margin: 2px 0;*/
  /*font-size: clamp(11px, 1.6vw, 11px);*/
  font-size: 13px;
  font-weight: bold;
  margin-left:35px;
   margin-top:0px;
  margin-bottom: 0px;
  
 
}

.common_new_up {
    margin-right:-50px;
}

.recognition,
.affiliation,
.address {
  color: black;
  font-weight: bold;
}


.form-number {
  position: absolute;
  top: 20px;
  left: 20px;
  color: #36013f;
  font-weight: bold;
}

.mriz{
   color: white; 
}
.form-title{
  background-color: #36013f;
  color: white;
  padding: 6px;
  text-align: center;
  font-weight: bold;
  margin: 10px 0;
  border-radius: 0;
}

.form-instruction {
  text-align: center;
  font-style: italic;
  margin-bottom: 15px;
  color: #555;
  font-size: clamp(11px, 1.8vw, 13px);
}


.office-use-section h3 {
  margin: 0 0 10px 0;
  font-size: clamp(14px, 2.3vw, 16px);
  font-weight: bold;
}

.office-fields .field {
  margin: 3px 0;
  font-size: clamp(11px, 1.8vw, 13px);
  font-weight: bold;
}
.bold-text{
    color: black;
}

.bold-text1{
    color: green;
}

.bold-text2{
    color: blue;
}
.bold-text3{
    color: #ec720e;
}

.flex-double {
  display: flex;
  flex-wrap: wrap;
  gap: 2px;
  margin-bottom: -20px;
  /padding-bottom: 6px;/
}

.flex-double .form-half {
  flex: 1;
  min-width: 300px;
   margin-bottom: -20px;
  /padding-bottom: 8px;/
}


.photo-box {
  border: 1px solid #ccc;
  width: 120px;
  height: 143px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #666;
  background: #f9f9f9;
  font-size: clamp(11px, 1.8vw, 13px);
}

.form-section {
  margin-bottom: 15px;
  padding-right: 170px;
}

.form-section label {
  display: block;
  margin-bottom: 4px;
  font-weight: bold;
  font-size: clamp(11px, 1.8vw, 13px);
}

.form-section input[type="text"],
.form-section input[type="date"],
.form-section textarea {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 0;
  font-size: clamp(11px, 1.8vw, 13px);
}

textarea {
  height: 40px;
  resize: none;
}

.block-letters {
  font-size: clamp(10px, 1.8vw, 12px);
  color: #666;
  margin-left: 10px;
}

.marital-status {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.marital-status label {
  font-weight: normal;
  display: flex;
  align-items: center;
  gap: 5px;
}

.address-details {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 8px;
  margin-top: 8px;
}

.address-details input {
  width: calc(100% - 60px);
  margin-left: 10px;
  border-radius: 0;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 8px;
  table-layout: fixed;
  font-size: clamp(11px, 1.8vw, 13px);
}

/* Specific column widths */
table th:nth-child(1) {
  width: 5%;
  
} /* Sl. No. */
table th:nth-child(2) {
  width: 7%;
} /* Exam Passed */
table th:nth-child(3) {
  width: 25%;
} /* School name */
/*table th:nth-child(4) {*/
/*  width: 20%;*/
} /* Board name */
table th:nth-child(4) {
  width: 10%;
} /* Year */
table th:nth-child(5) {
  width: 13%;
} /* Subjects */
table th:nth-child(6) {
  width: 12%;
} /* Marks */
table th:nth-child(7) {
  width: 8%;
} /* Percentage */

table th,
table td {
  border: 1px solid #ccc;
  padding: 6px;
  text-align: left;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

table td {
  padding: 0;
  height: 30px;
}

table td:not(:has(input)) {
  padding: 6px;
}

table input {
  width: 100%;
  height: 100%;
  padding: 3px 6px;
  border: none;
  margin: 0;
  font-size: inherit;
  outline: none;
  background: transparent;
}

table th {
  background: #f5f5f5;
  font-weight: bold;
  padding: 6px 4px;
  text-align: center;
}

.form-section:last-child {
  padding-right: 0;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
  .container {
    padding: 12px;
  }

  .logo-section {
    position: relative;
    left: 0;
    top: 0;
    text-align: center;
    margin-bottom: 15px;
    
  }

  .college-logo {
    width: 90px;
    height: 90px;
  }

  h1 {
    padding-top: 0;
  }

  .photo-section {
    position: static;
    width: 150px;
    margin: 20px auto;
    order: 1;
  }

  .container {
    display: flex;
    flex-direction: column;
  }

  .header {
    order: 0;
  }

  .form-number {
    order: 0;
  }

  .form-title {
    order: 0;
  }

  .form-instruction {
    order: 0;
  }

  .office-use-section {
    order: 2;
  }

  .admission-form {
    order: 3;
  }

  .form-section {
    padding-right: 0;
  }

  .marital-status {
    gap: 10px;
  }

  table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }

  table th,
  table td {
    min-width: unset; /* Remove previously set min-width */
  }

  /* Maintain column widths in scroll view */
  table th:nth-child(1) {
    min-width: 50px;
  }
  table th:nth-child(2) {
    min-width: 70px;
  }
  table th:nth-child(3) {
    min-width: 200px;
  }
 
  table th:nth-child(4) {
    min-width: 100px;
  }
  table th:nth-child(5) {
    min-width: 120px;
  }
  table th:nth-child(6) {
    min-width: 120px;
  }
  table th:nth-child(7) {
    min-width: 80px;
  }

  .address-details {
    grid-template-columns: 1fr;
  }

  .photo-box {
    width: 120px;
    height: 140px;
  }
}

@media screen and (max-width: 480px) {
  .container {
    padding: 10px;
  }

  .college-logo {
    width: 80px;
    height: 80px;
  }

  .photo-box {
    width: 120px;
    height: 150px;
  }

  .marital-status {
    flex-direction: column;
    gap: 5px;
  }
}

@media print {
  body {
    background: white;
    padding: 0;
  }

  .container {
    box-shadow: none;
    border: none;
  }
}

/* New form row styles */
.form-row {
  margin-bottom: 12px;
  padding-right: 130px;
}

.form-row label {
  display: inline-block;
  min-width: 200px;
  font-weight: bold;
  font-size: clamp(11px, 1.8vw, 13px);
}

.form-row input[type="text"],
.form-row input[type="date"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  font-size: clamp(11px, 1.8vw, 13px);
}

input[type="text"],
input[type="date"]
{
    font-weight: bold;
    color: black;
}



.radio-text
{
  margin-top: 37px;
  margin-bottom: 12px;
  
  
  /*padding-left: 10px;*/
  font-weight: bold;
}

.radio-group {
  display: inline-flex;
  gap: 2px;
}

.radio-label {
  font-weight: normal;
  min-width: auto;
  margin-left: 5px;
}
.radio-propert{
    color: red;
    margin-right: 3px;
}

.address-line {
  margin-top: 8px;
  margin-left: 0;
  display: flex;
  flex-direction: row;
  gap: 20px;
  width: 120%;
}

.address-line span {
  display: flex;
  align-items: center;
  white-space: nowrap;
  flex: 1;
}

.address-line input {
  width: 100%;
  max-width: 250px;
  padding: 8px;
  border: 1px solid #ccc;
  margin-left: 5px;
}

@media screen and (max-width: 768px) {
  .address-line {
    flex-wrap: wrap;
  }

  .address-line span {
    flex: 1 1 40%;
    min-width: 200px;
    margin-bottom: 10px;
  }

  .address-line input {
    max-width: none;
  }
}

/* Academic section styles */
.academic-section {
  padding-right: 0;
}

.note {
  margin: 5px 0;
  font-size: clamp(11px, 1.8vw, 13px);
  font-style: italic;
}

.academic-row {
  display: flex;
  border: 1px solid #ccc;
  margin-bottom: -1px;
  font-size: clamp(11px, 1.8vw, 13px);
}

.academic-row.header {
  background: #f5f5f5;
  font-weight: bold;
}

.academic-row > span {
  padding: 6px;
  border-right: 1px solid #ccc;
}

.academic-row > span:last-child {
  border-right: none;
}

.academic-row input {
  width: 100%;
  border: none;
  padding: 4px;
  font-size: inherit;
}

/* Column widths for academic row */
.sl-no {
  width: 5%;
}
.exam {
  width: 8%;
}
.school {
  width: 25%;
}
.board {
  width: 15%;
}
.year {
  width: 8%;
}
.subjects {
  width: 15%;
}
.marks {
  width: 15%;
}
.percentage {
  width: 9%;
}

@media screen and (max-width: 768px) {
  .container {
    padding: 12px;
  }

  .form-row {
    padding-right: 0;
  }

  .form-row label {
    display: block;
    margin-bottom: 5px;
    min-width: 100%;
  }

  .form-row input[type="text"],
  .form-row input[type="date"],
  .form-row textarea {
    width: 100%;
  }

  .address-line {
    margin-left: 0;
    flex-direction: column;
    gap: 8px;
  }

  .academic-row {
    font-size: 11px;
  }

  .academic-row input {
    padding: 2px;
  }
}

/* Education section styles */
.education-section {
  margin-bottom: 20px;
  border: 1px solid #ddd;
  padding: 15px;
  background: #f9f9f9;
}

.education-section h4 {
  margin: 0 0 15px 0;
  color: #36013f;
  font-size: 14px;
}

.edu-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

.edu-field {
  margin-bottom: 10px;
}

.edu-field label {
  display: block;
  font-size: 12px;
  color: #444;
  margin-bottom: 5px;
}

.edu-field input {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  background: white;
}

.edu-field label:after {
  content: " *";
  color: #36013f;
}

/* Remove asterisk from non-required fields */
.education-section:nth-child(3) .edu-field label:after,
.education-section:nth-child(4) .edu-field label:after {
  content: none;
}

@media screen and (max-width: 768px) {
  .edu-row {
    grid-template-columns: 1fr;
  }

  .education-section {
    padding: 10px;
  }
}

/* Documents upload section styles */
.documents-section {
  margin-top: 30px;
  padding-right: 0;
}

.documents-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  margin-top: 15px;
}

.document-row {
  background: #f9f9f9;
  padding: 15px;
  border: 1px solid #ddd;
}

.document-row label {
  display: block;
  font-size: 13px;
  color: #444;
  margin-bottom: 8px;
}

.document-row label:after {
  content: "";
}

.document-row label[for]:after {
  content: none;
}

/* Required document indicators */
.document-row:nth-child(1) label:first-child:after,
.document-row:nth-child(2) label:first-child:after,
.document-row:nth-child(3) label:first-child:after,
.document-row:nth-child(4) label:first-child:after,
.document-row:nth-child(5) label:first-child:after,
.document-row:nth-child(9) label:first-child:after,
.document-row:nth-child(10) label:first-child:after,
.document-row:nth-child(12) label:first-child:after,
.document-row:nth-child(13) label:first-child:after {
  content: " *";
  color: #36013f;
}

.file-upload {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 10px;
}

.file-upload input[type="file"] {
  position: absolute;
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  z-index: -1;
}

.file-label {
  order: 1;
  display: inline-block;
  padding: 6px 12px;
  background: #36013f;
  color: white !important;
  cursor: pointer;
  font-size: 12px;
  border-radius: 3px;
  min-width: 100px;
  text-align: center;
}

.file-label:hover {
  background: #4a0255;
}

.file-name {
  order: 2;
  flex: 1;
  font-size: 12px;
  color: #666;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
}

.preview-container {
  order: 3;
  width: 100%;
  margin-top: 10px;
  min-height: 40px;
}

.preview-image {
  max-width: 100px;
  max-height: 100px;
  object-fit: contain;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 2px;
  background: white;
}

.pdf-preview {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 80px;
  background: #f4f4f4;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.pdf-icon {
  color: #36013f;
  font-style: normal;
  font-weight: bold;
  font-size: 14px;
}

@media screen and (max-width: 768px) {
  .documents-grid {
    grid-template-columns: 1fr;
    gap: 15px;
  }

  .file-upload {
    flex-wrap: wrap;
  }

  .file-name {
    width: 100%;
    margin-top: 5px;
  }

  .preview-container {
    text-align: center;
  }

  .preview-image,
  .pdf-preview {
    margin: 0 auto;
  }
}

/* Add navigation buttons */
.form-navigation {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
}

.form-navigation button {
  padding: 8px 20px;
  background: #36013f;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size: 14px;
}

.form-navigation button:hover {
  background: #4a0255;
}

.form-navigation button[disabled] {
  background: #ccc;
  cursor: not-allowed;
}

/* New table layout for education sections */
.edu-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  background: white;
  table-layout: fixed;
}

.edu-table th,
.edu-table td {
  border: 1px solid #ccc;
  padding: 0;
  text-align: left;
  font-size: 13px;
  vertical-align: middle;
}

.edu-table th {
  background: #f0f0f0;
  font-weight: bold;
  color: #36013f;
  text-align: center;
  padding: 12px 8px;
  white-space: normal;
  height: 50px;
  vertical-align: middle;
}

.edu-table td:first-child {
  background: #f9f9f9;
  font-weight: bold;
  white-space: normal;
  padding: 8px;
}

.edu-table input {
  width: 100%;
  height: 100%;
  padding: 8px;
  border: none;
  background: transparent;
  font-size: 13px;
  display: block;
  box-sizing: border-box;
  min-height: 35px;
}

.edu-table input:focus {
  outline: none;
  background: #f0f0f0;
}

/* Column widths */
.edu-table th:nth-child(1),
.edu-table td:nth-child(1) {
  width: 9%;
}

.edu-table th:nth-child(2),
.edu-table td:nth-child(2) {
  width: 20%;
  /*height: 20%;*/
}

.edu-table th:nth-child(3),
.edu-table td:nth-child(3) {
  width: 10%;
}



.edu-table th:nth-child(4),
.edu-table td:nth-child(4) {
  width: 6%;
}

.edu-table th:nth-child(5),
.edu-table td:nth-child(5) {
  width: 6%;
}

.edu-table th:nth-child(6),
.edu-table td:nth-child(6) {
  width: 6%;
}

.edu-table th:nth-child(7),
.edu-table td:nth-child(7) {
  width: 6%;
}

/* Make table responsive */
@media screen and (max-width: 768px) {
  .edu-table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    table-layout: auto;
  }

  .edu-table th,
  .edu-table td {
    min-width: 180px;
    white-space: normal;
  }

  .edu-table th:first-child,
  .edu-table td:first-child {
    position: sticky;
    left: 0;
    z-index: 1;
    background: #f9f9f9;
    min-width: 150px;
  }
}

/* Update required field indicators */
.edu-field label:after,
.document-row label:after {
  color: #36013f;
}

.documents-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  background: white;
  table-layout: fixed;
}

.documents-table th,
.documents-table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
  font-size: 13px;
  vertical-align: middle;
}

.documents-table th {
  background: #f0f0f0;
  font-weight: bold;
  color: #36013f;
  text-align: center;
  padding: 12px 8px;
}

/* Column widths for documents table */
.documents-table th:nth-child(1),
.documents-table td:nth-child(1) {
  width: 25%;
}

.documents-table th:nth-child(2),
.documents-table td:nth-child(2) {
  width: 20%;
}

.documents-table th:nth-child(3),
.documents-table td:nth-child(3) {
  width: 55%;
}

.doc-preview-container {
  width: 60px;
  height: 60px;
  margin: 0 auto;
  position: relative;
  overflow: hidden;
  border: 1px solid #ddd;
  border-radius: 4px;
  background: #f9f9f9;
}

.doc-preview-container img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.doc-preview-container .pdf-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  background: #f4f4f4;
  color: #36013f;
  font-weight: bold;
}

/* Remove status-related styles */
.doc-status,
.status-pending,
.status-verified,
.status-rejected {
  display: none;
}

@media screen and (max-width: 768px) {
  .documents-table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }

  .documents-table th,
  .documents-table td {
    min-width: 120px;
  }
}
    
    
    
    
.form-number2 {
    text-align: right;
    font-weight: bold;
    font-size: 18px;
    color: #2e003e; /* optional: dark purple college theme */
    padding-right: 30px; /* optional: some spacing from edge */
    margin-top:-15px;
}

.reg_no{
    color: red;
    
    
}



.signature-box {
  width: 120px; /* Reduced from 200px */
  height: 50px; /* Reduced from 100px */
  border: 1px solid #ccc;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  background-color: #f9f9f9;
  font-size: 12px; /* Reduced font size */
}

.photo-section {
  position: absolute;
  top: 256px;
  right: 1px;
  display: flex;
  flex-direction: column;
  gap: 5px;
  width: 139px; /* Reduced from 200px */
}

#text-input1{
  width: 100%;
  /padding: 0px;/
  /border: 1px solid #ccc;/
  font-size: clamp(11px, 1.8vw, 13px);
  color: #36013f;
}

.question-color{
    color: #36013f;
}

.form-row input[type="text"]
 {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  font-size: clamp(11px, 1.8vw, 13px);
}

.form-row textarea {
  width: 100%;
  height: 100%;
  padding: 8px; 
  text-align: center;
  border: 1px solid #ccc;
  resize: none;
  text-align: left;
  /*background-color: red;*/
  /* margin-bottom: 10px; */
}

textarea {
  width: 100%;
  border: none;
  padding: 0; /* Removes inner gap */
  margin: 0;  /* Removes outer gap */
  font-size: 14px;
  font-family: inherit;
  line-height: 1.2; /* Adjust for tighter fit */
  box-sizing: border-box;
  overflow: hidden;
  resize: none;
  vertical-align: top;
  background: transparent; /* Optional for print-friendly */
}

.form-row input[type="date"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  font-size: clamp(11px, 1.8vw, 13px);
}

table input {
  width: 100%;
  height: 100%;
  padding: 3px 6px;
  border: none;
  margin: 0;
  font-size: inherit;
  outline: none;
  background: transparent;
}
table th,
table td {
  border: 1px solid #ccc;
  padding: 6px;
  text-align: left;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Specific column widths */
table th:nth-child(1) {
  width: 5%;
} /* Sl. No. */
table th:nth-child(2) {
  width: 7%;
} /* Exam Passed */
table th:nth-child(3) {
  width: 25%;
} /* School name */
table th:nth-child(4) {
  width: 20%;
} /* Board name */
table th:nth-child(5) {
  width: 10%;
} /* Year */
table th:nth-child(6) {
  width: 13%;
} /* Subjects */
table th:nth-child(7) {
  width: 12%;
} /* Marks */
table th:nth-child(8) {
  width: 8%;
} 

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 8px;
  table-layout: fixed;
  font-size: clamp(11px, 1.8vw, 13px);
}

.heading-color{
    color: green;
    font-weight: bold;
    margin-left:15px ;
    margin-right: -40px;
}
.email-color{
    color: blue;
}
.give-space {
    margin-top: 40px;
}


/*td {*/
/*        word-wrap: break-word;*/
/*        white-space: normal !important;*/
/*        max-width: 200px;*/
/*    }*/

#downloadable table {
  margin-bottom: 50px;
}

/*#downloadable {*/
/*  display: inline-block;*/
/*  width: auto;*/
/*  height: auto;*/
/*}*/

</style>
</head>
<body>

@php
    $batch = $student->batch;
@endphp    
    

<div class="template-container" id="downloadable" >
  <div class="template-inner">
   
   
    <div class="container">
    <div class="form-number2"><span class="reg_no">Registration No : </span>{{@$student->registration_no}}</div>
      <div class="header">
        <div class="logo-section">
          <img
            src="{{asset('uploads/setting/rsr_logo.png')}}"
            alt="RBS College Logo"
            class="college-logo"
          />
        </div>
        <h1 class="heading-color">{{$applicationSetting->title}}</h1>
        <p class="subtitle">
          RUN BY : {{$applicationSetting->run_by}}
        </p>
       <p class="recognition common_new_up">
         {{$applicationSetting->recognized}}
        </p>
        <p class="affiliation common_new_up">
         Approved By : {{@$applicationSetting->approved}}
        </p>
        <p class="affiliation common_new_up">
         Affiliated to : {{@$applicationSetting->affilated}}
        </p>
        <p class="address common_new_up">Add : {{@$applicationSetting->address}}</p>
        <p class="address common_new_up">Email : <a class="email-color">{{@$applicationSetting->email}}</a> | Contact No : <a class="email-color">{{@$applicationSetting->contact_no_first}},{{@$applicationSetting->contact_no_second}}</a></p>
        <!--<p class="address">Contact No: {{@$batch->college_phone}}</p>-->
      </div>
          <!--ADMISSION FORM-->
    
     <div class="form-title">ADMISSION FORM</div>

      <!--  <p class="form-instruction">-->
      <!--  Please read the prospectus carefully before filling the Application Form-->
      <!--</p>-->

      <div class="photo-section">
        <div class="photo-box">
           @if(is_file('uploads/student/'.@$application->photo))
            <img src="{{ asset('uploads/student/'.@$application->photo) }}" class="img-fluid " style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}" onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';">
            @else
            <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-fluid" style="max-width: 105px; max-height: 115px;" alt="{{ __('field_photo') }}">
           @endif
           
        </div>
         
         <div class="signature-box" style="margin-top: 10px;">
            @if(is_file('uploads/student/'.@$application->signature))
                <img src="{{ asset('uploads/student/'.@$application->signature) }}" class="img-fluid" style="width:85%; max-height: 50px;" alt="{{ __('field_signature') }}" onerror="this.src='{{ asset('dashboard/images/signature/default-signature.png') }}';">
            @else
                <img src="{{asset('uploads/setting/signature.jpg')}}" class="img-fluid" style="width:85%; max-height: 50px;" alt="{{ __('field_signature') }}">
            @endif
        </div>
        
      </div>

      <div class="office-use-section">
        <h3 class="question-color">For Office use Only</h3>
        <div class="office-fields">
          <div class="field"><span class="question-color">1. Session:</span> <span class="bold-text1">{{@$application->session}}</span></div>
          <div class="field"><span class="question-color">2. Admitted / Rejected / Under Consideration</span></div>
          <div class="field"><span class="question-color">3. Course:</span> <span class="bold-text2">{{@$application->program->title}}</span> </div>
          <div class="field"><span class="question-color">4. Admission Mode:</span> <span class="bold-text3">{{@$application->admission_mode}}</span> </div>
          <div class="field"><span class="question-color">5. Roll No.:</span><span style="color:black; font-weight:bold; font-size:16px;"> {{@$student->student_id}}</span> </div>
          <div class="field"><span class="question-color">6. Hostel:</span> _________________________</div>
        </div>
      </div>

      <form class="admission-form">
         <div class="form-row " id="text-input1">
          <label>01. Applicant's Name:</label>
          <input type="text"  name="applicant_name" value="{{ @$application->first_name . ' ' . @$application->last_name }}" disabled/>
          
        </div>
         <div class="form-row" id="text-input1">
          <label>02. Father's name:</label>
          <input type="text"  name="father_name" value="{{ @$application->father_name}}" disabled/>
        </div>
        
        <div class="flex-double">
            <!--Left Side -->
            <div class="form-half">
               
          <div class="form-row" id="text-input1">
          <label>03. Mother's Name:</label>
          <input type="text"  name="mother_name" value="{{ @$application->mother_name}}" disabled/>
        </div>

        <div class="form-row" id="text-input1">
          <label>04. Date of Birth:</label>
          <input type="date"  name="dob" value="{{ @$application->dob}}" disabled/>
        </div>
        
        <div class="form-row" id="text-input1">
          <label>05. Aadhaar No.:</label>
          <input type="text" name="aadhaar" value="{{ @$application->national_id}}" disabled/>
        </div>
           <div class="form-row" id="text-input1">
    <label>06. Marital Status:</label>
    <input type="text" name="" value="{{ @$application->marital_status }}" disabled />
</div>
    </div>
            <!--Right Side-->
            <div class="form-half">
    <div class="form-row" id="text-input1">
      <label>Student Contact No.:</label>
      <input type="text" name="student_contact" value="{{ @$application->phone }}" disabled/>
    </div>
    <div class="form-row" id="text-input1">
      <label>Parent Contact No.:</label>
      <input type="text" name="parent_contact" value="{{ @$application->parent_phone }}" disabled/>
    </div>
    <div class="form-row" id="text-input1">
      <label>Email ID:</label>
      <input type="text" name="email" value="{{ @$application->email }}" disabled/>
    </div>
     <div class="form-row" id="text-input1">
  <label>Nationality:</label>
     <input type="text" name="" value="{{ @$application->nationality }}" disabled />
   </div>
  </div>
        </div>

       

        <!--<div class="radio-text question-color">-->
        <!--  <label >06. Marital Status:</label>-->
        <!--  <div class="radio-group">-->
        <!--    <label class="radio-label"-->
        <!--      ><input type="radio" class="radio-propert" name="marital_status" value="married" {{ @$application->marital_status ? 'checked' : '' }} disabled/>{{@$application->marital_status}}-->
        <!--      </label>-->
           
        <!--   </div>-->
        <!--</div>-->
        <!--  <div class="form-row">-->
        <!--  <label>07. If Married Name of the Husband/Wife:</label>-->
        <!--  <input type="text" name="spouse_name" />-->
        <!--</div>-->

        <div class="form-row question-color give-space">
          <label>07. Present Address:</label>
          
         <!--<textarea name="present_address" value="{{ @$application->present_address}}" disabled>{{ @$application->present_address}}</textarea>-->
         <input type="text"  name="present_address" value="{{ @$application->present_address}}"  disabled/>


          <div class="address-line question-color ">
            <span >P/O.: <input type="text" name="present_po" value="{{ @$application->present_post}}" disabled/></span>
            <span>P.S.: <input type="text" name="present_ps" value="{{ @$application->present_police_station}}" disabled/></span>
            <span>District: <input type="text" name="present_district" value="{{ @$application->present_district}}" disabled/></span>
            <span>STATE: <input type="text" name="present_state" value="{{ @$application->presentProvince->title}}" disabled/></span>
            <span>PIN: <input type="text" name="present_pin" value="{{ @$application->present_pin}}" disabled/></span>
          </div>
        </div>

        <div class="form-row question-color">
          <label>08. Permanent Address:</label>
                 <!--<textarea name="permanent_address" value="{{ @$application->permanent_address}}" disabled>{{ @$application->permanent_address}}</textarea>-->
                <input type="text"  name="present_address" value="{{ @$application->permanent_address}}"  disabled/>

          <div class="address-line">
            
            <span>P/O.: <input type="text" name="permanent_po" value="{{ @$application->permanent_post}}" disabled/></span>
            <span>P.S.: <input type="text"  name="permanent_ps" value="{{ @$application->permanent_police_station}}" disabled/></span>
            <span>District: <input type="text" name="permanent_district" value="{{ @$application->permanent_district}}" disabled/></span>
            <span>STATE: <input type="text" name="permanent_state" value="{{ @$application->permanentProvince->title}}" disabled/></span>
            <span>PIN: <input type="text" name="permanent_pin" value="{{ @$application->permanent_pin}}" disabled/></span>

          </div>
          
        </div>
        <div class="form-row academic-section">
          <label class="question-color">09. Academic Record:</label>
          <!--<p class="note">-->
          <!--  (Please enclose attested certificate here with the form)-->
          <!--</p>-->

          <table class="edu-table">
            <thead>
              <tr>
                <th>Education Level</th>
                <th>School/College Name</th>
                <th>Board/University</th>
                
                <th>Year of Passing</th>
                <th>Total Marks</th>
                <th>Marks Obtained</th>
                <th>%</th>
              </tr>
              </thead>
            <tbody>
              <tr>
                <td class="bold-text" id="high-test">High School (10th)</td>
               
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;">{!! nl2br(e(@$application->high_school_name)) !!}</td>
                <!--<td><input type="text" name="tenth_school" value="{{ @$application->high_school_name}}" required /></td>-->
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;"> {!! nl2br(e(@$application->high_school_address)) !!}</td>
                <!--<td><input type="text" name="tenth_address" required  value="{{ @$application->high_school_address}}"/></td>-->
                <td><textarea  name="tenth_year" style="color:black; font-weight:bold;" value="{{ @$application->high_school_graduation_year}}" required >{{ @$application->high_school_graduation_year}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="tenth_total_marks" required value="{{ @$application->high_school_total_marks}}" >{{ @$application->high_school_total_marks}}</textarea></td>
                <td>
                  <textarea type="text" style="color:black; font-weight:bold;" name="tenth_obtained_marks" required value="{{ @$application->high_school_marks_obtained}}">{{ @$application->high_school_marks_obtained}}</textarea>
                </td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="tenth_percentage" value="{{ @$application->high_school_graduation_percentage}}" required >{{ @$application->high_school_graduation_percentage}}</textarea></td>
              </tr>
              <tr>
                <td class="bold-text">Intermediate (12th)</td>
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;">{!! nl2br(e(@$application->intermediate_name)) !!}</td>
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;"> {!! nl2br(e(@$application->intermediate_address)) !!}</td>

                <!--<td><input type="text" name="twelfth_address" required value="{{ @$application->intermediate_address}}" /></td>-->
                <td><textarea style="color:black; font-weight:bold;" type="text" name="twelfth_year" required  value="{{ @$application->intermediate_graduation_year}}" >{{ @$application->intermediate_graduation_year}}</textarea></td>
                <td>
                  <textarea type="text" style="color:black; font-weight:bold;" name="twelfth_total_marks" required value="{{ @$application->intermediate_total_marks}}" >{{ @$application->intermediate_total_marks}}</textarea>
                </td>
                <td>
                  <textarea type="text" style="color:black; font-weight:bold;" name="twelfth_obtained_marks" required value="{{ @$application->intermediate_marks_obtained}}" >{{ @$application->intermediate_marks_obtained}}</textarea>
                </td>
                <td>
                  <textarea type="text" style="color:black; font-weight:bold;" name="twelfth_percentage" value="{{ @$application->inter_graduation_percentage}}" required >{{ @$application->inter_graduation_percentage}}</textarea>
                </td>
              </tr>
              <tr>
                <td class="bold-text">Graduation (UG) </td>
               <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;">{!! nl2br(e(@$application->bach_college_name)) !!}</td>
               <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;"> {!! nl2br(e(@$application->bach_college_address)) !!}</td>
                
                <!--<td><input type="text" name="graduation_address" value="{{ @$application->bach_college_address}}"/></td>-->
                <td><textarea type="text" style="color:black; font-weight:bold;" name="graduation_year" value="{{ @$application->bach_gradu_year}}">{{ @$application->bach_gradu_year}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="graduation_total_marks" value="{{@$application->bach_total_marks}}">{{@$application->bach_total_marks}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="graduation_obtained_marks" value="{{@$application->bach_marks_obtained}}">{{@$application->bach_marks_obtained}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="graduation_percentage" value="{{ @$application->bach_gradu_percentage}}">{{ @$application->bach_gradu_percentage}}</textarea></td>
              </tr>
              <tr>
                <td class="bold-text">Masters <br>(PG) </td>
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;">{!! nl2br(e(@$application->master_college_name)) !!}</td>
                <td style="white-space: pre-line; color:black; font-weight:bold; padding-left:3px;"> {!! nl2br(e(@$application->master_college_address)) !!}</td>

                <!--<td><input type="text" name="masters_address" value="{{ @$application->master_college_address}}" /></td>-->
                <td><textarea type="text" style="color:black; font-weight:bold;" name="masters_year" value="{{ @$application->master_gradu_year}}">{{ @$application->master_gradu_year}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="masters_total_marks" value="{{@$application->master_total_marks}}" >{{@$application->master_total_marks}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="masters_obtained_marks" value="{{@$application->master_marks_obtained}}" >{{@$application->master_marks_obtained}}</textarea></td>
                <td><textarea type="text" style="color:black; font-weight:bold;" name="masters_percentage"value="{{ @$application->master_gradu_percentage}}" >{{ @$application->master_gradu_percentage}}</textarea></td>
              </tr>
            </tbody>
          </table>
        </div>
   
      </form>
      
       <div style="width: 100%; text-align: right; margin-top: 10px;">
    <div style="display: inline-block; font-weight:bold; font-size:20px; color:black; width: 200px;">
        Admission Incharge
    </div>
</div>
    </div>
    

  </div>
  
  
</div>
    
    <!-- PDF Js -->
    <script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/html2pdf/js/html2pdf.bundle.min.js') }}"></script>

<script type="text/javascript">
        "use strict";
        var pdf_title =  '{{ $title }}' + '.pdf'
        var pdf_content = document.getElementById("downloadable");

        var options = {
          margin:       0,
          filename:     pdf_title,
          image:        { type: 'jpeg', quality: 8.00 },
          html2canvas:  { scale: 1.5 },
          jsPDF:        { unit: 'in', format: 'A3', orientation: 'portrait' }
        };
        
        

        html2pdf(pdf_content, options);
</script>
    
    <script>
           document.querySelectorAll('textarea').forEach(textarea => {
  textarea.addEventListener('input', () => {
    textarea.style.height = 'auto'; // reset
    textarea.style.height = ${textarea.scrollHeight}px; // fit to content
  });

  // Optional: trigger it on page load too
  textarea.style.height = 'auto';
  textarea.style.height = ${textarea.scrollHeight}px;
});
    </script>
</body>
</html>