

<div class="form-group col-md-12">
  <label for="present_district">{{ __('field_district') }} <span>*</span></label>
  
   <input type="text" class="form-control" name="present_district" id="present_district" value="{{ @$row->present_district }}" required>

  <div class="invalid-feedback">
  {{ __('required_field') }} {{ __('field_district') }}
  </div>
</div>

<div class="form-group col-md-12">
  <label for="present_province">{{ __('field_province') }} <span>*</span></label>
  <select class="form-control" name="present_province" id="present_province" required>
    <option>{{ __('select') }}</option>
    @foreach( $provinces as $province )
    <option value="{{ $province->id }}" @isset($row) {{ $row->present_province == $province->id ? 'selected' : '' }} @endisset>{{ $province->title }}</option>
    @endforeach
  </select>

  <div class="invalid-feedback">
  {{ __('required_field') }} {{ __('field_province') }}
  </div>
</div>





<script type="text/javascript">
"use strict";
$("#present_province").on('change',function(e){
    e.preventDefault();
    var presentDistrict=$("#present_district");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url: "{{ route('filter-district') }}",
      data:{
        _token:$('input[name=_token]').val(),
        province:$(this).val()
      },
      success:function(response){
          // var jsonData=JSON.parse(response);
          $('option', presentDistrict).remove();
          $('#present_district').append('<option value="">{{ __("select") }}</option>');
          $.each(response, function(){
            $('<option/>', {
              'value': this.id,
              'text': this.title
            }).appendTo('#present_district');
          });
        }

    });
  });
  
  
   $('#same_address').on('change', function() {
        if ($(this).is(':checked')) {
            // Copy values from present address to permanent address
            $('#permanent_province').val($('#present_province').val());
            $('#permanent_district').val($('#present_district').val());
            $('#permanent_address').val($('#present_address').val());
             $('#permanent_pin').val($('#present_pin').val());
             $('#permanent_post').val($('#present_post').val());
            $('#permanent_police_station').val($('#present_police_station').val());
        } else {
            // Clear the permanent address fields
            $('#permanent_province').val('');
            $('#permanent_district').val('');
            $('#permanent_address').val('');
             $('#permanent_pin').val('');
             $('#permanent_post').val('');
            $('#permanent_police_station').val('');
        }
        
    });
</script>
