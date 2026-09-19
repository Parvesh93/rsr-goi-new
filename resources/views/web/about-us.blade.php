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
                                    <div class="slider-content s-slider-content mt-130">
                                        <h2 data-animation="fadeInUp" data-delay=".4s">{{ __('About') }}</h2>
                                        <p data-animation="fadeInUp" data-delay=".6s">{!! strip_tags('Home / About / About Overview', '<b><u><i><br>') !!}</p>

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


        <section class="about-section1">
            <div class="container">
                <div class="row">
                    <!-- Left Sidebar with Tabs -->
                    <div class="col-lg-3 col-md-12">
                        <!-- Mobile Selector -->
                        <select class="about-tabs-mobile d-md-none">
                            <option value="about-institution">About Institution</option>
                            <option value="vision-mission">Vision & Mission</option>
                            <option value="message-director">Director's Message</option>
                            <option value="message-principal">Principal's Message</option>
                            <option value="legacy">Our Legacy</option>
                            <option value="staff-management">Staff Management</option>
                        </select>

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


                            {{-- <li class="about-tab-item {{ request()->slug == 'about_our_vision' ? 'active' : '' }}">
                                <a class="mri" href="{{route('about.single',['slug' => "about_our_vision"])}}" >Our Vision And Mission</a>
                            </li>
                            <li class="about-tab-item {{ request()->slug == 'message_director' ? 'active' : '' }}">
                                <a class="mri" href="{{route('about.single',['slug' => "message_director"])}}" >Message From Director</a>
                            </li>
                            <li class="about-tab-item {{ request()->slug == 'message_principal' ? 'active' : '' }}">
                                <a class="mri" href="{{route('about.single',['slug' => "message_principal"])}}" >Message From Principal</a>
                            </li>
                            <li class="about-tab-item {{ request()->slug == 'our_legacy' ? 'active' : '' }}">
                                <a class="mri" href="{{route('about.single',['slug' => "our_legacy"])}}" >Our Legacy</a>
                            </li>
                            <li class="about-tab-item {{ request()->slug == 'staff_management' ? 'active' : '' }}">
                                <a class="mri" href="{{route('about.single',['slug' => "staff_management"])}}" >Staff Management</a>
                            </li> --}}
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
                                <h4 class="links-heading">Quick Links</h4>
                                <ul class="links-list">
                                    <li>
                                        <a href="#about-institution">About Institution RSGOI</a>
                                    </li>
                                    <li><a href="#our-vision">Our Vision And Mission</a></li>
                                    <li><a href="#director-message">Message From Director</a></li>
                                    <li>
                                        <a href="#principal-message">Message From Principal</a>
                                    </li>
                                    <li><a href="#our-legacy">Our Legacy</a></li>
                                    <li><a href="#staff-management">Staff Management</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Area -->
                    <div class="col-lg-9 col-md-12">
                        <div class="about-content">
                            <!-- Dynamic Content Section -->
                            <div class="about-tab-content active" id="about-institution">
                                <h1 class="about-heading">Welcome to Our Institutions</h1>
                                <p class="about-paragraph">
                                    <b> Our Institution RAM SHARAN GROUP OF INSTITUTIONS </b> is
                                    the latest symbol of the vision of our Founder Director
                                    Hon'ble Shri SANJAY KUMAR RAI. It has made good progress in a
                                    short span and has shown a very high level of academic
                                    accomplishment. RSGOI has benchmarked itself with the latest
                                    content and teaching methodologies.
                                </p>
                                <p class="about-paragraph">
                                    Welcome to RSGOI, which is the leading institution dedicated
                                    to excellence in nursing education in Bihar and in India.
                                    Established with a commitment to nurturing competent and
                                    compassionate healthcare professionals, including Under
                                    Graduate, Graduate, and Post Graduate Courses, we offer a
                                    range of programs tailored to meet the diverse needs of
                                    aspiring students and candidates seeking higher education.
                                </p>
                                <p class="about-paragraph">
                                    Good education encompasses instilling Moral, Aesthetic,
                                    Athletic, and Intellectual values in the citizens of tomorrow.
                                    We at RSGOI are the best place to achieve this kind of
                                    education. We are Affiliated to BNRC/BUHS, Approved by the
                                    Health Department Govt. of Bihar & Bihar University of Health
                                    Science Patna, and Babasaheb Bhimrao Ambedkar Bihar
                                    University, Muzaffarpur.
                                </p>
                                <p class="about-paragraph">
                                    Our college has lush green surroundings which provide a
                                    conducive environment for the students to grow not only as
                                    good professionals/managers but as world-class citizens too.
                                </p>
                                <p class="about-paragraph">
                                    Our institution takes pride in offering Bachelor of Science
                                    (BSC), BA, B.com Auxiliary Nurse Midwife (ANM), and General
                                    Nursing and Midwifery (GNM) programs, including B.Pharma,
                                    D.Pharma, B.ed, BBA, BCA, IA, ISC & ICOM, ITI, and many more.
                                    These programs are designed to equip students with the
                                    knowledge, skills, and practical experience necessary to excel
                                    in the dynamic field.
                                </p>
                                <p class="about-paragraph">
                                    At RSGOI, we believe in providing a holistic education that
                                    combines rigorous academic coursework with hands-on academic
                                    training. Our state-of-the-art facilities and experienced
                                    faculty members ensure that students receive comprehensive
                                    instruction in areas such as anatomy, physiology,
                                    pharmacology, and patient care techniques.
                                </p>
                                <p class="about-paragraph">
                                    What sets us apart is our unwavering commitment to fostering a
                                    supportive learning environment where students are encouraged
                                    to grow both personally and professionally. Through
                                    interactive classroom sessions, simulation labs, and clinical
                                    rotations, our students gain invaluable real-world experience
                                    that prepares them for the challenges of modern healthcare
                                    practice.
                                </p>


                            </div>

                            <!-- Vision Mission Content Tabs -->

                            {{-- <div class="about-tab-content" id="vision-mission">
    <h1 class="about-heading">Our Vision and Mission</h1>

    <h2 class="about-subheading">Our Vision</h2>
    <p class="about-paragraph">
        At RSGOI, our vision is to be globally recognized as a beacon of excellence in education, 
        research, and knowledge innovation. We strive to empower our students to become compassionate caregivers, 
        innovative leaders, and agents of positive change in various industries.
    </p>
    
    <p class="about-paragraph">
        • <strong>Excellence in Education:</strong> We provide a dynamic learning environment that fosters academic 
        excellence, critical thinking, and lifelong learning. Through innovative teaching methods, cutting-edge technology, 
        and hands-on experience, we prepare students to confidently meet evolving industry challenges.
        <br />
        • <strong>Leadership in Research and Innovation:</strong> We aspire to lead in research and innovation, pushing the 
        boundaries of knowledge in healthcare, business, and various industries. Our goal is to inspire groundbreaking discoveries 
        and transformative solutions that enhance outcomes across different sectors.
        <br />
        • <strong>Cultural Competence and Diversity:</strong> We value diversity and inclusivity as fundamental principles, 
        fostering a culture of respect, empathy, and cultural competence where students feel valued and empowered.
        <br />
        • <strong>Community Engagement and Service:</strong> We are committed to making a meaningful impact on individuals and 
        communities both locally and globally.
        <br />
        • <strong>Ethical Practice and Professionalism:</strong> Integrity, ethics, and professionalism form the foundation of 
        our values. Our vision is to instill a strong ethical mindset in students, preparing them to uphold the highest standards 
        in healthcare, business, and other fields.
    </p>

    <p class="about-paragraph">
        Our vision guides us in our pursuit of excellence, innovation, and service to humanity. Together, we aim to shape the 
        future of students in industries, top-notch companies, and healthcare for the betterment of society.
    </p>

    <h2 class="about-subheading">Our Mission</h2>
    <p class="about-paragraph">
        At RAM BILASH SINGH RAM DAYAL RAY COLLEGE, our mission is to educate, inspire, and empower the next generation 
        of professionals through excellence in education, research, and service.
    </p>

    <p class="about-paragraph">
        • <strong>Educational Excellence:</strong> We provide high-quality, evidence-based education that prepares students 
        for successful careers in nursing, healthcare, and other fields. Our innovative curricula, experiential learning, and 
        faculty mentorship cultivate critical thinking, competence, and compassionate care.
        <br />
        • <strong>Research and Scholarship:</strong> We promote rigorous research and scholarship to advance knowledge, practice, 
        and policy. Through a culture of inquiry and innovation, faculty and students engage in research that contributes to 
        scientific advancements and improves patient outcomes.
        <br />
        • <strong>Community Engagement and Service:</strong> We prioritize outreach initiatives, volunteerism, and advocacy to 
        address community needs and promote health equity.
        <br />
        • <strong>Professional Development:</strong> We support students and alumni through continuing education, professional 
        development, and career growth opportunities in fields such as accountancy, science and technology, and healthcare.
        <br />
        • <strong>Ethical Practice and Social Responsibility:</strong> Integrity, ethics, and social responsibility guide our 
        actions. We emphasize cultural competence and advocate for policies that uphold dignity, rights, and ethical practices.
    </p>

    <p class="about-paragraph">
        Additionally, our mission is to offer management education that enhances knowledge and skills across functional areas 
        through a benchmarked curriculum using innovative teaching-learning methods.
    </p>

    <p class="about-paragraph">
        • To prepare and produce competent, passionate, and market-centric professionals who can manage human resources, 
        business operations, and ensure world-class practices with endurance and commitment.
        <br />
        • To conduct interdisciplinary research in management, fostering professional and entrepreneurial growth.
        <br />
        • To establish industry linkages that enhance professional and entrepreneurial enrichment.
    </p>

    <p class="about-paragraph">
        Our mission drives us to strive for excellence in everything we do, making a positive impact on the lives of individuals 
        and communities worldwide.
    </p>
</div> --}}


                            <!-- Message From Director Content Tabs -->

                            {{-- <div class="about-tab-content" id="message-director">
                                <h1 class="about-heading">Message from the Director</h1>
                                <p class="about-paragraph">Dear Students and Parents,</p>
                                <p class="about-paragraph">
                                    It gives me immense pleasure to welcome you to RAM SHARAN ROY
                                    GROUP OF INSTITUTIONS. As the Director, I am proud to lead an
                                    institution that has consistently demonstrated its commitment
                                    to excellence in education and healthcare training.
                                </p>
                                <p class="about-paragraph">
                                    Our institution stands on the pillars of quality education,
                                    ethical values, and innovative teaching methodologies. We
                                    believe in nurturing not just professionals, but compassionate
                                    individuals who will make a positive impact on society.
                                </p>
                                <p class="about-paragraph">
                                    - Dr. Sanjay Kumar Rai
                                    <br />
                                    Director, RSGOI
                                </p>
                            </div> --}}

                            <!-- Message From Principal Content Tabs -->

                            {{-- <div class="about-tab-content" id="message-principal">
                                <h1 class="about-heading">Message from the Principal</h1>
                                <p class="about-paragraph">
                                    Welcome to our esteemed institution,
                                </p>
                                <p class="about-paragraph">
                                    As the Principal of RSGOI, I am delighted to lead an academic
                                    community that is dedicated to fostering excellence in
                                    education and personal development. Our institution provides a
                                    vibrant learning environment where students can grow both
                                    academically and personally.
                                </p>
                                <p class="about-paragraph">
                                    We focus on holistic development through a balanced
                                    combination of curricular and co-curricular activities. Our
                                    experienced faculty members are committed to providing quality
                                    education and mentorship to help students achieve their full
                                    potential.
                                </p>
                                <p class="about-paragraph">
                                    - Dr. Rajesh Kumar
                                    <br />
                                    Principal, RSGOI
                                </p>
                            </div> --}}

                            <!-- Our Legacy Content Tabs -->

                            {{-- <div class="about-tab-content" id="legacy">
                                <h1 class="about-heading">Legacy</h1>
                                <p class="about-paragraph">
                                    Since our establishment, RSGOI has been at the forefront of
                                    educational excellence in Bihar. Our journey began with a
                                    vision to transform healthcare education and has evolved into
                                    a comprehensive educational institution.
                                </p>
                                <p class="about-paragraph">
                                    Over the years, we have:
                                    <br />
                                    • Graduated thousands of successful professionals
                                    <br />
                                    • Established state-of-the-art facilities
                                    <br />
                                    • Built strong industry partnerships
                                    <br />
                                    • Achieved numerous academic accolades
                                </p>
                            </div> --}}

                            <!-- Staff Management Content Tabs -->

                            {{-- <div class="about-tab-content" id="staff-management">
                                <h1 class="about-heading">Staff Management</h1>
                                <p class="about-paragraph">
                                    Our institution is proud to have a team of highly qualified
                                    and dedicated professionals who bring extensive experience and
                                    expertise to their roles.
                                </p>
                                <p class="about-paragraph">
                                    Administrative Staff:
                                    <br />
                                    • Director: Dr. Sanjay Kumar Rai
                                    <br />
                                    • Principal: Dr. Rajesh Kumar
                                    <br />
                                    • Academic Dean: Dr. Priya Singh
                                    <br />
                                    • Administrative Officer: Mr. Amit Kumar
                                </p>
                                <p class="about-paragraph">
                                    Our faculty members hold advanced degrees from prestigious
                                    institutions and bring real-world experience to the classroom,
                                    ensuring that our students receive the highest quality
                                    education.
                                </p>
                            </div> --}}
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
                        <div class="quick-links mt-4">
                            <h4 class="links-heading">Quick Links</h4>
                            <ul class="links-list">
                                <li>
                                    <a href="#about-institution">About Institution RSGOI</a>
                                </li>
                                <li><a href="#our-vision">Our Vision And Mission</a></li>
                                <li><a href="#director-message">Message From Director</a></li>
                                <li><a href="#principal-message">Message From Principal</a></li>
                                <li><a href="#our-legacy">Our Legacy</a></li>
                                <li><a href="#staff-management">Staff Management</a></li>
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

   


@endsection
