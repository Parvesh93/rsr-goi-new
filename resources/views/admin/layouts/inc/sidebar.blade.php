<!-- Sidemenu -->
<div class="navbar-content scroll-div ps ps--active-y">
    <ul class="nav pcoded-inner-navbar">

        <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
                <span class="pcoded-micon"><i class="fas fa-home"></i></span>
                <span class="pcoded-mtext">{{ trans_choice('module_dashboard', 1) }}</span>
            </a>
        </li>

        @canany(['application-create', 'application-view', 'old-student-create', 'old-student-view', 'student-create',
            'student-view', 'student-import', 'student-password-print', 'student-password-change', 'student-card',
            'student-transfer-in-create', 'student-transfer-in-view', 'student-transfer-out-create',
            'student-transfer-out-view', 'status-type-create', 'status-type-view', 'id-card-setting-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/admission*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_admission', 2) }}</span>
                </a>

                <ul class="pcoded-submenu">
                    @canany(['application-create', 'application-view'])
                        <li class="{{ Request::is('admin/admission/application*') ? 'active' : '' }}"><a
                                href="{{ route('admin.application.index') }}"
                                class="">{{ trans_choice('module_application', 2) }}</a></li>
                    @endcanany



                    @canany(['student-create'])
                        <li class="{{ Request::is('admin/admission/student/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.student.create') }}"
                                class="">{{ trans_choice('module_registration', 1) }}</a></li>
                    @endcanany



                    @canany(['student-view', 'student-password-print', 'student-password-change', 'student-card',
                        'student-import'])
                        <li class="{{ Request::is('admin/admission/student') ? 'active' : '' }}"><a
                                href="{{ route('admin.student.index') }}"
                                class="">{{ trans_choice('module_student', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['student-transfer-in-create', 'student-transfer-in-view', 'student-transfer-out-create',
                        'student-transfer-out-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/admission/student-transfer*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_student_transfer', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @canany(['student-transfer-in-create', 'student-transfer-in-view'])
                                    <li class="{{ Request::is('admin/admission/student-transfer-in*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.student-transfer-in.index') }}"
                                            class="">{{ trans_choice('module_transfer_in', 1) }}</a></li>
                                @endcanany

                                @canany(['student-transfer-out-create', 'student-transfer-out-view'])
                                    <li class="{{ Request::is('admin/admission/student-transfer-out*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.student-transfer-out.index') }}"
                                            class="">{{ trans_choice('module_transfer_out', 1) }}</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany

                    @canany(['status-type-create', 'status-type-view'])
                        <li class="{{ Request::is('admin/admission/status-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.status-type.index') }}"
                                class="">{{ trans_choice('module_status_type', 2) }}</a></li>
                    @endcanany


                    @canany(['student-card'])
                        <li class="{{ Request::is('admin/admission/id-card') ? 'active' : '' }}"><a
                                href="{{ route('admin.id-card.index') }}"
                                class="">{{ trans_choice('module_id_card', 2) }}</a></li>
                    @endcanany




                    @canany(['student-card'])
                        <li class="{{ Request::is('admin/admission/certificate') ? 'active' : '' }}"><a
                                href="{{ route('admin.student.certificate') }}" class="">{{ 'CLC' }}</a></li>
                    @endcanany

                    @canany(['id-card-setting-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/admission/id-card-setting*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('id-card-setting-view')
                                    <li class="{{ Request::is('admin/admission/id-card-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.id-card-setting.index') }}"
                                            class="">{{ trans_choice('module_id_card_setting', 1) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany




        @if (auth()->user()->is_admin === 1)
            @canany(['old-student-create', 'old-student-view', 'provisional-create', 'provisional-view',
                'degree-clc-create', 'degree-clc-view', 'education-clc-create', 'education-clc-view',
                'education-clc-create', 'engineering-clc-view', 'engineering-clc-create', 'inter-clc-create',
                'inter-clc-view', 'nursing-clc-create', 'nursing-clc-view', 'degree-provisional-create',
                'degree-provisional-view', 'nursing-provisional-create', 'nursing-provisional-view',
                'engineering-provisional-create', 'engineering-provisional-view', 'inter-provisional-create',
                'inter-provisional-view', 'education-provisional-create', 'education-provisional-view'])
                <li
                    class="nav-item pcoded-hasmenu {{ Request::is('admin/old-student*') ||
                    Request::is('admin/provisional*') ||
                    Request::is('admin/degree-clc*') ||
                    Request::is('admin/education-clc*') ||
                    Request::is('admin/engineering-clc*') ||
                    Request::is('admin/inter-clc*') ||
                    Request::is('admin/nursing-clc*') ||
                    Request::is('admin/degree-provisional*') ||
                    Request::is('admin/nursing-provisional*') ||
                    Request::is('admin/engineering-provisional*') ||
                    Request::is('admin/inter-provisional*') ||
                    Request::is('admin/education-provisional*')
                        ? 'pcoded-trigger active'
                        : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                        <span class="pcoded-mtext">{{ trans_choice('module_id_certificate', 2) }}</span>
                    </a>


                    <ul class="pcoded-submenu">
                        @canany(['degree-clc-create', 'degree-clc-view', 'old-student-create', 'old-student-view',
                            'education-clc-create', 'education-clc-view', 'engineering-clc-view', 'engineering-clc-create',
                            'inter-clc-create', 'inter-clc-view', 'nursing-clc-create', 'nursing-clc-view'])
                            <li
                                class="nav-item pcoded-hasmenu {{ Request::is('admin/old-student*') ||
                                Request::is('admin/degree-clc*') ||
                                Request::is('admin/education-clc*') ||
                                Request::is('admin/engineering-clc*') ||
                                Request::is('admin/inter-clc*') ||
                                Request::is('admin/nursing-clc*')
                                    ? 'pcoded-trigger active'
                                    : '' }}">
                                <a href="#!" class="nav-link">
                                    <span class="pcoded-mtext">{{ trans_choice('module_clc', 2) }}</span>
                                </a>

                                <ul class="pcoded-submenu">
                                    @canany(['inter-clc-create', 'inter-clc-view'])
                                        <li class="{{ Request::is('admin/inter-clc*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.inter-clc.index') }}"
                                                class="">{{ trans_choice('module_inter_clc', 2) }}</a></li>
                                    @endcanany

                                    @canany(['degree-clc-create', 'degree-clc-view'])
                                        <li class="{{ Request::is('admin/degree-clc*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.degree-clc.index') }}"
                                                class="">{{ trans_choice('module_degree_clc', 2) }}</a></li>
                                    @endcanany

                                    @canany(['nursing-clc-create', 'nursing-clc-view'])
                                        <li class="{{ Request::is('admin/nursing-clc*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.nursing-clc.index') }}"
                                                class="">{{ trans_choice('module_nursing_clc', 2) }}</a></li>
                                    @endcanany

                                    @canany(['old-student-create', 'old-student-view'])
                                        <li class="{{ Request::is('admin/old-student*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.old-student.index') }}"
                                                class="">{{ trans_choice('module_pharmacy_clc', 2) }}</a></li>
                                    @endcanany

                                    @canany(['education-clc-create', 'education-clc-view'])
                                        <li class="{{ Request::is('admin/education-clc*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.education-clc.index') }}"
                                                class="">{{ trans_choice('module_education_clc', 2) }}</a></li>
                                    @endcanany

                                    @canany(['engineering-clc-create', 'engineering-clc-view'])
                                        <li class="{{ Request::is('admin/engineering-clc*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.engineering-clc.index') }}"
                                                class="">{{ trans_choice('module_engineering_clc', 2) }}</a></li>
                                    @endcanany



                                </ul>
                            </li>
                        @endcanany

                        @canany(['provisional-create', 'provisional-view', 'degree-provisional-create',
                            'degree-provisional-view', 'education-clc-create', 'education-clc-view',
                            'nursing-provisional-create', 'nursing-provisional-view', 'engineering-provisional-create',
                            'engineering-provisional-view', 'inter-provisional-create', 'inter-provisional-view',
                            'education-provisional-create', 'education-provisional-view'])
                            <li
                                class="nav-item pcoded-hasmenu {{ Request::is('admin/provisional*') || Request::is('admin/degree-provisional*') || Request::is('admin/nursing-provisional*') || Request::is('admin/engineering-provisional*') || Request::is('admin/inter-provisional*') || Request::is('admin/education-provisional*') ? 'pcoded-trigger active' : '' }}">
                                <a href="#!" class="nav-link">
                                    <span class="pcoded-mtext">{{ trans_choice('module_provisional', 2) }}</span>
                                </a>

                                <ul class="pcoded-submenu">

                                     @canany(['inter-provisional-create', 'inter-provisional-view'])
                                        <li class="{{ Request::is('admin/inter-provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.inter-provisional.index') }}"
                                                class="">{{ trans_choice('module_inter_provisional', 2) }}</a></li>
                                    @endcanany

                                     @canany(['degree-provisional-create', 'degree-provisional-view'])
                                        <li class="{{ Request::is('admin/degree-provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.degree-provisional.index') }}"
                                                class="">{{ trans_choice('module_degree_provisional', 2) }}</a></li>
                                    @endcanany

                                     @canany(['nursing-provisional-create', 'nursing-provisional-view'])
                                        <li class="{{ Request::is('admin/nursing-provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.nursing-provisional.index') }}"
                                                class="">{{ trans_choice('module_nursing_provisional', 2) }}</a></li>
                                    @endcanany

                                    @canany(['provisional-create', 'provisional-view'])
                                        <li class="{{ Request::is('admin/provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.provisional.index') }}"
                                                class="">{{ trans_choice('module_pharmacy_provisional', 2) }}</a></li>
                                    @endcanany

                                    @canany(['education-provisional-create', 'education-provisional-view'])
                                        <li class="{{ Request::is('admin/education-provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.education-provisional.index') }}"
                                                class="">{{ trans_choice('module_education_provisional', 2) }}</a></li>
                                    @endcanany

                                    @canany(['engineering-provisional-create', 'engineering-provisional-view'])
                                        <li class="{{ Request::is('admin/engineering-provisional*') ? 'active' : '' }}"><a
                                                href="{{ route('admin.engineering-provisional.index') }}"
                                                class="">{{ trans_choice('module_engineering_provisional', 2) }}</a></li>
                                    @endcanany

                                    





                                </ul>
                            </li>
                        @endcanany

                    </ul>

                </li>
            @endcanany
        @elseif(auth()->user()->is_admin === 0)
            @php
                $departmentCondition = App\Models\DepartmentCondition::where('status', 1)->first();
            @endphp
            @canany(['old-student-create', 'old-student-view', 'provisional-create', 'provisional-view',
                'degree-clc-create', 'degree-clc-view', 'education-clc-create', 'education-clc-view',
                'education-clc-create', 'engineering-clc-view', 'engineering-clc-create', 'inter-clc-create',
                'inter-clc-view', 'nursing-clc-create', 'nursing-clc-view', 'degree-provisional-create',
                'degree-provisional-view', 'nursing-provisional-create', 'nursing-provisional-view',
                'engineering-provisional-create', 'engineering-provisional-view', 'inter-provisional-create',
                'inter-provisional-view', 'education-provisional-create', 'education-provisional-view'])
                <li
                    class="nav-item pcoded-hasmenu {{ Request::is('admin/old-student*') ||
                    Request::is('admin/provisional*') ||
                    Request::is('admin/degree-clc*') ||
                    Request::is('admin/education-clc*') ||
                    Request::is('admin/engineering-clc*') ||
                    Request::is('admin/inter-clc*') ||
                    Request::is('admin/nursing-clc*') ||
                    Request::is('admin/degree-provisional*') ||
                    Request::is('admin/nursing-provisional*') ||
                    Request::is('admin/engineering-provisional*') ||
                    Request::is('admin/inter-provisional*') ||
                    Request::is('admin/education-provisional*')
                        ? 'pcoded-trigger active'
                        : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                        <span class="pcoded-mtext">{{ trans_choice('module_id_certificate', 2) }}</span>
                    </a>


                    <ul class="pcoded-submenu">
                        @canany(['degree-clc-create', 'degree-clc-view', 'old-student-create', 'old-student-view',
                            'education-clc-create', 'education-clc-view', 'engineering-clc-view', 'engineering-clc-create',
                            'inter-clc-create', 'inter-clc-view', 'nursing-clc-create', 'nursing-clc-view'])
                            <li
                                class="nav-item pcoded-hasmenu {{ Request::is('admin/old-student*') ||
                                Request::is('admin/degree-clc*') ||
                                Request::is('admin/education-clc*') ||
                                Request::is('admin/engineering-clc*') ||
                                Request::is('admin/inter-clc*') ||
                                Request::is('admin/nursing-clc*')
                                    ? 'pcoded-trigger active'
                                    : '' }}">
                                <a href="#!" class="nav-link">
                                    <span class="pcoded-mtext">{{ trans_choice('module_clc', 2) }}</span>
                                </a>

                                <ul class="pcoded-submenu">

                                    @if ($departmentCondition->inter_id === auth()->user()->college_department_id)
                                        @canany(['inter-clc-create', 'inter-clc-view'])
                                            <li class="{{ Request::is('admin/inter-clc*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.inter-clc.index') }}"
                                                    class="">{{ trans_choice('module_inter_clc', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->nursing_id === auth()->user()->college_department_id)
                                        @canany(['nursing-clc-create', 'nursing-clc-view'])
                                            <li class="{{ Request::is('admin/nursing-clc*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.nursing-clc.index') }}"
                                                    class="">{{ trans_choice('module_nursing_clc', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->degree_id === auth()->user()->college_department_id)
                                        @canany(['degree-clc-create', 'degree-clc-view'])
                                            <li class="{{ Request::is('admin/degree-clc*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.degree-clc.index') }}"
                                                    class="">{{ trans_choice('module_degree_clc', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->education_id === auth()->user()->college_department_id)
                                        @canany(['education-clc-create', 'education-clc-view'])
                                            <li class="{{ Request::is('admin/education-clc*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.education-clc.index') }}"
                                                    class="">{{ trans_choice('module_education_clc', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->engineering_id === auth()->user()->college_department_id)
                                        @canany(['engineering-clc-create', 'engineering-clc-view'])
                                            <li class="{{ Request::is('admin/engineering-clc*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.engineering-clc.index') }}"
                                                    class="">{{ trans_choice('module_engineering_clc', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->pharmacy_id === auth()->user()->college_department_id)
                                        @canany(['old-student-create', 'old-student-view'])
                                            <li class="{{ Request::is('admin/old-student*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.old-student.index') }}"
                                                    class="">{{ trans_choice('module_pharmacy_clc', 2) }}</a></li>
                                        @endcanany
                                    @endif

                                </ul>
                            </li>
                        @endcanany

                        @canany(['provisional-create', 'provisional-view', 'degree-provisional-create',
                            'degree-provisional-view', 'education-clc-create', 'education-clc-view',
                            'nursing-provisional-create', 'nursing-provisional-view', 'engineering-provisional-create',
                            'engineering-provisional-view', 'inter-provisional-create', 'inter-provisional-view',
                            'education-provisional-create', 'education-provisional-view'])
                            <li
                                class="nav-item pcoded-hasmenu {{ Request::is('admin/provisional*') || Request::is('admin/degree-provisional*') || Request::is('admin/nursing-provisional*') || Request::is('admin/engineering-provisional*') || Request::is('admin/inter-provisional*') || Request::is('admin/education-provisional*') ? 'pcoded-trigger active' : '' }}">
                                <a href="#!" class="nav-link">
                                    <span class="pcoded-mtext">{{ trans_choice('module_provisional', 2) }}</span>
                                </a>

                                <ul class="pcoded-submenu">

                                    @if ($departmentCondition->pharmacy_id === auth()->user()->college_department_id)
                                        @canany(['provisional-create', 'provisional-view'])
                                            <li class="{{ Request::is('admin/provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.provisional.index') }}"
                                                    class="">{{ trans_choice('module_pharmacy_provisional', 2) }}</a></li>
                                        @endcanany
                                    @elseif($departmentCondition->engineering_id === auth()->user()->college_department_id)
                                        @canany(['engineering-provisional-create', 'engineering-provisional-view'])
                                            <li class="{{ Request::is('admin/engineering-provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.engineering-provisional.index') }}"
                                                    class="">{{ trans_choice('module_engineering_provisional', 2) }}</a>
                                            </li>
                                        @endcanany
                                    @elseif ($departmentCondition->education_id === auth()->user()->college_department_id)
                                        @canany(['education-provisional-create', 'education-provisional-view'])
                                            <li class="{{ Request::is('admin/education-provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.education-provisional.index') }}"
                                                    class="">{{ trans_choice('module_education_provisional', 2) }}</a></li>
                                        @endcanany
                                    @elseif ($departmentCondition->nursing_id === auth()->user()->college_department_id)
                                        @canany(['nursing-provisional-create', 'nursing-provisional-view'])
                                            <li class="{{ Request::is('admin/nursing-provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.nursing-provisional.index') }}"
                                                    class="">{{ trans_choice('module_nursing_provisional', 2) }}</a></li>
                                        @endcanany
                                    @elseif ($departmentCondition->degree_id === auth()->user()->college_department_id)
                                        @canany(['degree-provisional-create', 'degree-provisional-view'])
                                            <li class="{{ Request::is('admin/degree-provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.degree-provisional.index') }}"
                                                    class="">{{ trans_choice('module_degree_provisional', 2) }}</a></li>
                                        @endcanany
                                    @elseif ($departmentCondition->inter_id === auth()->user()->college_department_id)
                                        @canany(['inter-provisional-create', 'inter-provisional-view'])
                                            <li class="{{ Request::is('admin/inter-provisional*') ? 'active' : '' }}"><a
                                                    href="{{ route('admin.inter-provisional.index') }}"
                                                    class="">{{ trans_choice('module_inter_provisional', 2) }}</a></li>
                                        @endcanany
                                    @endif

                                </ul>
                            </li>
                        @endcanany

                    </ul>

                </li>
            @endcanany

        @endif


        @php
            $teacherDepa = optional(auth()->user())->teacher_department;
            $collegeDepartment = auth()->user()->college_department_id;

            $collegeProgram = auth()->user()->college_program;

            $sidebarCondition = auth()->user()->sidebar_condition_id;
            if (!empty($collegeProgram) && !empty($sidebarCondition)) {
                $batch = \App\Models\Batch::where('department_id', $collegeDepartment)
                    ->where('status', '1')
                    ->orderBy('title', 'asc')
                    ->first();

                $programs = $batch && $batch->programs ? $batch->programs : collect(); // ensure $programs is always a collection

                $ids = $programs->pluck('id')->contains($teacherDepa) ? 1 : 0;
            } else {
                $ids = 0;
            }

        @endphp



        @if (auth()->user()->is_admin === 1)
            @canany(['sharan-clc-create', 'sharan-clc-view', 'sharan-clc-edit', 'sharan-clc-delete', 'billing-create',
                'billing-view', 'billing-edit', 'billing-delete', 'karma-clc-create', 'karma-clc-view', 'karma-clc-edit',
                'karma-clc-delete'])
                <li class="nav-item pcoded-hasmenu {{ Request::is('admin/clc*') ? 'pcoded-trigger active' : '' }}">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                        <span class="pcoded-mtext">{{ 'Degree' }}</span>
                    </a>
                    <ul class="pcoded-submenu">

                        @canany(['sharan-clc-create', 'sharan-clc-view'])
                            <li class="{{ Request::is('admin/clc/sharan*') ? 'active' : '' }}"><a
                                    href="{{ route('admin.sharan.index') }}"
                                    class="">{{ trans_choice('module_sharan', 2) }}</a></li>
                        @endcanany

                        {{-- @canany(['bilash-clc-create', 'bilash-clc-view'])
                            <li class="{{ Request::is('admin/clc/bilash*') ? 'active' : '' }}"><a
                                    href="{{ route('admin.bilash.index') }}"
                                    class="">{{ trans_choice('module_bilash', 2) }}</a></li>
                        @endcanany

                        @canany(['kanchan-clc-create', 'kanchan-clc-view'])
                            <li class="{{ Request::is('admin/clc/kanchan*') ? 'active' : '' }}"><a
                                    href="{{ route('admin.kanchan.index') }}"
                                    class="">{{ trans_choice('module_kanchan', 2) }}</a></li>
                        @endcanany --}}

                    </ul>


                </li>
            @endcanany
        @elseif(auth()->user()->is_admin === 0)
            @if ($ids === 1)
                @canany(['sharan-clc-create', 'sharan-clc-view', 'sharan-clc-edit', 'sharan-clc-delete',
                    'billing-create', 'billing-view', 'billing-edit', 'billing-delete', 'karma-clc-create',
                    'karma-clc-view', 'karma-clc-edit', 'karma-clc-delete'])
                    <li class="nav-item pcoded-hasmenu {{ Request::is('admin/clc*') ? 'pcoded-trigger active' : '' }}">
                        <a href="#!" class="nav-link">
                            <span class="pcoded-micon"><i class="fas fa-university"></i></span>
                            <span class="pcoded-mtext">{{ 'Degree' }}</span>
                        </a>

                        <ul class="pcoded-submenu">


                            @canany(['sharan-clc-create', 'sharan-clc-view'])
                                <li class="{{ Request::is('admin/clc/sharan*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.sharan.index') }}"
                                        class="">{{ trans_choice('module_sharan', 2) }}</a></li>
                            @endcanany

                            {{-- @canany(['bilash-clc-create', 'bilash-clc-view'])
                                    <li class="{{ Request::is('admin/clc/bilash*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.bilash.index') }}"
                                            class="">{{ trans_choice('module_bilash', 2) }}</a></li>
                                @endcanany
                            
                                @canany(['kanchan-clc-create', 'kanchan-clc-view'])
                                    <li class="{{ Request::is('admin/clc/kanchan*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.kanchan.index') }}"
                                            class="">{{ trans_choice('module_kanchan', 2) }}</a></li>
                                @endcanany --}}



                        </ul>


                    </li>
                @endcanany
            @endif
        @endif



        @canany(['student-attendance-action', 'student-attendance-report', 'student-leave-manage-view',
            'student-leave-manage-edit', 'student-note-create', 'student-note-view', 'student-enroll-single',
            'student-enroll-group', 'student-enroll-adddrop', 'student-enroll-complete', 'student-enroll-alumni'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/student*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-user-graduate"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_student', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">

                    @canany(['student-attendance-action', 'student-attendance-report'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/student-attendance*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_attendance', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('student-attendance-action')
                                    <li class="{{ Request::is('admin/student-attendance') ? 'active' : '' }}"><a
                                            href="{{ route('admin.student-attendance.index') }}"
                                            class="">{{ trans_choice('module_student_subject_attendance', 2) }}</a></li>
                                @endcan

                                @can('student-attendance-report')
                                    <li class="{{ Request::is('admin/student-attendance-report*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.student-attendance.report') }}"
                                            class="">{{ trans_choice('module_student_subject_report', 2) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['student-leave-manage-view', 'student-leave-manage-edit'])
                        <li class="{{ Request::is('admin/student-leave-manage*') ? 'active' : '' }}"><a
                                href="{{ route('admin.student-leave-manage.index') }}"
                                class="">{{ trans_choice('module_leave_manage', 1) }}</a></li>
                    @endcanany

                    @canany(['student-note-create', 'student-note-view'])
                        <li class="{{ Request::is('admin/student/student-note*') ? 'active' : '' }}"><a
                                href="{{ route('admin.student-note.index') }}"
                                class="">{{ trans_choice('module_student_note', 2) }}</a></li>
                    @endcanany

                    @canany(['student-enroll-single', 'student-enroll-group', 'student-enroll-adddrop',
                        'student-enroll-complete'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/student/single-enroll*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/group-enroll*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/subject-adddrop*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/student/course-complete*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_student_enroll', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @canany(['student-enroll-single'])
                                    <li class="{{ Request::is('admin/student/single-enroll*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.single-enroll.index') }}"
                                            class="">{{ trans_choice('module_single_enroll', 1) }}</a></li>
                                @endcanany

                                @canany(['student-enroll-group'])
                                    <li class="{{ Request::is('admin/student/group-enroll*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.group-enroll.index') }}"
                                            class="">{{ trans_choice('module_group_enroll', 2) }}</a></li>
                                @endcanany

                                @canany(['student-enroll-adddrop'])
                                    <li class="{{ Request::is('admin/student/subject-adddrop*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.subject-adddrop.index') }}"
                                            class="">{{ trans_choice('module_subject_adddrop', 2) }}</a></li>
                                @endcanany

                                @canany(['student-enroll-complete'])
                                    <li class="{{ Request::is('admin/student/course-complete*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.course-complete.index') }}"
                                            class="">{{ trans_choice('module_course_complete', 2) }}</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany

                    @canany(['student-enroll-alumni'])
                        <li class="{{ Request::is('admin/student/student-alumni*') ? 'active' : '' }}"><a
                                href="{{ route('admin.student-alumni.index') }}"
                                class="">{{ trans_choice('module_student_alumni', 1) }} {{ __('list') }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['college-department-create', 'college-department-view', 'faculty-create', 'faculty-view',
            'program-create', 'program-view', 'batch-create', 'batch-view', 'session-create', 'session-view',
            'semester-create', 'semester-view', 'section-create', 'section-view', 'class-room-create', 'class-room-view',
            'subject-create', 'subject-view', 'enroll-subject-create', 'enroll-subject-view', 'department-condition-view'])
            <li
                class="nav-item pcoded-hasmenu {{ Request::is('admin/academic*') || Request::is('admin/department/condition*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fab fa-accusoft"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_academic', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">

                    @canany(['college-department-create', 'college-department-view'])
                        <li class="{{ Request::is('admin/academic/college-department*') ? 'active' : '' }}"><a
                                href="{{ route('admin.college-department.index') }}"
                                class="">{{ trans_choice('module_college_department', 2) }}</a></li>
                    @endcanany

                    @canany(['faculty-create', 'faculty-view'])
                        <li class="{{ Request::is('admin/academic/faculty*') ? 'active' : '' }}"><a
                                href="{{ route('admin.faculty.index') }}"
                                class="">{{ trans_choice('module_faculty', 2) }}</a></li>
                    @endcanany

                    @canany(['program-create', 'program-view'])
                        <li class="{{ Request::is('admin/academic/program*') ? 'active' : '' }}"><a
                                href="{{ route('admin.program.index') }}"
                                class="">{{ trans_choice('module_program', 2) }}</a></li>
                    @endcanany

                    @canany(['batch-create', 'batch-view'])
                        <li class="{{ Request::is('admin/academic/batch*') ? 'active' : '' }}"><a
                                href="{{ route('admin.batch.index') }}"
                                class="">{{ trans_choice('module_batch', 2) }}</a></li>
                    @endcanany

                    @canany(['session-create', 'session-view'])
                        <li class="{{ Request::is('admin/academic/session*') ? 'active' : '' }}"><a
                                href="{{ route('admin.session.index') }}"
                                class="">{{ trans_choice('module_session', 2) }}</a></li>
                    @endcanany

                    @canany(['semester-create', 'semester-view'])
                        <li class="{{ Request::is('admin/academic/semester*') ? 'active' : '' }}"><a
                                href="{{ route('admin.semester.index') }}"
                                class="">{{ trans_choice('module_semester', 2) }}</a></li>
                    @endcanany

                    @canany(['section-create', 'section-view'])
                        <li class="{{ Request::is('admin/academic/section*') ? 'active' : '' }}"><a
                                href="{{ route('admin.section.index') }}"
                                class="">{{ trans_choice('module_section', 2) }}</a></li>
                    @endcanany


                    @canany(['department-condition-view'])
                        <li class="{{ Request::is('admin/department/condition*') ? 'active' : '' }}"><a
                                href="{{ route('admin.department.condition.index') }}"
                                class="">{{ trans_choice('module_department_condition', 2) }}</a></li>
                    @endcanany

                    @canany(['class-room-create', 'class-room-view'])
                        <li class="{{ Request::is('admin/academic/room*') ? 'active' : '' }}"><a
                                href="{{ route('admin.room.index') }}"
                                class="">{{ trans_choice('module_class_room', 2) }}</a></li>
                    @endcanany

                    @canany(['subject-create', 'subject-view'])
                        <li class="{{ Request::is('admin/academic/subject*') ? 'active' : '' }}"><a
                                href="{{ route('admin.subject.index') }}"
                                class="">{{ trans_choice('module_subject', 2) }}</a></li>
                    @endcanany

                    @canany(['enroll-subject-create', 'enroll-subject-view'])
                        <li class="{{ Request::is('admin/academic/enroll-subject*') ? 'active' : '' }}"><a
                                href="{{ route('admin.enroll-subject.index') }}"
                                class="">{{ trans_choice('module_enroll_subject', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['class-routine-create', 'class-routine-view', 'class-routine-print', 'exam-routine-create',
            'exam-routine-view', 'exam-routine-print', 'class-routine-teacher', 'routine-setting-class',
            'routine-setting-exam'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/routine*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="far fa-calendar-alt"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_routine', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['class-routine-create'])
                        <li class="{{ Request::is('admin/routine/class-routine/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.class-routine.create') }}"
                                class="">{{ trans_choice('module_manage_class', 2) }}</a></li>
                    @endcanany

                    @canany(['class-routine-view', 'class-routine-print'])
                        <li class="{{ Request::is('admin/routine/class-routine') ? 'active' : '' }}"><a
                                href="{{ route('admin.class-routine.index') }}"
                                class="">{{ trans_choice('module_class_routine', 2) }}</a></li>
                    @endcanany

                    @canany(['exam-routine-create'])
                        <li class="{{ Request::is('admin/routine/exam-routine/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-routine.create') }}"
                                class="">{{ trans_choice('module_manage_exam', 2) }}</a></li>
                    @endcanany

                    @canany(['exam-routine-view', 'exam-routine-print'])
                        <li class="{{ Request::is('admin/routine/exam-routine') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-routine.index') }}"
                                class="">{{ trans_choice('module_exam_routine', 2) }}</a></li>
                    @endcanany

                    @can('class-routine-teacher')
                        <li class="{{ Request::is('admin/routine/class-routine-teacher') ? 'active' : '' }}"><a
                                href="{{ route('admin.class-routine.teacher') }}"
                                class="">{{ trans_choice('module_teacher_routine', 2) }}</a></li>
                    @endcan

                    @canany(['routine-setting-class', 'routine-setting-exam'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/routine/routine-setting*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('routine-setting-class')
                                    <li class="{{ Request::is('admin/routine/routine-setting/class*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.routine-setting.class') }}"
                                            class="">{{ trans_choice('module_class_routine', 1) }}</a></li>
                                @endcan

                                @can('routine-setting-exam')
                                    <li class="{{ Request::is('admin/routine/routine-setting/exam*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.routine-setting.exam') }}"
                                            class="">{{ trans_choice('module_exam_routine', 1) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['exam-attendance', 'exam-marking', 'exam-result', 'subject-marking', 'subject-result', 'grade-view',
            'grade-create', 'exam-type-view', 'exam-type-create', 'admit-card-view', 'admit-card-print',
            'admit-card-download', 'admit-setting-view', 'result-contribution-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/exam*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-file-alt"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_examination', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('exam-attendance')
                        <li class="{{ Request::is('admin/exam/exam-attendance*') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-attendance.index') }}"
                                class="">{{ trans_choice('module_exam_attendance', 2) }}</a></li>
                    @endcan

                    @can('exam-marking')
                        <li class="{{ Request::is('admin/exam/exam-marking*') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-marking.index') }}"
                                class="">{{ trans_choice('module_exam_marking', 2) }}</a></li>
                    @endcan

                    @can('exam-result')
                        <li class="{{ Request::is('admin/exam/exam-result*') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-result') }}"
                                class="">{{ trans_choice('module_exam_result', 2) }}</a></li>
                    @endcan

                    @can('subject-marking')
                        <li class="{{ Request::is('admin/exam/subject-marking*') ? 'active' : '' }}"><a
                                href="{{ route('admin.subject-marking.index') }}"
                                class="">{{ trans_choice('module_subject_marking', 2) }}</a></li>
                    @endcan

                    @can('subject-result')
                        <li class="{{ Request::is('admin/exam/subject-result*') ? 'active' : '' }}"><a
                                href="{{ route('admin.subject-result') }}"
                                class="">{{ trans_choice('module_subject_result', 2) }}</a></li>
                    @endcan

                    @canany(['grade-view', 'grade-create'])
                        <li class="{{ Request::is('admin/exam/grade*') ? 'active' : '' }}"><a
                                href="{{ route('admin.grade.index') }}"
                                class="">{{ trans_choice('module_grade', 2) }}</a></li>
                    @endcanany

                    @canany(['exam-type-view', 'exam-type-create'])
                        <li class="{{ Request::is('admin/exam/exam-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.exam-type.index') }}"
                                class="">{{ trans_choice('module_exam_type', 2) }}</a></li>
                    @endcanany

                    @canany(['admit-card-view', 'admit-card-print', 'admit-card-download'])
                        <li class="{{ Request::is('admin/exam/admit-card*') ? 'active' : '' }}"><a
                                href="{{ route('admin.admit-card.index') }}"
                                class="">{{ trans_choice('module_admit_card', 2) }}</a></li>
                    @endcanany

                    @canany(['admit-setting-view', 'result-contribution-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/exam/admit-setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/exam/result-contribution*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('admit-setting-view')
                                    <li class="{{ Request::is('admin/exam/admit-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.admit-setting.index') }}"
                                            class="">{{ trans_choice('module_admit_setting', 1) }}</a></li>
                                @endcan

                                @can('result-contribution-view')
                                    <li class="{{ Request::is('admin/exam/result-contribution*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.result-contribution.index') }}"
                                            class="">{{ trans_choice('module_result_contribution', 2) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['assignment-create', 'assignment-view', 'assignment-marking', 'content-create', 'content-view',
            'content-type-view', 'content-type-create'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/download*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-newspaper"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_study_material', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['assignment-create', 'assignment-view', 'assignment-marking'])
                        <li class="{{ Request::is('admin/download/assignment*') ? 'active' : '' }}"><a
                                href="{{ route('admin.assignment.index') }}"
                                class="">{{ trans_choice('module_assignment', 2) }}</a></li>
                    @endcanany

                    @canany(['content-create', 'content-view'])
                        <li class="{{ Request::is('admin/download/content*') ? 'active' : '' }}"><a
                                href="{{ route('admin.content.index') }}"
                                class="">{{ trans_choice('module_content', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['content-type-view', 'content-type-create'])
                        <li class="{{ Request::is('admin/download/content-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.content-type.index') }}"
                                class="">{{ trans_choice('module_content_type', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['fees-student-due', 'fees-student-quick-assign', 'fees-student-quick-received', 'fees-student-report',
            'fees-student-print', 'fees-master-view', 'fees-master-create', 'fees-category-view', 'fees-category-create',
            'fees-discount-view', 'fees-discount-create', 'fees-fine-view', 'fees-fine-create', 'fees-receipt-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/fees*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-money-bill-wave"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_fees_collection', 1) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['fees-student-due', 'fees-student-quick-assign', 'fees-student-quick-received',
                        'fees-student-report', 'fees-student-print'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/fees-student*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_student_fees', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('fees-student-due')
                                    <li class="{{ Request::is('admin/fees-student') ? 'active' : '' }}"><a
                                            href="{{ route('admin.fees-student.index') }}"
                                            class="">{{ trans_choice('module_fees_due', 1) }}</a></li>
                                @endcan

                                @can('fees-student-quick-assign')
                                    <li class="{{ Request::is('admin/fees-student-quick-assign*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.fees-student.quick.assign') }}"
                                            class="">{{ trans_choice('module_fees_quick_assign', 1) }}</a></li>
                                @endcan

                                @can('fees-student-quick-received')
                                    <li class="{{ Request::is('admin/fees-student-quick-received*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.fees-student.quick.received') }}"
                                            class="">{{ trans_choice('module_fees_quick_received', 1) }}</a></li>
                                @endcan

                                @canany(['fees-student-report', 'fees-student-print'])
                                    <li class="{{ Request::is('admin/fees-student-report*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.fees-student.report') }}"
                                            class="">{{ trans_choice('module_fees_report', 2) }}</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany

                    @canany(['fees-master-create'])
                        <li class="{{ Request::is('admin/fees-master/create*') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-master.create') }}"
                                class="">{{ trans_choice('module_fees_master', 2) }}</a></li>
                    @endcanany

                    @canany(['fees-master-view'])
                        <li class="{{ Request::is('admin/fees-master') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-master.index') }}"
                                class="">{{ trans_choice('module_fees_master_history', 2) }}</a></li>
                    @endcanany

                    @canany(['fees-category-view', 'fees-category-create'])
                        <li class="{{ Request::is('admin/fees-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-category.index') }}"
                                class="">{{ trans_choice('module_fees_category', 2) }}</a></li>
                    @endcanany

                    @canany(['fees-discount-view', 'fees-discount-create'])
                        <li class="{{ Request::is('admin/fees-discount*') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-discount.index') }}"
                                class="">{{ trans_choice('module_fees_discount', 2) }}</a></li>
                    @endcanany

                    @canany(['fees-fine-view', 'fees-fine-create'])
                        <li class="{{ Request::is('admin/fees-fine*') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-fine.index') }}"
                                class="">{{ trans_choice('module_fees_fine', 2) }}</a></li>
                    @endcanany

                    @can('fees/student/quick-show')
                        <li class="{{ Request::is('admin/fees/student/quick-show*') ? 'active' : '' }}"><a
                                href="{{ route('admin.fees-student.quick.show') }}"
                                class="">{{ trans_choice('module_fees_quick_show', 1) }}</a></li>
                    @endcan

                    @can('fees/special/student')
                        <li class="{{ Request::is('admin/fees/special/student*') ? 'active' : '' }}"><a
                                href="{{ route('admin.special.student') }}"
                                class="">{{ trans_choice('field_special_student', 1) }}</a></li>
                    @endcan

                    @canany(['fees-fine-view', 'fees-fine-create', 'fees-receipt-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/fees-receipt*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('fees-receipt-view')
                                    <li class="{{ Request::is('admin/fees-receipt*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.fees-receipt.index') }}"
                                            class="">{{ trans_choice('module_fees_receipt_setting', 1) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['user-create', 'user-view', 'user-password-print', 'user-password-change', 'staff-note-create',
            'staff-note-view', 'payroll-view', 'payroll-action', 'payroll-print', 'payroll-report',
            'work-shift-type-create', 'work-shift-type-view', 'designation-create', 'designation-view', 'department-create',
            'department-view', 'tax-setting-create', 'tax-setting-view', 'pay-slip-setting-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/staff*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-users-cog"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_human_resource', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['user-create', 'user-view', 'user-password-print', 'user-password-change'])
                        <li class="{{ Request::is('admin/staff/user*') ? 'active' : '' }}"><a
                                href="{{ route('admin.user.index') }}"
                                class="">{{ trans_choice('module_staff', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['staff-note-create', 'staff-note-view'])
                        <li class="{{ Request::is('admin/staff/staff-note*') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-note.index') }}"
                                class="">{{ trans_choice('module_staff_note', 2) }}</a></li>
                    @endcanany

                    @canany(['payroll-view', 'payroll-action', 'payroll-print'])
                        <li class="{{ Request::is('admin/staff/payroll') ? 'active' : '' }}"><a
                                href="{{ route('admin.payroll.index') }}"
                                class="">{{ trans_choice('module_payroll', 2) }}</a></li>
                    @endcanany

                    @canany(['payroll-report'])
                        <li class="{{ Request::is('admin/staff/payroll-report*') ? 'active' : '' }}"><a
                                href="{{ route('admin.payroll.report') }}"
                                class="">{{ trans_choice('module_payroll_report', 2) }}</a></li>
                    @endcanany

                    @canany(['work-shift-type-create', 'work-shift-type-view'])
                        <li class="{{ Request::is('admin/staff/work-shift-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.work-shift-type.index') }}"
                                class="">{{ trans_choice('module_work_shift_type', 2) }}</a></li>
                    @endcanany

                    @canany(['designation-create', 'designation-view'])
                        <li class="{{ Request::is('admin/staff/designation*') ? 'active' : '' }}"><a
                                href="{{ route('admin.designation.index') }}"
                                class="">{{ trans_choice('module_designation', 2) }}</a></li>
                    @endcanany

                    @canany(['department-create', 'department-view'])
                        <li class="{{ Request::is('admin/staff/department*') ? 'active' : '' }}"><a
                                href="{{ route('admin.department.index') }}"
                                class="">{{ trans_choice('module_department', 2) }}</a></li>
                    @endcanany

                    @canany(['tax-setting-create', 'tax-setting-view', 'pay-slip-setting-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/staff/tax-setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/staff/pay-slip-setting*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @canany(['tax-setting-create', 'tax-setting-view'])
                                    <li class="{{ Request::is('admin/staff/tax-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.tax-setting.index') }}"
                                            class="">{{ trans_choice('module_tax_setting', 2) }}</a></li>
                                @endcanany

                                @can('pay-slip-setting-view')
                                    <li class="{{ Request::is('admin/staff/pay-slip-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.pay-slip-setting.index') }}"
                                            class="">{{ trans_choice('module_pay_slip_setting', 1) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['staff-daily-attendance-action', 'staff-daily-attendance-report', 'staff-hourly-attendance-action',
            'staff-hourly-attendance-report'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/attendance*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-calendar-check"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_staff_attendance', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('staff-daily-attendance-action')
                        <li class="{{ Request::is('admin/attendance/staff-daily-attendance*') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-daily-attendance.index') }}"
                                class="">{{ trans_choice('module_staff_daily_attendance', 2) }}</a></li>
                    @endcan

                    @can('staff-daily-attendance-report')
                        <li class="{{ Request::is('admin/attendance/staff-daily-report*') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-daily-attendance.report') }}"
                                class="">{{ trans_choice('module_staff_daily_report', 2) }}</a></li>
                    @endcan

                    @can('staff-hourly-attendance-action')
                        <li class="{{ Request::is('admin/attendance/staff-hourly-attendance*') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-hourly-attendance.index') }}"
                                class="">{{ trans_choice('module_staff_hourly_attendance', 2) }}</a></li>
                    @endcan

                    @can('staff-hourly-attendance-report')
                        <li class="{{ Request::is('admin/attendance/staff-hourly-report*') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-hourly-attendance.report') }}"
                                class="">{{ trans_choice('module_staff_hourly_report', 2) }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['staff-leave-create', 'staff-leave-view', 'leave-type-create', 'leave-type-view',
            'staff-leave-manage-edit', 'staff-leave-manage-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/leave*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-notes-medical"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_leave_manager', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['staff-leave-create'])
                        <li class="{{ Request::is('admin/leave/staff-leave/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-leave.create') }}"
                                class="">{{ trans_choice('module_apply_leave', 1) }}</a></li>
                    @endcanany

                    @canany(['staff-leave-view'])
                        <li class="{{ Request::is('admin/leave/staff-leave') ? 'active' : '' }}"><a
                                href="{{ route('admin.staff-leave.index') }}"
                                class="">{{ trans_choice('module_my_leave', 2) }}</a></li>
                    @endcanany

                    @canany(['leave-type-create', 'leave-type-view'])
                        <li class="{{ Request::is('admin/leave/leave-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.leave-type.index') }}"
                                class="">{{ trans_choice('module_leave_type', 2) }}</a></li>
                    @endcanany

                    @canany(['staff-leave-manage-edit', 'staff-leave-manage-view'])
                        <li class="{{ Request::is('admin/leave/leave-manage*') ? 'active' : '' }}"><a
                                href="{{ route('admin.leave-manage.index') }}"
                                class="">{{ trans_choice('module_leave_manage', 1) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['income-create', 'income-view', 'income-category-create', 'income-category-view', 'expense-create',
            'expense-view', 'expense-category-create', 'expense-category-view', 'outcome-view', 'collection/datafees'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/account*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-credit-card"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_income_expense', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">



                    @canany(['income-create', 'income-view'])
                        <li class="{{ Request::is('admin/account/income*') ? 'active' : '' }}"><a
                                href="{{ route('admin.income.index') }}"
                                class="">{{ trans_choice('module_income', 1) }} {{ __('list') }}</a></li>
                    @endcanany


                    @canany(['income-create', 'income-view'])
                        <li class="{{ Request::is('admin/account/datafees*') ? 'active' : '' }}"><a
                                href="{{ route('admin.collection.datafees') }}" class="">{{ 'Student Fees' }}
                                {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['income-category-create', 'income-category-view'])
                        <li class="{{ Request::is('admin/account/income-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.income-category.index') }}"
                                class="">{{ trans_choice('module_income_category', 2) }}</a></li>
                    @endcanany

                    @canany(['expense-create', 'expense-view'])
                        <li class="{{ Request::is('admin/account/expense*') ? 'active' : '' }}"><a
                                href="{{ route('admin.expense.index') }}"
                                class="">{{ trans_choice('module_expense', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['expense-category-create', 'expense-category-view'])
                        <li class="{{ Request::is('admin/account/expense-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.expense-category.index') }}"
                                class="">{{ trans_choice('module_expense_category', 2) }}</a></li>
                    @endcanany

                    @can('outcome-view')
                        <li class="{{ Request::is('admin/account/outcome*') ? 'active' : '' }}"><a
                                href="{{ route('admin.outcome.index') }}"
                                class="">{{ trans_choice('module_outcome_calculation', 2) }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['email-notify-create', 'email-notify-view', 'sms-notify-create', 'sms-notify-view', 'event-create',
            'event-view', 'event-calendar', 'notice-create', 'notice-view', 'notice-category-create',
            'notice-category-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/communicate*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-bullhorn"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_communicate', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['email-notify-create', 'email-notify-view'])
                        <li class="{{ Request::is('admin/communicate/email-notify*') ? 'active' : '' }}"><a
                                href="{{ route('admin.email-notify.index') }}"
                                class="">{{ trans_choice('module_email_notify', 2) }}</a></li>
                    @endcanany

                    @canany(['sms-notify-create', 'sms-notify-view'])
                        <li class="{{ Request::is('admin/communicate/sms-notify*') ? 'active' : '' }}"><a
                                href="{{ route('admin.sms-notify.index') }}"
                                class="">{{ trans_choice('module_sms_notify', 2) }}</a></li>
                    @endcanany

                    @canany(['event-create', 'event-view'])
                        <li class="{{ Request::is('admin/communicate/event') ? 'active' : '' }}"><a
                                href="{{ route('admin.event.index') }}"
                                class="">{{ trans_choice('module_event', 2) }} {{ __('list') }}</a></li>
                    @endcanany

                    @can('event-calendar')
                        <li class="{{ Request::is('admin/communicate/event-calendar') ? 'active' : '' }}"><a
                                href="{{ route('admin.event.calendar') }}"
                                class="">{{ trans_choice('module_calendar', 2) }}</a></li>
                    @endcan

                    @canany(['notice-create', 'notice-view'])
                        <li class="{{ Request::is('admin/communicate/notice*') ? 'active' : '' }}"><a
                                href="{{ route('admin.notice.index') }}"
                                class="">{{ trans_choice('module_notice', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany('notice-category-create', 'notice-category-view')
                        <li class="{{ Request::is('admin/communicate/notice-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.notice-category.index') }}"
                                class="">{{ trans_choice('module_notice_category', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['book-issue-action', 'book-issue-view', 'library-member-view', 'library-member-create',
            'library-member-card', 'book-create', 'book-view', 'book-print', 'book-request-create', 'book-request-view',
            'book-category-create', 'book-category-view', 'library-card-setting-view'])
            <li
                class="nav-item pcoded-hasmenu {{ Request::is('admin/library*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/member/library*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-book-open"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_library', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['book-issue-action'])
                        <li class="{{ Request::is('admin/library/issue-return/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.issue-return.create') }}"
                                class="">{{ trans_choice('module_book_issue', 1) }}</a></li>
                    @endcanany

                    @canany(['book-issue-action', 'book-issue-view'])
                        <li class="{{ Request::is('admin/library/issue-return') ? 'active' : '' }}"><a
                                href="{{ route('admin.issue-return.index') }}"
                                class="">{{ trans_choice('module_book_issue_return', 1) }}</a></li>
                    @endcanany

                    @canany(['library-member-create', 'library-member-view', 'library-member-card'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/member/library*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_member', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                <li class="{{ Request::is('admin/member/library-student*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.library-student.index') }}"
                                        class="">{{ trans_choice('module_student', 1) }} {{ __('list') }}</a></li>

                                <li class="{{ Request::is('admin/member/library-staff*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.library-staff.index') }}"
                                        class="">{{ trans_choice('module_staff', 1) }} {{ __('list') }}</a></li>

                                <li class="{{ Request::is('admin/member/library-outsider*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.library-outsider.index') }}"
                                        class="">{{ trans_choice('module_outsider', 1) }} {{ __('list') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['book-create', 'book-view', 'book-print'])
                        <li class="{{ Request::is('admin/library/book-list*') ? 'active' : '' }}"><a
                                href="{{ route('admin.book-list.index') }}"
                                class="">{{ trans_choice('module_book', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['book-request-create', 'book-request-view'])
                        <li class="{{ Request::is('admin/library/book-request*') ? 'active' : '' }}"><a
                                href="{{ route('admin.book-request.index') }}"
                                class="">{{ trans_choice('module_book_request', 2) }}</a></li>
                    @endcanany

                    @canany(['book-category-create', 'book-category-view'])
                        <li class="{{ Request::is('admin/library/book-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.book-category.index') }}"
                                class="">{{ trans_choice('module_book_category', 2) }}</a></li>
                    @endcanany

                    @canany(['library-card-setting-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/library-card-setting*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @can('library-card-setting-view')
                                    <li class="{{ Request::is('admin/library-card-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.library-card-setting.index') }}"
                                            class="">{{ trans_choice('module_library_card_setting', 1) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['item-issue-action', 'item-issue-view', 'item-stock-create', 'item-stock-view', 'item-create',
            'item-view', 'item-store-create', 'item-store-view', 'item-supplier-create', 'item-supplier-view',
            'item-category-create', 'item-category-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/inventory*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-dolly-flatbed"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_inventory', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['item-issue-action'])
                        <li class="{{ Request::is('admin/inventory/item-issue/create') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-issue.create') }}"
                                class="">{{ trans_choice('module_item_issue', 1) }}</a></li>
                    @endcanany

                    @canany(['item-issue-action', 'item-issue-view'])
                        <li class="{{ Request::is('admin/inventory/item-issue') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-issue.index') }}"
                                class="">{{ trans_choice('module_item_issue_return', 1) }}</a></li>
                    @endcanany

                    @canany(['item-stock-create', 'item-stock-view'])
                        <li class="{{ Request::is('admin/inventory/item-stock*') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-stock.index') }}"
                                class="">{{ trans_choice('module_item_stock', 2) }}</a></li>
                    @endcanany

                    @canany(['item-create', 'item-view'])
                        <li class="{{ Request::is('admin/inventory/item-list*') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-list.index') }}"
                                class="">{{ trans_choice('module_item', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['item-store-create', 'item-store-view'])
                        <li class="{{ Request::is('admin/inventory/item-store*') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-store.index') }}"
                                class="">{{ trans_choice('module_item_store', 2) }}</a></li>
                    @endcanany

                    @canany(['item-supplier-create', 'item-supplier-view'])
                        <li class="{{ Request::is('admin/inventory/item-supplier*') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-supplier.index') }}"
                                class="">{{ trans_choice('module_item_supplier', 2) }}</a></li>
                    @endcanany

                    @canany(['item-category-create', 'item-category-view'])
                        <li class="{{ Request::is('admin/inventory/item-category*') ? 'active' : '' }}"><a
                                href="{{ route('admin.item-category.index') }}"
                                class="">{{ trans_choice('module_item_category', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['hostel-member-create', 'hostel-member-view', 'hostel-room-create', 'hostel-room-view',
            'hostel-create', 'hostel-view', 'room-type-create', 'room-type-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/hostel*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-hotel"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_hostel', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['hostel-member-create', 'hostel-member-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/hostel-student*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/hostel-staff*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_member', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                <li class="{{ Request::is('admin/hostel-student*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.hostel-student.index') }}"
                                        class="">{{ trans_choice('module_student', 1) }} {{ __('list') }}</a></li>

                                <li class="{{ Request::is('admin/hostel-staff*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.hostel-staff.index') }}"
                                        class="">{{ trans_choice('module_staff', 1) }} {{ __('list') }}</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['hostel-room-create', 'hostel-room-view'])
                        <li class="{{ Request::is('admin/hostel/hostel-room*') ? 'active' : '' }}"><a
                                href="{{ route('admin.hostel-room.index') }}"
                                class="">{{ trans_choice('module_hostel_room', 2) }}</a></li>
                    @endcanany

                    @canany(['hostel-create', 'hostel-view'])
                        <li class="{{ Request::is('admin/hostel/hostel') ? 'active' : '' }}"><a
                                href="{{ route('admin.hostel.index') }}"
                                class="">{{ trans_choice('module_hostel', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['room-type-create', 'room-type-view'])
                        <li class="{{ Request::is('admin/hostel/room-type*') ? 'active' : '' }}"><a
                                href="{{ route('admin.room-type.index') }}"
                                class="">{{ trans_choice('module_room_type', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['transport-member-create', 'transport-member-view', 'transport-vehicle-create',
            'transport-vehicle-view', 'transport-route-create', 'transport-route-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/transport*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-bus-alt"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_transport', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['transport-member-create', 'transport-member-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/transport-student*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/transport-staff*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_member', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                <li class="{{ Request::is('admin/transport-student*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.transport-student.index') }}"
                                        class="">{{ trans_choice('module_student', 1) }} {{ __('list') }}</a></li>

                                <li class="{{ Request::is('admin/transport-staff*') ? 'active' : '' }}"><a
                                        href="{{ route('admin.transport-staff.index') }}"
                                        class="">{{ trans_choice('module_staff', 1) }} {{ __('list') }}</a></li>
                            </ul>
                        </li>
                    @endcanany

                    @canany(['transport-vehicle-create', 'transport-vehicle-view'])
                        <li class="{{ Request::is('admin/transport-vehicle*') ? 'active' : '' }}"><a
                                href="{{ route('admin.transport-vehicle.index') }}"
                                class="">{{ trans_choice('module_transport_vehicle', 2) }}</a></li>
                    @endcanany

                    @canany(['transport-route-create', 'transport-route-view'])
                        <li class="{{ Request::is('admin/transport-route*') ? 'active' : '' }}"><a
                                href="{{ route('admin.transport-route.index') }}"
                                class="">{{ trans_choice('module_transport_route', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['visitor-create', 'visitor-view', 'visitor-print', 'visit-purpose-create', 'visit-purpose-view',
            'visitor-token-setting-view', 'enquiry-create', 'enquiry-view', 'enquiry-source-create', 'enquiry-source-view',
            'enquiry-reference-create', 'enquiry-reference-view', 'phone-log-create', 'phone-log-view', 'complain-create',
            'complain-view', 'complain-type-create', 'complain-type-view', 'complain-source-create', 'complain-source-view',
            'postal-exchange-create', 'postal-exchange-view', 'postal-type-create', 'postal-type-view', 'meeting-create',
            'meeting-view', 'meeting-type-create', 'meeting-type-view'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/frontdesk*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-desktop"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_front_desk', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['visitor-create', 'visitor-view', 'visitor-print'])
                        <li class="{{ Request::is('admin/frontdesk/visit*') ? 'active' : '' }}"><a
                                href="{{ route('admin.visitor.index') }}"
                                class="">{{ trans_choice('module_visitor_log', 2) }}</a></li>
                    @endcanany

                    @canany(['phone-log-create', 'phone-log-view'])
                        <li class="{{ Request::is('admin/frontdesk/phone-log*') ? 'active' : '' }}"><a
                                href="{{ route('admin.phone-log.index') }}"
                                class="">{{ trans_choice('module_phone_log', 2) }}</a></li>
                    @endcanany

                    @canany(['enquiry-create', 'enquiry-view'])
                        <li class="{{ Request::is('admin/frontdesk/enquiry*') ? 'active' : '' }}"><a
                                href="{{ route('admin.enquiry.index') }}"
                                class="">{{ trans_choice('module_enquiry', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['complain-create', 'complaine-view'])
                        <li class="{{ Request::is('admin/frontdesk/complain*') ? 'active' : '' }}"><a
                                href="{{ route('admin.complain.index') }}"
                                class="">{{ trans_choice('module_complain', 1) }} {{ __('list') }}</a></li>
                    @endcanany

                    @canany(['postal-exchange-create', 'postal-exchange-view'])
                        <li class="{{ Request::is('admin/frontdesk/postal*') ? 'active' : '' }}"><a
                                href="{{ route('admin.postal-exchange.index') }}"
                                class="">{{ trans_choice('module_postal_exchange', 2) }}</a></li>
                    @endcanany

                    @canany(['meeting-create', 'meeting-view'])
                        <li class="{{ Request::is('admin/frontdesk/meeting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.meeting.index') }}"
                                class="">{{ trans_choice('module_meeting', 2) }}</a></li>
                    @endcanany

                    @canany(['visit-purpose-create', 'visit-purpose-view', 'visitor-token-setting-view',
                        'enquiry-source-create', 'enquiry-source-view', 'enquiry-reference-create', 'enquiry-reference-view',
                        'complain-type-create', 'complain-type-view', 'complain-source-create', 'complain-source-view',
                        'postal-type-create', 'postal-type-view', 'meeting-type-create', 'meeting-type-view'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/frontdesk/visit-purpose*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/visitor-token-setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/enquiry-source*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/enquiry-reference*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/complain-type*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/complain-source*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/postal-type*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/frontdesk/meeting-type*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @canany(['visit-purpose-create', 'visit-purpose-view'])
                                    <li class="{{ Request::is('admin/frontdesk/visit-purpose*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.visit-purpose.index') }}"
                                            class="">{{ trans_choice('module_visit_purpose', 2) }}</a></li>
                                @endcanany

                                @can('visitor-token-setting-view')
                                    <li class="{{ Request::is('admin/frontdesk/visitor-token-setting*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.visitor-token-setting.index') }}"
                                            class="">{{ trans_choice('module_visitor_token_setting', 2) }}</a></li>
                                @endcan

                                @canany(['enquiry-source-create', 'enquiry-source-view'])
                                    <li class="{{ Request::is('admin/frontdesk/enquiry-source*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.enquiry-source.index') }}"
                                            class="">{{ trans_choice('module_enquiry_source', 2) }}</a></li>
                                @endcanany

                                @canany(['enquiry-reference-create', 'enquiry-reference-view'])
                                    <li class="{{ Request::is('admin/frontdesk/enquiry-reference*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.enquiry-reference.index') }}"
                                            class="">{{ trans_choice('module_enquiry_reference', 2) }}</a></li>
                                @endcanany

                                @canany(['complain-type-create', 'complain-type-view'])
                                    <li class="{{ Request::is('admin/frontdesk/complain-type*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.complain-type.index') }}"
                                            class="">{{ trans_choice('module_complain_type', 2) }}</a></li>
                                @endcanany

                                @canany(['complain-source-create', 'complain-source-view'])
                                    <li class="{{ Request::is('admin/frontdesk/complain-source*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.complain-source.index') }}"
                                            class="">{{ trans_choice('module_complain_source', 2) }}</a></li>
                                @endcanany

                                @canany(['postal-type-create', 'postal-type-view'])
                                    <li class="{{ Request::is('admin/frontdesk/postal-type*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.postal-type.index') }}"
                                            class="">{{ trans_choice('module_postal_type', 2) }}</a></li>
                                @endcanany

                                @canany(['meeting-type-create', 'meeting-type-view'])
                                    <li class="{{ Request::is('admin/frontdesk/meeting-type*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.meeting-type.index') }}"
                                            class="">{{ trans_choice('module_meeting_type', 2) }}</a></li>
                                @endcanany
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['marksheet-view', 'marksheet-print', 'marksheet-download', 'marksheet-setting-view',
            'certificate-view', 'certificate-create', 'certificate-print', 'certificate-download',
            'certificate-template-view', 'certificate-template-create'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/transcript*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-address-card"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_transcript', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @canany(['marksheet-view', 'marksheet-print', 'marksheet-download'])
                        <li class="{{ Request::is('admin/transcript/marksheet-semester*') ? 'active' : '' }}"><a
                                href="{{ route('admin.marksheet.semester') }}"
                                class="">{{ trans_choice('module_marksheet_semester', 2) }}</a></li>
                    @endcanany

                    @canany(['marksheet-view', 'marksheet-print', 'marksheet-download'])
                        <li class="{{ Request::is('admin/transcript/marksheet') ? 'active' : '' }}"><a
                                href="{{ route('admin.marksheet.index') }}"
                                class="">{{ trans_choice('module_marksheet_total', 2) }}</a></li>
                    @endcanany

                    @canany(['marksheet-setting-view'])
                        <li class="{{ Request::is('admin/transcript/marksheet-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.marksheet-setting.index') }}"
                                class="">{{ trans_choice('module_marksheet_setting', 1) }}</a></li>
                    @endcanany

                    @canany(['certificate-view', 'certificate-create', 'certificate-print', 'certificate-download'])
                        <li class="{{ Request::is('admin/transcript/certificate*') ? 'active' : '' }}"><a
                                href="{{ route('admin.certificate.index') }}"
                                class="">{{ trans_choice('module_certificate', 2) }}</a></li>
                    @endcanany

                    @canany(['certificate-template-view', 'certificate-template-create'])
                        <li class="{{ Request::is('admin/transcript/certificate-template*') ? 'active' : '' }}"><a
                                href="{{ route('admin.certificate-template.index') }}"
                                class="">{{ trans_choice('module_certificate_template', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['report-student-progress', 'report-subject-students', 'report-student-attendance',
            'report-subject-attendance', 'report-collected-fees', 'report-student-fees', 'report-salary-paid',
            'report-staff-leaves', 'report-income', 'report-expense', 'report-library', 'report-book-return',
            'report-inventory', 'report-hostel', 'report-transport'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/report*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-chart-line"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_report', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('report-student-progress')
                        <li class="{{ Request::is('admin/report/student') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.student') }}"
                                class="">{{ trans_choice('module_student_progress', 1) }}</a></li>
                    @endcan

                    @can('report-subject-students')
                        <li class="{{ Request::is('admin/report/subject') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.subject') }}"
                                class="">{{ trans_choice('module_course_students', 1) }}</a></li>
                    @endcan

                    @can('report-student-attendance')
                        <li class="{{ Request::is('admin/report/student-attendance') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.student-attendance') }}"
                                class="">{{ trans_choice('module_student_attendance', 1) }}</a></li>
                    @endcan

                    @can('report-subject-attendance')
                        <li class="{{ Request::is('admin/report/subject-attendance') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.subject-attendance') }}"
                                class="">{{ trans_choice('module_student_subject_attendance', 1) }}</a></li>
                    @endcan

                    @can('report-collected-fees')
                        <li class="{{ Request::is('admin/report/fees') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.fees') }}"
                                class="">{{ trans_choice('module_collected_fees', 1) }}</a></li>
                    @endcan

                    @can('report-student-fees')
                        <li class="{{ Request::is('admin/report/student-fees') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.student-fees') }}"
                                class="">{{ trans_choice('module_student_fees', 1) }}</a></li>
                    @endcan

                    @can('report-salary-paid')
                        <li class="{{ Request::is('admin/report/payroll') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.payroll') }}"
                                class="">{{ trans_choice('module_salary_paid', 1) }}</a></li>
                    @endcan

                    @can('report-staff-leaves')
                        <li class="{{ Request::is('admin/report/leave') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.leave') }}"
                                class="">{{ trans_choice('module_staff_leaves', 1) }}</a></li>
                    @endcan

                    @can('report-income')
                        <li class="{{ Request::is('admin/report/income') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.income') }}"
                                class="">{{ trans_choice('module_total_income', 1) }}</a></li>
                    @endcan

                    @can('report-expense')
                        <li class="{{ Request::is('admin/report/expense') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.expense') }}"
                                class="">{{ trans_choice('module_total_expense', 1) }}</a></li>
                    @endcan

                    @can('report-library')
                        <li class="{{ Request::is('admin/report/library') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.library') }}"
                                class="">{{ trans_choice('module_library_history', 1) }}</a></li>
                    @endcan

                    @can('report-book-return')
                        <li class="{{ Request::is('admin/report/book-return') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.book-return') }}"
                                class="">{{ trans_choice('module_book_return_due', 1) }}</a></li>
                    @endcan

                    @can('report-inventory')
                        <li class="{{ Request::is('admin/report/inventory') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.inventory') }}"
                                class="">{{ trans_choice('module_inventory_history', 1) }}</a></li>
                    @endcan

                    @can('report-hostel')
                        <li class="{{ Request::is('admin/report/hostel') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.hostel') }}"
                                class="">{{ trans_choice('module_hostel_members', 1) }}</a></li>
                    @endcan

                    @can('report-transport')
                        <li class="{{ Request::is('admin/report/transport') ? 'active' : '' }}"><a
                                href="{{ route('admin.report.transport') }}"
                                class="">{{ trans_choice('module_transport_members', 1) }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['topbar-setting-view', 'social-setting-view', 'slider-view', 'slider-create', 'about-us-view',
            'feature-view', 'feature-create', 'course-view', 'course-create', 'web-event-view', 'web-event-create',
            'news-view', 'news-create', 'gallery-view', 'gallery-create', 'faq-view', 'faq-create', 'testimonial-view',
            'testimonial-create', 'page-view', 'page-create', 'call-to-action-view', 'about-view', 'about-create',
            'placement-view', 'placement-create', 'academic-view', 'academic-create', 'campus-view', 'campus-create',
            'lab-view', 'lab-create', 'inter-course-view', 'inter-course-create', 'bilash-course-view',
            'bilash-course-create', 'kanchan-course-view', 'kanchan-course-create', 'bed-course-view', 'bed-course-create',
            'pharmacy-course-view', 'pharmacy-course-create', 'nursing-course-view', 'nursing-course-create',
            'rbs-course-view', 'rbs-course-create', 'rsr-course-view', 'rsr-course-create'])
            <li class="nav-item pcoded-hasmenu {{ Request::is('admin/web*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-globe"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_front_web', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('topbar-setting-view')
                        <li class="{{ Request::is('admin/web/topbar-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.topbar-setting.index') }}"
                                class="">{{ trans_choice('module_topbar_setting', 1) }}</a></li>
                    @endcan


                    @can('social-setting-view')
                        <li class="{{ Request::is('admin/web/social-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.social-setting.index') }}"
                                class="">{{ trans_choice('module_social_setting', 1) }}</a></li>
                    @endcan


                    @canany(['slider-view', 'slider-create'])
                        <li class="{{ Request::is('admin/web/slider*') ? 'active' : '' }}"><a
                                href="{{ route('admin.slider.index') }}"
                                class="">{{ trans_choice('module_slider', 2) }}</a></li>
                    @endcanany

                    @can('about-us-view')
                        <li class="{{ Request::is('admin/web/about-us*') ? 'active' : '' }}"><a
                                href="{{ route('admin.about-us.index') }}"
                                class="">{{ trans_choice('module_about_us', 1) }}</a></li>
                    @endcan


                    @canany(['feature-view', 'feature-create'])
                        <li class="{{ Request::is('admin/web/feature*') ? 'active' : '' }}"><a
                                href="{{ route('admin.feature.index') }}"
                                class="">{{ trans_choice('module_feature', 2) }}</a></li>
                    @endcanany
                    @canany(['about-view', 'about-create'])
                        <li class="{{ Request::is('admin/web/about*') ? 'active' : '' }}"><a
                                href="{{ route('admin.about.index') }}"
                                class="">{{ trans_choice('module_about', 2) }}</a></li>
                    @endcanany

                    @canany(['course-view', 'course-create'])
                        <li class="{{ Request::is('admin/web/course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.course.index') }}"
                                class="">{{ trans_choice('module_course', 2) }}</a></li>
                    @endcanany
                    @canany(['inter-course-view', 'inter-course-create'])
                        <li class="{{ Request::is('admin/web/inter-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.inter-course.index') }}"
                                class="">{{ trans_choice('module_inter_course', 2) }}</a></li>
                    @endcanany
                    @canany(['bilash-course-view', 'bilash-course-create'])
                        <li class="{{ Request::is('admin/web/bilash-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.bilash-course.index') }}"
                                class="">{{ trans_choice('module_bilash_course', 2) }}</a></li>
                    @endcanany
                    @canany(['kanchan-course-view', 'kanchan-course-create'])
                        <li class="{{ Request::is('admin/web/kanchan-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.kanchan-course.index') }}"
                                class="">{{ trans_choice('module_kanchan_course', 2) }}</a></li>
                    @endcanany
                    @canany(['bed-course-view', 'bed-course-create'])
                        <li class="{{ Request::is('admin/web/bed-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.bed-course.index') }}"
                                class="">{{ trans_choice('module_bed_course', 2) }}</a></li>
                    @endcanany
                    @canany(['pharmacy-course-view', 'pharmacy-course-create'])
                        <li class="{{ Request::is('admin/web/pharmacy-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.pharmacy-course.index') }}"
                                class="">{{ trans_choice('module_pharmacy_course', 2) }}</a></li>
                    @endcanany
                    @canany(['nursing-course-view', 'nursing-course-create'])
                        <li class="{{ Request::is('admin/web/nursing-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.nursing-course.index') }}"
                                class="">{{ trans_choice('module_nursing_course', 2) }}</a></li>
                    @endcanany
                    @canany(['rbs-course-view', 'rbs-course-create'])
                        <li class="{{ Request::is('admin/web/rbs-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.rbs-course.index') }}"
                                class="">{{ trans_choice('module_rbs_course', 2) }}</a></li>
                    @endcanany

                    @canany(['rsr-course-view', 'rsr-course-create'])
                        <li class="{{ Request::is('admin/web/rsr-course*') ? 'active' : '' }}"><a
                                href="{{ route('admin.rsr-course.index') }}"
                                class="">{{ trans_choice('module_rsr_course', 2) }}</a></li>
                    @endcanany


                    @canany(['admission-view', 'admission-create'])
                        <li class="{{ Request::is('admin/web/admission*') ? 'active' : '' }}"><a
                                href="{{ route('admin.admission.index') }}"
                                class="">{{ trans_choice('module_admission', 2) }}</a></li>
                    @endcanany

                    @canany(['placement-view', 'placement-create'])
                        <li class="{{ Request::is('admin/web/placement*') ? 'active' : '' }}"><a
                                href="{{ route('admin.placement.index') }}"
                                class="">{{ trans_choice('module_placement', 2) }}</a></li>
                    @endcanany
                    @canany(['academic-view', 'academic-create'])
                        <li class="{{ Request::is('admin/web/academic*') ? 'active' : '' }}"><a
                                href="{{ route('admin.academic.index') }}"
                                class="">{{ trans_choice('module_academic', 2) }}</a></li>
                    @endcanany
                    @canany(['campus-view', 'campus-create'])
                        <li class="{{ Request::is('admin/web/campus*') ? 'active' : '' }}"><a
                                href="{{ route('admin.campus.index') }}"
                                class="">{{ trans_choice('module_campus', 2) }}</a></li>
                    @endcanany
                    @canany(['lab-view', 'lab-create'])
                        <li class="{{ Request::is('admin/web/lab*') ? 'active' : '' }}"><a
                                href="{{ route('admin.lab.index') }}"
                                class="">{{ trans_choice('module_lab', 2) }}</a></li>
                    @endcanany



                    @canany(['web-event-view', 'web-event-create'])
                        <li class="{{ Request::is('admin/web/web-event*') ? 'active' : '' }}"><a
                                href="{{ route('admin.web-event.index') }}"
                                class="">{{ trans_choice('module_event', 2) }}</a></li>
                    @endcanany

                    @canany(['news-view', 'news-create'])
                        <li class="{{ Request::is('admin/web/news*') ? 'active' : '' }}"><a
                                href="{{ route('admin.news.index') }}"
                                class="">{{ trans_choice('module_news', 2) }}</a></li>
                    @endcanany

                    @canany(['faq-view', 'faq-create'])
                        <li class="{{ Request::is('admin/web/faq*') ? 'active' : '' }}"><a
                                href="{{ route('admin.faq.index') }}"
                                class="">{{ trans_choice('module_faq', 2) }}</a></li>
                    @endcanany

                    @canany(['gallery-view', 'gallery-create'])
                        <li class="{{ Request::is('admin/web/gallery*') ? 'active' : '' }}"><a
                                href="{{ route('admin.gallery.index') }}"
                                class="">{{ trans_choice('module_gallery', 2) }}</a></li>
                    @endcanany

                    @canany(['testimonial-view', 'testimonial-create'])
                        <li class="{{ Request::is('admin/web/testimonial*') ? 'active' : '' }}"><a
                                href="{{ route('admin.testimonial.index') }}"
                                class="">{{ trans_choice('module_testimonial', 2) }}</a></li>
                    @endcanany

                    @canany(['page-view', 'page-create'])
                        <li class="{{ Request::is('admin/web/page*') ? 'active' : '' }}"><a
                                href="{{ route('admin.page.index') }}"
                                class="">{{ trans_choice('module_footer_page', 2) }}</a></li>
                    @endcanany

                    @can('call-to-action-view')
                        <li class="{{ Request::is('admin/web/call-to-action*') ? 'active' : '' }}"><a
                                href="{{ route('admin.call-to-action.index') }}"
                                class="">{{ trans_choice('module_call_to_action', 1) }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['setting-view', 'province-view', 'province-create', 'district-view', 'district-create',
            'language-view', 'language-create', 'translations-view', 'translations-create', 'setting-mail', 'setting-sms',
            'setting-payment', 'application-setting-view', 'schedule-setting-view', 'role-view', 'role-edit', 'field-staff',
            'field-student', 'field-application', 'student-panel-view'])
            <li
                class="nav-item pcoded-hasmenu {{ Request::is('admin/setting*') ? 'pcoded-trigger active' : '' }} {{ Request::is('admin/translations*') ? 'pcoded-trigger active' : '' }}">
                <a href="#!" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-cog"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_setting', 2) }}</span>
                </a>
                <ul class="pcoded-submenu">

                    @can('setting-second-view')
                        <li class="{{ Request::is('admin/setting/second') ? 'active' : '' }}"><a
                                href="{{ route('admin.setting.second.index') }}"
                                class="">{{ trans_choice('module_general_setting_second', 1) }}</a></li>
                    @endcan

                    @canany(['province-view', 'province-create'])
                        <li class="{{ Request::is('admin/setting/province*') ? 'active' : '' }}"><a
                                href="{{ route('admin.province.index') }}"
                                class="">{{ trans_choice('module_province', 2) }}</a></li>
                    @endcanany

                    @canany(['district-view', 'district-create'])
                        <li class="{{ Request::is('admin/setting/district*') ? 'active' : '' }}"><a
                                href="{{ route('admin.district.index') }}"
                                class="">{{ trans_choice('module_district', 2) }}</a></li>
                    @endcanany

                    @canany(['language-view', 'language-create'])
                        <li class="{{ Request::is('admin/setting/language*') ? 'active' : '' }}"><a
                                href="{{ route('admin.language.index') }}"
                                class="">{{ trans_choice('module_language', 2) }}</a></li>
                    @endcanany

                    @canany(['translations-view', 'translations-create'])
                        <li class="{{ Request::is('admin/translations*') ? 'active' : '' }}"><a
                                href="{{ route('admin.translations.index') }}"
                                class="">{{ trans_choice('module_translate', 2) }}</a></li>
                    @endcanany

                    @can('setting-mail')
                        <li class="{{ Request::is('admin/setting/mail-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.mail-setting.index') }}"
                                class="">{{ trans_choice('module_mail_setting', 1) }}</a></li>
                    @endcan

                    @can('setting-sms')
                        <li class="{{ Request::is('admin/setting/sms-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.sms-setting.index') }}"
                                class="">{{ trans_choice('module_sms_setting', 2) }}</a></li>
                    @endcan

                    @can('setting-payment')
                        <li class="{{ Request::is('admin/setting/payment-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.payment-setting.index') }}"
                                class="">{{ trans_choice('module_payment_setting', 2) }}</a></li>
                    @endcan

                    @can('application-setting-view')
                        <li class="{{ Request::is('admin/setting/application-setting*') ? 'active' : '' }}"><a
                                href="{{ route('admin.application-setting.index') }}"
                                class="">{{ trans_choice('module_application_setting', 1) }}</a></li>
                    @endcan

                    {{-- @can('schedule-setting-view')
                <li class="{{ Request::is('admin/setting/schedule-setting*') ? 'active' : '' }}"><a href="{{ route('admin.schedule-setting.index') }}" class="">{{ trans_choice('module_schedule_setting', 1) }}</a></li>
                @endcan --}}

                    @canany(['role-view', 'role-edit'])
                        <li class="{{ Request::is('admin/setting/role*') ? 'active' : '' }}"><a
                                href="{{ route('admin.role.index') }}"
                                class="">{{ trans_choice('module_role', 2) }}</a></li>
                    @endcanany

                    @canany(['field-staff', 'field-student', 'field-application'])
                        <li
                            class="nav-item pcoded-hasmenu {{ Request::is('admin/setting/field*') ? 'pcoded-trigger active' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-mtext">{{ trans_choice('module_field_setting', 2) }}</span>
                            </a>

                            <ul class="pcoded-submenu">
                                @canany(['field-staff'])
                                    <li class="{{ Request::is('admin/setting/field-user*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.field.user') }}"
                                            class="">{{ trans_choice('module_staff', 2) }}</a></li>
                                @endcan

                                @canany(['field-student'])
                                    <li class="{{ Request::is('admin/setting/field-student*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.field.student') }}"
                                            class="">{{ trans_choice('module_student', 2) }}</a></li>
                                @endcan

                                @canany(['field-application'])
                                    <li class="{{ Request::is('admin/setting/field-application*') ? 'active' : '' }}"><a
                                            href="{{ route('admin.field.application') }}"
                                            class="">{{ trans_choice('module_application', 2) }}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['student-panel-view'])
                        <li class="{{ Request::is('admin/setting/student-panel*') ? 'active' : '' }}"><a
                                href="{{ route('admin.student.panel') }}"
                                class="">{{ trans_choice('module_student_panel', 2) }}</a></li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['profile-view', 'profile-edit'])
            <li class="nav-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <a href="{{ route('admin.profile.index') }}" class="nav-link">
                    <span class="pcoded-micon"><i class="fas fa-user-edit"></i></span>
                    <span class="pcoded-mtext">{{ trans_choice('module_profile', 2) }}</span>
                </a>
            </li>
        @endcanany

    </ul>
</div>
<!-- End Sidebar -->
