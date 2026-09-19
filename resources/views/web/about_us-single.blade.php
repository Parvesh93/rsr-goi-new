@extends('web.layouts.master')
@section('title', __('about_us'))
@section('content')

    <main>

        <!-- breadcrumb-area -->
        {{-- @include('web.slider') --}}
        <!-- breadcrumb-area-end -->
        <div class="slider-active" style="background: #141b22;">

            @isset($sliders)
            @foreach ($sliders as $slider)
                <div class="single-slider slider-bg1"
                    style="background-image: url({{ asset('uploads/slider/' . $slider->attach) }}); background-size: cover;">
                    <div class="overlay"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="slider-content s-slider-content mt-120">
                                    <h2 data-animation="fadeInUp" data-delay=".4s">{{ $about1->title }}</h2>
                                    <p data-animation="fadeInUp" data-delay=".6s">{!! 'Home /'.$about1->title!!}</p>

                                    @if (isset($slider->button_link))
                                        <div class="slider-btn mt-20">
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


        <section class="about-section1">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <li class="nav-item dropdown labs-tabs-mobile d-md-none">
                            <a class="nav-link dropdown-toggle " href="./campus.html" id="campusDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{$about1->title}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="campusDropdown">
                                @isset($abouts)
                                @foreach ($abouts as $about)
                                    <li class="about-tab-item {{ request()->slug == $about->slug ? 'active' : '' }}">
                                        <a class=""
                                            href="{{ route('about.single', ['slug' => $about->slug]) }}">{{ $about->title }}</a>
                                    </li>
                                @endforeach
                            @endisset
    
                            </ul>
                        </li>
                        
                        <!-- Desktop Tabs -->
                        <ul class="about-tabs d-none d-md-flex">

                            @isset($abouts)
                                @foreach ($abouts as $about)
                                    <li class="about-tab-item {{ request()->slug == $about->slug ? 'active' : '' }}">
                                        <a class="mri"
                                            href="{{ route('about.single', ['slug' => $about->slug]) }}">{{ $about->title }}</a>
                                    </li>
                                @endforeach
                            @endisset

                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="about-enquiry mt-3">
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
                                                @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                                    @endforeach
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
                            
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-md-12">
                        <div class="about-content">
                            <!-- Dynamic Content Section -->
                            <div class="about-tab-content active" id="about-institution">

                                {!! $about1->description !!}

                            </div>


                        </div>
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-lg-none">
                        <!-- Enquiry Form -->
                        <div class="about-enquiry mt-4">
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
                                             @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                                    @endforeach
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
                        
                    </div>
                </div>
            </div>

            <div class="container about-page-imgs my-5">
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




@endsection
