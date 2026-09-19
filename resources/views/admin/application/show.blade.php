@extends('admin.layouts.master')
@section('title', $title)
@section('page_css')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/lightbox2-master/css/lightbox.min.css') }}">
@endsection
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-3">
                <div class="card user-card user-card-1">
                    <div class="card-body pb-0">
                        <div class="media user-about-block align-items-center mt-0 mb-3">
                            <div class="position-relative d-inline-block">
                                @if(is_file('uploads/'.$path.'/'.$row->photo))
                                <img src="{{ asset('uploads/'.$path.'/'.$row->photo) }}" class="img-radius img-fluid wid-80" alt="{{ __('field_photo') }}" onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';">
                                @else
                                <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius img-fluid wid-80" alt="{{ __('field_photo') }}">
                                @endif
                                <div class="certificated-badge">
                                    <i class="fas fa-certificate text-primary bg-icon"></i>
                                    <i class="fas fa-check front-icon text-white"></i>
                                </div>
                            </div>
                            <div class="media-body ms-3">
                                <h6 class="mb-1">{{ $row->first_name }} {{ $row->last_name }}</h6>
                                @if(isset($row->registration_no))
                                <p class="mb-0 text-muted">Application No:{{ $row->registration_no }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="f-w-500"><i class="far fa-envelope m-r-10"></i>{{ __('field_email') }} : </span>
                            <span class="float-end">{{ $row->email }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="f-w-500"><i class="fas fa-phone-alt m-r-10"></i>{{ __('field_phone') }} : </span>
                            <span class="float-end">{{ $row->phone }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="f-w-500"><i class="fas fa-graduation-cap m-r-10"></i>{{ __('field_program') }} : </span>
                            <span class="float-end">{{ $row->program->title ?? '' }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="f-w-500"><i class="far fa-calendar-alt m-r-10"></i>{{ __('field_apply_date') }} : </span>
                            <span class="float-end">
                                @if(isset($setting->date_format))
                                {{ date($setting->date_format, strtotime($row->apply_date)) }}
                                @else
                                {{ date("Y-m-d", strtotime($row->apply_date)) }}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item border-bottom-0">
                            <span class="f-w-500"><i class="far fa-question-circle m-r-10"></i>{{ __('field_status') }} : </span>
                            <span class="float-end">
                                @if( $row->status == 1 )
                                <span class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                @elseif( $row->status == 2 )
                                <span class="badge badge-pill badge-success">{{ __('status_approved') }}</span>
                                @else
                                <span class="badge badge-pill badge-danger">{{ __('status_rejected') }}</span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            @php
                function field($slug){
                    return \App\Models\Field::field($slug);
                }
            @endphp
            <div class="col-md-9">
                <div class="card">
                    <div class="card-block">
                        <div class="">
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset class="row gx-2 scheduler-border">
                                    @if(field('application_father_name')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_father_name') }}:</mark> {{ $row->father_name }}</p><hr/>
                                    @endif
                                    @if(field('application_father_occupation')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_father_occupation') }}:</mark> {{ $row->father_occupation }}</p><hr/>
                                    @endif
                                    @if(field('application_mother_name')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_mother_name') }}:</mark> {{ $row->mother_name }}</p><hr/>
                                    @endif
                                    @if(field('application_mother_occupation')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_mother_occupation') }}:</mark> {{ $row->mother_occupation }}</p><hr/>
                                    @endif

                                    <p><mark class="text-primary">{{ __('field_gender') }}:</mark> 
                                        @if( $row->gender == 1 )
                                        {{ __('gender_male') }}
                                        @elseif( $row->gender == 2 )
                                        {{ __('gender_female') }}
                                        @elseif( $row->gender == 3 )
                                        {{ __('gender_other') }}
                                        @endif
                                    </p><hr/>

                                    

                                    <p><mark class="text-primary">{{ __('field_dob') }}:</mark> 
                                        @if(isset($setting->date_format))
                                        {{ date($setting->date_format, strtotime($row->dob)) }}
                                        @else
                                        {{ date("Y-m-d", strtotime($row->dob)) }}
                                        @endif
                                    </p><hr/>

                                    @if(field('application_emergency_phone')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_emergency_phone') }}:</mark> {{ $row->emergency_phone }}</p><hr/>
                                    @endif
                                    @if(field('application_religion')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_religion') }}:</mark> {{ $row->religion }}</p><hr/>
                                    @endif
                                    @if(field('application_caste')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_caste') }}:</mark> {{ $row->caste }}</p><hr/>
                                    @endif
                                    @if(field('application_mother_tongue')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_mother_tongue') }}:</mark> {{ $row->mother_tongue }}</p><hr/>
                                    @endif
                                    @if(field('application_nationality')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_nationality') }}:</mark> {{ $row->nationality }}</p><hr/>
                                    @endif
                                     
                                    <p><mark class="text-primary">{{ __('field_phone_parents') }}:</mark> {{ $row->parent_phone }}</p><hr/>
                                    
                                     
                                    <p><mark class="text-primary">{{ __('field_session') }}:</mark> {{ $row->session }}</p><hr/>
                                   

                                    @if(field('application_marital_status')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_marital_status') }}:</mark> 
                                        @if( $row->marital_status == 1 )
                                        {{ __('marital_status_single') }}
                                        @elseif( $row->marital_status == 2 )
                                        {{ __('marital_status_married') }}
                                        @elseif( $row->marital_status == 3 )
                                        {{ __('marital_status_widowed') }}
                                        @elseif( $row->marital_status == 4 )
                                        {{ __('marital_status_divorced') }}
                                        @elseif( $row->marital_status == 5 )
                                        {{ __('marital_status_other') }}
                                        @endif
                                    </p><hr/>
                                    @endif

                                    @if(field('application_blood_group')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_blood_group') }}:</mark> 
                                        @if( $row->blood_group == 1 )
                                        {{ __('A+') }}
                                        @elseif( $row->blood_group == 2 )
                                        {{ __('A-') }}
                                        @elseif( $row->blood_group == 3 )
                                        {{ __('B+') }}
                                        @elseif( $row->blood_group == 4 )
                                        {{ __('B-') }}
                                        @elseif( $row->blood_group == 5 )
                                        {{ __('AB+') }}
                                        @elseif( $row->blood_group == 6 )
                                        {{ __('AB-') }}
                                        @elseif( $row->blood_group == 7 )
                                        {{ __('O+') }}
                                        @elseif( $row->blood_group == 8 )
                                        {{ __('O-') }}
                                        @endif
                                    </p><hr/>
                                     <p><mark class="text-primary">{{"Admission Mode"}}:</mark> {{ $row->admission_mode }}</p><hr/>
                                    <hr/>
                                    <p><mark class="text-primary">{{"Department"}}:</mark> {{ $row->department->title }}</p><hr/>
                                    <hr/>

                                    </fieldset>
                                    @endif

                                @if(field('application_signature')->status == 1)
                                     @php
                                        $file = @$row->signature;
                                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                                        $fileUrl = asset('uploads/student/' . $file);
                                      @endphp
                                    <p><mark class="text-primary">{{ __('field_signature') }}:</mark> 
                                <fieldset class="row gx-2 scheduler-border">
                                    @if(is_file('uploads/'.$path.'/'.$row->signature))
                                       
                                       
                                        @if(strtolower($extension) === 'pdf')
                    
                                          <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                                        @else
                                            <img src="{{ $fileUrl }}" class="img-fluid"  />
                                        @endif
                                        
                                    @endif
                                </fieldset>
                                    
                                 @endif
                                </div>
                                <div class="col-md-4">
                                    @if(field('application_national_id')->status == 1 || field('application_passport_no')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    @if(field('application_national_id')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_national_id') }}:</mark> {{ $row->national_id }}</p><hr/>
                                    @endif
                                    @if(field('application_pan_no')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_pan_id') }}:</mark> {{ $row->pan_id }}</p><hr/>
                                    @endif
                                    @if(field('application_passport_no')->status == 1)
                                    <p><mark class="text-primary">{{ __('field_passport_no') }}:</mark> {{ $row->passport_no }}</p>
                                    @endif
                                    </fieldset>
                                    @endif

                                    @if(field('application_address')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_present') }} {{ __('field_address') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_province') }}:</mark> {{ $row->presentProvince->title ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_post') }}:</mark> {{ $row->present_post ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_script') }}:</mark> {{ $row->present_police_station ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_district') }}:</mark> {{ $row->present_district ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_address') }}:</mark> {{ $row->present_address }}</p>
                                    </fieldset>

                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_permanent') }} {{ __('field_address') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_province') }}:</mark> {{ $row->permanentProvince->title ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_post') }}:</mark> {{ $row->permanent_post ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_script') }}:</mark> {{ $row->permanent_police_station ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_district') }}:</mark> {{ $row->permanent_district ?? '' }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_address') }}:</mark> {{ $row->permanent_address }}</p>
                                    </fieldset>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if(field('application_school_info')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_school_information') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_school_name') }}:</mark> {{ $row->high_school_name }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark> {{ $row->high_school_address }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_graduation_year') }}:</mark> {{ $row->high_school_graduation_year }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->high_school_total_marks }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->high_school_marks_obtained }}</p><hr/>
                                    
                                    <p><mark class="text-primary">{{ __('field_graduation_percentage') }}:</mark> {{ $row->high_school_graduation_percentage }}</p><hr/>
                                    </fieldset>
                                    @endif
                                    
                                    @if(field('application_collage_info')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_college_information') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_intermediate_name') }}:</mark> {{ $row->intermediate_name }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark> {{ $row->intermediate_address }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_graduation_year') }}:</mark> {{ $row->intermediate_graduation_year }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->intermediate_total_marks }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->intermediate_marks_obtained }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_graduation_percentage') }}:</mark> {{ $row->inter_graduation_percentage }}</p><hr/>
                                    </fieldset>
                                    @endif
                                    @if(field('application_bachelor_info')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_bachelor_information') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_bachelor_name') }}:</mark> {{ $row->bach_college_name }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark> {{ $row->bach_college_address }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_graduation_year') }}:</mark> {{ $row->bach_gradu_year }}</p><hr/>
                                    
                                    <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->bach_total_marks }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->bach_marks_obtained }}</p><hr/>
                                    
                                    <p><mark class="text-primary">{{ __('field_graduation_percentage') }}:</mark> {{ $row->bach_gradu_percentage }}</p><hr/>
                                    </fieldset>
                                    @endif
                                    @if(field('application_master_info')->status == 1)
                                    <fieldset class="row gx-2 scheduler-border">
                                    <legend>{{ __('field_master_information') }}</legend>
                                    <p><mark class="text-primary">{{ __('field_master_name') }}:</mark> {{ $row->master_college_name }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_study_address') }}:</mark> {{ $row->master_college_address }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_graduation_year') }}:</mark> {{ $row->master_gradu_year }}</p><hr/>
                                    
                                    <p><mark class="text-primary">{{ __('field_total_marks') }}:</mark> {{ $row->master_total_marks }}</p><hr/>
                                    <p><mark class="text-primary">{{ __('field_marks_obtained') }}:</mark> {{ $row->master_marks_obtained }}</p><hr/>
                                    
                                    <p><mark class="text-primary">{{ __('field_graduation_percentage') }}:</mark> {{ $row->master_gradu_percentage }}</p><hr/>
                                    </fieldset>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                
            @if(field('application_high_school_certificate')->status == 1)
             @php
                    $file = @$row->school_transcript;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
            @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->school_transcript))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_high_school_certificate')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_high_school_certificate') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                         <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                   @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                    @endif
                @endif
            </div>
            @endif
            
             @if(field('application_highschool_certificate')->status == 1)
             @php
                    $file = @$row->high_school_certificate;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
            @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->high_school_certificate))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_high_school_certificate')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_school_certifiate') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                         <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                   @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                    @endif
                @endif
            </div>
            @endif
            
             @if(field('application_highschool_slc')->status == 1)
             @php
                    $file = @$row->school_slc;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
            @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->school_slc))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_high_school_slc')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_high_school_slc') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->school_slc) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif

            @if(field('application_intermediate_certificate')->status == 1)
            
                
                @php
                    $file = @$row->school_certificate;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->school_certificate))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_intermediate_school_certificate')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_intermediate_school_certificate') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->school_certificate) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_intermediate_migration')->status == 1)
            
                
                @php
                    $file = @$row->intermediate_migration;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->intermediate_migration))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_intermediate_school_migration')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_intermediate_school_migration') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->intermediate_migration) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p> 
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_intermadiate_certi')->status == 1)
            
                
                @php
                    $file = @$row->intermediate_certificate;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->intermediate_certificate))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_intermediate_school_migration')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_intermediate_certifiate') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->intermediate_migration) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p> 
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
              @if(field('application_intermediate_clc')->status == 1)
            
                
                @php
                    $file = @$row->intermediate_clc;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->intermediate_clc))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_intermediate_school_clc')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_intermediate_school_clc') }} {{__('field_download')}}:</mark>  <a href="{{ asset('uploads/'.$path.'/'.$row->intermediate_clc) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p> 
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
             

            @if(field('application_bachelor_certificate')->status == 1)
           
                  @php
                    $file = @$row->collage_transcript;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->collage_transcript))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_graduation_certificate')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_graduation_certificate') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->collage_transcript) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif

            @if(field('application_master_certificate')->status == 1)
            
                   @php
                    $file = @$row->collage_certificate;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->collage_certificate))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_graduation_clc')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_graduation_clc') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->collage_certificate) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p> 
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
             @if(field('application_graduation_migration')->status == 1)
            
                   @php
                    $file = @$row->collage_migration;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->collage_migration))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_graduation_migration')}}</span><br-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_graduation_migration') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->collage_migration) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p> 
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_adhar_card')->status == 1)
           
                   @php
                    $file = @$row->adhar_card;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->adhar_card))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_adhar_card')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_adhar_card') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->adhar_card) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_parents_id')->status == 1)
            
                   @php
                    $file = @$row->parents_id;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->parents_id))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_parents_id')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_parents_id') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->parents_id) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_pan_card')->status == 1)
            
                   @php
                    $file = @$row->pan_card;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->pan_card))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_pan_card')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_pan_card') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->pan_card) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
              @if(field('application_photo')->status == 1)
            
                   @php
                    $file = @$row->photo;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->photo))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_photo')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_photo') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->photo) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
            @if(field('application_signature')->status == 1)
           
                   @php
                    $file = @$row->signature;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $fileUrl = asset('uploads/student/' . $file);
                @endphp
                
            <div class="col-md-3">
                @if(is_file('uploads/'.$path.'/'.$row->signature))
                <!--<a href="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" data-lightbox="gallery">-->
                <!--    <img src="{{ asset('uploads/'.$path.'/'.$row->school_transcript) }}" class="img-fluid">-->
                <!--</a>-->
                <!--<span>{{__('field_signature')}}</span><br/>-->
                <p class="mt-1"><mark class="text-primary">{{ __('field_signature') }} {{__('field_download')}}:</mark> <a href="{{ asset('uploads/'.$path.'/'.$row->signature) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a></p>
                 @if(strtolower($extension) === 'pdf')
                    
                  <iframe src="{{$fileUrl}}" class="img-fluid" ></iframe>
                @else
                    <img src="{{ $fileUrl }}" class="img-fluid"  />
                @endif
                @endif
            </div>
            @endif
            
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection

@section('page_js')
<script src="{{ asset('dashboard/plugins/lightbox2-master/js/lightbox.min.js') }}"></script>
@endsection