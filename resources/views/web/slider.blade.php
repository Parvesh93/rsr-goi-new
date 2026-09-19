<!-- Start New slider-area -->
<section id="home" class="slider-area fix p-relative">

    <div class="slider-active" style="background: #141b22;">

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

    </div>
</section>

<!-- End New slider-area -->
