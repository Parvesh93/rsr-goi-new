@extends('web.layouts.master')
@section('title', __('academic_us'))
@section('content')

    <main>

        <!-- breadcrumb-area -->
        <div class="" style="background: #141b22;">

            @isset($sliders)
                @foreach ($sliders as $slider)
                    <div class="single-slider slider-bg1"
                        style="background-image: url({{ asset('uploads/slider/' . $slider->attach) }}); background-size: cover;">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="slider-content s-slider-content mt-130">
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('academic_us') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Academic / Academic Overview', '<b><u><i><br>') !!}</p>

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


        <!-- Academic Tabs Section -->
        <section class="academic-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="academic-tabs-mobile d-md-none">
                            <option value="academic-overview">Academic Overview</option>
                            <option value="programs">Academic Programs</option>
                            <option value="faculty">Our Faculty</option>
                            <option value="research">Research & Development</option>
                            <option value="achievements">Academic Achievements</option>
                        </select>

                        <!-- Desktop Tabs -->
                        <ul class="academic-tabs d-none d-md-flex">
                            @isset($academic1)
                                @foreach ($academics as $academic)
                                    <li class="academic-tab-item {{ request()->slug == $academic->slug ? 'active' : '' }}">
                                        <a class="mri"
                                            href="{{ route('academic.single', ['slug' => $academic->slug]) }}">{{ $academic->title }}</a>
                                    </li>
                                @endforeach

                            @endisset
                            
                            
                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="academic-enquiry mt-3">
                                <div class="enquiry-form">
                                    <h4 class="form-heading hco">Enquiry Form</h4>
                                    <form action="{{ route('application.enquiry') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control about-form-input"
                                                placeholder="Full Name" name="full_name" required />
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control about-form-input"
                                                placeholder="Email" name="address" required />
                                        </div>
                                        <div class="mb-3">
                                            <input type="tel" class="form-control about-form-input"
                                                placeholder="Contact Number" name="contact" required />
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select about-form-input" name="course" required>
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
                                            <select class="form-select about-form-input" name="state" required>

                                                <option selected>Select Your State</option>
                                                @foreach (config('settings.state_list') as $key => $state)
                                                    {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                    <option value="{{ $state }}">{{ $state }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control about-form-input" placeholder="Requirement" name="place" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary academic-submit-btn">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div class="quick-links mt-3">
                                <h4 class="academic-links-heading">Quick Links</h4>
                                <ul class="academic-links-list">
                                    <li><a href="#academic-overview">Academic Overview</a></li>
                                    <li><a href="#faculty">Faculty</a></li>
                                    <li><a href="#departments">Departments</a></li>
                                    <li><a href="#research">Research</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-md-12">
                        <div class="academic-content">
                            <!-- Academic Overview Tab -->
                            <div class="academic-tab-content active" id="academic-overview">
                                <h1 class="academic-heading">Academic Excellence</h1>
                                <p class="academic-paragraph">
                                    Our institution is committed to providing quality education
                                    through innovative teaching methods, experienced faculty, and
                                    state-of-the-art facilities. We focus on both theoretical
                                    knowledge and practical skills.
                                </p>
                            </div>

                            <!-- Programs Tab -->
                            <div class="academic-tab-content" id="programs">
                                <h1 class="academic-heading">Academic Programs</h1>
                                <div class="program-list">
                                    <div class="program-item">
                                        <h3>Undergraduate Programs</h3>
                                        <ul>
                                            <li>B.Sc Nursing</li>
                                            <li>Bachelor of Pharmacy</li>
                                            <li>Bachelor of Arts</li>
                                            <li>Bachelor of Commerce</li>
                                        </ul>
                                    </div>
                                    <div class="program-item">
                                        <h3>Diploma Programs</h3>
                                        <ul>
                                            <li>GNM (General Nursing and Midwifery)</li>
                                            <li>D.Pharma</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Faculty Tab -->
                            <div class="academic-tab-content" id="faculty">
                                <h1 class="academic-heading">Our Faculty</h1>
                                <div class="faculty-list">
                                    <div class="faculty-item">
                                        <h3>Experienced Educators</h3>
                                        <p>
                                            Our faculty members bring extensive experience and
                                            expertise:
                                        </p>
                                        <ul>
                                            <li>PhD holders from prestigious institutions</li>
                                            <li>Industry experts as visiting faculty</li>
                                            <li>Regular faculty development programs</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Research Tab -->
                            <div class="academic-tab-content" id="research">
                                <h1 class="academic-heading">Research & Development</h1>
                                <div class="research-content">
                                    <h3>Research Areas</h3>
                                    <ul>
                                        <li>Healthcare Innovation</li>
                                        <li>Clinical Research</li>
                                        <li>Educational Technology</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Achievements Tab -->
                            <div class="academic-tab-content" id="achievements">
                                <h1 class="academic-heading">Academic Achievements</h1>
                                <div class="achievement-list">
                                    <div class="achievement-item">
                                        <h3>Student Achievements</h3>
                                        <ul>
                                            <li>University Rank Holders</li>
                                            <li>Research Publications</li>
                                            <li>Academic Competition Winners</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-lg-none">
                        <div class="academic-enquiry">
                            <div class="enquiry-form">
                                <h4 class="form-heading hco">Enquiry Form</h4>
                                <form action="{{ route('application.enquiry') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control about-form-input"
                                            placeholder="Full Name" name="full_name" required />
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control about-form-input"
                                            placeholder="Your Address" name="address" required />
                                    </div>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control about-form-input"
                                            placeholder="Contact Number" name="contact" required />
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select about-form-input" name="course" required>
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
                                        <select class="form-select about-form-input" name="state" required>

                                            <option selected>Select Your State</option>
                                            @foreach (config('settings.state_list') as $key => $state)
                                                {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control about-form-input" placeholder="Requirement" name="place" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary academic-submit-btn">
                                        Submit
                                    </button>
                                </form>
                            </div>

                            <!-- Quick Links -->
                            <div class="academic-quick-links">
                                <h4 class="academic-links-heading">Quick Links</h4>
                                <ul class="academic-links-list">
                                    <li><a href="#academic-overview">Academic Overview</a></li>
                                    <li><a href="#academic-courses">Academic Programs</a></li>
                                    <li>
                                        <a href="#academic-faculty">Faculty and Departments</a>
                                    </li>
                                </ul>
                            </div>
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


        <!-- Img sections -->

       

    </main>

@endsection
