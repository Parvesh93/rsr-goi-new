@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-block">
                          <div class="row">
                            <!-- Form Start -->
                            <input name="id" type="hidden" value="{{ (isset($row->id))?$row->id:-1 }}">
                            <input name="slug" type="hidden" value="admission">

                            <div class="form-group col-md-12">
                                <label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_title') }}
                                </div>
                            </div>
                             <div class="form-group col-md-12">
                                <label for="run_by" class="form-label">{{ __('field_run_by') }} <span>*</span></label>
                                <input type="text" class="form-control" name="run_by" id="run_by" value="{{ isset($row->run_by)?$row->run_by:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_run_by') }}
                                </div>
                            </div>
                             <div class="form-group col-md-12">
                                <label for="recognized" class="form-label">{{ __('field_recog') }} <span>*</span></label>
                                <input type="text" class="form-control" name="recognized" id="recognized" value="{{ isset($row->recognized)?$row->recognized:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_recog') }}
                                </div>
                            </div>
                             <div class="form-group col-md-12">
                                <label for="approved" class="form-label">{{ __('field_approved_by') }} <span>*</span></label>
                                <input type="text" class="form-control" name="approved" id="approved" value="{{ isset($row->approved)?$row->approved:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_approved_by') }}
                                </div>
                            </div>
                            
                             <div class="form-group col-md-12">
                                <label for="affilated" class="form-label">{{ "Affiliated to" }} <span>*</span></label>
                                <input type="text" class="form-control" name="affilated" id="affilated" value="{{ isset($row->affilated)?$row->affilated:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ "Affiliated to"  }}
                                </div>
                            </div>
                            
                             <div class="form-group col-md-12">
                                <label for="address" class="form-label">{{ __('field_address') }} <span>*</span></label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ isset($row->address)?$row->address:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_address') }}
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">{{ __('field_email') }} <span>*</span></label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ isset($row->email)?$row->email:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_email') }}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="contact_no_first" class="form-label">{{ __('field_contact_first') }} <span>*</span></label>
                                <input type="text" class="form-control" name="contact_no_first" id="contact_no_first" value="{{ isset($row->contact_no_first)?$row->contact_no_first:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_contact_first') }}
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="contact_no_second" class="form-label">{{ __('field_contact_second') }} <span>*</span></label>
                                <input type="text" class="form-control" name="contact_no_second" id="contact_no_second" value="{{ isset($row->contact_no_second)?$row->contact_no_second:'' }}" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_contact_second') }}
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="body" class="form-label">{{ __('field_body') }}</label>
                                <textarea class="form-control texteditor" name="body" id="body">{{ isset($row->body)?$row->body:'' }}</textarea>
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="footer_left" class="form-label">{{ __('field_footer_left') }}</label>
                                <textarea class="form-control" name="footer_left" id="footer_left">{{ isset($row->footer_left)?$row->footer_left:'' }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="footer_right" class="form-label">{{ __('field_footer_right') }}</label>
                                <textarea class="form-control" name="footer_right" id="footer_right">{{ isset($row->footer_right)?$row->footer_right:'' }}</textarea>
                            </div> --}}

                            <div class="form-group col-md-6">
                                <label for="logo_left">{{ __('field_logo_left') }}: <span>{{ __('image_size', ['height' => 200, 'width' => 'Any']) }}</span></label>

                                @if(isset($row->logo_left) && is_file('uploads/'.$path.'/'.$row->logo_left))
                                <img src="{{ asset('uploads/'.$path.'/'.$row->logo_left) }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                @endif
                                
                                <input type="file" class="form-control" name="logo_left" id="logo_left" value="{{ old('logo_left') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_logo_left') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="logo_right">{{ __('field_logo_right') }}: <span>{{ __('image_size', ['height' => 200, 'width' => 'Any']) }}</span></label>

                                @if(isset($row->logo_right) && is_file('uploads/'.$path.'/'.$row->logo_right))
                                <img src="{{ asset('uploads/'.$path.'/'.$row->logo_right) }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                @endif
                                
                                <input type="file" class="form-control" name="logo_right" id="logo_right" value="{{ old('logo_right') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_logo_right') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6 mt-4">
                                <div class="switch d-inline m-r-10">
                                    <input type="checkbox" id="status" name="status" value="1" @if(isset($row->status)) @if($row->status == 1) checked @endif @else checked @endif>
                                    <label for="status" class="cr"></label>
                                </div>
                                <label>{{ __('status_open') }}</label>
                            </div>
                            <!-- Form End -->
                          </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection