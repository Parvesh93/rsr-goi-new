@extends('admin.layouts.master')
@section('title', "Program Condition")
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="needs-validation" novalidate action="{{ route($route . '.program-condition-info') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ "Program Condition" }}</h5>
                            </div>
                            <div class="card-block row">

                                <!-- Form Start -->
                                <input name="id" type="hidden" value="{{ isset($row->id) ? $row->id : -1 }}">

                              
                                <div class="form-group col-md-6">
                                    <label for="ba_id">{{ 'BA Id' }} <span>*</span></label>
                                    <select class="form-control" name="ba_id" id="ba_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->ba_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'BA id' }}
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="b_com_id">{{ 'B.Com Id' }} <span>*</span></label>
                                    <select class="form-control" name="b_com_id" id="b_com_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->b_com_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'B.Com Id' }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="bsc_id">{{ 'B.Sc Id' }} <span>*</span></label>
                                    <select class="form-control" name="bsc_id" id="bsc_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->bsc_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'B.Sc Id' }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="bsc_nursing_id">{{ 'B.Sc Nursing Id' }} <span>*</span></label>
                                    <select class="form-control" name="bsc_nursing_id" id="bsc_nursing_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->bsc_nursing_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'B.Sc Nursing Id' }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gnm_id">{{ 'Gnm Id' }} <span>*</span></label>
                                    <select class="form-control" name="gnm_id" id="gnm_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->gnm_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Gnm Id' }}
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="anm_id">{{ 'Anm Id' }} <span>*</span></label>
                                    <select class="form-control" name="anm_id" id="anm_id" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}" @if (@$row->anm_id == $program->id) selected @endif>
                                                {{ $program->title }}</option>
                                        @endforeach


                                    </select>

                                    <div class="invalid-feedback">
                                        {{ __('required_field') }} {{ 'Anm Id' }}
                                    </div>
                                </div>

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
