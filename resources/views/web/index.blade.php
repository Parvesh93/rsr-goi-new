@extends('web.layouts.master')
@section('title', __('navbar_home'))

@section('social_meta_tags')
    @if (isset($setting))
        <meta property="og:type" content="website">
        <meta property='og:site_name' content="{{ $setting->title }}" />
        <meta property='og:title' content="{{ $setting->title }}" />
        <meta property='og:description' content="{!! str_limit(strip_tags($setting->meta_description), 160, ' ...') !!}" />
        <meta property='og:url' content="{{ route('home') }}" />
        <meta property='og:image' content="{{ asset('/uploads/setting/' . $setting->logo_path) }}" />


        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="{!! '@' . str_replace(' ', '', $setting->title) !!}" />
        <meta name="twitter:creator" content="@HiTechParks" />
        <meta name="twitter:url" content="{{ route('home') }}" />
        <meta name="twitter:title" content="{{ $setting->title }}" />
        <meta name="twitter:description" content="{!! str_limit(strip_tags($setting->meta_description), 160, ' ...') !!}" />
        <meta name="twitter:image" content="{{ asset('/uploads/setting/' . $setting->logo_path) }}" />
    @endif
@endsection

@section('content')

    <!-- main-area -->
    <main>

        {{--  
        <section class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center align-items-center g-4">
      
      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo1.png" class="img-fluid" alt="Logo 1">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo2.png" class="img-fluid" alt="Logo 2">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo3.png" class="img-fluid" alt="Logo 3">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo4.png" class="img-fluid" alt="Logo 4">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo5.png" class="img-fluid" alt="Logo 5">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo6.png" class="img-fluid" alt="Logo 6">
      </div>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
        <img src="logo7.png" class="img-fluid" alt="Logo 7">
      </div>

    </div>
  </div>
</section>

--}}


        <!-- Start New slider-area -->
        {{-- <section id="home" class="slider-area fix p-relative">

            <div class="slider-active" style="background: #141b22;">

                @isset($sliders)
                    @foreach ($sliders as $slider)
                        <div class="single-slider slider-bg"
                            style="background-image: url({{ asset('uploads/slider/' . $slider->attach) }}); background-size: cover;">
                            <div class="overlay"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="slider-content s-slider-content mt-130">
                                            <h2 data-animation="fadeInUp" data-delay=".4s">{{ $slider->title }}</h2>
                                            <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags($slider->sub_title, '<b><u><i><br>') !!}</p>
                                            <button class="btn btn-primary mt-4 pt-3 pb-3">Read More</button>

                                            @if (isset($slider->button_link))
                                                <div class="slider-btn mt-30">
                                                    <a href="{{ $slider->button_link }}" target="_blank"
                                                        class="btn ss-btn mr-15" data-animation="fadeInLeft"
                                                        data-delay=".4s">{{ $slider->button_text }} <i
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
        </section> --}}
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-slider">
                @isset($sliders)
                    @foreach ($sliders as $slider)
                    <div class="slide active" style="background-image: url({{asset('uploads/slider/' . $slider->attach) }})">
                        <div class="slide-content">
                            <h1 class="mri">{{ $slider->title }}</h1>
                            <p>
                                {!! strip_tags($slider->sub_title, '<b><u><i><br>') !!}
                            </p>
                            <button class="form-btn btn-primary"><a href="{{$slider->button_link}}">Learn More</a></button>
                        </div>
                    </div>
                    @endforeach
                @endisset
               
                {{-- <div class="slide" style="background-image: url('images/home/slide_2.jpg')">
                    <div class="slide-content">
                        <h1>Approved by Health Department Govt. Of Bihar University</h1>
                        <p>
                            At RSRGOI our vision is to be recognized globally as a beacon of
                            excellence in nursing education and knowledge innovation
                        </p>
                        <button class="form-btn btn-primary">Read More</button>
                    </div>
                </div> --}}

                <!-- Navigation -->
                <div class="navigation">
                    <span class="active" data-slide="0"></span>
                    <span data-slide="1"></span>
                </div>

                <!-- Navigation Arrows -->
                <button class="arrow left-arrow">&lt;</button>
                <button class="arrow right-arrow">&gt;</button>
            </div>
        </section>

        <!-- End New slider-area -->
        
        <!-- Start of approved-area -->
        @isset($approved)
         <section class="py-5 bg-white">
            <div class="container">
              <h3 class="fw-bold text-center mb-4">Approved By</h3>
          
              <div class="d-flex overflow-auto justify-content-center align-items-center gap-4 px-2 logos-scroll">
                  @foreach($approved as $key=>$app)
                   <img src="{{ asset('uploads/gallery/' . $app->attach) }}" class="approved-logo" alt="AICTE">
                  @endforeach
               
              </div>
            </div>
          </section>
          
        @endisset      
