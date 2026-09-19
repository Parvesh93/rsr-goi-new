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
                        <div class="card-block">
                            @can($access . '-create')
                                <a href="{{ route($route . '.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    {{ __('btn_add_new') }}</a>
                            @endcan

                            <a href="{{ route($route . '.index') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i>
                                {{ __('btn_refresh') }}</a>

                        </div>

                        <div class="card-block">
                            <form class="needs-validation" novalidate method="get" action="{{ route($route . '.index') }}">
                                <div class="row gx-2">
                                    {{-- @include('common.inc.student_search_filter') --}}
                                    
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
                                    
                                    <div class="form-group col-md-3">
                                        <label for="faculty">{{ __('field_faculty') }}</label>
                                        <select class="form-control faculty" name="faculty" id="faculty">
                                            <option value="0">{{ __('all') }}</option>
                                            @if (isset($faculties))
                                                @foreach ($faculties->sortBy('title') as $faculty)
                                                    <option value="{{ $faculty->id }}"
                                                        @if ($selected_faculty == $faculty->id) selected @endif>
                                                        {{ $faculty->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_faculty') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="program">{{ __('field_program') }}</label>
                                        <select class="form-control program" name="program" id="program">
                                            <option value="0">{{ __('all') }}</option>
                                            @if (isset($programs))
                                                @foreach ($programs->sortBy('title') as $program)
                                                    <option value="{{ $program->id }}"
                                                        @if ($selected_program == $program->id) selected @endif>
                                                        {{ $program->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_program') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="session">{{ __('field_session') }}</label>
                                        <select class="form-control session" name="session" id="session">
                                            <option value="0">{{ __('all') }}</option>
                                            @if (isset($sessions))
                                                @foreach ($sessions->sortByDesc('id') as $session)
                                                    <option value="{{ $session->id }}"
                                                        @if ($selected_session == $session->id) selected @endif>
                                                        {{ $session->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_session') }}
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
                            <div class="card-block">
                                <!-- [ Data table ] start -->
                                <div class="table-responsive">
                                    <table id="export-table" class="display table nowrap table-striped table-hover"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#
                                                    <div class="checkbox checkbox-success d-inline">
                                                        <input type="checkbox" id="checkbox" class="all_select">
                                                        <label for="checkbox" class="cr"
                                                            style="margin-bottom: 0px;"></label>
                                                    </div>
                                                </th>
                                                <th>{{__('field_serial_no')}}</th>
                                                <th>{{ __('field_student_id') }}</th>
                                                <th>{{ "Registration No" }}</th>
                                                <th>{{ __('field_name') }}</th>
                                                <th>{{ __('field_program') }}</th>
                                                <th>{{ __('field_session') }}</th>
                                                <th>{{ 'CLC' }}</th>
                                                <th>{{ __('field_action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rows as $key => $row)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                        <div class="checkbox checkbox-primary d-inline">
                                                            <input type="checkbox" data_id="{{ $row->id }}"
                                                                id="checkbox-{{ $row->id }}" value="{{ $row->id }}">
                                                            <label for="checkbox-{{ $row->id }}" class="cr"></label>
                                                        </div>
                                                    </td>
                                                     <td>
                                                    {{ $row->clc_no }}
                                                        
                                                    </td>
                                                    <td>
                                                    {{ $row->student_id }}
                                                        
                                                    </td>
                                                    <td>{{ $row->registration_no }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->program->title ?? '' }}</td>
                                                    <td>{{ $row->session->title ?? '' }}</td>



                                                    <td>
                                                        
                                                            
                                                                <a href="#" class="btn btn-icon btn-dark btn-sm"
                                                                    onclick="PopupWin('{{ route($route . '.clc', ['id' => $row->id]) }}', '{{ 'StudentCLS' }}', 1000, 600);">
                                                                    <i class="fas fa-print"></i>
                                                                </a>
                                                          
                                                        
                                                    </td>
                                          
                                                    <td>

                                                       

                                                        @can($access . '-edit')
                                                            <a href="{{ route($route . '.edit', $row->id) }}"
                                                                class="btn btn-icon btn-primary btn-sm">
                                                                <i class="far fa-edit"></i>
                                                            </a>
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
                @endisset

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
    
    $(".department").on('change',function(e){
      e.preventDefault(e);
      var faculty=$(".faculty");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-department-faculty') }}",
        data:{
          _token:$('input[name=_token]').val(),
          department:$(this).val()
        },
        success:function(response){
              console.log("Okk");
            // var jsonData=JSON.parse(response);
            $('option', faculty).remove();
            $('.faculty').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.faculty');
            });
          }

      });
    });
    

     $(".faculty").on('change', function(e) {
        e.preventDefault(e);
        var program = $(".program");
        // var college=$(".college");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('filter-program') }}",
            data: {
                _token: $('input[name=_token]').val(),
                faculty: $(this).val(),
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
