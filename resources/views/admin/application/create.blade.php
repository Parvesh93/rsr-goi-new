<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>{{ $applicationSetting->title ?? $title }}</title>

    @include('admin.layouts.common.header_script')

    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">

   <style type="text/css" media="screen">
        .inner {
            margin: 0 auto;
            margin-top: -35px;
            width: 100%;
            height: auto;
            overflow: hidden;
            clear: both;
        }

        .inner img {
            margin: 0 auto;
            max-width: 100%;
            width: auto;
            height: auto;
            overflow: hidden;
        }

        .basic-info {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: #f5fafa;
            padding: 15px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-bottom: 1px solid #ccc;
            gap: 10px;
        }

        .info-text {
            font-size: 16px;
            color: #3498db;
            font-weight: 500;
        }

        .print-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #fbc02d;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 18px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .print-button:hover {
            background-color: #3498db;
            color: white;
        }

        .print-button i {
            margin: 0;
        }

        /* Hover par dropdown open ho */
        .admission-dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        /* Dropdown-menu default hidden ho */
        .admission-dropdown .dropdown-menu {
            display: none;
            transition: all 0.3s ease;
            margin-top: 0;
        }

        /* Remove bullets from list */
        .admission-dropdown .dropdown-menu li {
            list-style: none;
        }

        /* Ensure dropdown items are properly aligned */
        .admission-dropdown .dropdown-menu .dropdown-item {
            padding-left: 15px;
        }

        .heading1 {
            color: rgb(10, 111, 10);
            margin-top: -40px;
            font-weight: bold;
        }

        .heading2 {
            color: #76037c;
            font-size: 20px;
            margin-top: -4px;
            font-weight: bold;
        }

        .heading3,
        .heading4,
        .heading5 {
            color: black;
            font-size: 20px;
            margin-top: -4px;
            font-weight: bold;
        }

        .heading6,
        .heading7 {
            color: rgb(35, 16, 236);
            font-size: 20px;
            margin-top: -6px;
            font-weight: bold;
        }

        .sub-heading {
            font-size: 20px;
            margin-top: -11px !important;
            color: red;
            font-weight: bold;
        }

        /* ✅ Mobile View Responsive CSS */
        @media (max-width: 768px) {
            .basic-info {
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
                padding: 10px 15px;
                gap: 6px;
            }

            .info-text {
                font-size: 14px;
            }

            .print-button {
                width: 100%;
                font-size: 16px;
                padding: 8px 10px;
            }

            .inner {
                margin-top: -15px;
            }

            .heading1,
            .heading2,
            .heading3,
            .heading4,
            .heading5,
            .heading6,
            .heading7,
            .sub-heading {
                font-size: 16px;
                margin-top: 2px !important;
                /* margin-bottom: 5px !important; */

                text-align: center;
            }

            .space-bo {
                margin-bottom: 15px !important;
            }


            .inner img {
                max-width: 100%;
                height: auto;
            }

        }
    </style>

</head>

