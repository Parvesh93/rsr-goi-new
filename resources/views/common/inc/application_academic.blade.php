   {{-- <div class="form-group col-md-6">
       <label for="admission_mode">College Department <span>*</span></label>

       <div class="dropdown admission-dropdown w-100">
           <button class="btn btn-light dropdown-toggle w-100 text-start" type="button" id="admissionModeDropdown"
               data-bs-toggle="dropdown" aria-expanded="false">
               Select College Department
           </button>
           <ul class="dropdown-menu w-100" aria-labelledby="admissionModeDropdown">
               @foreach ($departments as $department)
                   <li>
                       <a class="dropdown-item" href="#">{{ $department->title }}</a>
                   </li>
               @endforeach 
           </ul>
       </div>

       <div class="invalid-feedback">
           {{ __('required_field') }} {{ 'College Department' }}
       </div>
   </div> --}}


   <div class="form-group col-md-6">
       <label for="college_department">{{ 'College Department' }}
           <span>*</span></label>
       <select class="form-control college_department" name="college_department" required>
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

   <div class="form-group col-md-6">
       <label for="program">{{ __('field_program') }} <span>*</span></label>
       <select class="form-control program" name="program" id="program" required>
           <option value="0">{{ __('all') }}</option>
           @if (isset($programs))
               @foreach ($programs->sortBy('title') as $program)
                   <option value="{{ $program->id }}">{{ $program->title }}</option>
               @endforeach
           @endif
       </select>

       <div class="invalid-feedback">
           {{ __('required_field') }} {{ __('field_program') }}
       </div>
   </div>

   <div class="form-group col-md-12">
       <label for="session">{{ __('field_session') }} <span>*</span></label>
       <select class="form-control session" name="session" id="session" required>
           <option value="">{{ __('select') }}</option>
       </select>

       <div class="invalid-feedback">
           {{ __('required_field') }} {{ __('field_session') }}
       </div>
   </div>




   <!--<script src="{{ asset('dashboard/plugins/jquery/js/jquery.min.js') }}"></script>-->

   <script type="text/javascript">
       "use strict";

       $(".college_department").on('change', function(e) {
           //   e.preventDefault(e);
           var program = $(".program");
           //   var semester=$(".program");
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           //   alert(semester);

           $.ajax({
               type: 'POST',
               url: "{{ route('filter-college-department') }}",
               data: {
                   _token: $('input[name=_token]').val(),
                   department: $(this).val()
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
           //   e.preventDefault(e);
           var session = $(".session");
           //   var semester=$(".program");
           $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
           //   alert(semester);

           $.ajax({
               type: 'POST',
               url: "{{ route('filter-session') }}",
               data: {
                   _token: $('input[name=_token]').val(),
                   program: $(this).val()
               },
               success: function(response) {
                   // var jsonData=JSON.parse(response);
                   $('option', session).remove();
                   $('.session').append('<option value="">{{ __('select') }}</option>');
                   $.each(response, function() {
                       $('<option/>', {
                           'value': this.title,
                           'text': this.title
                       }).appendTo('.session');
                   });
               }

           });

       });
   </script>
