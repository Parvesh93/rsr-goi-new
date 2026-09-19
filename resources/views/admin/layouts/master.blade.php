<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('admin.layouts.common.header_script')

</head>

<body>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <nav
        class="pcoded-navbar active-lightblue title-lightblue navbar-lightblue brand-lightblue navbar-image-4 menu-item-icon-style2 {{ \Cookie::get('sidebar') }}">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                @if (isset($setting))
                    @if (is_file('uploads/setting-second/' . $setting->logo_path))
                        <a href="{{ route('admin.dashboard.index') }}" class="b-brand">
                            <img src="{{ asset('uploads/setting-second/' . $setting->logo_path) }}" alt="logo">
                        </a>
                    @endif
                @endif
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>


            @if (Request::is('admin*'))
                <!--- Sidemenu -->
                @include('admin.layouts.inc.sidebar')
                <!-- End Sidebar -->
            @endif

        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    @php
        $teacherDepa = auth()->user()->teacher_department;
        $collegeDepartment = auth()->user()->college_department_id;

        $user = auth()->user();
        $programs = App\Models\Program::where('department_id', $collegeDepartment)
            ->where('status', '1')
            ->orderBy('title', 'asc')
            ->get();
        $batches = App\Models\Batch::where('department_id', $collegeDepartment)
            ->where('status', '1')
            ->orderBy('title', 'asc')
            ->get();
    @endphp


    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            @if (isset($setting))
                @if (is_file('uploads/setting-second/' . $setting->logo_path))
                    <a href="{{ route('admin.dashboard.index') }}" class="b-brand">
                        <div class="b-bg">
                            <img src="{{ asset('uploads/setting-second/' . $setting->logo_path) }}" alt="logo"
                                height="20">
                        </div>
                    </a>
                @endif
            @endif
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            @if (auth()->user()->is_admin === 1)
                <ul class="navbar-nav me-auto">
                    <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                                class="feather icon-maximize"></i></a></li>
                    <li>
                        <h4 class="topbar-title">{{ $setting->title }}</h4>
                    </li>
                </ul>
            @elseif(auth()->user()->is_admin === 0)
                <ul class="navbar-nav me-auto">
                    <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                                class="feather icon-maximize"></i></a></li>
                    <li>
                        <h4 class="topbar-title">Department : {{ $user->collegeDepartment->title }} </h4>
                    </li>
                    {{-- <ul>
                    <h4 class="topbar-title">Colleges</h4>
                    @foreach ($batches as $batch)
                       <h4 class="topbar-title">{{ $batch->title }}</h4> 
                    @endforeach
                </ul> --}}
                    {{-- <ul>
                    <h4 class="topbar-title">Colleges To Have Program</h4>
                    @foreach ($programs as $program)
                       <h4 class="topbar-title">{{ $program->title }}</h4> 
                    @endforeach
                </ul> --}}

                </ul>
            @endif


            <!-- [ Auth Nav ] start -->
            @auth
                <ul class="navbar-nav ms-auto">
                    {{-- @can('student-attendance-create')
                <li><span class="top-icon"><a href="{{ route('admin.student-attendance.index') }}"><i class="fas fa-user-check"></i></a></span></li>
                @endcan

                @can('fees-student-due')
                <li><span class="top-icon"><a href="{{ route('admin.fees-student.index') }}"><i class="fas fa-money-bill-wave"></i></a></span></li>
                @endcan

                @canany(['book-issue-create', 'book-issue-view'])
                <li><span class="top-icon"><a href="{{ route('admin.issue-return.index') }}"><i class="fas fa-book-open"></i></a></span></li>
                @endcanany

                @canany(['visitor-create', 'visitor-view'])
                <li><span class="top-icon"><a href="{{ route('admin.visitor.create') }}"><i class="fas fa-calendar-check"></i></a></span></li>
                @endcanany

                @canany(['phone-log-create', 'phone-log-view'])
                <li><span class="top-icon"><a href="{{ route('admin.phone-log.index') }}"><i class="fas fa-phone"></i></a></span></li>
                @endcanany

                @can('setting-view')
                <li><span class="top-icon"><a href="{{ route('admin.setting.index') }}"><i class="fas fa-cog"></i></a></span></li>
                @endcan --}}

                    <!-- Language -->
                    @if (auth()->user()->is_admin === 0)
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">

                                    <i class="fas fa-users"></i> {{ 'Colleges' }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notification">
                                    <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">{{ 'Colleges' }}</h6>
                                    </div>

                                    <ul class="noti-body">
                                        @foreach ($batches as $batch)
                                            <li class="notification ">
                                                <a class="language" href="#">{{ $batch->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">

                                    <i class="fas fa-graduation-cap"></i> {{ 'College To Have Programs' }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notification">
                                    <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">{{ 'College To Have Programs' }}</h6>
                                    </div>

                                    <ul class="noti-body">
                                        @foreach ($programs as $program)
                                            <li class="notification ">
                                                <a class="language" href="#">{{ $program->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif


                    <li>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                @php
                                    $version = App\Models\Language::version();
                                @endphp
                                <i class="fas fa-language"></i> {{ $version->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right notification">
                                <div class="noti-head">
                                    <h6 class="d-inline-block m-b-0">{{ trans_choice('module_language', 2) }}</h6>
                                </div>

                                <ul class="noti-body">
                                    @foreach ($user_languages as $user_language)
                                        <li class="notification @if (\Session()->get('locale') == $user_language->code) active @endif">
                                            <a class="language"
                                                href="{{ route('version', $user_language->code) }}">{{ $user_language->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Notification -->
                    <li>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="icon feather icon-bell">
                                    @if (!empty(Auth::guard('web')->user()->unreadNotifications))
                                        @if (Auth::guard('web')->user()->unreadNotifications->count() > 0)
                                            <span class="notification-active"></span>
                                        @endif
                                    @endif
                                </i>
                            </a>
                            @if (!empty(Auth::guard('web')->user()->unreadNotifications))
                                <div class="dropdown-menu dropdown-menu-right notification">
                                    <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">{{ trans_choice('module_notification', 2) }}</h6>
                                    </div>
                                    <ul class="noti-body">
                                        @forelse(Auth::guard('web')->user()->unreadNotifications as $key => $notification)
                                            @if ($key < 10)
                                                @php
                                                    $notification_link = 'admin.dashboard.index';
                                                    $notification_type = '';
                                                    if ($notification->data['type'] == 'content') {
                                                        $notification_link = 'admin.content.index';
                                                        $notification_type = trans_choice('module_content', 1);
                                                    } elseif ($notification->data['type'] == 'notice') {
                                                        $notification_link = 'admin.notice.index';
                                                        $notification_type = trans_choice('module_notice', 1);
                                                    }
                                                @endphp
                                                <li class="notification">
                                                    <a class="media" href="{{ route($notification_link) }}">
                                                        <div class="media-body">
                                                            <p><strong>{{ $notification->data['title'] }}</strong><span
                                                                    class="n-time text-muted"><i
                                                                        class="icon feather icon-clock m-r-10"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                                            </p>
                                                            <p><i class="fas fa-arrow-circle-right"></i>
                                                                {{ $notification_type }}</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endif
                                        @empty
                                            <li class="notification">{{ __('status_no_notification') }}</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </li>

                    <!-- Profile -->
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="far fa-user"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img src="{{ asset('uploads/user/' . Auth::user()->photo) }}" class="img-radius"
                                        alt="User Profile"
                                        @if (Auth::user()->gender == 1) onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';" @else  onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';" @endif>
                                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>

                                    <a href="javascript:void(0);" class="dud-logout" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">

                                        <i class="feather icon-log-out"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>

                                </div>
                                <ul class="pro-body">
                                    @can('profile-view')
                                        <li><a href="{{ route('admin.profile.index') }}" class="dropdown-item"><i
                                                    class="feather icon-user"></i> {{ trans_choice('module_profile', 2) }}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            @endauth
            <!-- [ Auth Nav ] end -->

        </div>
    </header>
    <!-- [ Header ] end -->


    <!-- [ chat user list ] start -->
    <section class="header-user-list">
        <div class="h-list-header">
            <div class="input-group">

                <input type="text" id="search-friends" class="form-control" placeholder="Search Friend . . .">

            </div>
        </div>
        <div class="h-list-body">
            <a href="#!" class="h-close-text"><i class="feather icon-chevrons-right"></i></a>
            <div class="main-friend-cont scroll-div">
                <div class="main-friend-list">

                </div>
            </div>
        </div>
    </section>
    <!-- [ chat user list ] end -->

    <!-- [ chat message ] start -->
    <section class="header-chat">
        <div class="h-list-header">
            <h6></h6>
            <a href="#!" class="h-back-user-list"><i class="feather icon-chevron-left"></i></a>
        </div>
        <div class="h-list-body">
            <div class="main-chat-cont scroll-div">


                <div class="main-friend-chat">
                    <div class="media chat-messages">

                        <div class="media-body chat-menu-content">

                        </div>
                    </div>
                    <div class="media chat-messages">
                        <div class="media-body chat-menu-reply">

                        </div>
                    </div>
                    <div class="media chat-messages">

                        <div class="media-body chat-menu-content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ chat message ] end -->


    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">

                    <!-- start page title -->
                    <!-- Include page breadcrumb -->
                    @include('admin.layouts.inc.breadcrumb')
                    <!-- end page title -->


                    <!-- Start Content-->
                    @yield('content')
                    <!-- End Content-->

                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->


    @include('admin.layouts.common.footer_script')

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
        
        $(document).on("change", ".all_select", function () {
    var table = $(this).closest("table");
    var checked = $(this).is(":checked");

    table.find("tbody input[type='checkbox']").prop("checked", checked);
});

$(document).on("change", "table tbody input[type='checkbox']", function () {
    var table = $(this).closest("table");
    var master = table.find(".all_select");

    if (!master.length) {
        return;
    }

    var checkboxes = table.find("tbody input[type='checkbox']");
    var checked = checkboxes.filter(":checked").length;

    master.prop("checked", checkboxes.length > 0 && checked === checkboxes.length);
});
        
    </script>

</body>

</html>
