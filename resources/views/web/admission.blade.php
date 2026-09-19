@extends('web.layouts.master')
@section('title', __('field_admission'))
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
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('admission') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Admission / Admission Overview', '<b><u><i><br>') !!}</p>

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


        <section class="admission-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="admission-tabs-mobile d-md-none">
                            <option value="admission-overview">Admission Overview</option>
                            <option value="requirements">Admission Process</option>
                            <option value="procedure">Application Eligibility</option>
                            <option value="scholarships">Fee Structure</option>
                            <option value="important-dates">FAQs About Admissions</option>
                        </select>

                        <!-- Desktop Tabs -->
                        <ul class="admission-tabs d-none d-md-flex">
                            @isset($admissions)
                                @foreach ($admissions as $admission)
                                    <li class="admission-tab-item {{ request()->slug == $admission->slug ? 'active' : '' }}">
                                        <a class="mri"
                                            href="{{ route('admission.single', ['slug' => $admission->slug]) }}">{{ $admission->title }}</a>
                                    </li>
                                @endforeach
                            @endisset
                            
                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="admission-enquiry mt-3">
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
                                        <button type="submit" class="btn btn-primary admission-submit-btn">
                                            Submit
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Links -->
                            <div class="quick-links mt-3">
                                <h4 class="admission-links-heading">Quick Links</h4>
                                <ul class="admission-links-list">
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
                        {{-- <div class="admission-content"> --}}
                            <!-- Admission Overview Tab -->
                            <div class="admission-tab-content active" id="admission-overview">
                                <h1 class="admission-heading">Admission Process</h1>
                                <p class="admission-paragraph">
                                    Welcome to the admission portal of RSGOI. We offer a
                                    transparent and merit-based admission process for all our
                                    programs. Our admission team is here to guide you through
                                    every step.
                                </p>
                            </div>

                            

                            

                            
                            
                        {{-- </div> --}}
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-block d-lg-none">
                        <div class="admission-enquiry mt-4">
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
                                    <button type="submit" class="btn btn-primary admission-submit-btn">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="quick-links mt-4">
                            <h4 class="admission-links-heading">Quick Links</h4>
                            <ul class="admission-links-list">
                                <li><a href="#admission-overview">Admission Overview</a></li>
                                <li><a href="#admission-process">Admission Process</a></li>
                                <li><a href="#eligibility">Eligibility Criteria</a></li>
                                <li><a href="#documents">Required Documents</a></li>
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

        


        <!-- Img sections -->
  
       
        

    </main>

@endsection
