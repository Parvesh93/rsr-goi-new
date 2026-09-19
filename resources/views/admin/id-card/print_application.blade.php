<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,maximum-scale=1.0">
	<title>{{ @$title }}</title>

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

	<!--<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_id_card.css') }}" media="screen, print">-->
   <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/prints/student_application.css') }}" media="screen, print">
  @php 
  $version = App\Models\Language::version(); 
  @endphp
  @if($version->direction == 1)
  <!-- RTL css -->
  <style type="text/css" media="screen, print">
    .template-container {
      direction: rtl;
    }
    .template-container .temp-title h2, 
    .template-container .temp-title h4, 
    .template-container .temp-footer .inner p {
      text-align: center;
    }
    .template-container .table-no-border tr td {
      float: right;
      text-align: right;
    }
    .template-container .table-no-border tr td.temp-logo {
      float: none;
    }
 
  </style>
  @endif
</head>
<body>


<div class="printable">
    <!--rbs_logo_1744443454.png-->


    <div class="container">
      <div class="header">
        <div class="logo-section">
          <img
            src="rbs_logo_1744443454.webp"
            alt="RBS College Logo"
            class="college-logo"
          />
        </div>
        <h1>R.B.S.R.D.R. COLLEGE</h1>
        <p class="subtitle">
          (Run & Managed By-Ram Sharan Roy Memorial Educational and Social
          welfare trust)
        </p>
        <p class="recognition">
          Recognized by Department of health, Govt. of Bihar
        </p>
        <p class="affiliation">
          Affiliated by Bihar University Of Health Sciences, Patna & BNRC Patna
        </p>
        <p class="address">Saraipur, Raghopur, Hajipur, Vaishali - 844102</p>
      </div>

      <div class="form-number">287</div>
      <div class="form-title">ADMISSION FORM</div>
        <p class="form-instruction">
        Please read the prospectus carefully before filling the Application Form
      </p>

      <div class="photo-section">
        <div class="photo-box">
          Affix Recent<br />
          Passport Size<br />
          Photograph
        </div>
      </div>

      <div class="office-use-section">
        <h3>For Office use Only</h3>
        <div class="office-fields">
          <div class="field">1. Session: _________________________</div>
          <div class="field">2. Admitted / Rejected / Under Consideration</div>
          <div class="field">3. Course: _________________________</div>
          <div class="field">4. Roll No.: _________________________</div>
          <div class="field">5. Hostel: _________________________</div>
        </div>
      </div>

      <form class="admission-form">
        <div class="form-row">
          <label>01. Applicant's Name:</label>
          <input type="text" name="applicant_name" />
          <span class="block-letters">(IN BLOCK LETTERS)</span>
        </div>

        <div class="form-row">
          <label>02. Father's name:</label>
          <input type="text" name="father_name" />
        </div>
          <div class="form-row">
          <label>03. Mother's Name:</label>
          <input type="text" name="mother_name" />
        </div>

        <div class="form-row">
          <label>04. Date of Birth:</label>
          <input type="date" name="dob" />
        </div>

        <div class="form-row">
          <label>05. Aadhaar No.:</label>
          <input type="text" name="aadhaar" />
        </div>

        <div class="form-row">
          <label>06. Marital Status:</label>
          <div class="radio-group">
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="married" />
              Married</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="unmarried" />
              Unmarried</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="widow" />
              Widow</label
            >
            <label class="radio-label"
              ><input type="radio" name="marital_status" value="divorcee" />
              Divorcee</label
            >
           </div>
        </div>
          <div class="form-row">
          <label>07. If Married Name of the Husband/Wife:</label>
          <input type="text" name="spouse_name" />
        </div>

        <div class="form-row">
          <label>08. Present Address:</label>
          <textarea name="present_address"></textarea>
          <div class="address-line">
            <span>P/O.: <input type="text" name="present_po" /></span>
            <span>P.S.: <input type="text" name="present_ps" /></span>
            <span>District: <input type="text" name="present_district" /></span>
            <span>PIN: <input type="text" name="present_pin" /></span>
          </div>
        </div>

        <div class="form-row">
          <label>09. Permanent Address:</label>
          <textarea name="permanent_address"></textarea>
          <div class="address-line">
            <span>P/O.: <input type="text" name="permanent_po" /></span>
            <span>P.S.: <input type="text" name="permanent_ps" /></span>
            <span
              >District: <input type="text" name="permanent_district"
            /></span>
            <span>PIN: <input type="text" name="permanent_pin" /></span>
          </div>
        </div>
        <div class="form-row academic-section">
          <label>10. Academic Record:</label>
          <p class="note">
            (Please enclose attested certificate here with the form)
          </p>

          <table class="edu-table">
            <thead>
              <tr>
                <th>Education Level</th>
                <th>School/College Name</th>
                <th>Board/University</th>
                <th>Complete Address</th>
                <th>Year of Passing</th>
                <th>Total Marks</th>
                <th>Marks Obtained</th>
                <th>%</th>
              </tr>
              </thead>
            <tbody>
              <tr>
                <td>High School (10th)</td>
                <td><input type="text" name="tenth_school" required /></td>
                <td><input type="text" name="tenth_board" required /></td>
                <td><input type="text" name="tenth_address" required /></td>
                <td><input type="text" name="tenth_year" required /></td>
                <td><input type="text" name="tenth_total_marks" required /></td>
                <td>
                  <input type="text" name="tenth_obtained_marks" required />
                </td>
                <td><input type="text" name="tenth_percentage" required /></td>
              </tr>
              <tr>
                <td>Intermediate (12th)</td>
                <td><input type="text" name="twelfth_school" required /></td>
                <td><input type="text" name="twelfth_board" required /></td>
                <td><input type="text" name="twelfth_address" required /></td>
                <td><input type="text" name="twelfth_year" required /></td>
                <td>
                  <input type="text" name="twelfth_total_marks" required />
                </td>
                <td>
                  <input type="text" name="twelfth_obtained_marks" required />
                </td>
                <td>
                  <input type="text" name="twelfth_percentage" required />
                </td>
              </tr>
              <tr>
                <td>Graduation</td>
             <td><input type="text" name="graduation_college" /></td>
                <td><input type="text" name="graduation_university" /></td>
                <td><input type="text" name="graduation_address" /></td>
                <td><input type="text" name="graduation_year" /></td>
                <td><input type="text" name="graduation_total_marks" /></td>
                <td><input type="text" name="graduation_obtained_marks" /></td>
                <td><input type="text" name="graduation_percentage" /></td>
              </tr>
              <tr>
                <td>Masters</td>
                <td><input type="text" name="masters_college" /></td>
                <td><input type="text" name="masters_university" /></td>
                <td><input type="text" name="masters_address" /></td>
                <td><input type="text" name="masters_year" /></td>
                <td><input type="text" name="masters_total_marks" /></td>
                <td><input type="text" name="masters_obtained_marks" /></td>
                <td><input type="text" name="masters_percentage" /></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-row documents-section">
          <label>11. Required Documents:</label>
          <table class="documents-table">
            <thead>
              <tr>
                <th>Document Name</th>
                <th>Preview</th>
                <th>File Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>10th Marksheet *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="tenth_marksheet"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="tenth_marksheet" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
                </tr>
              <tr>
                <td>10th SLC/CLC *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="tenth_slc"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="tenth_slc" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>12th Marksheet *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                 <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="twelfth_marksheet"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="twelfth_marksheet" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>12th CLC *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="twelfth_clc"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="twelfth_clc" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>12th Migration/Provisional *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="twelfth_migration"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="twelfth_migration" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Graduation Marksheet</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="graduation_marksheet"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="graduation_marksheet" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
               <td>Graduation CLC</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="graduation_clc"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="graduation_clc" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Graduation Migration</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="graduation_migration"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="graduation_migration" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Masters Marksheet</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                 <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="masters_marksheet"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="masters_marksheet" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Masters CLC</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                  <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="masters_clc"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="masters_clc" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Masters Migration</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="masters_migration"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="masters_migration" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Aadhar Card *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="aadhar_card"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="aadhar_card" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Pan Card</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                  <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="pan_card"
                      accept=".pdf,.jpg,.jpeg,.png"
                    />
                    <label for="pan_card" class="file-label">Choose File</label>
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Parents ID *</td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                  <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="parents_id"
                      accept=".pdf,.jpg,.jpeg,.png"
                      required
                    />
                    <label for="parents_id" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Photo *<br /><small>(300x300 px)</small></td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                   <td>
                  <div class="file-upload">
                    <input type="file" id="photo" accept="image/*" required />
                    <label for="photo" class="file-label">Choose File</label>
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
              <tr>
                <td>Signature *<br /><small>(300x100 px)</small></td>
                <td>
                  <div class="doc-preview-container">
                    <!-- Preview will be shown here -->
                  </div>
                </td>
                <td>
                  <div class="file-upload">
                    <input
                      type="file"
                      id="signature"
                      accept="image/*"
                      required
                    />
                    <label for="signature" class="file-label"
                      >Choose File</label
                    >
                    <span class="file-name">No file chosen</span>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>



 
 <!--<h1>Ram</h1>-->
<div class="page-break"></div>
</div>


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