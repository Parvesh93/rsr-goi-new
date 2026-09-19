@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <!--<div>Ram</div>-->
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }} {{ __('list') }}</h5>
                        </div>
                        <!--<div class="card-block">-->
                        <!--    @can($access . '-create')
        -->
                            <!--        <a href="{{ route($route . '.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>-->
                            <!--            {{ __('btn_add_new') }}</a>-->
                            <!--
    @endcan-->


                        <!--    <a href="{{ route('student.reset') }}" hidden class="btn btn-primary"><i class="fas fa-plus"></i>-->
                        <!--            Reset</a>-->

                        <!--    <a href="{{ route($route . '.index') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i>-->
                        <!--        {{ __('btn_refresh') }}</a>-->

                        <!--    @can($access . '-import')
        -->
                            <!--        <a href="{{ route($route . '.import') }}" class="btn btn-dark"><i class="fas fa-upload"></i>-->
                            <!--            {{ __('btn_import') }}</a>-->
                            <!--
    @endcan-->

                        <!--    @isset($rows)-->
                            <!--        @can($access . '-password-print')
            -->
                                <!--            <form class="needs-validation d-inline" novalidate method="get"-->
                                <!--                action="{{ route($route . '.password-multiprint') }}" target="_blank">-->
                                <!--                <input type="hidden" name="students" class="students" value="">-->
                                <!--                <button type="submit" class="btn btn-sm btn-dark print-btn"><i class="fas fa-print"></i>-->
                                <!--                    {{ __('field_password') }}</button>-->
                                <!--            </form>-->
                                <!--
        @endcan-->
                        <!--    @endisset-->
                        <!--</div>-->

                        <div class="card-block">
                            <form class="needs-validation" novalidate method="get"
                                action="{{ route('admin.income.feesCollection') }}">
                                <div class="row gx-2">

                                    <div class="form-group col-md-3">
                                        <label for="department">{{ 'College Department' }}</label>
                                        <select class="form-control department" name="department" id="department" required>
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if ($college_department == $department->id) selected @endif>
                                                    {{ $department->title }}</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'College Department' }}
                                        </div>
                                    </div>

                                    @include('common.inc.student_search_filter')

                                    <div class="form-group col-md-3">
                                        <label for="status">{{ __('field_status') }}</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    @if ($selected_status == $status->id) selected @endif>{{ $status->title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_status') }}
                                        </div>
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="student_id">{{ __('field_student_id') }}</label>
                                        <input type="text" class="form-control" name="student_id" id="student_id"
                                            value="{{ $selected_student_id }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_student_id') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="student_regi">{{ __('field_regis_no') }}</label>
                                        <input type="text" class="form-control" name="student_regi" id="student_regi"
                                            value="{{ $selected_student_regi }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_regis_no') }}
                                        </div>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="person">{{ 'Reference Person Name' }}</label>
                                        <select class="form-control" name="person" id="person" required>
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($persons as $person)
                                                <option value="{{ $person }}"
                                                    @if ($selected_person == $person) selected @endif>{{ $person }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'Reference Person Name' }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i>
                                            {{ __('btn_search') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @isset($rows)
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">

                                
                                    <form class="needs-validation d-inline" novalidate method="get"
                                        action="{{ route('admin.fees-receipt.multiprint') }}" target="_blank">
                                        <input type="hidden" name="students" class="students" value="">
                                        <button type="button" class="btn btn-sm btn-dark print-btn"><i class="fas fa-print"></i>
                                            {{ __('btn_print') }} {{ __('field_selected') }}</button>
                                    </form>
                                

                            </div>
                            <div class="card-block">
                                <!-- [ Data table ] start -->
                                <div class="table-responsive">
                                    <table id="export-table" class="display table nowrap table-striped table-hover"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="checkbox checkbox-success d-inline">
                                                        <input type="checkbox" id="checkbox" class="all_select">
                                                        <label for="checkbox" class="cr"
                                                            style="margin-bottom: 0px;"></label>
                                                    </div>
                                                </th>
                                                <th>{{ __('field_student_id') }}</th>
                                                <th>{{ __('field_regis_no') }}</th>
                                                <th>{{ __('field_name') }}</th>
                                                <th>{{ __('field_program') }}</th>
                                                <th>{{ __('field_session') }}</th>
                                                <th>{{ __('field_semester') }}</th>
                                                <!--<th>{{ __('field_section') }}</th>-->
                                                <th>{{ __('field_status') }}</th>
                                                <!--<th>{{ 'CLC' }}</th>-->
                                                <th>{{ __('field_action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rows as $key => $row)
                                                @php
                                                    $enroll = \App\Models\Student::enroll($row->id);
                                                @endphp
                                                <tr>
                                                    <td>
                                                       
                                                        <div class="checkbox checkbox-primary d-inline">
                                                            <input type="checkbox" data_id="{{ $row->id }}"
                                                                id="checkbox-{{ $row->id }}" value="{{ $row->id }}">
                                                            <label for="checkbox-{{ $row->id }}" class="cr"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route($route . '.show', $row->id) }}">
                                                            {{ $row->student_id }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $row->registration_no }}</td>
                                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                                    <td>{{ $row->program->title ?? '' }}</td>
                                                    <td>{{ $enroll->session->title ?? '' }}</td>
                                                    <td>{{ $enroll->semester->title ?? '' }}</td>
                                                    <!--<td>{{ $enroll->section->title ?? '' }}</td>-->
                                                    <td>
                                                        @foreach ($row->statuses as $key => $status)
                                                            <span class="badge badge-primary">{{ $status->title }}</span><br>
                                                        @endforeach
                                                    </td>

                                                    <!--<td>-->
                                                    <!--    @can($access . '-card')
            -->
                                                        <!--        @if (isset($print))
            -->
                                                        <!--            <a href="#" class="btn btn-icon btn-dark btn-sm"-->
                                                        <!--                onclick="PopupWin('{{ route($route . '.cls', ['id' => $row->id]) }}', '{{ 'StudentCLS' }}', 1000, 600);">-->
                                                        <!--                <i class="fas fa-print"></i>-->
                                                        <!--            </a>-->
                                                        <!--
            @endif-->
                                                        <!--
        @endcan-->
                                                    <!--</td>-->

                                                    <td>
                                                        @can($access . '-edit')
                                                            <a href="{{ route('admin.edit.income.feesCollection', $row->id) }}"
                                                                class="btn btn-icon btn-primary btn-sm">
                                                                <i class="fa fa-inr"></i>
                                                            </a>
                                                        @endcan

                                                        <a href="#" class="btn btn-icon btn-dark btn-sm"
                                                            onclick="PopupWin('{{ route('admin.fees-receipt.print', ['id' => $row->id]) }}', '{{ $title }}', 1000, 600);">
                                                            <i class="fas fa-print"></i>
                                                        </a>

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
                @endisset

            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    {{-- <script type="text/javascript">
    "use strict";
    $(document).ready(function() {
        $(".print-btn").on('click',function(e){

            var numberOfChecked = $("input[data_id]:checked").length;
            if(numberOfChecked <= 0){
                e.preventDefault();
                alert("{{ __('select') }} {{ __('field_student_id') }}");
            }

            var students = [];
            $.each($("input[data_id]:checked"), function(){
                students.push($(this).val());
            });

            $(".students").val( students.join(',') );
        });
    });

    // checkbox all-check-button selector
    $(".all_select").on('click',function(e){
        if($(this).is(":checked")){
            // check all checkbox
            $("input:checkbox").prop('checked', true);
        }
        else if($(this).is(":not(:checked)")){
            // uncheck all checkbox
            $("input:checkbox").prop('checked', false);
        }
    });
    </script> --}}

    <script>
        "use strict";

        $(document).ready(function() {

            $(".print-btn").on("click", function(e) {
                e.preventDefault();

                let checked = $("input[data_id]:checked");

                if (checked.length === 0) {
                    alert("{{ __('select') }} {{ __('field_student_id') }}");
                    return;
                }

                let students = [];
                checked.each(function() {
                    students.push($(this).val());
                });

                $(".students").val(students.join(','));

                let form = $(this).closest("form")[0];

                // ⏱️ Delay before submit
                setTimeout(function() {
                    form.submit(); // 🔥 multiprint page open
                }, 800);
            });

        });

        // Select all checkbox
        $(".all_select").on("click", function() {
            $("input:checkbox").prop("checked", this.checked);
        });
    </script>



@endsection
