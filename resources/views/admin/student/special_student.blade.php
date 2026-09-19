@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            

            @isset($rows)
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="export-table1" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#
                                            <div class="checkbox checkbox-success d-inline">
                                                <input type="checkbox" id="checkbox" class="all_select">
                                                <label for="checkbox" class="cr" style="margin-bottom: 0px;"></label>
                                            </div>
                                        </th>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_references_information') }}</th>
                                        <th>{{ "RefDate" }}</th>
                                        <th>{{ "RefUTR_No" }}</th>
                                        <th>{{ "RefName" }}</th>
                                        <th>{{ __('field_caase_information') }}</th>
                                        <th>{{ "CashDate" }}</th>
                                        <th>{{ "CashUTR_No" }}</th>
                                        <th>{{ "CashRefName" }}</th>
                                        <th>{{ __('field_bank_information') }}</th>
                                        <th>{{ "BankDate" }}</th>
                                        <th>{{ "BankUTR_No" }}</th>
                                        <th>{{ "BankRefName" }}</th>
                                        
                                        <th>{{ "Deduction Received" }}</th>
                                        <th>{{ "DeductionDate" }}</th>
                                        <th>{{ "DeductionUTR_No" }}</th>
                                        <th>{{ "DeductionName" }}</th>
                                        <th>{{ __('field_total_information') }}</th>
                                        <th>{{ __('field_session') }}</th>
                                        <th>{{ __('field_semester') }}</th>
                                        <th>{{ __('field_section') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        {{-- <th>{{ __('field_login') }}</th> --}}
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                  @php
                                    $enroll = \App\Models\Student::enroll($row->id);
                                  @endphp
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                            <div class="checkbox checkbox-primary d-inline">
                                                <input type="checkbox" data_id="{{ $row->id }}" id="checkbox-{{ $row->id }}" value="{{ $row->id }}">
                                                <label for="checkbox-{{ $row->id }}" class="cr"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route($route.'.show', $row->id) }}">
                                            {{ $row->student_id }}
                                            </a>
                                        </td>
                                        <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                        <td>{{ $row->program->title ?? '' }}</td>
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
                                            @foreach($row->deductions as $key => $deduction)
                                            <div>
                                                <span class="badge badge-warning">{{ $deduction->deduction_amount }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        
                                        <td>
                                            @foreach($row->deductions as $key => $deduction)
                                            <div>
                                                <span class="badge badge-warning">{{ $deduction->deduction_date }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($row->deductions as $key => $deduction)
                                            <div>
                                                <span class="badge badge-warning">{{ $deduction->utr_no }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        
                                        <td>
                                            @foreach($row->deductions as $key => $deduction)
                                            <div>
                                                <span class="badge badge-warning">{{ $deduction->deduction_name }}</span>
                                            </div>
                                            @endforeach
                                        </td>
                                        
                                         @if(!empty($row->total_amounts))
                                         <td><span class="badge badge-primary">{{ $row->total_amounts }}</span></td> 
                                          @else
                                          <td><span class="badge badge-primary"></span></td>
                                          @endif
                                        <td>{{ $enroll->session->title ?? '' }}</td>
                                        <td>{{ $enroll->semester->title ?? '' }}</td>
                                        <td>{{ $enroll->section->title ?? '' }}</td>
                                        <td>
                                            @foreach($row->statuses as $key => $status)
                                            <span class="badge badge-primary">{{ $status->title }}</span><br>
                                            @endforeach
                                        </td>
                                        {{-- <td>
                                            @can($access.'-edit')
                                            @if( $row->login == 1 )
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-times"></i></a>
                                            @else
                                            <a href="{{ route($route.'.status', $row->id) }}" class="btn btn-icon btn-success btn-sm"><i class="fas fa-check"></i></a>
                                            @endif
                                            @else
                                            @if( $row->login == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_blocked') }}</span>
                                            @endif
                                            @endcan
                                        </td> --}}
                                        <td>
                                            @can($access.'-password-print')
                                            <a href="#" class="btn btn-dark btn-sm" onclick="PopupWin('{{ route($route.'.print-password', [$row->id]) }}', '{{ $title }}', 800, 500);"><i class="fas fa-print"></i> {{ __('field_password') }}</a>
                                            @endcan

                                            <form action="{{ route($route.'.send-password', [$row->id]) }}" method="post" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-envelope"></i> {{ __('field_password') }}</button>
                                            </form>
                                            <br/>
                                            
                                            <a href="{{ route($route.'.show', $row->id) }}" class="btn btn-icon btn-success btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @can($access.'-edit')
                                            <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            @endcan

                                            @can($access.'-card')
                                            @if(isset($print))
                                            <a href="#" class="btn btn-icon btn-warning btn-sm" onclick="PopupWin('{{ route($route.'.card', $row->id) }}', '{{ $title }}', 800, 500);">
                                                <i class="fas fa-address-card"></i>
                                            </a>
                                            @endif
                                            @endcan

                                            @can($access.'-password-change')
                                            <button class="btn btn-icon btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal-{{ $row->id }}">
                                            <i class="fas fa-key"></i>
                                            </button>

                                            <!-- Include Password Change modal -->
                                            @include($view.'.password-change')
                                            @endcan
                                            
                                            @can($access.'-delete')
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                            @endcan
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