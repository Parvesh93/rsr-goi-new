@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!--<div>Ram</div>-->
           

            <div class="col-sm-12">
                <div class="card">
                    @if(isset($rows))
                  

                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="export-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <!--<th>-->
                                        <!--    <div class="checkbox checkbox-success d-inline">-->
                                        <!--        <input type="checkbox" id="checkbox" class="all_select">-->
                                        <!--        <label for="checkbox" class="cr" style="margin-bottom: 0px;"></label>-->
                                        <!--    </div>-->
                                        <!--</th>-->
                                        <th>#</th>
                                        <!--<th>{{ __('field_receipt') }}</th>-->
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_fees_type') }}</th>
                                        <th>{{ __('field_fee') }}</th>
                                        <th>{{ __('field_discount') }}</th>
                                        <th>{{ __('field_fine_amount') }}</th>
                                        <th>{{ __('field_net_amount') }}</th>
                                        <th>{{ __('field_pay_date') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_payment_method') }}</th>
                                        <th>{{ __('field_note') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <!--<td>-->
                                        <!--    <div class="checkbox checkbox-primary d-inline">-->
                                        <!--        <input type="checkbox" data_id="{{ $row->id }}" id="checkbox-{{ $row->id }}" value="{{ $row->id }}">-->
                                        <!--        <label for="checkbox-{{ $row->id }}" class="cr"></label>-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td>{{ $key + 1 }}</td>
                                        <!--<td>{{ $print->prefix ?? '' }}{{ str_pad($row->id, 6, '0', STR_PAD_LEFT) }}</td>.-->
                                        <td>
                                            @isset($row->studentEnroll->student->student_id)
                                            <a href="{{ route('admin.student.show', $row->studentEnroll->student->id) }}">
                                            {{ $row->studentEnroll->student->student_id ?? '' }}
                                            </a>
                                            @endisset
                                        </td>
                                        <td>{{ $row->category->title ?? '' }}</td>
                                        <td>
                                            @if(isset($row->fee_amount))
                                            {{ number_format((float)$row->fee_amount, 2, '.', '') }} 
                                            @else
                                            {{ number_format((float)$row->fee_amount, 2, '.', '') }} 
                                            @endif 
                                            {!! $setting->currency_symbol !!}
                                        </td>
                                        <td>
                                            @if(isset($row->fee_amount))
                                            {{ number_format((float)$row->discount_amount, 2, '.', '') }} 
                                            @else
                                            {{ number_format((float)$row->discount_amount, 2, '.', '') }} 
                                            @endif 
                                            {!! $setting->currency_symbol !!}
                                        </td>
                                        <td>
                                            @if(isset($row->fee_amount))
                                            {{ number_format((float)$row->fine_amount, 2, '.', '') }} 
                                            @else
                                            {{ number_format((float)$row->fine_amount, 2, '.', '') }} 
                                            @endif 
                                            {!! $setting->currency_symbol !!}
                                        </td>
                                        <td>
                                            @if(isset($row->fee_amount))
                                            {{ number_format((float)$row->paid_amount, 2, '.', '') }} 
                                            @else
                                            {{ number_format((float)$row->paid_amount, 2, '.', '') }} 
                                            @endif 
                                            {!! $setting->currency_symbol !!}
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            @if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->pay_date)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->pay_date)) }}
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            <span class="badge badge-pill badge-success">{{ __('status_paid') }}</span>
                                            @elseif($row->status == 2)
                                            <span class="badge badge-pill badge-danger">{{ __('status_canceled') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-primary">{{ __('status_pending') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $row->payment_method == 1 )
                                            {{ __('payment_method_card') }}
                                            @elseif( $row->payment_method == 2 )
                                            {{ __('payment_method_cash') }}
                                            @elseif( $row->payment_method == 3 )
                                            {{ __('payment_method_cheque') }}
                                            @elseif( $row->payment_method == 4 )
                                            {{ __('payment_method_bank') }}
                                            @elseif( $row->payment_method == 5 )
                                            {{ __('payment_method_e_wallet') }}
                                            @elseif( $row->payment_method == 6 )
                                            {{ __('PayPal') }}
                                            @elseif( $row->payment_method == 7 )
                                            {{ __('Stripe') }}
                                            @elseif( $row->payment_method == 8 )
                                            {{ __('RazorPay') }}
                                            @elseif( $row->payment_method == 9 )
                                            {{ __('PayStack') }}
                                            @elseif( $row->payment_method == 10 )
                                            {{ __('Flutterwave') }}
                                            @endif
                                        </td>
                                        <td>{!! $row->note !!}</td>
                                        <td>
                                            <!--@can($access.'-delete')-->
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <!-- Include Delete modal -->
                                            @include('admin.layouts.inc.delete')
                                            
                                            @if(is_file('uploads/reciept/'.$row->attach))
                                            <a href="{{ asset('uploads/reciept/'.$row->attach) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a>
                                            @endif
                                            <!--@endcan-->
                                            <!--@if($row->status == 0)-->
                                            <!--<button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#payModal-{{ $row->id }}">-->
                                            <!--    <i class="fas fa-plus"></i>-->
                                            <!--</button>-->
                                            <!-- Include Pay modal -->
                                            <!--@include($view.'.pay')-->

                                            <!--@elseif($row->status == 1)-->
                                            <!--@can($access.'-print')-->
                                            <!--@if(isset($print))-->
                                            <!--<a href="#" class="btn btn-icon btn-dark btn-sm" onclick="PopupWin('{{ route($route.'.print', ['id' => $row->id]) }}', '{{ $title }}', 1000, 600);">-->
                                            <!--    <i class="fas fa-print"></i>-->
                                            <!--</a>-->
                                            <!--@endif-->
                                            <!--@endcan-->
                                            
                                            <!--@can($access.'-action')-->
                                            <!--<button type="button" class="btn btn-icon btn-danger btn-sm" title="{{ __('status_unpaid') }}" data-bs-toggle="modal" data-bs-target="#unpayModal-{{ $row->id }}">-->
                                            <!--    <i class="fas fa-undo"></i>-->
                                            <!--</button>-->
                                             <!--Include Unpay modal -->
                                            
                                            <!--@endcan-->
                                            <!--@endif-->
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    @endif
                    
                </div>
            </div>
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
                alert("{{ __('select') }} {{ __('field_receipt') }}");
            }

            var fees = [];
            $.each($("input[data_id]:checked"), function(){
                fees.push($(this).val());
            });

            $(".fees").val( fees.join(',') );
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