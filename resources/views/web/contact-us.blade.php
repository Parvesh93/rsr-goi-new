@extends('web.layouts.master')
@section('title', __('contact-us'))
@section('content')




    <main>
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
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('contact-us') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Contact / Contact Overview', '<b><u><i><br>') !!}</p>

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


        <section class="contact-section">
            <div class="container contact-page-container">
                <div class="row justify-content-between">
                    <!-- Address Section -->
                    <div class="col-md-5 contact-page-address">
                        <h3>Contact Us</h3>
                        <div class="underline"></div>

                        <!-- Address Block -->
                        <div class="contact-info-block">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <p><strong>ADDRESS :</strong></p>
                                <p>
                                    {!! $topBarSetting->address !!}
                                </p>
                            </div>
                        </div>

                        <!-- Phone Block -->
                        <div class="contact-info-block">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-details">
                                <p><strong>PHONE :</strong></p>
                                <p>{{ $topBarSetting->phone }}</p>

                            </div>
                        </div>

                        <!-- Email Block -->
                        <div class="contact-info-block">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <p><strong>EMAIL :</strong></p>
                                <p>{{ $topBarSetting->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Enquiry Form -->
                    <div class="col-md-6 contact-page-form">
                        <h4 class="hco">Enquiry Form</h4>
                        <form action="{{ route('application.enquiry') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Full Name" name="full_name"
                                        required />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Email" name="address"
                                        required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <select class="form-select" name="course" required>
                                        <option selected disabled>Select Your Course</option>
                                       @foreach($programs as $program)
                                        <option value="{{$program->title}}">{{$program->title}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Contact Us" name="contact"
                                        required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select class="form-select" name="state" required>
                                        <option>Select Your State</option>
                                        @foreach (config('settings.state_list') as $key => $state)
                                            {{-- <option {{@$generalSetting->time_zone==$key?'selected':''}} value="{{$key}}">{{$key}}</option>   --}}
                                            <option value="{{ $state }}">{{ $state }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" name="place" placeholder="Requirement" required></textarea>
                            </div>
                            <button type="submit" class="btn w-100">View All Notes</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row map-section">
                <div class="col-12">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9936.069705672138!2d-0.12462648526937766!3d51.500729992479075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604c662a47d07%3A0xb6ae34b2e7bf3252!2sLondon%20Eye!5e0!3m2!1sen!2suk!4v1614598044970!5m2!1sen!2suk"
                            width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>



    </main>



    </script>
@endsection
