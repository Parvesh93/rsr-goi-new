@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="needs-validation" novalidate action="{{ route($route . '.departmentinfo') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="card-block row">

                                <!-- Form Start -->
                                <input name="id" type="hidden" value="{{ isset($row->id) ? $row->id : -1 }}">

                                <div class="form-group col-md-4">
                                    <label for="inter_id">{{ 'Inter Id' }} <span>*</span></label>
                                    <select class="form-control" name="inter_id" id="inter_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Inter id' }}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="degree_id">{{ 'Degree Id' }} <span>*</span></label>
                                    <select class="form-control" name="degree_id" id="degree_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Degree id' }}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pharmacy_id">{{ 'Pharmacy Id' }} <span>*</span></label>
                                    <select class="form-control" name="pharmacy_id" id="pharmacy_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Pharmacy id' }}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="nursing_id">{{ 'Nursing Id' }} <span>*</span></label>
                                    <select class="form-control" name="nursing_id" id="nursing_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Nursing id' }}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="education_id">{{ 'Education Id' }} <span>*</span></label>
                                    <select class="form-control" name="education_id" id="education_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Education id' }}
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="engineering_id">{{ 'Engineering Id' }} <span>*</span></label>
                                    <select class="form-control" name="engineering_id" id="engineering_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Engineering id' }}
                                    </div>
                                </div>
                                <hr />

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                    {{ __('btn_update') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection
