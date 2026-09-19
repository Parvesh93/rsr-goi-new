@extends('web.layouts.master')
@section('title', __('lab_us'))
@section('content')

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
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('lab') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Lab / lab Overview', '<b><u><i><br>') !!}</p>

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



        <section class="labs-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="labs-tabs-mobile d-md-none">
                            <option value="labs-overview">Labs Overview</option>
                            <option value="nursing-labs">Nursing Labs</option>
                            <option value="computer-labs">Computer Labs</option>
                            <option value="science-labs">Science Labs</option>
                            <option value="equipment">Lab Equipment</option>
                        </select>

                        <!-- Desktop Tabs -->
                        <ul class="labs-tabs d-none d-md-flex">

                            @isset($labs)
                                @foreach ($labs as $lab)
                                    <li class="labs-tab-item {{ request()->slug == $lab->slug ? 'active' : '' }}">
                                        <a class="mri"
                                            href="{{ route('lab.single', ['slug' => $lab->slug]) }}">{{ $lab->title }}</a>
                                    </li>
                                @endforeach
                            @endisset



                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="labs-enquiry mt-3">
                                <div class="enquiry-form">
                                    <h4 class="form-heading hco">Enquiry Form</h4>
                                    <form action="{{ route('application.enquiry') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control about-form-input"
                                                placeholder="Full Name" name="full_name" required />
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control about-form-input" placeholder="Email"
                                                name="address" required />
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
                                        <button type="submit" class="btn btn-primary labs-submit-btn">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div class="quick-links mt-3">
                                <h4 class="labs-links-heading">Quick Links</h4>
                                <ul class="labs-links-list">
                                    <li><a href="#nursing-labs">Nursing Labs</a></li>
                                    <li><a href="#computer-labs">Computer Labs</a></li>
                                    <li><a href="#science-labs">Science Labs</a></li>
                                    <li><a href="#research-labs">Research Labs</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-md-12">
                        <div class="labs-content">
                            <!-- Labs Overview Tab -->
                            <div class="labs-tab-content active" id="labs-overview">
                                <h1 class="labs-heading">Laboratory Facilities</h1>
                                <p class="labs-paragraph">
                                    Our institution boasts state-of-the-art laboratory facilities
                                    equipped with modern technology and equipment. These labs
                                    provide hands-on experience to students across various
                                    disciplines.
                                </p>
                            </div>

                            <!-- Nursing Labs Tab -->
                            <div class="labs-tab-content" id="nursing-labs">
                                <h1 class="labs-heading">Nursing Laboratories</h1>
                                <div class="labs-facilities">
                                    <div class="lab-item">
                                        <h3>Fundamental Nursing Lab</h3>
                                        <p>
                                            Equipped with patient care simulators and basic nursing
                                            equipment
                                        </p>
                                        <ul>
                                            <li>Advanced patient mannequins</li>
                                            <li>Vital signs monitoring equipment</li>
                                            <li>Basic nursing care tools</li>
                                        </ul>
                                    </div>
                                    <div class="lab-item">
                                        <h3>Advanced Simulation Lab</h3>
                                        <p>
                                            High-fidelity simulation center for complex medical
                                            scenarios
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Computer Labs Tab -->
                            <div class="labs-tab-content" id="computer-labs">
                                <h1 class="labs-heading">Computer Laboratories</h1>
                                <div class="labs-facilities">
                                    <div class="lab-item">
                                        <h3>Main Computer Lab</h3>
                                        <p>Features:</p>
                                        <ul>
                                            <li>50 Latest Configuration Computers</li>
                                            <li>High-speed Internet Connection</li>
                                            <li>Essential Software Packages</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Science Labs Tab -->
                            <div class="labs-tab-content" id="science-labs">
                                <h1 class="labs-heading">Science Laboratories</h1>
                                <div class="labs-facilities">
                                    <div class="lab-item">
                                        <h3>Physics Lab</h3>
                                        <p>Complete setup for physics experiments</p>
                                    </div>
                                    <div class="lab-item">
                                        <h3>Chemistry Lab</h3>
                                        <p>
                                            Modern equipment for chemical analysis and experiments
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Equipment Tab -->
                            <div class="labs-tab-content" id="equipment">
                                <h1 class="labs-heading">Laboratory Equipment</h1>
                                <div class="labs-facilities">
                                    <div class="lab-item">
                                        <h3>Latest Equipment</h3>
                                        <ul>
                                            <li>Medical Simulators</li>
                                            <li>Diagnostic Equipment</li>
                                            <li>Research Microscopes</li>
                                            <li>Digital Lab Tools</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-block d-lg-none">
                        <div class="labs-enquiry mt-4">
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
                                    <button type="submit" class="btn btn-primary labs-submit-btn">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="quick-links mt-4">
                            <h4 class="labs-links-heading">Quick Links</h4>
                            <ul class="labs-links-list">
                                <li><a href="#nursing-labs">Nursing Labs</a></li>
                                <li><a href="#computer-labs">Computer Labs</a></li>
                                <li><a href="#science-labs">Science Labs</a></li>
                                <li><a href="#research-labs">Research Labs</a></li>
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
                                    <img src="{{ asset('uploads/gallery/' . $gallery->attach) }}"
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
