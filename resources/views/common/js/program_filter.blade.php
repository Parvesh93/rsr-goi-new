<!-- Filter Search -->
<script type="text/javascript">
    "use strict";

   

    $(".batch").on('change',function(e){
      e.preventDefault(e);
      var department_te=$(".department_te");
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
            $('option', department_te).remove();
            $('.department_te').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.department_te');
            });
          }

      });
    });


</script>