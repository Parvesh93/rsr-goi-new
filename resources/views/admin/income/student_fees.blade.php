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
                            <h5>{{ "Student Fees" }} {{ __('list') }}</h5>
                        </div>
                        <div class="card-block">
                            @can($access . '-create')
                                <a href="{{ route($route . '.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    {{ __('btn_add_new') }}</a>
                            @endcan

                            <a href="{{ route($route . '.index') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i>
                                {{ __('btn_refresh') }}</a>

                            {{-- @can($access . '-import')
                                <a href="{{ route($route . '.import') }}" class="btn btn-dark"><i class="fas fa-upload"></i>
                                    {{ __('btn_import') }}</a>
                            @endcan --}}

                            {{-- @isset($rows)
                                @can($access . '-password-print')
                                    <form class="needs-validation d-inline" novalidate method="get"
                                        action="{{ route($route . '.password-multiprint') }}" target="_blank">
                                        <input type="hidden" name="students" class="students" value="">
                                        <button type="submit" class="btn btn-sm btn-dark print-btn"><i class="fas fa-print"></i>
                                            {{ __('field_password') }}</button>
                                    </form>
                                @endcan
                            @endisset --}}
                        </div>

                        <div class="card-block">
                            <form class="needs-validation" novalidate method="get" action="{{ route('admin.collection.datafees') }}">
                                <div class="row gx-2">

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

                                    @include('common.inc.student_search_filter')

                                    <div class="form-group col-md-3">
                                        <label for="status">{{ __('field_status') }}</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    @if ($selected_status == $status->id) selected @endif>{{ $status->title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_status') }}
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
                                        <label for="person">{{ 'Reference Person Name' }}</label>
                                        <select class="form-control" name="person" id="person" required>
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($persons as $person)
                                                <option value="{{ $person }}"
                                                    @if ($selected_person == $person) selected @endif>{{ $person }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ 'Reference Person Name' }}
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
                            <table id="export-table1" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Serial No
                                            <!--<div class="checkbox checkbox-success d-inline">-->
                                            <!--    <input type="checkbox" id="checkbox" class="all_select">-->
                                            <!--    <label for="checkbox" class="cr" style="margin-bottom: 0px;"></label>-->
                                            <!--</div>-->
                                        </th>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_father_name') }}</th>
                                       
                                        <th>{{ "Phone No" }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_session') }}</th>
                                        
                                        <th>{{ __('field_caase_information') }}</th>
                                        <th>{{ "Cash Date" }}</th>
                                        <th>{{ "Cash Rept.No" }}</th>
                                        <th>{{ "Cash Ref.Name" }}</th>
                                        
                                        <th>{{ __('field_bank_information') }}</th>
                                        <th>{{ "Bank Date" }}</th>
                                        <th>{{ "Bank UTR_No" }}</th>
                                        <th>{{ "Bank Name" }}</th>
                                        
                                         <th>{{ __('field_references_information') }}</th>
                                        <th>{{ "Ref Date" }}</th>
                                        <th>{{ "Ref Rept.No" }}</th>
                                        <th>{{ "Ref. Name" }}</th>
                                        
                                      
                                        <th>{{"Tatal Cash" }}</th>
                                        <th>{{ "Total Bank" }}</th>
                                        <th>{{ "Total Ref" }}</th>
                                        <th>{{ "Total Amount" }}</th>
                                        <th>{{ "Ref Name" }}</th>
                                        <th>{{ "Status" }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                  @php
                                    $enroll = \App\Models\Student::enroll($row->id);
                                    $totalAmount=0;
                                  @endphp
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                            <!--<div class="checkbox checkbox-primary d-inline">-->
                                            <!--    <input type="checkbox" data_id="{{ $row->id }}" id="checkbox-{{ $row->id }}" value="{{ $row->id }}">-->
                                            <!--    <label for="checkbox-{{ $row->id }}" class="cr"></label>-->
                                            <!--</div>-->
                                        </td>
                                        <td>
                                            <a href="{{ route($route.'.show', $row->id) }}">
                                            {{ $row->student_id }}
                                            </a>
                                        </td>
                                        <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ $row->father_name }} </td>
                                        <td>{{ $row->phone }} </td>
                                        <td>{{ $row->program->title ?? '' }}</td>
                                        <td>{{ $enroll->session->title ?? '' }}</td>
                                        
                                         <td>
                                            @foreach($row->cashReceived as $key => $cash)
                                            <div>
                                                <span class="badge badge-danger">{{ $cash->cash_amount }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->cashReceived as $key => $cash)
                                            <div>
                                                <span class="badge badge-danger">{{ $cash->cash_date }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->cashReceived as $key => $cash)
                                            <div>
                                                <span class="badge badge-danger">{{ $cash->utr_no }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->cashReceived as $key => $cash)
                                            <div>
                                                <span class="badge badge-danger">{{ $cash->cash_name }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        
                                         <td>
                                            @foreach($row->bankReceived as $key => $bank)
                                            <div>
                                                <span class="badge  badge-success">{{ $bank->bank_amount }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->bankReceived as $key => $bank)
                                            <div>
                                                <span class="badge  badge-success">{{ $bank->bank_date }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->bankReceived as $key => $bank)
                                            <div>
                                                <span class="badge badge-success">{{ $bank->utr_no }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->bankReceived as $key => $bank)
                                            <div>
                                                <span class="badge badge badge-success">{{ $bank->bank_name }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        
                                        
                                         <td>
                                            @foreach($row->refrences as $key => $refrence)
                                            <div>
                                                <span class="badge badge-primary">{{ $refrence->ref_amount }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->refrences as $key => $refrence)
                                            <div>
                                                <span class="badge badge-primary">{{ $refrence->ref_date }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->refrences as $key => $refrence)
                                            <div>
                                                <span class="badge badge-primary">{{ $refrence->utr_no }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->refrences as $key => $refrence)
                                            <div>
                                                <span class="badge badge-primary">{{ $refrence->ref_name }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                     
                                          <td>
                                           {{$row->cashTotal}}
                                         </td>
                                          <td>
                                           {{$row->bankTotal}}
                                         </td>
                                         <td>
                                           {{$row->refTotal}}
                                         </td>
                                        
                                      
                                         @if(!empty($row->total_amounts))
                                         <td><span class="badge badge-primary">{{ $row->total_amounts }}</span></td> 
                                         @else
                                          <td><span class="badge badge-primary"></span></td>
                                         @endif
                                          <td>
                                           {{$row->refrence_person_name}}
                                         </td>
                                         <td>
                                            @foreach ($row->statuses as $key => $status)
                                             <span class="badge badge-primary">{{ $status->title }}</span><br>
                                            @endforeach
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
<script type="text/javascript">
    "use strict";
    $(document).ready(function() {
        $(".print-btn").on('click',function(e){

            var numberOfChecked = $("input[data_id]:checked").length;
            if(numberOfChecked <= 0){
                e.preventDefault();
                alert("{{ __('select') }} {{ __('field_student') }}");
            }

            var students = [];
            $.each($("input[data_id]:checked"), function(){
                students.push($(this).val());
            });

            $(".students").val( students.join(',') );
        });
    });

    // checkbox all-check-button selector
    $(".all_select").on('click',function(e){
        if($(this).is(":checked")){
            // check all checkbox
            $("input:checkbox").prop('checked', true);
        }
        else if($(this).is(":not(:checked)")){
            // uncheck all checkbox
            $("input:checkbox").prop('checked', false);
        }
    });
</script>
@endsection