@extends('admin.layouts.master')
@section('title', $title)
@section('page_css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/lightbox2-master/css/lightbox.min.css') }}">
@endsection
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card user-card user-card-1">
                        <div class="card-body pb-0">
                            @php $student = $row; @endphp
                            @php
                                $curr_enroll = \App\Models\Student::enroll($row->id);
                            @endphp

                            <div class="media user-about-block align-items-center mt-0 mb-3">
                                <div class="position-relative d-inline-block">
                                    @if (is_file('uploads/' . $path . '/' . $row->photo))
                                        <img src="{{ asset('uploads/' . $path . '/' . $row->photo) }}"
                                            class="img-radius img-fluid wid-80" alt="{{ __('field_photo') }}"
                                            onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';">
                                    @else
                                        <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}"
                                            class="img-radius img-fluid wid-80" alt="{{ __('field_photo') }}">
                                    @endif
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-primary bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </div>
                                <div class="media-body ms-3">
                                    <h6 class="mb-1">{{ $row->first_name }} {{ $row->last_name }}</h6>
                                    @if (isset($row->student_id))
                                        <p class="mb-0 text-muted">Roll No:{{ $row->student_id }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="far fa-envelope m-r-10"></i>{{ __('field_email') }} :
                                </span>
                                <span class="float-end">{{ $row->email }}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="fas fa-phone-alt m-r-10"></i>{{ __('field_phone') }} :
                                </span>
                                <span class="float-end">{{ $row->phone }}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="fas fa-users m-r-10"></i>{{ __('field_batch') }} : </span>
                                <span class="float-end">{{ $row->batch->title ?? '' }}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="fas fa-graduation-cap m-r-10"></i>{{ __('field_program') }}
                                    : </span>
                                <span class="float-end">{{ $row->program->title ?? '' }}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="f-w-500"><i
                                        class="far fa-calendar-alt m-r-10"></i>{{ __('field_admission_date') }} : </span>
                                <span class="float-end">
                                    @if (isset($setting->date_format))
                                        {{ date($setting->date_format, strtotime($row->admission_date)) }}
                                    @else
                                        {{ date('Y-m-d', strtotime($row->admission_date)) }}
                                    @endif
                                </span>
                            </li>
                            @if (isset($row->registration_no))
                                <li class="list-group-item border-bottom-0">
                                    <span class="f-w-500"><i
                                            class="far fa-question-circle m-r-10"></i>{{ __('field_registration_no') }} :
                                    </span>
                                    <span class="float-end">{{ $row->registration_no }}</span>
                                </li>
                            @endif
                        </ul>

                        @php
                            $total_credits = 0;
                            $total_cgpa = 0;
                        @endphp
                        @foreach ($row->studentEnrolls as $key => $item)
                            @if (isset($item->subjectMarks))
                                @foreach ($item->subjectMarks as $mark)
                                    @php
                                        $marks_per = round($mark->total_marks);
                                    @endphp

                                    @foreach ($grades as $grade)
                                        @if ($marks_per >= $grade->min_mark && $marks_per <= $grade->max_mark)
                                            @php
                                                if ($grade->point > 0) {
                                                    $total_cgpa =
                                                        $total_cgpa + $grade->point * $mark->subject->credit_hour;
                                                    $total_credits = $total_credits + $mark->subject->credit_hour;
                                                }
                                            @endphp
                                            @break
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                        @endforeach
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col">
                                    <h6 class="mb-1">{{ number_format((float) $total_credits, 2, '.', '') }}</h6>
                                    <p class="mb-0">{{ __('field_total_credit_hour') }}</p>
                                </div>
                                <div class="col border-start">
                                    <h6 class="mb-1">
                                        @php
                                            if ($total_credits <= 0) {
                                                $total_credits = 1;
                                            }
                                            $com_gpa = $total_cgpa / $total_credits;
                                            echo number_format((float) $com_gpa, 2, '.', '');
                                        @endphp
                                    </h6>
                                    <p class="mb-0">{{ __('field_cumulative_gpa') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    function field($slug)
                    {
                        return \App\Models\Field::field($slug);
                    }
                @endphp
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-block">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="row gx-2 scheduler-border">
                                            @if (field('student_father_name')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_father_name') }}:</mark>
                                                    {{ $row->father_name }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_father_occupation')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_father_occupation') }}:</mark>
                                                    {{ $row->father_occupation }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_mother_name')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_mother_name') }}:</mark>
                                                    {{ $row->mother_name }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_mother_occupation')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_mother_occupation') }}:</mark>
                                                    {{ $row->mother_occupation }}</p>
                                                <hr />
                                            @endif

                                            <p><mark class="text-primary">{{ __('field_gender') }}:</mark>
                                                @if ($row->gender == 1)
                                                    {{ __('gender_male') }}
                                                @elseif($row->gender == 2)
                                                    {{ __('gender_female') }}
                                                @elseif($row->gender == 3)
                                                    {{ __('gender_other') }}
                                                @endif
                                            </p>
                                            <hr />

                                            <p><mark class="text-primary">{{ __('field_dob') }}:</mark>
                                                @if (isset($setting->date_format))
                                                    {{ date($setting->date_format, strtotime($row->dob)) }}
                                                @else
                                                    {{ date('Y-m-d', strtotime($row->dob)) }}
                                                @endif
                                            </p>
                                            <hr />

                                            @if (field('student_emergency_phone')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_emergency_phone') }}:</mark>
                                                    {{ $row->emergency_phone }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_religion')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_religion') }}:</mark>
                                                    {{ $row->religion }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_caste')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_caste') }}:</mark>
                                                    {{ $row->caste }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_mother_tongue')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_mother_tongue') }}:</mark>
                                                    {{ $row->mother_tongue }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_nationality')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_nationality') }}:</mark>
                                                    {{ $row->nationality }}</p>
                                                <hr />
                                            @endif

                                            @if (field('student_marital_status')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_marital_status') }}:</mark>
                                                    @if ($row->marital_status == 1)
                                                        {{ __('marital_status_single') }}
                                                    @elseif($row->marital_status == 2)
                                                        {{ __('marital_status_married') }}
                                                    @elseif($row->marital_status == 3)
                                                        {{ __('marital_status_widowed') }}
                                                    @elseif($row->marital_status == 4)
                                                        {{ __('marital_status_divorced') }}
                                                    @elseif($row->marital_status == 5)
                                                        {{ __('marital_status_other') }}
                                                    @endif
                                                </p>
                                                <hr />
                                            @endif

                                            @if (field('student_blood_group')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_blood_group') }}:</mark>
                                                    @if ($row->blood_group == 1)
                                                        {{ __('A+') }}
                                                    @elseif($row->blood_group == 2)
                                                        {{ __('A-') }}
                                                    @elseif($row->blood_group == 3)
                                                        {{ __('B+') }}
                                                    @elseif($row->blood_group == 4)
                                                        {{ __('B-') }}
                                                    @elseif($row->blood_group == 5)
                                                        {{ __('AB+') }}
                                                    @elseif($row->blood_group == 6)
                                                        {{ __('AB-') }}
                                                    @elseif($row->blood_group == 7)
                                                        {{ __('O+') }}
                                                    @elseif($row->blood_group == 8)
                                                        {{ __('O-') }}
                                                    @endif
                                                </p>
                                                <hr />
                                            @endif

                                            @if (field('student_national_id')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_national_id') }}:</mark>
                                                    {{ $row->national_id }}</p>
                                                <hr />
                                            @endif
                                            @if (field('student_passport_no')->status == 1)
                                                <p><mark class="text-primary">{{ __('field_passport_no') }}:</mark>
                                                    {{ $row->passport_no }}</p>
                                            @endif
                                            
                                            <p><mark class="text-primary">{{ "Reference Person Name" }}:</mark>
                                                    {{ $row->refrence_person_name }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        @if (field('student_address')->status == 1)
                                            <fieldset class="row gx-2 scheduler-border">
                                                <legend>{{ __('field_present') }} {{ __('field_address') }}</legend>
                                                <p><mark class="text-primary">{{ __('field_province') }}:</mark>
                                                    {{ $row->presentProvince->title ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_post') }}:</mark>
                                                    {{ $row->present_post ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_script') }}:</mark>
                                                    {{ $row->present_police_station ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_district') }}:</mark>
                                                    {{ $row->present_district ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_address') }}:</mark>
                                                    {{ $row->present_address }}</p>
                                            </fieldset>

                                            <fieldset class="row gx-2 scheduler-border">
                                                <legend>{{ __('field_permanent') }} {{ __('field_address') }}</legend>
                                                <p><mark class="text-primary">{{ __('field_province') }}:</mark>
                                                    {{ $row->permanentProvince->title ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_post') }}:</mark>
                                                    {{ $row->permanent_post ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_script') }}:</mark>
                                                    {{ $row->permanent_police_station ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_district') }}:</mark>
                                                    {{ $row->permanent_district ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_address') }}:</mark>
                                                    {{ $row->permanent_address }}</p>
                                            </fieldset>
                                        @endif

                                        <fieldset class="row gx-2 scheduler-border">
                                            <p><mark class="text-primary">{{ __('field_hostel') }}:</mark>
                                                {{ $row->hostelRoom->room->hostel->name ?? '' }}</p>
                                            <hr />
                                            <p><mark class="text-primary">{{ __('field_room') }}:</mark>
                                                {{ $row->hostelRoom->room->name ?? '' }}</p>
                                            <hr />
                                        </fieldset>
                                        <fieldset class="row gx-2 scheduler-border">
                                            <p><mark class="text-primary">{{ __('field_route') }}:</mark>
                                                {{ $row->transport->transportRoute->title ?? '' }}</p>
                                            <hr />
                                            <p><mark class="text-primary">{{ __('field_vehicle') }}:</mark>
                                                {{ $row->transport->transportVehicle->number ?? '' }}</p>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-transcript-tab" data-bs-toggle="pill"
                                        href="#pills-transcript" role="tab" aria-controls="pills-transcript"
                                        aria-selected="true">{{ __('tab_transcript') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-educational-tab" data-bs-toggle="pill"
                                        href="#pills-educational" role="tab" aria-controls="pills-educational"
                                        aria-selected="false">{{ __('tab_educational_info') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-fees-details-tab" data-bs-toggle="pill"
                                        href="#pills-fees-details" role="tab" aria-controls="pills-fees-details"
                                        aria-selected="false">{{ 'Fees Details' }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="pills-fees-tab" data-bs-toggle="pill" href="#pills-fees"
                                        role="tab" aria-controls="pills-fees"
                                        aria-selected="false">{{ __('tab_fees_assign') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-book-tab" data-bs-toggle="pill" href="#pills-book"
                                        role="tab" aria-controls="pills-book"
                                        aria-selected="false">{{ __('tab_book_issues') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-notes-tab" data-bs-toggle="pill" href="#pills-notes"
                                        role="tab" aria-controls="pills-notes"
                                        aria-selected="false">{{ __('tab_notes') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-leave-tab" data-bs-toggle="pill" href="#pills-leave"
                                        role="tab" aria-controls="pills-leave"
                                        aria-selected="false">{{ __('tab_leave') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                                        href="#pills-documents" role="tab" aria-controls="pills-documents"
                                        aria-selected="false">{{ __('tab_documents') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-transcript" role="tabpanel"
                                    aria-labelledby="pills-transcript-tab">
                                    @php
                                        $semesters_check = 0;
                                        $semester_items = [];
                                    @endphp

                                    @foreach ($row->studentEnrolls as $key => $enroll)
                                        @if ($semesters_check != $enroll->session->title)
                                            @php
                                                array_push($semester_items, [
                                                    $enroll->session->title,
                                                    $enroll->semester->title,
                                                    $enroll->section->title,
                                                ]);
                                                $semesters_check = $enroll->session->title;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @foreach ($semester_items as $key => $semester_item)
                                        <div class="clearfix"></div>
                                        <div class="table-responsive">
                                            <div class="card-header">
                                                <h5>{{ $semester_item[0] }} | {{ $semester_item[1] }} |
                                                    {{ $semester_item[2] }}</h5>
                                            </div>
                                            <!-- [ Data table ] start -->
                                            <div class="table-responsive">
                                                <table class="display table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('field_code') }}</th>
                                                            <th>{{ __('field_subject') }}</th>
                                                            <th>{{ __('field_credit_hour') }}</th>
                                                            <th>{{ __('field_point') }}</th>
                                                            <th>{{ __('field_grade') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $semester_credits = 0;
                                                            $semester_cgpa = 0;
                                                        @endphp
                                                        @foreach ($row->studentEnrolls as $key => $item)
                                                            @if ($semester_item[1] == $item->semester->title && $semester_item[0] == $item->session->title)

                                                                @foreach ($item->subjects as $subject)
                                                                    @php
                                                                        $semester_credits =
                                                                            $semester_credits + $subject->credit_hour;
                                                                        $subject_grade = null;
                                                                    @endphp

                                                                    <tr>
                                                                        <td>{{ $subject->code }}</td>
                                                                        <td>
                                                                            {{ $subject->title }}
                                                                            @if ($subject->subject_type == 0)
                                                                                ({{ __('subject_type_optional') }})
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ round($subject->credit_hour, 2) }}</td>
                                                                        <td>
                                                                            @if (isset($item->subjectMarks))
                                                                                @foreach ($item->subjectMarks as $mark)
                                                                                    @if ($mark->subject_id == $subject->id)
                                                                                        @if (
                                                                                            (date('Y-m-d', strtotime($mark->publish_date)) == date('Y-m-d') &&
                                                                                                date('H:i:s', strtotime($mark->publish_time)) <= date('H:i:s')) ||
                                                                                                date('Y-m-d', strtotime($mark->publish_date)) < date('Y-m-d'))

                                                                                            @php
                                                                                                $marks_per = round(
                                                                                                    $mark->total_marks,
                                                                                                );
                                                                                            @endphp

                                                                                            @foreach ($grades as $grade)
                                                                                                @if ($marks_per >= $grade->min_mark && $marks_per <= $grade->max_mark)
                                                                                                    {{ number_format((float) $grade->point * $subject->credit_hour, 2, '.', '') }}
                                                                                                    @php
                                                                                                        $semester_cgpa =
                                                                                                            $semester_cgpa +
                                                                                                            $grade->point *
                                                                                                                $subject->credit_hour;
                                                                                                        $subject_grade =
                                                                                                            $grade->title;
                                                                                                    @endphp
                                                                                                    @break
                                                                                                @endif
                                                                                            @endforeach

                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $subject_grade ?? '' }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="2">{{ __('field_term_total') }}</th>
                                                            <th>{{ $semester_credits }}</th>
                                                            <th>{{ number_format((float) $semester_cgpa, 2, '.', '') }}
                                                            </th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- [ Data table ] end -->
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane fade" id="pills-educational" role="tabpanel"
                                    aria-labelledby="pills-educational-tab">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <fieldset class="row gx-2 scheduler-border">
                                                <p><mark class="text-primary">{{ __('field_batch') }}:</mark>
                                                    {{ $row->batch->title ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_program') }}:</mark>
                                                    {{ $row->program->title ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_session') }}:</mark>
                                                    {{ $curr_enroll->session->title ?? '' }}</p>
                                                <hr />
                                                <p><mark class="text-primary">{{ __('field_semester') }}:</mark>
                                                    {{ $curr_enroll->semester->title ?? '' }}</p>
                                                <hr />
                                                 <p><mark class="text-primary">{{ "Admission Mode" }}:</mark>
                                                    {{ $row->admission_mode ?? '' }}</p>
                                                <hr />
                                                

                                                <p><mark class="text-primary">{{ __('field_status') }}:</mark>
                                                    @foreach ($row->statuses as $key => $status)
                                                        <span class="badge badge-primary">{{ $status->title }}</span>
                                                    @endforeach
                                                </p>
                                                <hr />
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            @if (field('student_school_info')->status == 1)
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_school_information') }}</legend>
                                                    <p><mark class="text-primary">{{ __('field_school_name') }}:</mark>
                                                        {{ $row->high_school_name }}</p>
                                                    <hr />
                                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark>
                                                        {{ $row->high_school_address }}</p>
                                                    <hr />
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_year') }}:</mark>
                                                        {{ $row->high_school_graduation_year }}</p>
                                                    <hr />
                                                     <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->high_school_total_marks }}</p><hr/>
                                                     <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->high_school_marks_obtained }}</p><hr/>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_percentage') }}:</mark>
                                                        {{ $row->high_school_graduation_percentage }}</p>
                                                    <hr />
                                                </fieldset>
                                            @endif

                                            @if (field('student_collage_info')->status == 1)
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_college_information') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_intermediate_name') }}:</mark>
                                                        {{ $row->intermediate_name }}</p>
                                                    <hr />
                                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark>
                                                        {{ $row->intermediate_address }}</p>
                                                    <hr />
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_year') }}:</mark>
                                                        {{ $row->intermediate_graduation_year }}</p>
                                                    <hr />
                                                     <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->intermediate_total_marks }}</p><hr/>
                                                     <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->intermediate_marks_obtained }}</p><hr/>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_percentage') }}:</mark>
                                                        {{ $row->inter_graduation_percentage }}</p>
                                                    <hr />
                                                </fieldset>
                                            @endif

                                            
                                        </div>
                                        <div class="col-md-3">
                                           
                                         @if (field('student_bachelor_info')->status == 1)
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_bachelor_information') }}</legend>
                                                    <p><mark class="text-primary">{{ __('field_bachelor_name') }}:</mark>
                                                        {{ $row->intermediate_name }}</p>
                                                    <hr />
                                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark>
                                                        {{ $row->intermediate_address }}</p>
                                                    <hr />
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_year') }}:</mark>
                                                        {{ $row->intermediate_graduation_year }}</p>
                                                    <hr />
                                                     <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->bach_total_marks }}</p><hr/>
                                                     <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->bach_marks_obtained }}</p><hr/>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_percentage') }}:</mark>
                                                        {{ $row->inter_graduation_percentage }}</p>
                                                    <hr />
                                                </fieldset>
                                            @endif

                                            @if (field('student_master_info')->status == 1)
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_master_information') }}</legend>
                                                    <p><mark class="text-primary">{{ __('field_master_name') }}:</mark>
                                                        {{ $row->master_college_name }}</p>
                                                    <hr />
                                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark>
                                                        {{ $row->master_college_address }}</p>
                                                    <hr />
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_year') }}:</mark>
                                                        {{ $row->master_gradu_year }}</p>
                                                    <hr />
                                                     <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->master_total_marks }}</p><hr/>
                                                     <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{$row->master_marks_obtained }}</p><hr/>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_graduation_percentage') }}:</mark>
                                                        {{ $row->master_gradu_percentage }}</p>
                                                    <hr />
                                                </fieldset>
                                            @endif
                                        </div>

                                        <div class="col-md-3">
                                            @if (field('student_relatives')->status == 1)
                                                @foreach ($row->relatives as $key => $relative)
                                                    <fieldset class="row gx-2 scheduler-border">
                                                        <legend>
                                                            {{ __('field_guardians_information') }}-{{ $key + 1 }}
                                                        </legend>
                                                        <p><mark class="text-primary">{{ __('field_relation') }}:</mark>
                                                            {{ $relative->relation }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_name') }}:</mark>
                                                            {{ $relative->name }}</p>
                                                        <hr />
                                                        <p><mark
                                                                class="text-primary">{{ __('field_occupation') }}:</mark>
                                                            {{ $relative->occupation }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_phone') }}:</mark>
                                                            {{ $relative->phone }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_address') }}:</mark>
                                                            {{ $relative->address }}</p>
                                                        <hr />
                                                    </fieldset>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="pills-fees-details" role="tabpanel"
                                    aria-labelledby="pills-fees-details-tab">
                                    <div class="row">
                                        <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ "Total Course Fees " }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ "Total Course Fees " }}:</mark>
                                                        {{ $row->total_course_fees }}</p>
                                                    <hr />

                                                </fieldset>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                              
                                            @if (!empty($row->refrences))
                                                @foreach ($row->refrences as $key => $refrence)
                                                    <fieldset class="row gx-2 scheduler-border">
                                                        <legend>
                                                            {{ __('field_references_information') }}-{{ $key + 1 }}
                                                        </legend>
                                                        <p><mark
                                                                class="text-primary">{{ __('field_refrence_id') }}:</mark>
                                                            {{ $refrence->utr_no }}</p>
                                                        <hr />
                                                        <p><mark
                                                                class="text-primary">{{ __('field_ref_amount') }}:</mark>
                                                            {{ $refrence->ref_amount }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_ref_date') }}:</mark>
                                                            {{ $refrence->ref_date }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_ref_name') }}:</mark>
                                                            {{ $refrence->ref_name }}</p>
                                                        <hr />
                                                    </fieldset>
                                                @endforeach

                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            @if (!empty($row->cashReceived))
                                                @foreach ($row->cashReceived as $key => $cash)
                                                    <fieldset class="row gx-2 scheduler-border">
                                                        <legend>{{ __('field_caase_information') }}-{{ $key + 1 }}
                                                        </legend>
                                                        <p><mark class="text-primary">{{ __('field_cash_id') }}:</mark>
                                                            {{ $cash->utr_no }}</p>
                                                        <hr />
                                                        <p><mark
                                                                class="text-primary">{{ __('field_cash_amount') }}:</mark>
                                                            {{ $cash->cash_amount }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_cash_date') }}:</mark>
                                                            {{ $cash->cash_date }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_cash_name') }}:</mark>
                                                            {{ $cash->cash_name }}</p>
                                                        <hr />
                                                    </fieldset>
                                                @endforeach

                                            @endif
                                        </div>

                                        <div class="col-md-3">

                                            @if (!empty($row->bankReceived))
                                                @foreach ($row->bankReceived as $key => $bank)
                                                    <fieldset class="row gx-2 scheduler-border">
                                                        <legend>{{ __('field_bank_information') }}-{{ $key + 1 }}
                                                        </legend>
                                                        <p><mark class="text-primary">{{ __('field_bank_id') }}:</mark>
                                                            {{ $bank->receipt_no }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_bank_utr_no') }}:</mark>
                                                            {{ $bank->utr_no }}</p>
                                                        <hr />
                                                        <p><mark
                                                                class="text-primary">{{ __('field_bank_amount') }}:</mark>
                                                            {{ $bank->bank_amount }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_bank_date') }}:</mark>
                                                            {{ $bank->bank_date }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_bank_name') }}:</mark>
                                                            {{ $bank->bank_name }}</p>
                                                        <hr />
                                                    </fieldset>
                                                @endforeach
                                            @endif


                                        

                                        </div>


                                        <div class="col-md-3">
                                               @if (!empty($row->deductions))
                                                @foreach ($row->deductions as $key => $deduction)
                                                    <fieldset class="row gx-2 scheduler-border">
                                                        <legend>{{"Any Other Deduction" }}-{{ $key + 1 }}
                                                        </legend>
                                                        <p><mark class="text-primary">{{ __('field_deduction_id') }}:</mark>
                                                            {{ $deduction->utr_no }}</p>
                                                        <hr />
                                                        <p><mark
                                                                class="text-primary">{{ __('field_deduction_amount') }}:</mark>
                                                            {{ $deduction->deduction_amount }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_deduction_date') }}:</mark>
                                                            {{ $deduction->deduction_date }}</p>
                                                        <hr />
                                                        <p><mark class="text-primary">{{ __('field_deduction_names') }}:</mark>
                                                            {{ $deduction->deduction_name }}</p>
                                                        <hr />
                                                    </fieldset>
                                                @endforeach
                                            @endif

                                               
                                        </div>

                                    </div>
                                    <div class="row">
                                        
                                        
                                        <div class="col-md-3">
                                             @if (!empty($row->refTotal))
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_total_ref') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_total_ref') }}:</mark>
                                                        {{ $row->refTotal }}</p>
                                                    <hr />

                                                </fieldset>
                                            @endif
                                            
                                        </div>
                                        
                                        <div class="col-md-3">
                                             @if (!empty($row->cashTotal))
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_total_cash') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_total_cash') }}:</mark>
                                                        {{ $row->cashTotal }}</p>
                                                    <hr />

                                                </fieldset>
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-3">
                                             @if (!empty($row->bankTotal))
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_total_bank') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_total_bank') }}:</mark>
                                                        {{ $row->bankTotal }}</p>
                                                    <hr />

                                                </fieldset>
                                            @endif
                                            
                                        </div>
                                        <div class="col-md-3">
                                             @if (!empty($row->deductionTotal))
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_de_name') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_de_name') }}:</mark>
                                                        {{ $row->deductionTotal }}</p>
                                                    <hr />

                                                </fieldset>
                                            @endif
                                            
                                        </div>
                                        
                                        <div>
                                            @if (!empty($row->total_amounts))
                                                <fieldset class="row gx-2 scheduler-border">
                                                    <legend>{{ __('field_total_information') }}</legend>
                                                    <p><mark
                                                            class="text-primary">{{ __('field_total_information') }}:</mark>
                                                        {{ $row->total_amounts }}</p>
                                                    <hr />

                                                </fieldset>
                                            @endif
                                            
                                        </div>
                                        
                                         
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="pills-fees" role="tabpanel"
                                    aria-labelledby="pills-fees-tab">
                                    <!-- [ Data table ] start -->
                                    @isset($fees)
                                        <div class="table-responsive">
                                            <table id="basic-table" class="display table nowrap table-striped table-hover"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('field_session') }}</th>
                                                        <th>{{ __('field_semester') }}</th>
                                                        <th>{{ __('field_fees_type') }}</th>
                                                        <th>{{ __('field_fee') }}</th>
                                                        <th>{{ __('field_discount') }}</th>
                                                        <th>{{ __('field_fine_amount') }}</th>
                                                        <th>{{ __('field_net_amount') }}</th>
                                                        <th>{{ __('field_due_date') }}</th>
                                                        <th>{{ __('field_status') }}</th>
                                                        <th>{{ __('field_pay_date') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fees->sortByDesc('id') as $key => $row)
                                                        @if ($row->status == 0)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->studentEnroll->session->title ?? '' }}</td>
                                                                <td>{{ $row->studentEnroll->semester->title ?? '' }}</td>
                                                                <td>{{ $row->category->title ?? '' }}</td>
                                                                <td>
                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $row->fee_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $row->fee_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $discount_amount = 0;
                                                                        $today = date('Y-m-d');
                                                                    @endphp

                                                                    @isset($row->category)
                                                                        @foreach ($row->category->discounts->where('status', '1') as $discount)
                                                                            @php
                                                                                $availability = \App\Models\FeesDiscount::availability(
                                                                                    $discount->id,
                                                                                    $row->studentEnroll->student_id,
                                                                                );
                                                                            @endphp

                                                                            @if (isset($availability))
                                                                                @if ($discount->start_date <= $today && $discount->end_date >= $today)
                                                                                    @if ($discount->type == '1')
                                                                                        @php
                                                                                            $discount_amount =
                                                                                                $discount_amount +
                                                                                                $discount->amount;
                                                                                        @endphp
                                                                                    @else
                                                                                        @php
                                                                                            $discount_amount =
                                                                                                $discount_amount +
                                                                                                ($row->fee_amount /
                                                                                                    100) *
                                                                                                    $discount->amount;
                                                                                        @endphp
                                                                                    @endif
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endisset


                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $discount_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $discount_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $fine_amount = 0;
                                                                    @endphp
                                                                    @if (empty($row->pay_date) || $row->due_date < $row->pay_date)
                                                                        @php
                                                                            $due_date = strtotime($row->due_date);
                                                                            $today = strtotime(date('Y-m-d'));
                                                                            $days =
                                                                                (int) (($today - $due_date) / 86400);
                                                                        @endphp

                                                                        @if ($row->due_date < date('Y-m-d'))
                                                                            @isset($row->category)
                                                                                @foreach ($row->category->fines->where('status', '1') as $fine)
                                                                                    @if ($fine->start_day <= $days && $fine->end_day >= $days)
                                                                                        @if ($fine->type == '1')
                                                                                            @php
                                                                                                $fine_amount =
                                                                                                    $fine_amount +
                                                                                                    $fine->amount;
                                                                                            @endphp
                                                                                        @else
                                                                                            @php
                                                                                                $fine_amount =
                                                                                                    $fine_amount +
                                                                                                    ($row->fee_amount /
                                                                                                        100) *
                                                                                                        $fine->amount;
                                                                                            @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endisset
                                                                        @endif
                                                                    @endif


                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $fine_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $fine_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $net_amount =
                                                                            $row->fee_amount -
                                                                            $discount_amount +
                                                                            $fine_amount;
                                                                    @endphp

                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $net_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $net_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->date_format))
                                                                        {{ date($setting->date_format, strtotime($row->due_date)) }}
                                                                    @else
                                                                        {{ date('Y-m-d', strtotime($row->due_date)) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($row->status == 1)
                                                                        <span
                                                                            class="badge badge-pill badge-success">{{ __('status_paid') }}</span>
                                                                    @elseif($row->status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ __('status_canceled') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td></td>
                                                            </tr>
                                                        @elseif($row->status == 1)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->studentEnroll->session->title ?? '' }}</td>
                                                                <td>{{ $row->studentEnroll->semester->title ?? '' }}</td>
                                                                <td>{{ $row->category->title ?? '' }}</td>
                                                                <td>
                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $row->fee_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $row->fee_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $row->discount_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $row->discount_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $row->fine_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $row->fine_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->decimal_place))
                                                                        {{ number_format((float) $row->paid_amount, $setting->decimal_place, '.', '') }}
                                                                    @else
                                                                        {{ number_format((float) $row->paid_amount, 2, '.', '') }}
                                                                    @endif
                                                                    {!! $setting->currency_symbol !!}
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->date_format))
                                                                        {{ date($setting->date_format, strtotime($row->due_date)) }}
                                                                    @else
                                                                        {{ date('Y-m-d', strtotime($row->due_date)) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($row->status == 1)
                                                                        <span
                                                                            class="badge badge-pill badge-success">{{ __('status_paid') }}</span>
                                                                    @elseif($row->status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ __('status_canceled') }}</span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->date_format))
                                                                        {{ date($setting->date_format, strtotime($row->pay_date)) }}
                                                                    @else
                                                                        {{ date('Y-m-d', strtotime($row->pay_date)) }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                        <!-- [ Data table ] end -->
                                    </div>
                                    <div class="tab-pane fade" id="pills-book" role="tabpanel"
                                        aria-labelledby="pills-book-tab">
                                        <!-- [ Data table ] start -->
                                        <div class="table-responsive">
                                            <table id="basic-table2" class="display table nowrap table-striped table-hover"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('field_isbn') }}</th>
                                                        <th>{{ __('field_book') }}</th>
                                                        <th>{{ __('field_issue_date') }}</th>
                                                        <th>{{ __('field_due_return_date') }}</th>
                                                        <th>{{ __('field_return_date') }}</th>
                                                        <th>{{ __('field_status') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @isset($student->member)
                                                        @foreach ($student->member->issuReturn->sortByDesc('id') as $key => $row)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->book->isbn ?? '' }}</td>
                                                                <td>{{ $row->book->title ?? '' }}</td>
                                                                <td>
                                                                    @if (isset($setting->date_format))
                                                                        {{ date($setting->date_format, strtotime($row->issue_date)) }}
                                                                    @else
                                                                        {{ date('Y-m-d', strtotime($row->issue_date)) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($setting->date_format))
                                                                        {{ date($setting->date_format, strtotime($row->due_date)) }}
                                                                    @else
                                                                        {{ date('Y-m-d', strtotime($row->due_date)) }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (!empty($row->return_date))
                                                                        @if (isset($setting->date_format))
                                                                            {{ date($setting->date_format, strtotime($row->return_date)) }}
                                                                        @else
                                                                            {{ date('Y-m-d', strtotime($row->return_date)) }}
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($row->status == 0)
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ __('status_lost') }}</span>
                                                                    @elseif($row->status == 1)
                                                                        @if ($row->due_date < date('Y-m-d'))
                                                                            <span
                                                                                class="badge badge-pill badge-danger">{{ __('status_delay') }}</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-pill badge-primary">{{ __('status_issued') }}</span>
                                                                        @endif
                                                                    @elseif($row->status == 2)
                                                                        <span
                                                                            class="badge badge-pill badge-success">{{ __('status_returned') }}</span>
                                                                        @if ($row->due_date < $row->return_date)
                                                                            <span
                                                                                class="badge badge-pill badge-danger">{{ __('status_delayed') }}</span>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- [ Data table ] end -->
                                    </div>
                                    <div class="tab-pane fade" id="pills-notes" role="tabpanel"
                                        aria-labelledby="pills-notes-tab">
                                        <!-- [ Data table ] start -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('field_date') }}</th>
                                                        <th>{{ __('field_title') }}</th>
                                                        <th>{{ __('field_note') }}</th>
                                                        <th>{{ __('field_attach') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->notes->where('status', 1)->sortBy('id') as $note)
                                                        <tr>
                                                            <td>
                                                                @if (isset($setting->date_format))
                                                                    {{ date($setting->date_format, strtotime($note->created_at)) }}
                                                                @else
                                                                    {{ date('Y-m-d', strtotime($note->created_at)) }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $note->title }}</td>
                                                            <td>{{ $note->description }}</td>
                                                            <td>
                                                                @if (is_file('uploads/note/' . $note->attach))
                                                                    <a href="{{ asset('uploads/note/' . $note->attach) }}"
                                                                        class="btn btn-sm btn-icon btn-dark" download><i
                                                                            class="fas fa-download"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- [ Data table ] end -->
                                    </div>
                                    <div class="tab-pane fade" id="pills-leave" role="tabpanel"
                                        aria-labelledby="pills-leave-tab">
                                        <!-- [ Data table ] start -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('field_leave_date') }}</th>
                                                        <th>{{ __('field_days') }}</th>
                                                        <th>{{ __('field_apply_date') }}</th>
                                                        <th>{{ __('field_status') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($student->leaves->sortByDesc('id') as $leave)
                                                        <tr>
                                                            <td>
                                                                @if (isset($setting->date_format))
                                                                    {{ date($setting->date_format, strtotime($leave->from_date)) }}
                                                                @else
                                                                    {{ date('Y-m-d', strtotime($leave->from_date)) }}
                                                                @endif
                                                                -
                                                                @if (isset($setting->date_format))
                                                                    {{ date($setting->date_format, strtotime($leave->to_date)) }}
                                                                @else
                                                                    {{ date('Y-m-d', strtotime($leave->to_date)) }}
                                                                @endif
                                                            </td>
                                                            <td>{{ (int) ((strtotime($leave->to_date) - strtotime($leave->from_date)) / 86400) + 1 }}
                                                            </td>
                                                            <td>
                                                                @if (isset($setting->date_format))
                                                                    {{ date($setting->date_format, strtotime($leave->apply_date)) }}
                                                                @else
                                                                    {{ date('Y-m-d', strtotime($leave->apply_date)) }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($leave->status == 1)
                                                                    <span
                                                                        class="badge badge-pill badge-success">{{ __('status_approved') }}</span>
                                                                @elseif($leave->status == 2)
                                                                    <span
                                                                        class="badge badge-pill badge-danger">{{ __('status_rejected') }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- [ Data table ] end -->
                                    </div>
                                    <div class="tab-pane fade" id="pills-documents" role="tabpanel"
                                        aria-labelledby="pills-documents-tab">
                                        <!-- [ Data table ] start -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('field_title') }}</th>
                                                        <th>{{ __('field_document') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="row">
                                                        @if (field('application_high_school_certificate')->status == 1)
                                                            @php
                                                                $file = @$row->school_transcript;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->school_transcript))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_high_school_certificate') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_high_school_certificate') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_highschool_certificate')->status == 1)
                                                            @php
                                                                $file = @$row->high_school_certificate;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->high_school_certificate))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_high_school_certificate') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_school_certifiate') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_highschool_slc')->status == 1)
                                                            @php
                                                                $file = @$row->school_slc;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->school_slc))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_high_school_slc') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_high_school_slc') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->school_slc) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_intermediate_certificate')->status == 1)


                                                            @php
                                                                $file = @$row->school_certificate;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->school_certificate))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_intermediate_school_certificate') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_intermediate_school_certificate') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->school_certificate) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_intermediate_migration')->status == 1)


                                                            @php
                                                                $file = @$row->intermediate_migration;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->intermediate_migration))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_intermediate_school_migration') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_intermediate_school_migration') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->intermediate_migration) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_intermadiate_certi')->status == 1)


                                                            @php
                                                                $file = @$row->intermediate_certificate;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->intermediate_certificate))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_intermediate_school_migration') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_intermediate_certifiate') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->intermediate_migration) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_intermediate_clc')->status == 1)


                                                            @php
                                                                $file = @$row->intermediate_clc;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->intermediate_clc))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_intermediate_school_clc') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_intermediate_school_clc') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->intermediate_clc) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif



                                                        @if (field('application_bachelor_certificate')->status == 1)

                                                            @php
                                                                $file = @$row->collage_transcript;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->collage_transcript))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_graduation_certificate') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_graduation_certificate') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->collage_transcript) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_master_certificate')->status == 1)

                                                            @php
                                                                $file = @$row->collage_certificate;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->collage_certificate))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_graduation_clc') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_graduation_clc') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->collage_certificate) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_graduation_migration')->status == 1)

                                                            @php
                                                                $file = @$row->collage_migration;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->collage_migration))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_graduation_migration') }}</span><br-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_graduation_migration') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->collage_migration) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_adhar_card')->status == 1)

                                                            @php
                                                                $file = @$row->adhar_card;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->adhar_card))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_adhar_card') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_adhar_card') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->adhar_card) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_parents_id')->status == 1)

                                                            @php
                                                                $file = @$row->parents_id;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->parents_id))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_parents_id') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_parents_id') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->parents_id) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_pan_card')->status == 1)

                                                            @php
                                                                $file = @$row->pan_card;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->pan_card))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_pan_card') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_pan_card') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->pan_card) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_photo')->status == 1)

                                                            @php
                                                                $file = @$row->photo;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->photo))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_photo') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_photo') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->photo) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if (field('application_signature')->status == 1)

                                                            @php
                                                                $file = @$row->signature;
                                                                $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                                $fileUrl = asset('uploads/student/' . $file);
                                                            @endphp

                                                            <div class="col-md-3">
                                                                @if (is_file('uploads/' . $path . '/' . $row->signature))
                                                                    <!--<a href="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" data-lightbox="gallery">-->
                                                                    <!--    <img src="{{ asset('uploads/' . $path . '/' . $row->school_transcript) }}" class="img-fluid">-->
                                                                    <!--</a>-->
                                                                    <!--<span>{{ __('field_signature') }}</span><br/>-->
                                                                    <p class="mt-1"><mark
                                                                            class="text-primary">{{ __('field_signature') }}
                                                                            {{ __('field_download') }}:</mark> <a
                                                                            href="{{ asset('uploads/' . $path . '/' . $row->signature) }}"
                                                                            class="btn btn-icon btn-dark btn-sm" download><i
                                                                                class="fas fa-download"></i></a></p>
                                                                    @if (strtolower($extension) === 'pdf')

                                                                        <iframe src="{{ $fileUrl }}"
                                                                            class="img-fluid"></iframe>
                                                                    @else
                                                                        <img src="{{ $fileUrl }}" class="img-fluid" />
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @endif

                                                    </div>
                                                    @foreach ($student->documents as $document)
                                                        <tr>
                                                            <td>{{ $document->title }}</td>
                                                            <td>
                                                                @if (is_file('uploads/' . $path . '/' . $document->attach))
                                                                    <a target="__blank"
                                                                        href="{{ asset('uploads/' . $path . '/' . $document->attach) }}"
                                                                        class="btn btn-sm btn-icon btn-dark" download><i
                                                                            class="fas fa-download"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- [ Data table ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
        </div>
        <!-- End Content-->

    @endsection

@section('page_js')
    <script src="{{ asset('dashboard/plugins/lightbox2-master/js/lightbox.min.js') }}"></script>
@endsection
