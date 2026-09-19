@extends('web.layouts.master')
@section('title', __('navbar_gallery'))
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
                                    <div class="slider-content s-slider-content mt-120">
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('Gallery') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / Gallery / Gallery Overview', '<b><u><i><br>') !!}</p>

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
        <!-- breadcrumb-area-end -->

        <!-- Gallery Tabs Section -->
        <section class="gallery-content-section">
            <!-- Mobile Selector (stays the same) -->
            <select class="gallery-tabs-mobile d-md-none">
                <option value="all">ALL</option>
                <option value="college-function">COLLEGE FUNCTION</option>
                <option value="inspection">INSPECTION</option>
                <option value="nursing">NURSING</option>
                <option value="iti">ITI</option>
                <option value="library">LIBARARY</option>
                <option value="computer-lab">COMPUTER LAB</option>
                <option value="class-room">CLASS ROOM</option>
                <option value="campus">CAMPUS</option>
                <option value="placement">PLACEMENT</option>
            </select>

            <!-- Desktop Tabs (new layout) -->
            <ul class="gallery-tabs d-none d-md-flex">
                <li class="gallery-tab-item active">
                    <a href="#all" class="gallery-tab-link">ALL</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#college-function" class="gallery-tab-link">COLLEGE FUNCTION</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#inspection" class="gallery-tab-link">INSPECTION</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#nursing" class="gallery-tab-link">NURSING</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#iti" class="gallery-tab-link">ITI</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#library" class="gallery-tab-link">LIBARARY</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#computer-lab" class="gallery-tab-link">COMPUTER LAB</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#class-room" class="gallery-tab-link">CLASS ROOM</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#campus" class="gallery-tab-link">CAMPUS</a>
                </li>
                <li class="gallery-tab-item">
                    <a href="#placement" class="gallery-tab-link">PLACEMENT</a>
                </li>
            </ul>
        </section>

        <!-- gallery-area -->
        {{-- class="pt-150 pb-105" --}}





        <section class="gallery-section" id="work"class="pt-10 pb-10">
            <div class="container">
                <div class="portfolio">
                    <div class="grid col3 wow fadeInUp  animated" data-animation="fadeInUp" data-delay=".4s">



                        @isset($galleries)
                            @foreach ($galleries as $gallery)
                                <div class="grid-item">
                                    <a class="popup-image" href="{{ asset('uploads/gallery/' . $gallery->attach) }}">
                                        <figure class="gallery-image">
                                            <img src="{{ asset('uploads/gallery/' . $gallery->attach) }}"
                                                alt="{{ $gallery->title ?? '' }}" class="img">
                                        </figure>
                                    </a>
                                </div>
                            @endforeach

                        @endisset


                    </div>
                </div>
            </div>
        </section>
        <!-- gallery-area-end -->

    </main>
    <!-- main-area-end -->

@endsection
