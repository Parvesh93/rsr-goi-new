@extends('web.layouts.master')
@section('title', __('campus-facilities'))

@section('content')

    <main>
        <!-- breadcrumb-area -->

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
                                    <div class="slider-content s-slider-content mt-130">
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('campus_us') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Campus / Campus Overview', '<b><u><i><br>') !!}</p>

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




        <!-- Campus Facilities Tabs Section -->
        <section class="campus-section">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="campus-tabs-mobile d-md-none">
                            <option value="campus-overview">Campus Overview</option>
                            <option value="infrastructure">Infrastructure</option>
                            <option value="hostel">Hostel Facilities</option>
                            <option value="transport">Transportation</option>
                            <option value="cafeteria">Cafeteria</option>
                        </select>

                        <!-- Desktop Tabs -->
                        <ul class="campus-tabs d-none d-md-flex">
                           @isset($campuses)
                           @foreach ($campuses as $campus)
                           <li class="campus-tab-item {{ request()->slug == $campus->slug ? 'active' : '' }}">
                               <a class="mri" href="{{ route('campus.single', ['slug' => $campus->slug]) }}">{{$campus->title}}</a>
                           </li>
                               
                           @endforeach
                          
                               
                           @endisset
                           
                           
                        </ul>

                        <!-- Desktop Only: Enquiry Form and Quick Links -->
                        <div class="d-none d-lg-block">
                            <!-- Enquiry Form -->
                            <div class="campus-enquiry mt-3">
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
                                               @foreach($programs as $program)
                                                    <option value="{{$program->title}}">{{$program->title}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select about-form-input" name="state" required>

                                                <option selected>Select Your State</option>
                                                @foreach (config('settings.state_list') as $key => $state)
                                                    <option value="{{ $state }}">{{ $state }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control about-form-input" placeholder="Requirement" name="place" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary campus-submit-btn">
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
                        <div class="campus-content">
                            <!-- Campus Overview Tab -->
                            <div class="campus-tab-content active" id="campus-overview">
                                <h1 class="campus-heading">Our Campus</h1>
                                <p class="campus-paragraph">
                                    Spread across acres of lush greenery, our campus provides a
                                    perfect blend of modern infrastructure and natural beauty. The
                                    campus is designed to create an ideal learning environment.
                                    Spread across acres of lush greenery, our campus provides a
                                    perfect blend of modern infrastructure and natural beauty. The
                                    campus is designed to create an ideal learning environment.

                                </p>

                            </div>

                            <!-- Infrastructure Tab -->
                            {{-- <div class="campus-tab-content" id="infrastructure">
                                <h1 class="campus-heading">Infrastructure</h1>
                                <div class="facility-item">
                                    <h3>Academic Blocks</h3>
                                    <ul>
                                        <li>Modern Classrooms with Smart Boards</li>
                                        <li>Well-equipped Laboratories</li>
                                        <li>Digital Library</li>
                                        <li>Conference Halls</li>
                                    </ul>
                                </div>
                                <div class="facility-item">
                                    <h3>Sports Facilities</h3>
                                    <ul>
                                        <li>Indoor Sports Complex</li>
                                        <li>Outdoor Sports Ground</li>
                                        <li>Gymnasium</li>
                                    </ul>
                                </div>
                            </div> --}}

                            <!-- Hostel Tab -->
                            {{-- <div class="campus-tab-content" id="hostel">
                                <h1 class="campus-heading">Hostel Facilities</h1>
                                <div class="facility-item">
                                    <h3>Accommodation</h3>
                                    <ul>
                                        <li>Separate Boys & Girls Hostels</li>
                                        <li>24/7 Security</li>
                                        <li>Wi-Fi Enabled</li>
                                        <li>Medical Facility</li>
                                    </ul>
                                </div>
                            </div> --}}

                            <!-- Transport Tab -->
                            {{-- <div class="campus-tab-content" id="transport">
                                <h1 class="campus-heading">Transportation</h1>
                                <div class="facility-item">
                                    <h3>Bus Services</h3>
                                    <p>
                                        We provide transportation facilities covering major routes:
                                    </p>
                                    <ul>
                                        <li>20+ Bus Routes</li>
                                        <li>GPS Enabled Buses</li>
                                        <li>Experienced Drivers</li>
                                    </ul>
                                </div>
                            </div> --}}

                            <!-- Cafeteria Tab -->
                            {{-- <div class="campus-tab-content" id="cafeteria">
                                <h1 class="campus-heading">Cafeteria</h1>
                                <div class="facility-item">
                                    <h3>Food Court</h3>
                                    <ul>
                                        <li>Hygienic Food Preparation</li>
                                        <li>Multiple Food Options</li>
                                        <li>Spacious Seating Area</li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Mobile Only: Enquiry Form and Quick Links -->
                    <div class="col-12 d-block d-lg-none">
                        <div class="campus-enquiry mt-4">
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
                                                <option value="{{ $state }}">{{ $state }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control about-form-input" placeholder="Requirement" name="place" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary campus-submit-btn">
                                        Submit
                                    </button>
                                </form>
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
