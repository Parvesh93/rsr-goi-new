@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">
@endsection

@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Card ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <!--<div>Ram</div>-->
                        <div class="card-header">
                            <h5>{{ __('modal_edit') }} {{ $title }}</h5>
                        </div>
                        <div class="card-block">
                            <a href="{{ route($route . '.index') }}" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i>
                                {{ __('btn_back') }}</a>

                            <a href="{{ route($route . '.edit', $row->id) }}" class="btn btn-info"><i
                                    class="fas fa-sync-alt"></i>
                                {{ __('btn_refresh') }}</a>
                        </div>

                        @php
                            function field($slug)
                            {
                                return \App\Models\Field::field($slug);
                            }
                        @endphp


                        <div class="">

                            <form id="" class="" action="{{ route($route . '.update', $row->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')

                                {{-- <div>Ram</div> --}}

                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="row scheduler-border">

                                            <div class="form-group col-md-6">
                                                <label for="registration_no">{{ __('field_regis_uni_no') }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control" name="registration_no"
                                                    id="registration_no" value="{{ $row->registration_no }}" required>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_regis_uni_no') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="student_id">{{ __('field_college_id') }} <span>*</span></label>
                                                <input type="text" class="form-control" name="student_id" id="student_id"
                                                    value="{{ $row->student_id }}" required>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_college_id') }}
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="name">{{ 'Student Name' }}
                                                    <span>*</span></label>

                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ $row->name }}" required>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ 'Student Name' }}
                                                </div>
                                            </div>

                                            @if (field('student_father_name')->status == 1)
                                                <div class="form-group col-md-6">
                                                    <label for="father_name">{{ __('field_father_name') }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="father_name"
                                                        id="father_name" value="{{ $row->father_name }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_father_name') }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if (field('student_mother_name')->status == 1)
                                                <div class="form-group col-md-6">
                                                    <label for="mother_name">{{ __('field_mother_name') }}
                                                        <span>*</span></label>
                                                    <input type="text" class="form-control" name="mother_name"
                                                        id="mother_name" value="{{ $row->mother_name }}" required>

                                                    <div class="invalid-feedback">
                                                        {{ __('required_field') }} {{ __('field_mother_name') }}
                                                    </div>
                                                </div>
                                            @endif




                                            <div class="form-group col-md-6">
                                                <label for="batch">{{ __('field_batch') }} <span>*</span></label>
                                                <select class="form-control batch" name="batch" id="batch" required>
                                                    <option value="">{{ __('select') }}</option>
                                                    @foreach ($batches as $batch)
                                                        <option value="{{ $batch->id }}"
                                                            @if ($row->batch_id == $batch->id) selected @endif>
                                                            {{ $batch->title }}</option>
                                                    @endforeach
                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_batch') }}
                                                </div>
                                            </div>




                                            <div class="form-group col-md-6">
                                                <label for="program">{{ __('field_program') }} <span>*</span></label>
                                                <select class="form-control program" name="program" id="program">
                                                    <option value="0">{{ __('all') }}</option>
                                                    @if (isset($programs))
                                                        @foreach ($programs->sortBy('title') as $program)
                                                            <option value="{{ $program->id }}"
                                                                @if ($row->program_id == $program->id) selected @endif>
                                                                {{ $program->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_program') }}
                                                </div>
                                            </div>



                                            <div class="form-group col-md-6">
                                                <label for="session">{{ __('field_session') }} <span>*</span></label>
                                                <select class="form-control session" name="session" id="session">
                                                    <option value="0">{{ __('all') }}</option>
                                                    @if (isset($sessions))
                                                        @foreach ($sessions->sortByDesc('id') as $session)
                                                            <option value="{{ $session->id }}"
                                                                @if ($row->session_id == $session->id) selected @endif>
                                                                {{ $session->title }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_session') }}
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="division">{{ 'Student Passing Division' }}
                                                    <span>*</span></label>
                                                <select class="form-control " name="division" id="division" required>
                                                    <option value="">{{ __('select') }}</option>
                                                    <option value={{ $row->division }}
                                                        @if ($row->division == 'FIRST') selected @endif>
                                                        {{ 'First Division' }} </option>
                                                    <option value={{ $row->division }}
                                                        @if ($row->division == 'SECOND') selected @endif>
                                                        {{ 'Second Division' }} </option>
                                                    <option value={{ $row->division }}
                                                        @if ($row->division == 'THIRD') selected @endif>
                                                        {{ 'Third Division' }} </option>
                                                    <option value={{ $row->division }}
                                                        @if ($row->division == 'FOURTH') selected @endif>
                                                        {{ 'Fourth Division' }} </option>

                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ 'Student Passing Division' }}
                                                </div>
                                            </div>




                                            <div class="form-group col-md-6">
                                                <label for="dob">{{ 'Date' }} <span>*</span></label>
                                                <input type="dob" class="form-control dob" name="dob"
                                                    id="dob" value="{{ $row->date }}" required>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ 'Date' }}
                                                </div>
                                            </div>





                                            <div class="form-group col-md-6">
                                                <label for="college_name">{{ 'Board/University/College' }}
                                                    <span>*</span></label>
                                                <input type="text" class="form-control" name="college_name"
                                                    id="college_name" value="{{ $row->college_name }}" required>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ 'Board/University/College' }}
                                                </div>
                                            </div>









                                            <div class="form-group col-md-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="fas fa-save"></i> {{ __('btn_update') }}</button>


                                            </div>
                                        </fieldset>
                                    </div>
                                </div>





                            </form>
                        </div>

                    </div>
                </div>
                <!-- [ Card ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection


@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>



    <script type="text/javascript">
        "use strict";

        $(".batch").on('change', function(e) {
            e.preventDefault(e);
            var program = $(".program");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('filter-batch') }}",
                data: {
                    _token: $('input[name=_token]').val(),
                    batch: $(this).val(),
                    college: $('.college option:selected').val(),
                },
                success: function(response) {
                    // var jsonData=JSON.parse(response);
                    $('option', program).remove();
                    $('.program').append('<option value="">{{ __('select') }}</option>');
                    $.each(response, function() {
                        $('<option/>', {
                            'value': this.id,
                            'text': this.title
                        }).appendTo('.program');
                    });
                }

            });
        });

        $(".program").on('change', function(e) {
            e.preventDefault(e);
            var session = $(".session");
            var semester = $(".semester");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('filter-session') }}",
                data: {
                    _token: $('input[name=_token]').val(),
                    program: $(this).val(),
                    college: $('.college option:selected').val(),

                },
                success: function(response) {
                    // var jsonData=JSON.parse(response);
                    $('option', session).remove();
                    $('.session').append('<option value="">{{ __('select') }}</option>');
                    $.each(response, function() {
                        $('<option/>', {
                            'value': this.id,
                            'text': this.title
                        }).appendTo('.session');
                    });
                }

            });


        });
    </script>
@endsection
