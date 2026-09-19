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
                                                @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                                    @endforeach
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
                            <div class="quick-links mt-3">
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
                                            @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                            @endforeach
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

                        <div class="quick-links mt-4">
                            <h4 class="course-links-heading">Quick Links</h4>
                            <ul class="course-links-list">
                                <li><a href="#course-overview">Course Overview</a></li>
                                <li><a href="#admission">Admission</a></li>
                                <li><a href="#curriculum">Curriculum</a></li>
                                <li><a href="#faculty">Faculty</a></li>
                            </ul>
                        </div>
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
    </main>
    <!-- main-area-end -->

@endsection
