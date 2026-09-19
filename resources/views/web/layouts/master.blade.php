<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    
   
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (isset($setting))
        <!-- App Title -->
        <title>@yield('title') | {{ $setting->meta_title ?? '' }}</title>

        <meta name="description" content="{!! str_limit(strip_tags($setting->meta_description), 160, ' ...') !!}">
        <meta name="keywords" content="{!! strip_tags($setting->meta_keywords) !!}">

        <!-- App favicon -->
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('/uploads/setting-second/' . $setting->favicon_path) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('uploads/setting-second/' . $setting->favicon_path) }}"
            type="image/x-icon">
    @endif


    @if (empty($setting))
        <!-- App Title -->
        <title>@yield('title')</title>
    @endif



    <!-- Social Meta Tags -->
    <link rel="canonical" href="{{ route('home') }}">

    @yield('social_meta_tags')
    <!--Start Link for new website -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />



    <!-- End Link for new website -->

    <!-- Stylesheets -->
    {{-- <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('web/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">

    <!-- new style css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- contact css -->
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
    <!-- course css -->
    <link rel="stylesheet" href="{{ asset('assets/css/course.css') }}">

    <!-- Gallery CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/gallery.css') }}">
    <!-- About CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

    <!-- Admission CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admission.css') }}">
    <!-- Placement CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/placements.css') }}">
    <!-- Academic CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/academic.css') }}">
    <!-- Labs CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/labs.css') }}">
    <!-- Campus CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/campus.css') }}">
    <!-- Campus CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/common-fixes.css') }}">

    <!-- toastr css -->
    <!--<link rel="stylesheet" href="{{ asset('dashboard/plugins/toastr/css/toastr.min.css') }}">-->
     <!-- toastr CSS -->
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <!-- toastr CSS -->
    <!-- select2 css -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">



    @php
        $version = App\Models\Language::version();
    @endphp


    @if ($version->direction == 1)
        <!-- RTL css -->
        <link rel="stylesheet" href="{{ asset('web/css/rtl.css') }}">
    @endif


</head>

<body>
    <div class="top-bar text-center">
        @isset($collegesInfo)
        @foreach ($collegesInfo as $info)
            <marquee>
                {{ $info->title }}
            </marquee>
        @endforeach
        @endisset()

    </div>

    <!-- Start new header -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            @if (isset($setting))
                <a class="navbar-brand custom-logo" href="{{ route('home') }}">
                    <img src="{{ asset('/uploads/setting-second/' . $setting->logo_path) }}" alt="Logo"
                        height="100" />
                </a>
            @endif



            <div class="d-flex align-items-center">
                <div class="tb-contact-details me-3">
                    @isset($topbarSetting->phone)
                        <div>
                            <h4>Ram Sharan Roy Group of Instituitions</h4>
                        </div><strong><i class="bi bi-telephone"></i> Admission Helpline:
                            <a href="tel:{{ str_replace(' ', '', $topbarSetting->phone ?? '') }}"
                                class="text-black text-decoration-none">{{ $topbarSetting->phone ?? '' }}</a>
                        </strong>
                    @endisset
                    @isset($topbarSetting->email)
                        <strong><i class="bi bi-envelope ms-2"></i>
                            <a href="mailto:{{ $topbarSetting->email ?? '' }}"
                                class="text-black text-decoration-none">{{ $topbarSetting->email ?? '' }}</a>
                        </strong>
                    @endisset
                </div>
                <div class="tb-buttons">
                    <a href="{{ route('download.infomation') }}" class="btn btn-sm mx-1">Downloads</a>
                    <a href="#" class="btn btn-sm mx-1" data-bs-toggle="modal"
                        data-bs-target="#enquiryModal">Apply Now</a>

                    <!-- Enquiry Form Modal -->
                    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="enquiryModalLabel">
                                        Enquiry Form
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('application.enquiry') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Full Name"
                                                    name="full_name" required />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Email"
                                                    name="address" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" name="course" required>
                                                    <option value="">Select Your Course</option>
                                                    @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input type="text" class="form-control" name="contact"
                                                    placeholder="Contact Number" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <select class="form-select" name="state" required>
                                                    <option value="">Select Your State</option>
                                                    @foreach (config('settings.state_list') as $key => $state)
                                                        {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                        <option value="{{ $state }}">{{ $state }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" placeholder="Requirement" name="place" rows="4" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            Submit
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if (Route::has('student.login'))
                        <a class="btn btn-sm mx-1" href="{{ route('student.login') }}"
                            target="_blank">{{ __('field_student') }}
                            {{ __('field_login') }}</a>
                    @endif

                    @if (Route::has('login'))
                        <a class="btn btn-sm mx-1" href="{{ route('login') }}"
                            target="_blank">{{ __('field_staff') }}
                            {{ __('field_login') }}</a>
                    @endif
                    
                     @if (Route::has('login'))
                        <a class="btn btn-sm mx-1" href="{{ route('login') }}"
                            target="_blank">Admin Login
                            </a>
                    @endif

                    <!--<a href="{{ route('application.contact') }}" class="btn btn-sm mx-1">Admin Login</a>-->
                    <a href="{{ route('application.contact') }}" class="btn btn-sm mx-1">Contact Us</a>

                    @php
                        $application = App\Models\ApplicationSetting::status();
                    @endphp
                    @isset($application)
                        <a href="{{ route('application.index') }}" target="_blank"
                            class="btn btn-sm mx-1 ">{{ __('navbar_admission') }}</a>
                    @endisset

                </div>
            </div>
        </div>
    </nav>



    <nav class="navbar navbar-expand-lg navbar-custom-2">
        <div class="container">
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#mobile">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mobile">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                    </li>



                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="./about.html" id="aboutDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            @isset($abouts)
                                @foreach ($abouts as $about)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('about.single', ['slug' => $about->slug]) }}">{{ $about->title }}</a>
                                    </li>
                                @endforeach
                            @endisset

                            <li>
                                <a class="dropdown-item" href="https://ncte.gov.in/Website/Hindi/Index.aspx">NCTE</a>
                            </li>

                            {{-- <li>
                                <a class="dropdown-item" href="{{route('about.single',['slug'=>'about-institution-rsgoi']) }}">About Overview</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Our Story</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Leadership</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">About Institution RSGOI</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Our Vision And Mission</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Message From Director</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Message From Principal</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Our Legacy</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./about.html">Staff Management</a>
                            </li> --}}
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="./about.html" id="aboutDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nursing
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                          
                             @isset($course_diplomas)
                                        @foreach ($course_diplomas as $course_diploma)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('diploma.single', ['slug' => $course_diploma->slug]) }}">{{ $course_diploma->title }}
                                                </a>
                                            </li>
                                        @endforeach
                            @endisset

                          
                        </ul>
                    </li>

                     <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="./about.html" id="aboutDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pharmacy
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                          
                             @isset($pharmacies)
                                        @foreach ($pharmacies as $pharmacy)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('pharmacy1.single', ['slug' => $pharmacy->slug]) }}">{{ $pharmacy->title }}
                                                </a>
                                            </li>
                                        @endforeach
                             @endisset

                          
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="./about.html" id="aboutDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Engineering
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                          
                             @isset($engineering)
                                        @foreach ($engineering as $engineer)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('engineering.single', ['slug' => $engineer->slug]) }}">{{ $engineer->title }}
                                                </a>
                                            </li>
                                        @endforeach
                            @endisset
                          
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="./about.html" id="aboutDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            B.Ed
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                          
                             @isset($educations)
                                        @foreach ($educations as $education)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('education.single', ['slug' => $education->slug]) }}">{{ $education->title }}
                                                </a>
                                            </li>
                                        @endforeach
                            @endisset
                             
                          
                        </ul>
                    </li>



                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="course.html" id="coursesDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Department
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            {{-- @isset($courses)
                                @foreach ($courses as $course)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('course.single', ['slug' => $course->slug]) }}">{{ $course->title }}</a>
                                    </li>
                                @endforeach
                            @endisset --}}


                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Inter College
                                </a>
                                <ul class="dropdown-menu">
                                    @isset($course_pages)
                                        @foreach ($course_pages as $course_page)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('undergraduate.single', ['slug' => $course_page->slug]) }}">{{ $course_page->title }}</a>
                                            </li>
                                        @endforeach
                                    @endisset

                                </ul>
                            </li>



                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Degree</a>
                                <ul class="dropdown-menu">

                                    @isset($degrees)
                                        @foreach ($degrees as $degree)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('degree.single', ['slug' => $degree->slug]) }}">{{ $degree->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset

                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Nursing</a>
                                <ul class="dropdown-menu">

                                    @isset($course_diplomas)
                                        @foreach ($course_diplomas as $course_diploma)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('diploma.single', ['slug' => $course_diploma->slug]) }}">{{ $course_diploma->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset




                                </ul>
                            </li>
                            
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Pharmacy</a>
                                <ul class="dropdown-menu">

                                    @isset($pharmacies)
                                        @foreach ($pharmacies as $pharmacy)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('pharmacy1.single', ['slug' => $pharmacy->slug]) }}">{{ $pharmacy->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset
                                    {{-- <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="./bed.html">B.Ed</a>
                                        <ul class="dropdown-menu">

                                            @isset($beds)
                                                @foreach ($beds as $bed)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('bed.single', ['slug' => $bed->slug]) }}">{{ $bed->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endisset


                                        </ul>
                                    </li> --}}


                                </ul>
                            </li>
                             
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Education</a>
                                <ul class="dropdown-menu">

                                    @isset($educations)
                                       <!--<div>{{$educations}}</div>-->
                                        @foreach ($educations as $education)
                                       
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('education.single', ['slug' => $education->slug]) }}">{{ $education->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset
                             


                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Engineering</a>
                                <ul class="dropdown-menu">

                                    @isset($engineering)
                                        @foreach ($engineering as $engineer)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('engineering.single', ['slug' => $engineer->slug]) }}">{{ $engineer->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset
                             


                                </ul>
                            </li>

                            {{-- <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="./course.html">Education</a>
                                <ul class="dropdown-menu">

                                    @isset($educations)
                                        @foreach ($educations as $education)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('education.single', ['slug' => $education->slug]) }}">{{ $education->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endisset
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="./bed.html">B.Ed</a>
                                        <ul class="dropdown-menu">

                                            @isset($beds)
                                                @foreach ($beds as $bed)
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('bed.single', ['slug' => $bed->slug]) }}">{{ $bed->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endisset


                                        </ul>
                                    </li>


                                </ul>
                            </li> --}}

                            {{-- <li class="dropdown-submenu">
                                <a class="dropdown-item"
                                    href="https://rsrgoi.com/course/ram-sharan-roy-college-of-technology">Ram Sharan
                                    Roy College of Technology</a>
                            </li> --}}


                            {{-- <li>
                                <a class="dropdown-item" href="./course.html">Postgraduate</a>
                            </li> --}}
                        </ul>
                    </li>
                    <!-- Admission -->
                    {{-- <li class="nav-item ">

                        <a class="nav-link text-white" href="{{ route('application.admission') }}">
                            Admission
                        </a>

                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="./admission.html" id="admissionDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admission
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="admissionDropdown">
                            @isset($admissions)
                                @foreach ($admissions as $admission)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admission.single', ['slug' => $admission->slug]) }}">{{ $admission->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset

                            {{-- <li>
                                <a class="dropdown-item"
                                    href="{{ route('admission.single', ['slug' => 'admission-overview']) }}">Admission
                                    Procedure</a>
                            </li> --}}

                            {{-- <li>
                                <a class="dropdown-item" href="./admission.html">Eligibility Criteria</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./admission.html">Required Documents</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./admission.html">Fee Structure</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./admission.html">Scholarships</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./admission.html">Important Dates</a>
                            </li> --}}
                        </ul>
                    </li>

                    <!-- Placement -->
                    {{-- <li class="nav-item ">

                        <a class="nav-link text-white" href="{{ route('application.placement') }}">
                            Placement
                        </a>

                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="./placements.html"
                            id="placementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Placement
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="placementDropdown">
                            @isset($placements)
                                @foreach ($placements as $placement)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('placement.single', ['slug' => $placement->slug]) }}">{{ $placement->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset

                            {{-- <li>
                                <a class="dropdown-item"
                                    href="{{ route('placement.single', ['slug' => 'placement-overview']) }}">Placement
                                    Overview</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./placements.html">Workshops & Seminars</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./placements.html">Training & Placements</a>
                            </li> --}}
                        </ul>
                    </li>

                    <!-- Academics -->
                    {{-- <li class="nav-item ">

                        <a class="nav-link text-white" href="{{ route('application.academic') }}">
                            Academics
                        </a>

                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="./academic.html" id="academicsDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Academics
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="academicsDropdown">
                            @isset($academics)
                                @foreach ($academics as $academic)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('academic.single', ['slug' => $academic->slug]) }}">{{ $academic->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset

                            {{-- <li>
                                <a class="dropdown-item"
                                    href="{{ route('academic.single', ['slug' => 'academic-overview']) }}">Academic
                                    Overview</a>
                            </li> --}}
                            {{-- <li>
                                <a class="dropdown-item" href="./academic.html">Academic Calendar</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./academic.html">Policies</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./academic.html">Rules & Regulations</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./academic.html">Examinations</a>
                            </li> --}}
                        </ul>
                    </li>

                    <!-- Campus Facilities -->
                    {{-- <li class="nav-item ">

                        <a class="nav-link text-white" href="{{ route('application.campus') }}">
                            Campus Facilities
                        </a>

                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="./campus.html" id="campusDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Campus Facilities
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="campusDropdown">
                            @isset($campuses)
                                @foreach ($campuses as $campus)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('campus.single', ['slug' => $campus->slug]) }}">{{ $campus->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset

                            {{-- <li>
                                <a class="dropdown-item"
                                    href="{{ route('campus.single', ['slug' => 'campus-overview']) }}">Campus
                                    Overview</a>
                            </li> --}}
                            {{-- <li>
                                <a class="dropdown-item" href="./campus.html">Facilities Overview</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./campus.html">Class Rooms</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./campus.html">Library</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./campus.html">Sports Complex</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./campus.html">Hostel</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./campus.html">Transportation</a>
                            </li> --}}
                        </ul>
                    </li>

                    <!-- Labs -->
                    {{-- <li class="nav-item ">

                        <a class="nav-link text-white" href="{{ route('application.lab') }}">
                            Labs
                        </a>

                    </li> --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="./labs.html" id="labsDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Labs
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="labsDropdown">
                            @isset($labs)
                                @foreach ($labs as $lab)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('lab.single', ['slug' => $lab->slug]) }}">{{ $lab->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset

                            {{-- <li>
                                <a class="dropdown-item"
                                    href="{{ route('lab.single', ['slug' => 'labs-overview']) }}">Labs Overview</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./labs.html">Nursing Labs</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./labs.html">Computer Labs</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="./labs.html">Science Labs</a>
                            </li> --}}
                        </ul>
                    </li>

                    <li class="{{ Request::is('gallery*') ? 'current' : '' }} nav-item">

                        <a class="nav-link text-white" href="{{ route('gallery') }}">{{ __('navbar_gallery') }}</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-3">
                        @if (isset($setting))
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="logo"></a>
                        </div>
                        @endif
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="main-menu text-right text-xl-right">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="{{ Request::path() == '/' ? 'current' : '' }}"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                    <li class="{{ Request::is('course*') ? 'current' : '' }}"><a href="{{ route('course') }}">{{ __('navbar_course') }}</a></li>
                                    <li class="{{ Request::is('event*') ? 'current' : '' }}"><a href="{{ route('event') }}">{{ __('navbar_event') }}</a></li>
                                    <li class="{{ Request::is('faq*') ? 'current' : '' }}"><a href="{{ route('faq') }}">{{ __('navbar_faqs') }}</a></li>
                                    <li class="{{ Request::is('gallery*') ? 'current' : '' }}"><a href="{{ route('gallery') }}">{{ __('navbar_gallery') }}</a></li>
                                    <li class="{{ Request::is('news*') ? 'current' : '' }}"><a href="{{ route('news') }}">{{ __('navbar_news') }}</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                     
                    <div class="col-xl-3 col-lg-3 text-right d-none d-lg-block text-right text-xl-right">
                        @php 
                        $application = App\Models\ApplicationSetting::status(); 
                        @endphp
                        @isset($application)
                        <div class="login">
                            <ul>
                                <li>
                                    <div class="second-header-btn">
                                       <a href="{{ route('application.index') }}" target="_blank" class="btn">{{ __('navbar_admission') }}</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endisset
                    </div>
                    
                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- End new header -->





    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->


    <!--Start New Web footer -->

    <footer class="footer-section text-light py-5">
        <div class="container">
            <div class="row gy-4">
                <!-- Logo and About Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="">

                        @if (isset($setting))
                            <img src="{{ asset('/uploads/setting-second/' . $setting->logo_path) }}" alt="Logo"
                                class="footer-logo mb-3" />
                        @endif

                        <p style="text-align: justify;">
                            RAM SHARAN ROY GROUP OF INSTITUTIONS IS THE LATEST SYMBOL OF THE
                            VISION OF OUR FOUNDER DIRECTOR HON'BLE SHRI SANJAY KUMAR RAI. IT
                            HAS MADE GOOD PROGRESS IN A SHORT SPAN AND HAS SHOWN A VERY HIGH
                            LEVEL OF ACADEMIC ACCOMPLISHMENT. RSRGOI HAS BENCHMARKED ITSELF
                            WITH THE LATEST CONTENT AND TEACHING METHODOLOGIES.
                        </p>
                    </div>
                </div>

                <!-- Quick Links Section -->

                <div class="col-lg-2 col-md-6">
                    <div class="">
                        <h5 class="fw-bold hco mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li>
                                <i class="fas fa-angle-right me-2"></i><a href="{{ route('home') }}"
                                    class="text-light">Home</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-right me-2"></i><a href="{{ route('application.about') }}"
                                    class="text-light">About</a>
                            </li>
                            <li>
                                <i class="fas fa-angle-right me-2"></i><a href="{{ route('course') }}"
                                    class="text-light">Courses</a>
                            </li>
                            <!--<li>-->
                            <!--    <i class="fas fa-angle-right me-2"></i><a href="#" class="text-light">Blog</a>-->
                            <!--</li>-->
                            <li>
                                <i class="fas fa-angle-right me-2"></i><a href="{{ route('application.contact') }}"
                                    class="text-light">Contact</a>
                            </li>
                            @isset($quick_pages)

                                @foreach ($quick_pages as $quick_page)
                                    <li><i class="fas fa-angle-right me-2"></i><a class="text-light"
                                            href="{{ route('page.single', ['slug' => $quick_page->slug]) }}">{{ $quick_page->title }}</a>
                                    </li>
                                @endforeach
                            @endisset


                        </ul>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="all-courses">
                        <h5 class="fw-bold hco mb-3">All Courses</h5>
                        <ul class="list-unstyled">
                            {{-- @isset($footer_pages)
                                @foreach ($footer_pages as $footer_page)
                                    <li><i class="fas fa-angle-right me-2"></i><a class="text-light"
                                            href="{{ route('page.single', ['slug' => $footer_page->slug]) }}">{{ $footer_page->title }}</a>
                                    </li>
                                @endforeach
                            @endisset --}}
                            @isset($course_pages)
                                @foreach ($course_pages as $course_page)
                                    <li><i class="fas fa-angle-right me-2"></i><a class="text-light"
                                            href="{{ route('undergraduate.single', ['slug' => $course_page->slug]) }}">{{ $course_page->title }}</a>
                                    </li>
                                @endforeach
                            @endisset
                            @isset($degrees)
                                @foreach ($degrees as $degree)
                                    <li><i class="fas fa-angle-right me-2"></i><a class="text-light"
                                            href="{{ route('degree.single', ['slug' => $degree->slug]) }}">{{ $degree->title }}</a>
                                    </li>
                                @endforeach
                            @endisset
                            @isset($course_diplomas)
                                @foreach ($course_diplomas as $course_diploma)
                                    <li><i class="fas fa-angle-right me-2"></i><a class="text-light"
                                            href="{{ route('diploma.single', ['slug' => $course_diploma->slug]) }}">{{ $course_diploma->title }}</a>
                                    </li>
                                @endforeach
                            @endisset


                        </ul>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="">
                        <h5 class="fw-bold hco mb-3">Main Campus Office</h5>
                        <ul class="list-unstyled">
                            @isset($topbarSetting->phone)
                                <li>
                                    <i class="icon fal fa-phone"></i>
                                    <span><a class="hco"
                                            href="tel:{{ str_replace(' ', '', $topbarSetting->phone ?? '') }}">{{ $topbarSetting->phone ?? '' }}</a></span>
                                </li>
                            @endisset

                            {{-- 📞 --}}
                            @isset($topbarSetting->email)
                                <li class="mt-2 mr-2">
                                    <i class="icon fal fa-envelope"></i>
                                    <span><a class="hco"
                                            href="mailto:{{ $topbarSetting->email ?? '' }}">{{ ' ' }}{{ $topbarSetting->email ?? '' }}</a></span>
                                </li>
                            @endisset

                            @isset($topbarSetting->address)
                                <li class="mt-2">
                                    <i class="icon fal fa-map-marker-check"></i>
                                    <span>{{ $topbarSetting->address ?? '' }}</span>
                                </li>
                            @endisset

                        </ul>
                        <div class="social-icons d-flex mt-3">
                            <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="me-3"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- <div class="fixed-enrollment-btn">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enquiryModal">
            Enroll Now
        </button>
    </div> --}}




    


    <!--End New Web footer -->


    <!--Start For new web Script JS -->




    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>





    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    <!-- about js-->
    <script src="{{ asset('assets/js/about.js') }}"></script>

    <script src="{{ asset('assets/js/tabs.js') }}"></script>

    <script src="{{ asset('assets/js/slider.js') }}"></script>


    <!--End For new web Script JS -->

    <!-- Script JS -->

    <script src="{{ asset('web/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('web/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('web/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('web/js/slick.min.js') }}"></script>
    <script src="{{ asset('web/js/paroller.js') }}"></script>
    <script src="{{ asset('web/js/wow.min.js') }}"></script>
    <script src="{{ asset('web/js/js_isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('web/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web/js/element-in-view.js') }}"></script>
    <script src="{{ asset('web/js/main.js') }}"></script>

    <!-- toastr Js -->
    <!--<script src="{{ asset('dashboard/plugins/toastr/js/toastr.min.js') }}"></script>-->
    
    <!-- toastr JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- toastr JS -->
    <!-- Toastr message display -->


    <script type="text/javascript">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]("{{ $error }}");
            @endforeach
        @endif
    </script>

<script>
    window.onload = function() {
      // "Enroll Now" button ka selector yahaan daalna hai
      var enrollButton = document.querySelector("#abc");
  
      if(enrollButton){
        enrollButton.click();
      } else {
        console.log("Enroll Now button not found.");
      }
    };
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
