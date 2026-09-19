@extends('admin.layouts.master')
@section('title', $title)
@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                @can($access . '-create')
                    <div class="col-md-4">
                        <form class="needs-validation" novalidate action="{{ route($route . '.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ __('btn_create') }} {{ $title }}</h5>
                                </div>
                                <div class="card-block">
                                    <!-- Form Start -->
                                    <div class="form-group ">
                                        <label for="college_department">{{ 'College Department' }}
                                            <span>*</span></label>
                                        <select class="form-control" name="college_department" required>
                                            <option value="">{{ __('select') }}</option>

                                            @foreach ($departments as $key => $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->title }}</option>
                                            @endforeach

                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'College Department' }}
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            value="{{ old('title') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_title') }}
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="clc_college" class="form-label">{{ 'CLC College Name' }}
                                            <span>*</span></label>
                                        <input type="text" class="form-control" name="clc_college" id="clc_college"
                                            value="{{ old('clc_college') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College Name' }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="clc_college_add" class="form-label">{{ 'CLC College Address' }} </label>
                                        <input type="text" class="form-control" name="clc_college_add" id="clc_college_add"
                                            value="{{ old('clc_college_add') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College Address' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="clc_college_run" class="form-label">{{ 'CLC College Running' }} </label>
                                        <input type="text" class="form-control" name="clc_college_run" id="clc_college_run"
                                            value="{{ old('clc_college_run') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College Running' }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="clc_college_reco" class="form-label">{{ 'CLC College Recognized' }}
                                        </label>
                                        <input type="text" class="form-control" name="clc_college_reco" id="clc_college_reco"
                                            value="{{ old('clc_college_reco') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College Recognized' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="clc_college_app" class="form-label">{{ 'CLC College Approved' }} </label>
                                        <input type="text" class="form-control" name="clc_college_app" id="clc_college_app"
                                            value="{{ old('clc_college_app') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College Approved' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="clc_college_veri" class="form-label">{{ 'CLC College Verification' }}
                                        </label>
                                        <input type="text" class="form-control" name="clc_college_veri" id="clc_college_veri"
                                            value="{{ old('clc_college_veri') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'CLC College  Verification' }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="college_email" class="form-label">{{ 'College Email' }}
                                            </label>
                                        <input type="email" class="form-control" name="college_email" id="college_email"
                                            value="{{ old('college_email') }}" >

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'college_email' }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="college_phone" class="form-label">{{ 'College Phone Number' }}
                                            </label>
                                        <input type="text" class="form-control" name="college_phone" id="college_phone"
                                            value="{{ old('college_phone') }}" >

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'College Phone Number' }}
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="attach">{{ "ClC Watermark" }}
                                            <span>{{ __('image_size', ['height' => '1536', 'width' => 1024]) }}</span></label>
                                        <input type="file" class="form-control" name="attach" id="attach"
                                            value="{{ old('attach') }}">

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ "ClC Watermark" }}
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                            <label for="clc_image">{{ "CLC Logo" }}: <span>{{ __('image_size', ['height' => 185, 'width' => 185]) }}</span></label>
                            <input type="file" class="form-control" name="clc_image" id="clc_image" value="{{ old('clc_image') }}">

                            <div class="invalid-feedback">
                              {{ __('required_field') }} {{ "CLC Logo" }}
                            </div>
                        </div>  


                                    <div class="form-group">
                                        <label for="start_date" class="form-label">{{ __('field_start_date') }}
                                            <span>*</span></label>
                                        <input type="date" class="form-control date" name="start_date" id="start_date"
                                            value="{{ old('start_date') }}" required>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_start_date') }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="program">{{ __('field_assign') }} {{ __('field_program') }}
                                            <span>*</span></label>

                                        <div class="checkbox">
                                            <input type="checkbox" name="all_check" id="all_check" class="all_check"
                                                checked>
                                            <label for="all_check" class="cr">{{ __('all') }}</label>
                                        </div>

                                        @foreach ($programs as $key => $program)
                                            <br />
                                            <div class="checkbox d-inline">
                                                <input type="checkbox" class="program" name="programs[]"
                                                    id="program-{{ $key }}" value="{{ $program->id }}" checked>
                                                <label for="program-{{ $key }}"
                                                    class="cr">{{ $program->title }}</label>
                                            </div>
                                        @endforeach

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_program') }}
                                        </div>
                                    </div>
                                    <!-- Form End -->
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
                                        {{ __('btn_save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endcan
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }} {{ __('list') }}</h5>
                        </div>
                        <div class="card-block">
                            <!-- [ Data table ] start -->
                            <div class="table-responsive">
                                <table id="basic-table" class="display table nowrap table-striped table-hover"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('field_title') }}</th>

                                            <th>{{ __('field_start_date') }}</th>
                                            <th>{{"Department"}}</th>
                                            <th>{{ __('field_program') }}</th>
                                            
                                            <!--<th>{{ __('field_thumbnail') }}</th>-->
                                            <th>{{ __('field_status') }}</th>
                                            <th>{{ __('field_action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->title }}</td>
                                                <td>
                                                    @if (isset($setting->date_format))
                                                        {{ date($setting->date_format, strtotime($row->start_date)) }}
                                                    @else
                                                        {{ date('Y-m-d', strtotime($row->start_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{$row->department->title}}</td>
                                                <td>
                                                    @foreach ($row->programs as $key => $program)
                                                        <span class="badge badge-primary">{{ $program->title }}</span><br>
                                                    @endforeach
                                                </td>



                                                <!-- <td>-->

                                                <!--    @if (is_file('uploads/batch/' . $row->clc_college_img))
    -->
                                                <!--    <img style="width:150px; height:150" src="{{ asset('uploads/batch/' . $row->clc_college_img) }}" alt="" srcset="">-->
                                                <!--
    @endif-->
                                                <!--</td>-->

                                                <td>
                                                    @if ($row->status == 1)
                                                        <span
                                                            class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @can($access . '-edit')
                                                        <button type="button" class="btn btn-icon btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal-{{ $row->id }}">
                                                            <i class="far fa-edit"></i>
                                                        </button>
                                                        <!-- Include Edit modal -->
                                                        @include($view . '.edit')
                                                    @endcan

                                                    @can($access . '-delete')
                                                        <button type="button" class="btn btn-icon btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal-{{ $row->id }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                        <!-- Include Delete modal -->
                                                        @include('admin.layouts.inc.delete')
                                                    @endcan
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
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    <script type="text/javascript">
        "use strict";
        // checkbox all-check-button selector
        $(".all_check").on('click', function(e) {
            if ($(this).is(":checked")) {
                // check all checkbox
                $(".program").prop('checked', true);
            } else if ($(this).is(":not(:checked)")) {
                // uncheck all checkbox
                $(".program").prop('checked', false);
            }
        });
    </script>
@endsection
