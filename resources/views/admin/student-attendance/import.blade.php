@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} {{ __('btn_import') }}</h5>
                    </div>
                    <div class="card-block">
                        <a href="{{ route($route.'.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> {{ __('btn_back') }}</a>

                        <a href="{{ route($route.'.import') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                    </div>

                    <div class="card-block">
                        <p>1. Your Excel data should be in the format of the download file. The first line of your Excel file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems. <a href="{{ asset('dashboard/sample/attendance.xlsx') }}" class="text-primary" download>Download Sample File</a></p><hr/>
                        <p>2. If the column you are trying to import is date, Make sure that is formatted in format Y-m-d (2022-06-30). Also keep the excel field format as text instead of date.</p><hr/>
                        <p>3. For "Attendance" use ( P=Present, A=Absent, L=Leave, H=Holiday ).</p><hr/>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <form class="needs-validation" novalidate action="{{ route($route.'.import.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="row gx-2">
                                
                                 <div class="form-group col-md-3">
                                            <label for="batch">{{ __('field_batch') }} <span>*</span></label>
                                            <select class="form-control batch" name="batch" id="batch" required>
                                                <option value="">{{ __('select') }}</option>
                                                @foreach ($batches as $batch)
                                                    <option value="{{ $batch->id }}"
                                                        @if (old('batch') == $batch->id) selected @endif>
                                                        {{ $batch->title }}</option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_batch') }}
                                            </div>
                                </div>
                                 <div class="form-group col-md-3">
                                                <label for="program">{{ __('field_program') }} <span>*</span></label>
                                                <select class="form-control program" name="program" id="program"
                                                    required>
                                                    <option value="">{{ __('select') }}</option>
                                                    @foreach ($programs as $key => $program)
                                                        <option value="{{ $program->id }}">{{ $program->title }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <div class="invalid-feedback">
                                                    {{ __('required_field') }} {{ __('field_program') }}
                                                </div>
                                 </div> 
                                
                                <div class="form-group col-md-3">
                                    <label for="session">{{ __('field_session') }} <span>*</span></label>
                                    <select class="form-control session" name="session" id="session" required>
                                        <option value="">{{ __('select') }}</option>
                                        @foreach( $sessions as $session )
                                        <option value="{{ $session->id }}" @if( old('session') == $session->id) selected @endif>{{ $session->title }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_session') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="subject">{{ __('field_subject') }} <span>*</span></label>
                                    <select class="form-control subject" name="subject" id="subject" required>
                                        <option value="">{{ __('select') }}</option>
                                        @if(isset($subjects))
                                        @foreach( $subjects->sortBy('code') as $subject )
                                        <option value="{{ $subject->id }}" @if( old('subject') == $subject->id) selected @endif>{{ $subject->code }} - {{ $subject->title }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('field_subject') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="import">{{ __('File xlsx') }} <span>*</span></label>
                                    <input type="file" class="form-control" name="import" id="import" value="{{ old('import') }}" accept=".xlsx" required>

                                    <div class="invalid-feedback">
                                      {{ __('required_field') }} {{ __('File xlsx') }}
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-upload"></i> {{ __('btn_upload') }}</button>
                                </div>
                            </div>
                        </form>
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
    
     $(".batch").on('change',function(e){
      e.preventDefault(e);
      var program=$(".program");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-batch') }}",
        data:{
          _token:$('input[name=_token]').val(),
          batch:$(this).val(),
         
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', program).remove();
            $('.program').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.program');
            });
          }

      });
    });
    
   
   
    $(".program").on('change',function(e){
      e.preventDefault(e);
      var session=$(".session");
     
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-session') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val(),
          college:$('.college option:selected').val(),
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', session).remove();
            $('.session').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.session');
            });
          }

      });

     
    });
 
    
    $(".session").on('change',function(e){
      e.preventDefault(e);
      var subject=$(".subject");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-techer-subject') }}",
        data:{
          _token:$('input[name=_token]').val(),
          session:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', subject).remove();
            $('.subject').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.code +' - '+ this.title
              }).appendTo('.subject');
            });
          }

      });
    });
</script>
@endsection