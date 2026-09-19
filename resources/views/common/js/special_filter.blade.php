<!-- Filter Search -->
<script type="text/javascript">
    "use strict";

    $(".semester1").on('change',function(e){
      e.preventDefault(e);
      var section=$(".section1");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-section') }}",
        data:{
          _token:$('input[name=_token]').val(),
          semester:$(this).val(),
          program:$('.program1 option:selected').val(),
          

        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', section).remove();
            $('.section1').append('<option value="">{{ __("select") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.section1');
            });
          }

      });
    });
</script>