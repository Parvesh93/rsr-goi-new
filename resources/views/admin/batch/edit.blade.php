    <!-- Edit modal content -->
    <div id="editModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form class="needs-validation" novalidate action="{{ route($route.'.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ __('modal_edit') }} {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                         <div class="form-group ">
                            <label for="college_department">{{ 'College Department' }}
                                <span>*</span></label>
                            <select class="form-control" name="college_department" required>
                                <option value="">{{ __('select') }}</option>

                                @foreach ($departments as $key => $department)
                                    <option value="{{ $department->id }}" @if ($row->department_id == $department->id) selected @endif>
                                        {{ $department->title }}</option>
                                @endforeach

                            </select>

                            <div class="invalid-feedback">
                                {{ __('required_field') }} {{ 'College Department' }}
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $row->title }}" required>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_title') }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                                <label for="clc_college" class="form-label">{{ "CLC College Name" }} <span>*</span></label>
                                <input type="text" class="form-control" name="clc_college" id="clc_college" value="{{ $row->clc_college }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College Name" }}
                                </div>
                    </div>
                    
                     <div class="form-group">
                                <label for="clc_college_add" class="form-label">{{ "CLC College Address" }} </label>
                                <input type="text" class="form-control" name="clc_college_add" id="clc_college_add" value="{{ $row->clc_college_add }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College Address" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="clc_college_run" class="form-label">{{ "CLC College Running" }} </label>
                                <input type="text" class="form-control" name="clc_college_run" id="clc_college_run" value="{{ $row->clc_college_run }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College Running" }}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="clc_college_reco" class="form-label">{{ "CLC College Recognized" }} </label>
                                <input type="text" class="form-control" name="clc_college_reco" id="clc_college_reco" value="{{ $row->clc_college_reco }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College Recognized" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="clc_college_app" class="form-label">{{ "CLC College Approved" }} </label>
                                <input type="text" class="form-control" name="clc_college_app" id="clc_college_app" value="{{ $row->clc_college_app }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College Approved" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="clc_college_veri" class="form-label">{{ "CLC College Verification" }} </label>
                                <input type="text" class="form-control" name="clc_college_veri" id="clc_college_veri" value="{{ $row->clc_college_var }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "CLC College  Verification" }}
                                </div>
                            </div>
                            
                            
                    
                            <div class="form-group">
                                <label for="college_email" class="form-label">{{ "College Email" }} </label>
                                <input type="email" class="form-control" name="college_email" id="college_email" value="{{ $row->college_email }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "college_email" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="college_phone" class="form-label">{{ "College Phone Number" }} </label>
                                <input type="text" class="form-control" name="college_phone" id="college_phone" value="{{ $row->college_phone }}" >

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "College Phone Number" }}
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <label for="attach">{{ "ClC Watermark" }}: <span>{{ __('image_size', ['height' => 1536, 'width' => 1024]) }}</span></label>
                            <input type="file" class="form-control" name="attach" id="attach" value="{{ old('attach') }}">

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
                        <label for="start_date" class="form-label">{{ __('field_start_date') }} <span>*</span></label>
                        <input type="date" class="form-control date" name="start_date" id="start_date" value="{{ $row->start_date }}" required>

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_start_date') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="program">{{ __('field_assign') }} {{ __('field_program') }} <span>*</span></label><br/>

                        @foreach($programs as $key => $program)
                        <br/>
                        <div class="checkbox d-inline">
                            <input type="checkbox" name="programs[]" id="program-{{ $key }}-{{ $row->id }}" value="{{ $program->id }}"

                            @foreach($row->programs as $selected_program)
                                @if($selected_program->id == $program->id) checked @endif 
                            @endforeach

                            >
                            <label for="program-{{ $key }}-{{ $row->id }}" class="cr">{{ $program->title }}</label>
                        </div>
                        @endforeach

                        <div class="invalid-feedback">
                          {{ __('required_field') }} {{ __('field_program') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">{{ __('select_status') }}</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" @if( $row->status == 1 ) selected @endif>{{ __('status_active') }}</option>
                            <option value="0" @if( $row->status == 0 ) selected @endif>{{ __('status_inactive') }}</option>
                        </select>
                    </div>
                    <!-- Form End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                </div>

              </form>
            </div>
        </div>
    </div>