<body>

    @isset($applicationSetting)
        <!-- Start Content-->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="card">

                    {{-- <div>Ram</div> --}}

                    <div class="card-block">
                        <div class="row mt-5 mb-5">
                            <div class="col-sm-2">
                                <div class="inner text-center">
                                    @if (is_file('uploads/application-setting/' . $applicationSetting->logo_left))
                                        <img src="{{ asset('uploads/application-setting/' . $applicationSetting->logo_left) }}"
                                            class="img-fluid" alt="Logo">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h2 class="heading1"><b>{{ $applicationSetting->title }}</b></h2>
                                <h3 class="heading2"><span>RUN BY: </span>{{ $applicationSetting->run_by }}</h3>
                                <h3 class="heading3">{{ $applicationSetting->recognized  }}</h3>
                                <h3 class="heading4"><span>Approved By: </span>{{ $applicationSetting->approved }}</h3>
                                <h3 class="heading4"><span>Affiliated to: </span>{{ $applicationSetting->affilated }}</h3>
                                <h3 class="heading5"><span>Add: </span>{{ $applicationSetting->address }}</h3>
                                <h3 class="space-bo"><span class="sub-heading">Email: </span><span class="heading6">{{ $applicationSetting->email }}</span>|<span class="sub-heading">Contact No: </span><span class="heading7">{{ $applicationSetting->contact_no_first }}, {{ $applicationSetting->contact_no_second }}</span> </h3>
                                <!--<h3 class="heading7"><span>Contact No: </span><a href="">{{ $applicationSetting->contact_no_first }}, {{ $applicationSetting->contact_no_second }}</a></h3>-->
                                <!--<p>{!! strip_tags($applicationSetting->body, '<br><b><i><strong><u><a><span><del>') !!}</p>-->
                            </div>
                            <div class="col-sm-2">
                                <div class="inner text-center">
                                    @if (is_file('uploads/application-setting/' . $applicationSetting->logo_right))
                                        <img src="{{ asset('uploads/application-setting/' . $applicationSetting->logo_right) }}"
                                            class="img-fluid" alt="Logo">
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Success Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <i class="fas fa-check-double"></i> {{ trans_choice('module_application', 1) }}
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <!-- [ Card ] start -->
                    <div class="col-sm-12">


                        <!--<div>{{ $id }}</div>-->



                        <!--<div class="basic-info">-->
                        <!--      <span class="info-text">Download application form after form filled:</span>-->

                        <!--      <a href="{{ route('student.application.download', $id) }}" target="_blank" class="btn btn-icon btn-dark btn-sm">-->
                        <!--                      <i class="fas fa-download"></i>-->
                        <!--                  </a>-->
                        <!--</div>-->
                        <!--<div>Ram</div>-->

                        <div class="card">
                            @php
                                function field($slug)
                                {
                                    return \App\Models\Field::field($slug);
                                }
                            @endphp
                            <div class="wizard-sec-bg">
                                <form id="wizard-advanced-form" class="needs-validation" novalidate
                                    action="{{ route($route . '.store') }}" method="post" enctype="multipart/form-data"
                                    style="display: none;">
                                    @csrf

                                    <h3>{{ __('tab_basic_info') }}</h3>
                                    <!--<h3>{{ __('tab_basic_info') }}</h3>-->
                                    <content class="form-step">
                                        <!-- Form Start -->
                                        <!--<div>Ram</div> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <fieldset class="row scheduler-border">
                                                    <div class="form-group col-md-6">
                                                        <label for="field_roll">{{ __('field_roll') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control" name="roll_no"
                                                            id="roll_no" value="Fill by Admin..." disabled>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_roll') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="admission_mode">{{ 'Admission Mode' }}
                                                            <span>*</span></label>
                                                        <select class="form-control" name="admission_mode"
                                                            id="admission_mode" required>
                                                            <option value="">{{ __('select') }}</option>
                                                            <option value="DRCC"
                                                                @if (old('admission_mode') == 'DRCC') selected @endif>
                                                                {{ 'DRCC' }}</option>
                                                            <option value="Cash"
                                                                @if (old('admission_mode') == 'Cash') selected @endif>
                                                                {{ 'Cash' }}</option>

                                                        </select>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ 'Admission Mode' }}
                                                        </div>
                                                    </div>




                                                    @include('common.inc.application_academic')
                                                  




                                                    <div class="form-group col-md-6">
                                                        <label for="first_name">{{ __('field_first_name') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            id="first_name" value="{{ old('first_name') }}" required>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_first_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="last_name">{{ __('field_last_name') }}
                                                        </label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="last_name" value="{{ old('last_name') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_last_name') }}
                                                        </div>
                                                    </div>

                                                    @if (field('application_father_name')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="father_name">{{ __('field_father_name') }}
                                                                <span>*</span></label>
                                                            <input type="text" class="form-control" name="father_name"
                                                                id="father_name" value="{{ old('father_name') }}"
                                                                required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_father_name') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_father_occupation')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="father_occupation">{{ __('field_father_occupation') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="father_occupation" id="father_occupation"
                                                                value="{{ old('father_occupation') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_father_occupation') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_mother_name')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="mother_name">{{ __('field_mother_name') }}
                                                                <span>*</span></label>
                                                            <input type="text" class="form-control" name="mother_name"
                                                                id="mother_name" value="{{ old('mother_name') }}"
                                                                required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_mother_name') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_mother_occupation')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="mother_occupation">{{ __('field_mother_occupation') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="mother_occupation" id="mother_occupation"
                                                                value="{{ old('mother_occupation') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_mother_occupation') }}
                                                            </div>
                                                        </div>
                                                    @endif



                                                    <div class="form-group col-md-6">
                                                        <label for="email">{{ __('field_email') }}
                                                            <span>*</span></label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="email" value="{{ old('email') }}" required>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_email') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="gender">{{ __('field_gender') }}
                                                            <span>*</span></label>
                                                        <select class="form-control" name="gender" id="gender"
                                                            required>
                                                            <option value="">{{ __('select') }}</option>
                                                            <option value="1"
                                                                @if (old('gender') == 1) selected @endif>
                                                                {{ __('gender_male') }}</option>
                                                            <option value="2"
                                                                @if (old('gender') == 2) selected @endif>
                                                                {{ __('gender_female') }}</option>
                                                            <option value="3"
                                                                @if (old('gender') == 3) selected @endif>
                                                                {{ __('gender_other') }}</option>
                                                        </select>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_gender') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="dob">{{ __('field_dob') }} <span>*</span></label>
                                                        <input type="date" class="form-control date" name="dob"
                                                            id="dob" value="{{ old('dob') }}" required>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_dob') }}
                                                        </div>
                                                    </div>

                                                    @if (field('application_emergency_phone')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="emergency_phone">{{ __('field_emergency_phone') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="emergency_phone" id="emergency_phone"
                                                                value="{{ old('emergency_phone') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_emergency_phone') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <!--@if (field('application_religion')->status == 1)
    -->
                                                    <!--    <div class="form-group col-md-6">-->
                                                    <!--        <label for="religion">{{ __('field_religion') }}</label>-->
                                                    <!--        <input type="text" class="form-control" name="religion"-->
                                                    <!--            id="religion" value="{{ old('religion') }}">-->

                                                    <!--        <div class="invalid-feedback">-->
                                                    <!--            {{ __('required_field') }} {{ __('field_religion') }}-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--
    @endif-->
                                                    @if (field('application_religion')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="religion">{{ __('field_religion') }}</label>
                                                            <select class="form-control" name="religion" id="religion">
                                                                <option value="">{{ __('select') }}</option>
                                                                <option value="Hindu"
                                                                    @if (old('religion') == 'Hindu') selected @endif>
                                                                    {{ __('religion_hindu') }}</option>
                                                                <option value="Muslim"
                                                                    @if (old('religion') == 'Muslim') selected @endif>
                                                                    {{ __('religion_muslim') }}</option>
                                                                <option value="Christian"
                                                                    @if (old('religion') == 'Christian') selected @endif>
                                                                    {{ __('religion_christian') }}</option>
                                                                <option value="Sikh"
                                                                    @if (old('religion') == 'Sikh') selected @endif>
                                                                    {{ __('religion_sikh') }}</option>
                                                                <option value="Buddhist"
                                                                    @if (old('religion') == 'Buddhist') selected @endif>
                                                                    {{ __('religion_buddhist') }}</option>
                                                                <option value="Jain"
                                                                    @if (old('religion') == 'Jain') selected @endif>
                                                                    {{ __('religion_jain') }}</option>
                                                                <option value="Other"
                                                                    @if (old('religion') == 'Other') selected @endif>
                                                                    {{ __('religion_other') }}</option>
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_religion') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('student_caste')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="gender">{{ __('field_caste') }}
                                                                <span>*</span></label>

                                                            <select class="form-control" name="caste" id="caste"
                                                                required>
                                                                <option value="">{{ __('select') }}</option>
                                                                <option value="GEN"
                                                                    @if (old('caste') == 'GEN') selected @endif>
                                                                    {{ 'GEN' }}</option>
                                                                <option value="OBC"
                                                                    @if (old('caste') == 'OBC') selected @endif>
                                                                    {{ 'OBC' }}</option>
                                                                <option value="SC"
                                                                    @if (old('caste') == 'SC') selected @endif>
                                                                    {{ 'SC' }}</option>
                                                                <option value="ST"
                                                                    @if (old('caste') == 'ST') selected @endif>
                                                                    {{ 'ST' }}</option>
                                                                <option value="OTHER"
                                                                    @if (old('caste') == 'OTHER') selected @endif>
                                                                    {{ 'OTHER' }}</option>
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_caste') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_mother_tongue')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="mother_tongue">{{ __('field_mother_tongue') }}</label>
                                                            <input type="text" class="form-control"
                                                                name="mother_tongue" id="mother_tongue"
                                                                value="{{ old('mother_tongue') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_mother_tongue') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_nationality')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="nationality">{{ __('field_nationality') }}</label>
                                                            <input type="text" class="form-control" name="nationality"
                                                                id="nationality" value="{{ old('nationality') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_nationality') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_marital_status')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="marital_status">{{ __('field_marital_status') }} <span>*</span></label>
                                                            <select class="form-control" name="marital_status"
                                                                id="marital_status" required>
                                                                <option value="">{{ __('select') }}</option>
                                                                <option value="Unmarried"
                                                                    @if (old('marital_status') == 1) selected @endif>
                                                                    {{ __('marital_status_single') }}</option>
                                                                <option value="Married"
                                                                    @if (old('marital_status') == 2) selected @endif>
                                                                    {{ __('marital_status_married') }}</option>
                                                                <option value="Widowed"
                                                                    @if (old('marital_status') == 3) selected @endif>
                                                                    {{ __('marital_status_widowed') }}</option>
                                                                <option value="Divorced"
                                                                    @if (old('marital_status') == 4) selected @endif>
                                                                    {{ __('marital_status_divorced') }}</option>
                                                                <!--<option value="5"-->
                                                                <!--    @if (old('marital_status') == 5) selected @endif>-->
                                                                <!--    {{ __('marital_status_other') }}</option>-->
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }}
                                                                {{ __('field_marital_status') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_blood_group')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="blood_group">{{ __('field_blood_group') }}</label>
                                                            <select class="form-control" name="blood_group"
                                                                id="blood_group">
                                                                <option value="">{{ __('select') }}</option>
                                                                <option value="1"
                                                                    @if (old('blood_group') == 1) selected @endif>
                                                                    {{ __('A+') }}</option>
                                                                <option value="2"
                                                                    @if (old('blood_group') == 2) selected @endif>
                                                                    {{ __('A-') }}</option>
                                                                <option value="3"
                                                                    @if (old('blood_group') == 3) selected @endif>
                                                                    {{ __('B+') }}</option>
                                                                <option value="4"
                                                                    @if (old('blood_group') == 4) selected @endif>
                                                                    {{ __('B-') }}</option>
                                                                <option value="5"
                                                                    @if (old('blood_group') == 5) selected @endif>
                                                                    {{ __('AB+') }}</option>
                                                                <option value="6"
                                                                    @if (old('blood_group') == 6) selected @endif>
                                                                    {{ __('AB-') }}</option>
                                                                <option value="7"
                                                                    @if (old('blood_group') == 7) selected @endif>
                                                                    {{ __('O+') }}</option>
                                                                <option value="8"
                                                                    @if (old('blood_group') == 8) selected @endif>
                                                                    {{ __('O-') }}</option>
                                                            </select>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_blood_group') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group col-md-6">
                                                        <label for="phone">{{ __('field_phone') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control" name="phone"
                                                            id="phone" value="{{ old('phone') }}" required>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_phone') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="parent_phone">{{ __('field_phone_parents') }} <span>*</span>
                                                        </label>
                                                        <input type="text" class="form-control" name="parent_phone"
                                                            id="parent_phone" value="{{ old('parent_phone') }}" required>

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_phone_parents') }}
                                                        </div>
                                                    </div>

                                                    @if (field('application_national_id')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="national_id">{{ __('field_national_id') }} <span>*</span></label>
                                                            <input type="text" class="form-control" name="national_id"
                                                                id="national_id" value="{{ old('national_id') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_national_id') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_passport_no')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="passport_no">{{ __('field_passport_no') }} </label>
                                                            <input type="text" class="form-control" name="passport_no"
                                                                id="passport_no" value="{{ old('passport_no') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_passport_no') }}
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (field('application_pan_no')->status == 1)
                                                        <div class="form-group col-md-6">
                                                            <label for="pan_no">{{ __('field_pan_id') }}</label>
                                                            <input type="text" class="form-control" name="pan_no"
                                                                id="pan_no" value="{{ old('pan_no') }}">

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_pan_id') }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                     <div class="form-group col-md-6">
                                                            <label for="pan_no">{{ "Nationality" }} <span>*</span></label>
                                                            
                                                            <select class="form-control nationality" id="nationality" name="nationality" required>
                                                              <option value="">Select Nationality</option>
                                                              <option value="Indian">Indian</option>
                                                              <option value="American">American</option>
                                                              <option value="British">British</option>
                                                              <option value="Australian">Australian</option>
                                                              <option value="Other">Other</option>
                                                            </select>
                                                           
                                                        </div>



                                                 
                                                </fieldset>
                                            </div>
                                        </div>

                                        @if (field('application_address')->status == 1)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <fieldset class="row scheduler-border">
                                                        <legend>{{ __('field_present') }} {{ __('field_address') }}
                                                        </legend>


                                                        <div class="form-group col-md-12">
                                                            <label
                                                                for="present_address">{{ __('field_address') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="present_address" id="present_address"
                                                                value="{{ old('present_address') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_address') }}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-12">
                                                            <label for="present_pin">{{ __('field_pin_code') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="present_pin" id="present_pin"
                                                                value="{{ old('present_pin') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_pin_code') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="present_post">{{ __('field_post') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="present_post" id="present_post"
                                                                value="{{ old('present_post') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_post') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label
                                                                for="present_police_station">{{ __('field_script') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="present_police_station" id="present_police_station"
                                                                value="{{ old('present_police_station') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_script') }}
                                                            </div>
                                                        </div>
                                                        @include('common.inc.present_province_address')




                                                    </fieldset>
                                                </div>

                                                <div class="col-md-6">
                                                    <fieldset class="row scheduler-border">
                                                        <legend>{{ __('field_permanent') }} {{ __('field_address') }}
                                                        </legend>

                                                        <div class="form-group col-md-12">
                                                            <label for="same_address"></label>
                                                            <input type="checkbox" class="form-check-input"
                                                                name="same_address" id="same_address"
                                                                style="margin-right: 8px;" required>{{ __('field_same_address') }}

                                                            <!--<div class="invalid-feedback">-->
                                                            <!--{{ __('required_field') }} {{ __('field_same_address') }}-->
                                                            <!--</div>-->
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label
                                                                for="permanent_address">{{ __('field_address') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="permanent_address" id="permanent_address"
                                                                value="{{ old('permanent_address') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_address') }}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-12">
                                                            <label for="permanent_pin">{{ __('field_pin_code') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="permanent_pin" id="permanent_pin"
                                                                value="{{ old('permanent_pin') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_pin_code') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="permanent_post">{{ __('field_post') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="permanent_post" id="permanent_post"
                                                                value="{{ old('permanent_post') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_post') }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label
                                                                for="permanent_police_station">{{ __('field_script') }} <span>*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="permanent_police_station"
                                                                id="permanent_police_station"
                                                                value="{{ old('permanent_police_station') }}" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('required_field') }} {{ __('field_script') }}
                                                            </div>
                                                        </div>
                                                        @include('common.inc.permanent_province')

                                                    </fieldset>
                                                </div>
                                            </div>
                                        @endif


                                        <!-- Form End -->
                                    </content>

                                    @if (field('application_school_info')->status == 1 ||
                                            field('application_collage_info')->status == 1 ||
                                            field('application_bachelor_info')->status == 1 ||
                                            field('application_master_info')->status == 1)
                                        <h3>{{ __('tab_educational_info') }}</h3>
                                        <content class="form-step">
                                            <!-- Form Start--->
                                            @if (field('application_school_info')->status == 1)
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_school_information') }}</legend>
                                                    <div class="form-group col-md-4">
                                                        <label for="high_school_name">{{ __('field_school_name') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_name" id="high_school_name"
                                                            value="{{ old('high_school_name') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_school_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="high_school_study_address">{{ __('field_study_address') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_study_address"
                                                            id="high_school_study_address"
                                                            value="{{ old('high_school_study_address') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_study_address') }}
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="high_school_graduation_year">{{ __('field_graduation_year') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_graduation_year"
                                                            id="high_school_graduation_year"
                                                            value="{{ old('high_school_graduation_year') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                        </div>
                                                    </div>

                                                   

                                                    
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="high_school_total_marks">{{ __('field_total_marks') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_total_marks"
                                                            id="high_school_total_marks"
                                                            value="{{ old('high_school_total_marks') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_total_marks') }}
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="high_school_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_total_marks_obtained"
                                                            id="high_school_total_marks_obtained"
                                                            value="{{ old('high_school_total_marks_obtained') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_marks_obtained') }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="high_school_graduation_percentage">{{ __('field_graduation_percentage') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="high_school_graduation_percentage"
                                                            id="high_school_graduation_percentage"
                                                            value="{{ old('high_school_graduation_percentage') }}">
                                                        {{-- required --}}

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_percentage') }}
                                                        </div>
                                                    </div>
                                                    
                                                     
                                                </fieldset>
                                            @endif

                                            @if (field('application_collage_info')->status == 1)
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_college_information') }}</legend>
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_name">{{ __('field_intermediate_name') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_name" id="intermediate_name"
                                                            value="{{ old('intermediate_name') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_intermediate_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_study_address">{{ __('field_study_address') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_study_address"
                                                            id="intermediate_study_address"
                                                            value="{{ old('intermediate_study_address') }}">
                                                        {{-- required  --}}

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_study_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_graduation_year">{{ __('field_graduation_year') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_graduation_year"
                                                            id="intermediate_graduation_year"
                                                            value="{{ old('intermediate_graduation_year') }}">
                                                        {{-- required  --}}

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                        </div>
                                                    </div>

                                                   
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_total_marks">{{ __('field_total_marks') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_total_marks"
                                                            id="intermediate_total_marks"
                                                            value="{{ old('intermediate_total_marks') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_total_marks') }}
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_total_marks_obtained"
                                                            id="intermediate_total_marks_obtained"
                                                            value="{{ old('intermediate_total_marks_obtained') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_marks_obtained') }}
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="intermediate_graduation_percentage">{{ __('field_graduation_percentage') }}
                                                            <span>*</span></label>
                                                        <input type="text" class="form-control"
                                                            name="intermediate_graduation_percentage"
                                                            id="intermediate_graduation_percentage"
                                                            value="{{ old('intermediate_graduation_percentage') }}">
                                                        {{-- required  --}}

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_percentage') }}
                                                        </div>
                                                    </div>
                                                    
                                                </fieldset>
                                            @endif

                                            {{-- For  Bachelors   --}}
                                            @if (field('application_bachelor_info')->status == 1)
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_bachelor_information') }}</legend>
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_college_name">{{ __('field_bachelor_name') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_college_name" id="bachelor_college_name"
                                                            value="{{ old('bachelor_college_name') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_bachelor_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_study_address">{{ __('field_study_address') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_study_address" id="bachelor_study_address"
                                                            value="{{ old('bachelor_study_address') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_study_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_graduation_year">{{ __('field_graduation_year') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_graduation_year" id="bachelor_graduation_year"
                                                            value="{{ old('bachelor_graduation_year') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                        </div>
                                                    </div>

                                                  
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_total_marks">{{ __('field_total_marks') }}
                                                            </label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_total_marks"
                                                            id="bachelor_total_marks"
                                                            value="{{ old('bachelor_total_marks') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_total_marks') }}
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                            </label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_total_marks_obtained"
                                                            id="bachelor_total_marks_obtained"
                                                            value="{{ old('bachelor_total_marks_obtained') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_marks_obtained') }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="bachelor_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="bachelor_graduation_percentage"
                                                            id="bachelor_graduation_percentage"
                                                            value="{{ old('bachelor_graduation_percentage') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_percentage') }}
                                                        </div>
                                                    </div>
                                                    
                                                </fieldset>
                                            @endif


                                            {{-- For Master  --}}
                                            @if (field('application_master_info')->status == 1)
                                                <fieldset class="row scheduler-border">
                                                    <legend>{{ __('field_master_information') }}</legend>
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="master_college_name">{{ __('field_master_name') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="master_college_name" id="master_college_name"
                                                            value="{{ old('master_college_name') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_master_name') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="master_study_address">{{ __('field_study_address') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="master_study_address" id="master_study_address"
                                                            value="{{ old('master_study_address') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_study_address') }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="master_graduation_year">{{ __('field_graduation_year') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="master_graduation_year" id="master_graduation_year"
                                                            value="{{ old('master_graduation_year') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_graduation_year') }}
                                                        </div>
                                                    </div>

                                                   
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="master_total_marks">{{ __('field_total_marks') }}
                                                            </label>
                                                        <input type="text" class="form-control"
                                                            name="master_total_marks"
                                                            id="master_total_marks"
                                                            value="{{ old('master_total_marks') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_total_marks') }}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label
                                                            for="master_total_marks_obtained">{{ __('field_marks_obtained') }}
                                                            </label>
                                                        <input type="text" class="form-control"
                                                            name="master_total_marks_obtained"
                                                            id="master_total_marks_obtained"
                                                            value="{{ old('master_total_marks_obtained') }}">
                                                       

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_marks_obtained') }}
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-group col-md-4">
                                                        <label
                                                            for="master_graduation_percentage">{{ __('field_graduation_percentage') }}</label>
                                                        <input type="text" class="form-control"
                                                            name="master_graduation_percentage"
                                                            id="master_graduation_percentage"
                                                            value="{{ old('master_graduation_percentage') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_percentage') }}
                                                        </div>
                                                    </div>
                                                    
                                                </fieldset>
                                            @endif
                                            <!-- Form End--->
                                        </content>
                                    @endif

                                    @if (field('application_high_school_certificate')->status == 1 ||
                                            field('application_highschool_certificate')->status == 1 ||
                                            field('application_highschool_slc')->status == 1 ||
                                            field('application_intermediate_certificate')->status == 1 ||
                                            field('application_intermediate_migration')->status == 1 ||
                                            field('application_intermadiate_certi')->status == 1 ||
                                            field('application_intermediate_clc')->status == 1 ||
                                            field('application_bachelor_certificate')->status == 1 ||
                                            field('application_graduation_migration')->status == 1 ||
                                            field('application_master_certificate')->status == 1 ||
                                            field('application_adhar_card')->status == 1 ||
                                            field('application_parents_id')->status == 1 ||
                                            field('application_pan_card')->status == 1 ||
                                            field('application_photo')->status == 1 ||
                                            field('application_signature')->status == 1)
                                        <h3>{{ __('tab_documents') }}</h3>
                                        <content class="form-step">
                                            <!-- Form Start--->
                                            <fieldset class="row scheduler-border">
                                                @if (field('application_high_school_certificate')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="high_school_certificate">{{ __('field_high_school_certificate') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="high_school_certificate" id="high_school_certificate"
                                                            value="{{ old('high_school_certificate') }}">


                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_high_school_certificate') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_highschool_certificate')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="high_school_certi">{{ __('field_school_certifiate') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="high_school_certi" id="high_school_certi"
                                                            value="{{ old('high_school_certi') }}">


                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_school_certifiate') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_highschool_slc')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="high_school_certificate">{{ __('field_high_school_slc') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control" name="high_school_slc"
                                                            id="high_school_slc" value="{{ old('high_school_slc') }}">
                                                        {{-- required  --}}

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_high_school_slc') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_intermediate_certificate')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="intermediate_certificate">{{ __('field_intermediate_school_certificate') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="intermediate_certificate" id="intermediate_certificate"
                                                            value="{{ old('intermediate_certificate') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_intermediate_school_certificate') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_intermediate_migration')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="intermediate_migration">{{ __('field_intermediate_school_migration') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="intermediate_migration" id="intermediate_migration"
                                                            value="{{ old('intermediate_migration') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_intermediate_school_migration') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_intermadiate_certi')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="intermediate_certi">{{ __('field_intermediate_certifiate') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="intermediate_certi" id="intermediate_certi"
                                                            value="{{ old('intermediate_certi') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_intermediate_certifiate') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_intermediate_clc')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="intermediate_clc">{{ __('field_intermediate_school_clc') }}
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="intermediate_clc" id="intermediate_clc"
                                                            value="{{ old('intermediate_clc') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_intermediate_school_clc') }}
                                                        </div>
                                                    </div>
                                                @endif


                                                @if (field('application_bachelor_certificate')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="bachelor_certificate">{{ __('field_graduation_certificate') }}
                                                        </label>
                                                        <input type="file" class="form-control"
                                                            name="bachelor_certificate" id="bachelor_certificate"
                                                            value="{{ old('bachelor_certificate') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_certificate') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_graduation_migration')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="graduation_migration">{{ __('field_graduation_migration') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="graduation_migration" id="graduation_migration"
                                                            value="{{ old('graduation_migration') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_migration') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_master_certificate')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label
                                                            for="master_certificate">{{ __('field_graduation_clc') }}</label>
                                                        <input type="file" class="form-control"
                                                            name="master_certificate" id="master_certificate"
                                                            value="{{ old('master_certificate') }}">

                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }}
                                                            {{ __('field_graduation_clc') }}
                                                        </div>
                                                    </div>
                                                @endif


                                                @if (field('application_adhar_card')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="adhar_card">{{ __('field_adhar_card') }}:
                                                            <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                            <!--<span>*</span>-->
                                                        </label>
                                                        <input type="file" class="form-control" name="adhar_card"
                                                            id="adhar_card" value="{{ old('adhar_card') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_adhar_card') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_parents_id')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="parents_id">{{ __('field_parents_id') }}:
                                                            <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                            <!--<span>*</span>-->
                                                        </label>
                                                        <input type="file" class="form-control" name="parents_id"
                                                            id="parents_id" value="{{ old('parents_id') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_parents_id') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_pan_card')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="pan_card">{{ __('field_pan_card') }}:
                                                            <!--<span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>-->
                                                            <!--<span>*</span>-->
                                                        </label>
                                                        <input type="file" class="form-control" name="pan_card"
                                                            id="pan_card" value="{{ old('pan_card') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_pan_card') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_photo')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="photo">{{ __('field_photo') }}:
                                                            <span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span>
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control" name="photo"
                                                            id="photo" value="{{ old('photo') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_photo') }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (field('application_signature')->status == 1)
                                                    <div class="form-group col-md-6">
                                                        <label for="signature">{{ __('field_signature') }}:
                                                            <span>{{ __('image_size', ['height' => 100, 'width' => 300]) }}</span>
                                                            <span>*</span></label>
                                                        <input type="file" class="form-control" name="signature"
                                                            id="signature" value="{{ old('signature') }}">
                                                        {{-- required  --}}
                                                        <div class="invalid-feedback">
                                                            {{ __('required_field') }} {{ __('field_signature') }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </fieldset>
                                            <!-- Form End--->
                                        </content>
                                    @endif
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- [ Card ] end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- End Content-->
    @endisset


    @include('admin.layouts.common.footer_script')




    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>



    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";

        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideLeft",
            labels: {
                finish: "{{ __('btn_finish') }}",
                next: "{{ __('btn_next') }}",
                previous: "{{ __('btn_previous') }}",
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {

            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {

            }
        });
    </script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
