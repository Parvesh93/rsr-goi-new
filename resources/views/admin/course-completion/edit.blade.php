@extends('admin.layouts.master')
@section('title', $title)
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h5>Edit {{ $title }}</h5></div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="POST" action="{{ route('admin.course-completion.update', ['type' => $type, 'courseCompletion' => $row->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Batch <span>*</span></label>
                                    <select class="form-control" name="batch_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($batches as $batch)
                                            <option value="{{ $batch->id }}" @selected(old('batch_id', $row->batch_id) == $batch->id)>{{ $batch->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('field_program') }} <span>*</span></label>
                                    <select class="form-control" name="program_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" @selected(old('program_id', $row->program_id) == $program->id)>{{ $program->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('field_session') }} <span>*</span></label>
                                    <select class="form-control" name="session_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}" @selected(old('session_id', $row->session_id) == $session->id)>{{ $session->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>{{ __('field_student_id') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="student_id" value="{{ old('student_id', $row->student_id) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Registration No</label>
                                    <input type="text" class="form-control" name="registration_no" value="{{ old('registration_no', $row->registration_no) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{ __('field_name') }} <span>*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $row->name) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Father Name <span>*</span></label>
                                    <input type="text" class="form-control" name="father_name" value="{{ old('father_name', $row->father_name) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Mother Name</label>
                                    <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name', $row->mother_name) }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Board/University/College</label>
                                    <input type="text" class="form-control" name="college_name" value="{{ old('college_name', $row->college_name) }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Certificate Date <span>*</span></label>
                                    <input type="date" class="form-control" name="date" value="{{ old('date', optional($row->date)->format('Y-m-d')) }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Course Start Date <span>*</span></label>
                                    <input type="date" class="form-control" name="course_start_date" value="{{ old('course_start_date', optional($row->course_start_date)->format('Y-m-d')) }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Course End Date <span>*</span></label>
                                    <input type="date" class="form-control" name="course_end_date" value="{{ old('course_end_date', optional($row->course_end_date)->format('Y-m-d')) }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Relieving Date <span>*</span></label>
                                    <input type="date" class="form-control" name="relieving_date" value="{{ old('relieving_date', optional($row->relieving_date)->format('Y-m-d')) }}" required>
                                </div>

                                <div class="form-group col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('btn_update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
