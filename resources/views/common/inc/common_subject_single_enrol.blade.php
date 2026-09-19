<div class="form-group col-md-3">
    <label for="college_status">{{ 'College Status' }}
        <span>*</span></label>
    <select class="form-control college" name="college_status" id="college" required>
        <option value="">{{ __('select') }}</option>

        <option value="1" @if ($selected_college_id == 1) selected @endif>
            {{ __('college_first') }}</option>
        <option value="2" @if ($selected_college_id == 2) selected @endif>
            {{ __('college_second') }}</option>

    </select>

    <div class="invalid-feedback">
        {{ __('required_field') }} {{ 'College Status' }}
    </div>
</div>


<div class="form-group col-md-3">
    <label for="student" class="form-label">{{ __('field_student') }}
        <span>*</span></label>
    <select class="form-control student select2" name="student" id="student" required>
        <option value="">{{ __('select') }}</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}"
                @if ($selected_student == $student->student_id) selected @endif>
                {{ $student->student_id }} - {{ $student->first_name }}
                {{ $student->last_name }}</option>
        @endforeach
    </select>

    <div class="invalid-feedback">
        {{ __('required_field') }} {{ __('field_student') }}
    </div>
</div>


<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript">
    "use strict";

    
    $(".college").on('change',function(e){
      e.preventDefault();
      var student=$(".student");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-student_id') }}",
        data:{
          _token:$('input[name=_token]').val(),
          college:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', student).remove();
            $('.student').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.student_id,
                'text': this.student_id+'-'+this.first_name+' '+this.last_name
              }).appendTo('.student');
            });
          }

      });
    });

   </script>