<!-- End of approved-area -->

        <!-- Start New Web service-area and Features Section -->
        <section class="info-section">
            <div class="container">
                <div class="row">
                    <!-- Feature 1 -->
                    <div class="col-md-4 mb-2">
                        <div class="feature-item">
                            <i class="fas fa-chalkboard-teacher feature-icon"></i>
                            <h3>Skilled Lecturers</h3>
                            <p>
                                At RSRGOI We are Having Highly Qualified And Experienced
                                Lecturers.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-md-4 mb-2">
                        <div class="feature-item">
                            <i class="fas fa-graduation-cap feature-icon"></i>
                            <h3>Scholarship Facility</h3>
                            <p>Student Credit Card Facilities Available at RSRGOI.</p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-md-4">
                        <div class="feature-item">
                            <i class="fas fa-book feature-icon"></i>
                            <h3>Book Library</h3>
                            <p>We are Having well Furnished library.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Start New Web service-area and Features Section -->



        <!--Start New Web About Section -->

        <section class="info-section">
            <div class="container">
                <div class="row">
                    <!-- Welcome Section -->
                    <div class="col-md-6">
                        <div class="info-box">
                            <h3 class="info-title">Welcome at RSRGOI</h3>
                            <ul class="info-list">
                                @foreach ($approves as $approve)
                                    <li>{{ $approve->title }}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <!-- Important Notices Section -->
                    <div class="col-md-6">
                        <div class="info-box">
                            <h3 class="info-title">Important Notices</h3>
                            <ul class="info-list">
                                @foreach ($notices as $notice)
                                    <li>{{ $notice->title }}</li>
                                @endforeach

                            </ul>
                            <a href="#" class="info-btn">View All Notices</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>







        <!--Start Form Section-->

        <section class="welcome-section">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Section: Welcome Text -->
                    <div class="col-lg-6 mb-4">
                        @foreach ($institutes as $inst)
                            <h2 class="welcome-title">{{ $inst->title }}</h2>
                            {{-- {!! str_limit($row->section, 50, ' ...') !!}  --}}
                            <div class="welcom-underline"></div>
                            <p style="text-align: justify;" class="description ">
                                {!! $inst->description !!}
                            </p>
                        @endforeach

                        <a href="{{$inst->button_link}}" class="form-btn">Read More</a>
                    </div>


                    <!-- Right Section: Enquiry Form -->
                    <div class="col-lg-6">
                        <div class="enquiry">
                            <h3 class="text-left mb-4">Enquiry Form</h3>
                            <form action="{{ route('application.enquiry') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Full Name" name="full_name"
                                            required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Email" name="address"
                                            required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <select class="form-select" name="course" required>
                                            <option>Select Your Course</option>
                                            <!-- Add course options here -->
                                            @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Contact Number"
                                            name="contact" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <select class="form-select" name="state" required>
                                            <option value="">Select Your State</option>
                                            @foreach (config('settings.state_list') as $key => $state)
                                                {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Requirement" name="place" rows="4" required></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Submit
                                </button>
        
                            </div>
                        </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--End Form Section-->

        <!--Courses Section-->

        <section class="courses-section">
            <div class="container">
                <h2 class="section-title">Courses Offered at RSRGOI</h2>
                <div class="underline"></div>
                <div class="row">
                    <!-- Course Item -->

                    @foreach ($images as $key => $image)
                        <div class="col-md-4">
                            <div class="course-item">
                                {{-- assets/images/anm.png  --}}
                                <a href="{{$image->button_link}}"><img src="{{ asset('uploads/gallery/' . $image->attach) }}" alt="ANM" /></a>
                                <!--<img src="{{ asset('uploads/gallery/' . $image->attach) }}" alt="ANM" />-->
                                <div class="course-title"><a class="mri"
                                                    href="{{$image->button_link}}">{{ $image->title }}</a></div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Add more courses here -->
                </div>
            </div>
        </section>

        <!--Vison-->
        @isset($about)
            <section class="vision-mission-section py-5">
                <div class="container">
                    <div class="row">
                        <!-- Left Column: Vision and Mission -->
                        <div class="col-lg-6">
                            <!-- Vision -->
                            <div class="mri-card mb-4 p-3 shadow-sm border-0">
                                <div class="card-body">
                                    <h3 class="card-title fw-bold text-uppercase text-white">
                                        {{ $about->vision_title }}
                                    </h3>
                                    <div class="mb-3 mt-3">
                                        <img src="{{ asset('uploads/about-us/' . $about->attach) }}" alt="Vision Image"
                                            class="img-fluid rounded">
                                    </div>
                                    <p style="text-align: justify;" class="card-text text-white ">
                                        {!! strip_tags($about->vision_desc, '<a><b><i><u><strong>') !!}

                                    </p>
                                </div>
                            </div>

                            <!-- Mission -->
                            <div class="mri-card p-3 mb-3 shadow-sm border-0">
                                <div class="card-body">
                                    <h3 class="card-title fw-bold text-uppercase text-white">
                                        {{ $about->mission_title }}
                                    </h3>
                                    {{-- card-text text-white  --}}
                                    <p style="text-align: justify;" class="card-text text-white">
                                        {!! strip_tags($about->mission_desc, '<a><b><i><u><strong>') !!}

                                    </p>
                                    <a href="#" class="form-btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>



                        <!-- Right Column: Features -->
                        <div class="vision-right col-lg-6">
                            <div class="vision-right-inner">
                                <div class="row g-3 ">
                                    <!-- Feature 1 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-center">
                                            <div class="icon me-3">
                                                <i class="fa fa-graduation-cap v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-center">
                                                    20+ years of excellence
                                                </h6>
                                                <p class="mb-0 text-muted text-center">
                                                    in the field of education
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 2 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-qrcode v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">50+ well equipped</h6>
                                                <p class="mb-0 text-muted">labs and workshops</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 3 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-map v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">20+ states students</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 4 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-users v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">10:1 student to faculty</h6>
                                                <p class="mb-0 text-muted">ratio</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 5 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-magnet v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">15+ acres of</h6>
                                                <p class="mb-0 text-muted">lush green campus</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 6 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-reply v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">5 campuses</h6>
                                                <p class="mb-0 text-muted">in Delhi & NCR</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 7 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-user-circle v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">6000+ total</h6>
                                                <p class="mb-0 text-muted">enrolled students</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Feature 8 -->
                                    <div class="col-sm-6 mb-3">
                                        <div class="text-center align-items-start">
                                            <div class="icon me-3">
                                                <i class="fa fa-share-square v-icon"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">20000+ alumni</h6>
                                                <p class="mb-0 text-muted">till 2024</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endisset
        <!--Stats Section-->

        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <!-- Stats Card 1 -->
                    @foreach ($missions as $mission)
                        <div class="col-md-3">
                            <div class="stats-card">
                                <div class="stats-icon">
                                    <img src="{{ asset('uploads/gallery/' . $mission->attach) }}"
                                        alt="Instructors Icon" />
                                </div>
                                <div class="stats-info">
                                    <h2 class="stats-number">{{ $mission->description }}</h2>
                                    <p class="stats-label">{{ $mission->title }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>





            <!--<div class="container">-->
            <!--    <div class="blog-section">-->
            <!--        <div class="blog-header">-->
            <!--            <div>-->
            <!--                <h2 class="blog-title">Our Blogs</h2>-->
            <!--                <div class="underline"></div>-->
            <!--            </div>-->
            <!--            <a href="#" class="blog-view-all">View All</a>-->
            <!--        </div>-->

            <!--         Swiper -->
            <!--        <div class="swiper-container blog-swiper swiper-initialized swiper-horizontal swiper-backface-hidden">-->
            <!--            <div class="swiper-wrapper" id="swiper-wrapper-5c2d35b96b54f3b9" aria-live="polite">-->
            <!--                 Blog Slide 1 -->
            <!--                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3"-->
            <!--                    style="width: 418.667px; margin-right: 20px;">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/library.png" alt="Blog Image" class="blog-image">-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">-->
            <!--                            Summer Course Starts From 1st June-->
            <!--                        </h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text since-->
            <!--                            the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                 Blog Slide 2 -->
            <!--                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 3"-->
            <!--                    style="width: 418.667px; margin-right: 20px;">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/classroom.png" alt="Blog Image" class="blog-image">-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">-->
            <!--                            Guest Interview will Occur Soon...-->
            <!--                        </h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text since-->
            <!--                            the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                 Blog Slide 3 -->
            <!--                <div class="swiper-slide" role="group" aria-label="3 / 3"-->
            <!--                    style="width: 418.667px; margin-right: 20px;">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/students.png" alt="Blog Image" class="blog-image">-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">New Exam Schedules for Diploma</h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text since-->
            <!--                            the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->



            <!--<div class="container">-->
            <!--    <div class="blog-section">-->
            <!--        <div class="blog-header">-->
            <!--            <h2 class="blog-title">News & Events</h2>-->

            <!--            <a href="#" class="blog-view-all">View All</a>-->
            <!--        </div>-->
            <!--        <div class="underline-news"></div>-->

                    <!-- Swiper -->
            <!--        <div class="swiper-container blog-swiper">-->
            <!--            <div class="swiper-wrapper">-->
                            <!-- Blog Slide 1 -->
            <!--                <div class="swiper-slide">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/news1.png" alt="Blog Image" class="blog-image" />-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">-->
            <!--                            Harvard University Tops the Shanghai Ranking Again-->
            <!--                        </h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Dimplly dummy text of the printing and typesetting industry.-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text ever-->
            <!--                            since the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
                            <!-- Blog Slide 2 -->
            <!--                <div class="swiper-slide">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/news2.png" alt="Blog Image" class="blog-image" />-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">-->
            <!--                            Oxford University Applications Fall by 4%-->
            <!--                        </h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Dimplly dummy text of the printing and typesetting industry.-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text ever-->
            <!--                            since the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
                            <!-- Blog Slide 3 -->
            <!--                <div class="swiper-slide">-->
            <!--                    <div class="blog-card">-->
            <!--                        <img src="assets/images/news3.png" alt="Blog Image" class="blog-image" />-->
            <!--                        <p class="blog-date">September 14, 2017</p>-->
            <!--                        <h3 class="blog-card-title">-->
            <!--                            Economics Graduates are Paid the Highest Salaries-->
            <!--                        </h3>-->
            <!--                        <p class="blog-description">-->
            <!--                            Dimplly dummy text of the printing and typesetting industry.-->
            <!--                            Lorem Ipsum has been the industry's standard dummy text ever-->
            <!--                            since the 1500s...-->
            <!--                        </p>-->
            <!--                        <a href="#" class="blog-learn-more">Learn More</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            
        </section>
        <!-- News Section -->

        {{-- <div class="container">
            <div class="blog-section">
                <div class="blog-header">
                    <h2 class="blog-title">Our News</h2>


                </div>
                <div class="underline-news"></div>

                <section class="blog-area p-relative fix ">
                    <div class="container">
                        <div class="row">

                            @foreach ($newses as $news)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-post2 hover-zoomin  wow fadeInUp animated"
                                        data-animation="fadeInUp" data-delay=".4s">
                                        <div class="blog-thumb2 mt-2">
                                            <a
                                                href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}"><img
                                                    src="{{ asset('uploads/news/' . $news->attach) }}"
                                                    alt="News"></a>

                                            <div class="date-home">
                                                <i class="fal fa-calendar-alt"></i>
                                                {{ date('d F, Y', strtotime($news->date)) }}
                                            </div>
                                        </div>
                                        <div class="blog-content2">
                                            <h4><a
                                                    href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}">{{ $news->title }}</a>
                                            </h4>

                                            <p>{!! str_limit(strip_tags($news->description), 120, ' ...') !!}</p>

                                            <div class="blog-btn"><a
                                                    href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}">{{ __('btn_read_more') }}
                                                    <i class="fal fa-long-arrow-right"></i></a></div>
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
                                            {{ $newses->appends(Request::only('search'))->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        </section> --}}

        <!-- News Section -->
        {{-- <section class="stats-section">
        <div class="container">
            <div class="blog-section">
                <div class="blog-header">
                    <h2 class="blog-title">News & Events</h2>

                    <a href="#" class="blog-view-all">View All</a>
                </div>
                <div class="underline-news"></div>

                <!-- Swiper -->
                <div class="swiper-container blog-swiper">
                    <div class="swiper-wrapper">
                        <!-- Blog Slide 1 -->
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <img src="assets/images/news1.png" alt="Blog Image" class="blog-image" />
                                <p class="blog-date">September 14, 2017</p>
                                <h3 class="blog-card-title">
                                    Harvard University Tops the Shanghai Ranking Again
                                </h3>
                                <p class="blog-description">
                                    Dimplly dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s...
                                </p>
                                <a href="#" class="blog-learn-more">Learn More</a>
                            </div>
                        </div>
                        <!-- Blog Slide 2 -->
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <img src="assets/images/news2.png" alt="Blog Image" class="blog-image" />
                                <p class="blog-date">September 14, 2017</p>
                                <h3 class="blog-card-title">
                                    Oxford University Applications Fall by 4%
                                </h3>
                                <p class="blog-description">
                                    Dimplly dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s...
                                </p>
                                <a href="#" class="blog-learn-more">Learn More</a>
                            </div>
                        </div>
                        <!-- Blog Slide 3 -->
                        <div class="swiper-slide">
                            <div class="blog-card">
                                <img src="assets/images/news3.png" alt="Blog Image" class="blog-image" />
                                <p class="blog-date">September 14, 2017</p>
                                <h3 class="blog-card-title">
                                    Economics Graduates are Paid the Highest Salaries
                                </h3>
                                <p class="blog-description">
                                    Dimplly dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever
                                    since the 1500s...
                                </p>
                                <a href="#" class="blog-learn-more">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section> --}}






        <!--Testimonials Section-->
        @isset($testimonials)
            <section class="testimonials-section">
                <div class="container">
                    <div class="">
                        <div class="test-section-header text-left mb-4">
                            <h2>Testimonials</h2>
                            <div class="welcom-underline"></div>
                        </div>

                        <!-- Swiper Container -->
                        <div class="swiper-container testimonials-carousel">
                            <div class="swiper-wrapper">
                                <!-- Testimonial 1 -->
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-card p-3 shadow rounded">
                                            <p class="testimonial-text">
                                                {!! $testimonial->description !!}
                                            </p>
                                            <h4 class="testimonial-author mt-3">{{ $testimonial->name }}</h4>
                                            <p class="testimonial-role text-muted">{{ $testimonial->designation }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endisset


        <!--Reviews-->
        @isset($reviews)
            <section class="ratting-section">
                <div class="container">
                    <div class="reviews-section py-5">
                        <div class="reviews-header text-center mb-4">
                            <h2>Reviews & Rating</h2>
                            <div class="underline"></div>
                        </div>

                        <!-- Swiper Container -->
                        <div
                            class="swiper-container reviews-carousel swiper-initialized swiper-horizontal swiper-backface-hidden">
                            <div class="swiper-wrapper" id="swiper-wrapper-626171776f63cb74" aria-live="polite">
                                <!-- Rating Card 1 -->
                                @foreach ($reviews as $review)
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4"
                                        style="width: 409px; margin-right: 20px;">
                                        <div class="rating-card text-center shadow p-2 rounded">
                                            <img src="{{ asset('uploads/gallery/' . $review->attach) }}" alt="Facebook Logo"
                                                class="rating-logo mb-3" height="auto" width="130px;">
                                            <p class="rating-text">{{ $review->title }}</p>
                                            <div class="rating-stars text-warning fs-5">⭐⭐⭐⭐⭐</div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
            </section>
        @endisset



        <!--Recruiter-->
        @isset($contents)
            <section class="recruit-section">
                <div class="container">
                    <div class="recruiters-section py-5">
                        <div class="section-header text-center mb-4">
                            <h2>Our Top Recruiters</h2>
                            <div class="underline"></div>
                        </div>

                        <!-- Swiper Container -->
                        <div class="swiper-container recruiters-carousel">
                            <div class="swiper-wrapper">
                                @foreach ($contents as $content)
                                    <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5"
                                        style="width: 289px; margin-right: 15px;">
                                        <div class="recruiter-card text-center">
                                            <img src="{{ asset('uploads/gallery/' . $content->attach) }}" alt="Cvent Logo"
                                                class="recruiter-logo">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endisset


        @isset($features)
            <section class="faci-section">
                <div class="container">
                    <div class="facilities-section py-5">
                        <div class="facilities-header text-center mb-5">
                            <h2>Be at RSRGOI Best in Academics & Educational Facilities</h2>
                            <p style="text-align: justify;" class="facilities-description ">
                                The college is situated in the heart of the city. Apart from being
                                the Garden City, Hajipur is now the natural choice and preferred
                                destination for students from different parts of the country to
                                pursue professional education in any other field.
                            </p>
                            <p class="facilities-highlight fw-bold">
                                RSRGOI Mahnar | Top College in Vaishali, Bihar
                            </p>
                        </div>

                        <!-- Facilities Grid -->
                        <div class="row g-4">
                            <!-- Facility 1 -->
                            @foreach ($features as $key => $feature)
                                <div class="col-md-4 col-sm-6">
                                    <div class="facility-card text-center">
                                        <img src="{{ asset('uploads/feature/' . $feature->attach) }}" alt="Classroom"
                                            class="facility-image rounded w-100 mb-3" />
                                        <p class="facility-title fw-bold">{{ $feature->title }} →</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>


            </section>
        @endisset
        
        <div class="fixed-enrollment-btn">
        <button type="button" class="btn btn-primary" id="abc" data-bs-toggle="modal" data-bs-target="#smallModal">
            Enroll Now
        </button>
    </div>
    <div class="modal fade" id="smallModal" tabindex="-1" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallModalLabel">
                        Enquiry Form
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('application.enquiry') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" name="full_name"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Email" name="address"
                                    required />
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
                        <div class="row">
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Requirement" name="place" rows="4" required></textarea>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Submit
                                </button>
        
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




        {{-- '+918292868654'  --}}
        {{-- '{{$topbarSetting->phone}}' --}}
        <!-- Whatsapp button -->
        <div class="whatsapp-container">
            <div class="ping-animation"></div>


            <button class="whatsapp-button" onclick="openWhatsApp(event,'{{ $topbarSetting->phone ?? '91xxxxxxxxxx' }}')">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp Icon" />
                <span class="ripple"></span>
            </button>
        </div>



    </main>
    <!-- main-area-end -->

@endsection
