@extends('web.layouts.master')
@section('title', __('navbar_course'))
@section('content')

    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->

        <div class="slider-active" style="background: #141b22;">
            
            @isset($sliders)
                @foreach ($sliders as $slider)
                    <div class="single-slider slider-bg1"
                        style="background-image: url({{ asset('uploads/slider/' . $slider->attach) }}); background-size: cover;">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="slider-content s-slider-content mt-130">
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('course') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Course / Course Overview', '<b><u><i><br>') !!}</p>

                                        @if (isset($slider->button_link))
                                            <div class="slider-btn mt-30">
                                                <a href="{{ $slider->button_link }}" target="_blank" class="btn ss-btn mr-15"
                                                    data-animation="fadeInLeft" data-delay=".4s">{{ $slider->button_text }} <i
                                                        class="fal fa-long-arrow-right"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 p-relative">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset

        </div>

        <!-- breadcrumb-area-end -->


        <!-- Course Tabs Section -->
        <section class="course-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="course-tabs-mobile d-md-none">
                            <option value="course-overview">Course Overview</option>
                            <option value="undergraduate">Undergraduate Courses</option>
                            <option value="postgraduate">Postgraduate Courses</option>
                            <option value="diploma">Diploma Courses</option>
                            <option value="certification">Certification Programs</option>
                        </select>

                        <!-- Desktop Tabs -->

                        <ul class="course-tabs d-none d-md-flex">
                            @isset($courses)
                                @foreach ($courses as $course)
                                    <li class="course-tab-item {{ request()->slug == $course->slug ? 'active' : '' }}">
                                        <a class="mri"
                                            href="{{ route('course.single', ['slug' => $course->slug]) }}">{{ $course->title }}
                                        </a>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="course-enquiry mt-3">
                                <div class="enquiry-form">
                                    <h4 class="hco">Enquiry Form</h4>
                                    <form action="{{ route('application.enquiry') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control course-form-input"
                                                placeholder="Full Name" name="full_name" required />
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control course-form-input" placeholder="Email"
                                                name="address" required />
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select course-form-input" name="course" required>
                                                <option selected>Select Your Course</option>
                                                <option value="ANM">ANM</option>
                                                <option value="GNM">GNM</option>
                                                <option value="Bachelor of Science in Nursing">
                                                    Bachelor of Science in Nursing
                                                </option>
                                                <option value="B.Pharma">B.Pharma</option>
                                                <option value="D.Pharma">D.Pharma</option>
                                                <option value="Intermediate In Arts">
                                                    Intermediate In Arts
                                                </option>
                                                <option value="Intermediate In Science">
                                                    Intermediate In Science
                                                </option>
                                                <option value="Intermediate In Commerce">
                                                    Intermediate In Commerce
                                                </option>
                                                <option value="ITI">ITI</option>
                                                <option value="B.Sc">B.Sc</option>
                                                <option value="B.com">B.com</option>
                                                <option value="B.Ed">B.Ed</option>
                                                <option value="BBA">BBA</option>
                                                <option value="BCA">BCA</option>
                                                <option value="B.A">B.A</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Contact Us"
                                                name="contact" required />
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" name="state" required>
                                                <option>Select Your State</option>
                                                @foreach (config('settings.state_list') as $key => $state)
                                                    {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                    <option value="{{ $state }}">{{ $state }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control course-form-input" placeholder="Requirement" name="place" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary course-submit-btn">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <!--<div class="quick-links mt-3">-->
                            <!--    <h4 class="course-links-heading">Quick Links</h4>-->
                            <!--    <ul class="course-links-list">-->
                            <!--        <li><a href="#admission-overview">Admission Overview</a></li>-->
                            <!--        <li><a href="#admission-process">Admission Process</a></li>-->
                            <!--        <li>-->
                            <!--            <a href="#admission-eligibility">Admission Eligibility</a>-->
                            <!--        </li>-->
                            <!--        <li><a href="#important-notes">Important Notes</a></li>-->
                            <!--    </ul>-->
                            <!--</div>-->
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-md-12">
                        <div class="course-content">
                            <!-- Course Overview Tab -->
                            <div class="course-tab-content active" id="course-overview">
                                <h1 class="course-heading">Course Overview</h1>
                                <p class="course-paragraph">
                                    Welcome to our comprehensive course offerings at RSGOI...
                                </p>
                            </div>

                            <!-- Undergraduate Tab -->
                            <div class="course-tab-content" id="undergraduate">
                                <h1 class="course-heading">Undergraduate Programs</h1>
                                <div class="course-list">
                                    <div class="course-item">
                                        <h3>Bachelor of Science in Nursing (B.Sc Nursing)</h3>
                                        <p>Duration: 4 years</p>
                                        <p>Eligibility: 10+2 with Science</p>
                                    </div>
                                    <div class="course-item">
                                        <h3>Bachelor of Arts (B.A)</h3>
                                        <p>Duration: 3 years</p>
                                        <p>Eligibility: 10+2 in any stream</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Postgraduate Tab -->
                            <div class="course-tab-content" id="postgraduate">
                                <h1 class="course-heading">Postgraduate Programs</h1>
                                <div class="course-list">
                                    <div class="course-item">
                                        <h3>Master of Science in Nursing (M.Sc Nursing)</h3>
                                        <p>Duration: 2 years</p>
                                        <p>Eligibility: B.Sc Nursing</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Diploma Tab -->
                            <div class="course-tab-content" id="diploma">
                                <h1 class="course-heading">Diploma Courses</h1>
                                <div class="course-list">
                                    <div class="course-item">
                                        <h3>General Nursing and Midwifery (GNM)</h3>
                                        <p>Duration: 3 years</p>
                                        <p>Eligibility: 10+2 with Science</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Certification Tab -->
                            <div class="course-tab-content" id="certification">
                                <h1 class="course-heading">Certification Programs</h1>
                                <div class="course-list">
                                    <div class="course-item">
                                        <h3>Healthcare Management</h3>
                                        <p>Duration: 6 months</p>
                                        <p>Mode: Online/Offline</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-block d-lg-none">
                        <div class="course-enquiry mt-4">
                            <div class="enquiry-form">
                                <h4 class="hco">Enquiry Form</h4>
                                <form action="{{ route('application.enquiry') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control course-form-input"
                                            placeholder="Full Name" name="full_name" required />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control course-form-input"
                                            placeholder="Your Address" name="address" required />
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select course-form-input" name="course" required>
                                            <option selected>Select Your Course</option>
                                            <option value="ANM">ANM</option>
                                            <option value="GNM">GNM</option>
                                            <option value="Bachelor of Science in Nursing">
                                                Bachelor of Science in Nursing
                                            </option>
                                            <option value="B.Pharma">B.Pharma</option>
                                            <option value="D.Pharma">D.Pharma</option>
                                            <option value="Intermediate In Arts">
                                                Intermediate In Arts
                                            </option>
                                            <option value="Intermediate In Science">
                                                Intermediate In Science
                                            </option>
                                            <option value="Intermediate In Commerce">
                                                Intermediate In Commerce
                                            </option>
                                            <option value="ITI">ITI</option>
                                            <option value="B.Sc">B.Sc</option>
                                            <option value="B.com">B.com</option>
                                            <option value="B.Ed">B.Ed</option>
                                            <option value="BBA">BBA</option>
                                            <option value="BCA">BCA</option>
                                            <option value="B.A">B.A</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Contact Us"
                                            name="contact" required />
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="state" required>
                                            <option>Select Your State</option>
                                            @foreach (config('settings.state_list') as $key => $state)
                                                {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control course-form-input" placeholder="Requirement" name="place" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary course-submit-btn">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!--<div class="quick-links mt-4">-->
                        <!--    <h4 class="course-links-heading">Quick Links</h4>-->
                        <!--    <ul class="course-links-list">-->
                        <!--        <li><a href="#course-overview">Course Overview</a></li>-->
                        <!--        <li><a href="#admission">Admission</a></li>-->
                        <!--        <li><a href="#curriculum">Curriculum</a></li>-->
                        <!--        <li><a href="#faculty">Faculty</a></li>-->
                        <!--    </ul>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <div class="container course-page-imgs my-5">
                <div class="row g-4">
                    @isset($galleries)

                        @foreach ($galleries as $gallery)
                            <div class="col-md-4">
                                <div class="about-img-card shadow">
                                    <img src="{{ asset(asset('uploads/gallery/' . $gallery->attach)) }}"
                                        alt="Campus Building" class="img-fluid rounded" />
                                </div>
                            </div>
                        @endforeach
                    @endisset



                </div>
            </div>
        </section>



        {{-- <section class="course-section">
            <div class="container course-page-imgs my-5">
                <div class="row g-4">
                    @foreach ($galleries as $gallery)
                        <div class="col-md-4">
                            <div class="about-img-card shadow">
                                <img src="{{ asset(asset('uploads/gallery/' . $gallery->attach)) }}"
                                    alt="Campus Building" class="img-fluid rounded" />
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section> --}}




        <!-- Course Tabs Section -->
        {{-- <section class="course-content-section">
            <!-- Mobile Selector -->
            <select class="course-tabs-mobile d-md-none">

                <option value="course-overview">Course Overview</option>
                <option value="undergraduate">Undergraduate Programs</option>
                <option value="postgraduate">Postgraduate Programs</option>
                <option value="diploma">Diploma Courses</option>
            </select> --}}

        <!-- Desktop Tabs -->
        {{-- <ul class="course-tabs d-none d-md-flex">
                @foreach ($courses as $course)
                <li class="course-tab-item active">
                    <a href="{{ route('course.single', ['slug' => $course->slug]) }}" class="course-tab-link">{{$course->title}}
                        </a>
                </li>
                @endforeach
                
                
            </ul> --}}
        {{-- </section> --}}

        <!-- course-content-section -->
        {{-- <section class="course-section">
            <div class="container">
                <div class="row">
                    <!-- Left Content Section -->
                    <div class="col-lg-8 col-md-12 course-content">
                        
                        <!-- Dropdown for Mobile View -->
                        <div class="d-lg-none mb-3">
                            <select class="form-select course-dropdown" id="course-mobile-dropdown">
                                <option value="course-institution" selected>
                                    About Institution RSGOI
                                </option>
                                <option value="vision-mission">Our Vision And Mission</option>
                                <option value="message-director">Message From Director</option>
                            </select>
                        </div>

                        <!-- Dynamic Content Section -->
                        <div class="course-tab-content active" id="course-institution">
                            <h1 class="course-heading">Welcome to Our Institutions</h1>
                            <p class="course-paragraph">
                                <b> Our Institution RAM SHARAN GROUP OF INSTITUTIONS </b> is the
                                latest symbol of the vision of our Founder Director Hon'ble Shri
                                SANJAY KUMAR RAI. It has made good progress in a short span and
                                has shown a very high level of academic accomplishment. RSGOI
                                has benchmarked itself with the latest content and teaching
                                methodologies.
                            </p>
                            <p class="course-paragraph">
                                Welcome to RSGOI, which is the leading institution dedicated to
                                excellence in nursing education in Bihar and in India.
                                Established with a commitment to nurturing competent and
                                compassionate healthcare professionals, including Under
                                Graduate, Graduate, and Post Graduate Courses, we offer a range
                                of programs tailored to meet the diverse needs of aspiring
                                students and candidates seeking higher education.
                            </p>
                            <!-- Additional paragraphs -->
                        </div>

                        <!-- Additional Content Tabs -->
                        <div class="course-tab-content" id="vision-mission" style="display: none">
                            <h1 class="course-heading">Our Vision and Mission</h1>
                            <p class="course-paragraph">
                                (Add the Vision and Mission text here.)
                            </p>
                        </div>
                        <div class="course-tab-content" id="message-director" style="display: none">
                            <h1 class="course-heading">Message from the Director</h1>
                            <p class="course-paragraph">(Add the Director's message here.)</p>
                        </div>
                    </div>

                    <!-- Right Enquiry Form Section -->
                    <div class="col-lg-4 col-md-12 course-enquiry">
                        <div class="enquiry-form">
                            <h4 class="hco">Enquiry Form</h4>
                            <form action="{{ route('application.enquiry') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control course-form-input" placeholder="Full Name"
                                        name="full_name" required />
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control course-form-input" placeholder="Your Address"
                                        name="address" required />
                                </div>
                                <div class="mb-3">
                                    <select class="form-select course-form-input" name="course" required>
                                        <option selected>Select Your Course</option>
                                        <option value="ANM">ANM</option>
                                        <option value="GNM">GNM</option>
                                        <option value="Bachelor of Science in Nursing">
                                            Bachelor of Science in Nursing
                                        </option>
                                        <option value="B.Pharma">B.Pharma</option>
                                        <option value="D.Pharma">D.Pharma</option>
                                        <option value="Intermediate In Arts">
                                            Intermediate In Arts
                                        </option>
                                        <option value="Intermediate In Science">
                                            Intermediate In Science
                                        </option>
                                        <option value="Intermediate In Commerce">
                                            Intermediate In Commerce
                                        </option>
                                        <option value="ITI">ITI</option>
                                        <option value="B.Sc">B.Sc</option>
                                        <option value="B.com">B.com</option>
                                        <option value="B.Ed">B.Ed</option>
                                        <option value="BBA">BBA</option>
                                        <option value="BCA">BCA</option>
                                        <option value="B.A">B.A</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Contact Us" name="contact"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" name="state" required>
                                        <option>Select Your State</option>
                                        @foreach (config('settings.state_list') as $key => $state)
                                            <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>  
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control course-form-input" placeholder="Requirement" name="place" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary course-submit-btn">
                                    Submit
                                </button>
                            </form>
                        </div>

                        <!-- Quick Links -->
                        <div class="course-quick-links">
                            <h4 class="course-links-heading">Quick Links</h4>
                            <ul class="course-links-list">
                                <li><a href="#admission-overview">Admission Overview</a></li>
                                <li><a href="#admission-process">Admission Process</a></li>
                                <li>
                                    <a href="#admission-eligibility">Admission Eligibility</a>
                                </li>
                                <li><a href="#important-notes">Important Notes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}



        {{-- <!-- course-area -->
        <section class="shop-area pt-120 pb-120 p-relative " data-animation="fadeInUp animated" data-delay=".2s">
            <div class="container">
                <div class="row align-items-center">

                    @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="courses-item mb-30 hover-zoomin">
                            <div class="thumb fix">
                                <a href="{{ route('course.single', ['slug' => $course->slug]) }}"><img src="{{ asset('uploads/course/'.$course->attach) }}" alt="Course"></a>
                            </div>
                            <div class="courses-content">                                    
                                <div class="cat"><i class="fal fa-graduation-cap"></i> {{ $course->faculty }}</div>

                                <h3><a href="{{ route('course.single', ['slug' => $course->slug]) }}">{{ $course->title }}</a></h3>
                                <p>{!! str_limit(strip_tags($course->description), 120, ' ...') !!}</p>

                                <a href="{{ route('course.single', ['slug' => $course->slug]) }}" class="readmore">{{ __('btn_read_more') }} <i class="fal fa-long-arrow-right"></i></a>
                            </div>
                            <div class="icon">
                                <img src="{{ asset('web/img/icon/cou-icon.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrap mt-20 text-center">
                            <nav>
                                <ul class="pagination">
                                    {{ $courses->appends(Request::only('search'))->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- course-area-end --> --}}

    </main>
    <!-- main-area-end -->

@endsection
