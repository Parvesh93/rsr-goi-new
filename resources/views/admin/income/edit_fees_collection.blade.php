@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
    <!-- Wizard css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/wizard.css') }}">
@endsection

@section('content')

    <!-- Start Content-->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Card ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('modal_edit') }} {{ 'Fees' }}</h5>
                        </div>
                        <div class="card-block">
                            <!--<a href="{{ route('admin.income.feesCollection') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>-->
                            <!--    {{ __('btn_back') }}</a>-->

                            <a href="{{ route('admin.edit.income.feesCollection', $row->id) }}" class="btn btn-info"><i
                                    class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}</a>
                        </div>

                        @php
                            function field($slug)
                            {
                                return \App\Models\Field::field($slug);
                            }
                            
                             $enroll = \App\Models\Student::enroll($row->id);
                        @endphp
                        
                        <div class="col-md-12">
    <fieldset class="scheduler-border ml-5">
        <div class="row">

            
            <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary">Name : </mark><br>
                    {{ $row->first_name }} {{ $row->last_name }}
                </p>
            </div>
           

           
            <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary">Roll No :</mark><br>
                    {{ $row->student_id }}
                </p>
            </div>
            
             <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary">Registration No :</mark><br>
                    {{ $row->registration_no }}
                </p>
            </div>
           

            
            <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary">{{ __('field_mother_name') }}:</mark><br>
                    {{ $row->father_name }}
                </p>
            </div>
            

            
            <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary">Course :</mark><br>
                    {{ $row->program->title }}
                </p>
            </div>
           
            
            <div class="col-md-4 mb-2">
                <p>
                    <mark class="text-primary"> Session :</mark><br>
                    {{ $enroll->session->title }}
                </p>
            </div>


        </div>
    </fieldset>
</div>
                        <div class="wizard-sec-bg">
                            
                          

                            <form id="wizard-advanced-form" class="needs-validation" novalidate
                                action="{{ route('admin.update.income.feesCollection', $row->id) }}" method="post"
                                enctype="multipart/form-data" style="display: none;">
                                @csrf
                                @method('PUT')


                                <h3>{{ 'Student Fees Information' }}</h3>
                                <content class="form-step">
                                    

                                    @if (!empty($row->refrences))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_references_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->refrences as $refrence)
                                                    <div id="inputFormFieldSecond" class="row">

                                                        <div class="form-group col-md-4"><label for="refrence_ids"
                                                                class="form-label">{{ __('field_refrence_id') }}</label><input
                                                                type="text" class="form-control" name="refrence_ids[]"
                                                                id="refrence_ids" value="{{ $refrence->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_refrence_id') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="ref_amounts"
                                                                class="form-label">{{ __('field_ref_amount') }}
                                                            </label><input type="text" class="form-control ref_amounts"
                                                                name="ref_amounts[]" id="ref_amounts"
                                                                value="{{ $refrence->ref_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_amount') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="ref_dates"
                                                                class="form-label">{{ __('field_ref_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="ref_dates[]" id="ref_dates"
                                                                value="{{ $refrence->ref_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="ref_names"
                                                                class="form-label">{{ __('field_ref_name') }}
                                                            </label><input type="text" class="form-control"
                                                                name="ref_names[]" id="ref_names"
                                                                value="{{ $refrence->ref_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_ref_name') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach



                                                <div id="newFieldSecond" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldSecond" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_refrences') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    @if (!empty($row->cashReceived))
                                        {{-- <div>Ram</div> --}}

                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_caase_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->cashReceived as $cash)
                                                    <div id="inputFormFieldcCash" class="row">
                                                        <div class="form-group col-md-4"><label for="cash_ids"
                                                                class="form-label">{{ __('field_cash_id') }}</label><input
                                                                type="text" class="form-control" name="cash_ids[]"
                                                                id="cash_ids" value="{{ $cash->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_id') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_amounts"
                                                                class="form-label">{{ __('field_cash_amount') }}
                                                            </label><input type="text" class="form-control cash_amounts"
                                                                name="cash_amounts[]" id="cash_amounts"
                                                                value="{{ $cash->cash_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_amount') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_dates"
                                                                class="form-label">{{ __('field_cash_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="cash_dates[]" id="cash_dates"
                                                                value="{{ $cash->cash_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="cash_names"
                                                                class="form-label">{{ __('field_cash_name') }}
                                                            </label><input type="text" class="form-control"
                                                                name="cash_names[]" id="cash_names"
                                                                value="{{ $cash->cash_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_cash_name') }}</div>
                                                        </div>

                                                    </div>
                                                @endforeach


                                                <div id="newFieldCash" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldCash" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_cash') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>

                                    @endif

                                    @if (!empty($row->bankReceived))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ __('field_bank_information') }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->bankReceived as $bank)
                                                    <div id="inputFormFieldBank" class="row">
                                                        <div class="form-group col-md-4"><label for="bank_ids"
                                                                class="form-label">{{ __('field_bank_id') }}</label><input
                                                                type="text" class="form-control" name="bank_ids[]"
                                                                id="bank_ids" value="{{ $bank->receipt_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_id') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="utr_nos"
                                                                class="form-label">{{ __('field_bank_utr_no') }}
                                                            </label><input type="text" class="form-control utr_nos"
                                                                name="utr_nos[]" id="utr_nos"
                                                                value="{{ $bank->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_utr_no') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="bank_amounts"
                                                                class="form-label">{{ __('field_bank_amount') }}
                                                            </label><input type="text"
                                                                class="form-control bank_amounts" name="bank_amounts[]"
                                                                id="bank_amounts" value="{{ $bank->bank_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_amount') }}</div>
                                                        </div>

                                                        <div class="form-group col-md-4"><label for="bank_dates"
                                                                class="form-label">{{ __('field_bank_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="bank_dates[]" id="bank_dates"
                                                                value="{{ $bank->bank_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_date') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="bank_names"
                                                                class="form-label">{{ __('field_bank_names') }}
                                                            </label><input type="text" class="form-control"
                                                                name="bank_names[]" id="bank_names"
                                                                value="{{ $bank->bank_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_names') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach


                                                <div id="newFieldBank" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldBank" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif

                                    @if (!empty($row->deductions))
                                        <fieldset class="row scheduler-border">
                                            <legend>{{ 'Any Other Deduction' }}</legend>
                                            <div class="container-fluid">
                                                @foreach ($row->deductions as $deduction)
                                                    <div id="inputFormFieldDeduction" class="row">
                                                        <div class="form-group col-md-4"><label for="deduction_ids"
                                                                class="form-label">{{ __('field_deduction_id') }}</label><input
                                                                type="text" class="form-control"
                                                                name="deduction_ids[]" id="deduction_ids"
                                                                value="{{ $deduction->deduction_id }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_id') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="deduction_amounts"
                                                                class="form-label">{{ __('field_deduction_amount') }}
                                                            </label><input type="text"
                                                                class="form-control deduction_amounts"
                                                                name="deduction_amounts[]" id="deduction_amounts"
                                                                value="{{ $deduction->deduction_amount }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_amount') }}</div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4"><label for="utr_nos"
                                                                class="form-label">{{ __('field_bank_utr_no') }}
                                                            </label><input type="text"
                                                                class="form-control utr_nos"
                                                                name="utr_nos[]" id="utr_nos"
                                                                value="{{ $deduction->utr_no }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_bank_utr_no') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="deduction_dates"
                                                                class="form-label">{{ __('field_deduction_date') }}
                                                            </label><input type="date" class="form-control date"
                                                                name="deduction_dates[]" id="deduction_dates"
                                                                value="{{ $deduction->deduction_date }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_date') }}</div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-4"><label for="purposes"
                                                                class="form-label">{{ __('field_purpose') }}
                                                            </label><input type="text"
                                                                class="form-control purposes"
                                                                name="purposes[]" id="purposes"
                                                                value="{{ $deduction->purpose }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_purpose') }}</div>
                                                        </div>
                                                        <div class="form-group col-md-4"><label for="deduction_names"
                                                                class="form-label">{{ __('field_deduction_names') }}
                                                            </label><input type="text" class="form-control"
                                                                name="deduction_names[]" id="deduction_names"
                                                                value="{{ $deduction->deduction_name }}">
                                                            <div class="invalid-feedback">{{ __('required_field') }}
                                                                {{ __('field_deduction_names') }}</div>
                                                        </div>
                                                    </div>
                                                @endforeach


                                                <div id="newFieldDeduction" class="clearfix"></div>
                                                <div class="form-group">
                                                    <button id="addFieldDeduction" type="button" class="btn btn-info"><i
                                                            class="fas fa-plus"></i>
                                                        {{ 'Add Any Other Deduction' }}</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    @endif


                                    <fieldset class="row scheduler-border">
                                        <legend>{{ __('field_total_information') }}</legend>


                                        <div class="form-group col-md-3">
                                            <label for="RefT" class="form-label">{{ __('field_total_ref') }}
                                                <span>(REF Amount)</span></label>
                                            <input type="text" class="form-control RefT" name="RefT"
                                                id="RefT" value="{{ $row->refTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_ref') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="CashT" class="form-label">{{ __('field_total_cash') }}
                                                <span>(<span>Cash Receiveds Amount</span>)</span></label>
                                            <input type="text" class="form-control CashT" name="CashT"
                                                id="CashT" value="{{ $row->cashTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_cash') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="BankT" class="form-label">{{ __('field_total_bank') }}
                                                <span>(Bank
                                                    Received Amount)</span></label>
                                            <input type="text" class="form-control BankT" name="BankT"
                                                id="BankT" value="{{ $row->bankTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_bank') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="deductionT" class="form-label">{{ __('field_de_name') }}
                                                <span>(Any Other Deduction Amount)</span></label>
                                            <input type="text" class="form-control BankT" name="deductionT"
                                                id="deductionT" value="{{ $row->deductionTotal }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_de_name') }}
                                            </div>

                                            <!--<div id="newFieldBank" class="clearfix"></div>-->
                                            <!--<div class="form-group">-->
                                            <!--    <button id="addFieldBank" type="button" class="btn btn-info"><i-->
                                            <!--            class="fas fa-plus"></i> {{ __('btn_add_bank') }}</button>-->
                                            <!--</div>-->
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label for="total_amounts"
                                                class="form-label">{{ __('field_total_information') }}
                                                <span>(<span>Cash Received Amount,</span><span>Bank Received
                                                        Amount,</span>)</span></label>
                                            <input type="text" class="form-control total_amounts" name="total_amounts"
                                                id="total_amounts" value="{{ $row->total_amounts }}">

                                            <div class="invalid-feedback">
                                                {{ __('required_field') }} {{ __('field_total_information') }}
                                            </div>


                                        </div>
                                    </fieldset>


                                    <!-- Form End--->
                                </content>


                            </form>
                        </div>

                    </div>
                </div>
                <!-- [ Card ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- End Content-->

@endsection

@section('page_js')
    <!-- validate Js -->
    <script src="{{ asset('dashboard/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>

    <!-- Wizard Js -->
    <script src="{{ asset('dashboard/js/pages/jquery.steps.js') }}"></script>

    <script type="text/javascript">
        "use strict";
        var form = $("#wizard-advanced-form").show();

        form.steps({
            headerTag: "h3",
            bodyTag: "content",
            transitionEffect: "slideLeft",
            labels: {
                finish: "{{ __('btn_finish') }}",
                next: "{{ __('btn_next') }}",
                previous: "{{ __('btn_previous') }}",
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                // Allways allow previous action even if the current form is not valid!
                if (currentIndex > newIndex) {
                    return true;
                }
                // Needed in some cases if the user went back (clean up)
                if (currentIndex < newIndex) {
                    // To remove error styles
                    form.find(".body:eq(" + newIndex + ") label.error").remove();
                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                }
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onStepChanged: function(event, currentIndex, priorIndex) {

            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                $("#wizard-advanced-form").submit();
            }
        }).validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {

            }
        });
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addField', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormField" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="relation" class="form-label">{{ __('field_relation') }} </label><input type="text" class="form-control" name="relations[]" id="relation" value="{{ old('relation') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_relation') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="relative_name" class="form-label">{{ __('field_name') }} </label><input type="text" class="form-control" name="relative_names[]" id="relative_name" value="{{ old('relative_name') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_name') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="occupation" class="form-label">{{ __('field_occupation') }} </label><input type="text" class="form-control" name="occupations[]" id="occupation" value="{{ old('occupation') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_occupation') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="relative_phone" class="form-label">{{ __('field_phone') }} </label><input type="text" class="form-control" name="relative_phones[]" id="relative_phone" value="{{ old('relative_phone') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_phone') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="address" class="form-label">{{ __('field_address') }} </label><input type="text" class="form-control" name="addresses[]" id="address" value="{{ old('address') }}" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_address') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><button id="removeField" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newField').append(html);
            });

            // remove Field
            $(document).on('click', '#removeField', function() {
                $(this).closest('#inputFormField').remove();
            });
        }(jQuery));
    </script>



    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldSecond', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldSecond" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="refrence_ids" class="form-label">{{ __('field_refrence_id') }}</label><input type="text" class="form-control" name="refrence_ids[]" id="refrence_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_refrence_id') }}</div></div>';

                html +=
                    '<div class="form-group col-md-4"><label for="ref_amounts" class="form-label">{{ __('field_ref_amount') }} </label><input type="text" class="form-control ref_amounts" name="ref_amounts[]" id="ref_amounts" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="ref_dates" class="form-label">{{ __('field_ref_date') }} </label><input type="date" class="form-control date" name="ref_dates[]" id="ref_dates" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="ref_names" class="form-label">{{ __('field_ref_name') }} </label><input type="text" class="form-control" name="ref_names[]" id="ref_names" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_ref_name') }}</div></div>';

                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldSecond" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldSecond').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldSecond', function() {
                $(this).closest('#inputFormFieldSecond').remove();
            });
        }(jQuery));
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldCash', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldcCash" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_ids" class="form-label">{{ __('field_cash_id') }}</label><input type="text" class="form-control" name="cash_ids[]" id="cash_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_amounts" class="form-label">{{ __('field_cash_amount') }} </label><input type="text" class="form-control cash_amounts" name="cash_amounts[]" id="cash_amounts" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_dates" class="form-label">{{ __('field_cash_date') }} </label><input type="date" class="form-control date" name="cash_dates[]" id="cash_dates" value="" ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="cash_names" class="form-label">{{ __('field_cash_name') }} </label><input type="text" class="form-control" name="cash_names[]" id="cash_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_cash_name') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldCash" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldCash').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldCash', function() {
                $(this).closest('#inputFormFieldcCash').remove();
            });
        }(jQuery));
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldBank', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldBank" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_ids" class="form-label">{{ __('field_bank_id') }}</label><input type="text" class="form-control" name="bank_ids[]" id="bank_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="utr_nos" class="form-label">{{ __('field_bank_utr_no') }} </label><input type="text" class="form-control utr_nos" name="utr_nos[]" id="utr_nos" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_utr_no') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_amounts" class="form-label">{{ __('field_bank_amount') }} </label><input type="text" class="form-control bank_amounts" name="bank_amounts[]" id="bank_amounts" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_amount') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_dates" class="form-label">{{ __('field_bank_date') }} </label><input type="date" class="form-control date" name="bank_dates[]" id="bank_dates" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_date') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="bank_names" class="form-label">{{ __('field_bank_names') }} </label><input type="text" class="form-control" name="bank_names[]" id="bank_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_names') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldBank" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldBank').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldBank', function() {
                $(this).closest('#inputFormFieldBank').remove();
            });
        }(jQuery));
    </script>



    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addFieldDeduction', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="inputFormFieldDeduction" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_ids" class="form-label">{{ __('field_deduction_id') }}</label><input type="text" class="form-control" name="deduction_ids[]" id="deduction_ids" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_id') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_amounts" class="form-label">{{ __('field_deduction_amount') }} </label><input type="text" class="form-control deduction_amounts" name="deduction_amounts[]" id="deduction_amounts" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_amount') }}</div></div>';
                    
                html +=
                    '<div class="form-group col-md-4"><label for="utr_nos" class="form-label">{{ __('field_bank_utr_no') }} </label><input type="text" class="form-control utr_nos" name="utr_nos[]" id="utr_nos" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_bank_utr_no') }}</div></div>';  
                    
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_dates" class="form-label">{{ __('field_deduction_date') }} </label><input type="date" class="form-control date" name="deduction_dates[]" id="deduction_dates" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_date') }}</div></div>';
                    
                html +=
                    '<div class="form-group col-md-4"><label for="purposes" class="form-label">{{ __('field_purpose') }} </label><input type="text" class="form-control purposes" name="purposes[]" id="purposes" value=""><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_purpose') }}</div></div>';
                        
                html +=
                    '<div class="form-group col-md-4"><label for="deduction_names" class="form-label">{{ __('field_deduction_names') }} </label><input type="text" class="form-control" name="deduction_names[]" id="deduction_names" value=""  ><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_deduction_names') }}</div></div>';


                html +=
                    '<div class="form-group col-md-4"><button id="removeFieldDeduction" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newFieldDeduction').append(html);
            });

            // remove Field
            $(document).on('click', '#removeFieldDeduction', function() {
                $(this).closest('#inputFormFieldDeduction').remove();
            });
        }(jQuery));
    </script>


    <script>
        function calculateTotal() {
            let refTotal = 0;
            let cashTotal = 0;
            let bankTotal = 0;
            let reductionTotal = 0;

            document.querySelectorAll('.ref_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                refTotal += value;
            });

            document.querySelectorAll('.cash_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                cashTotal += value;
            });

            document.querySelectorAll('.bank_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                bankTotal += value;
            });

            document.querySelectorAll('.deduction_amounts').forEach(function(input) {
                let value = parseFloat(input.value) || 0;
                reductionTotal += value;
            });

            let grandTotal = cashTotal + bankTotal;
            document.getElementById('RefT').value = refTotal.toFixed(2);
            document.getElementById('CashT').value = cashTotal.toFixed(2);
            document.getElementById('BankT').value = bankTotal.toFixed(2);
            document.getElementById('deductionT').value = reductionTotal.toFixed(2);

            document.getElementById('total_amounts').value = grandTotal.toFixed(2);
        }

        // Jab bhi amount me kuch type karo to calculate karo
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('ref_amounts') || e.target.classList.contains('cash_amounts') || e
                .target.classList.contains('bank_amounts') || e.target.classList.contains('deduction_amounts')) {
                calculateTotal();
            }
        });
    </script>

    <script type="text/javascript">
        (function($) {
            "use strict";
            // add Field
            $(document).on('click', '#addDocument', function() {
                var html = '';
                html += '<hr/>';
                html += '<div id="documentFormField" class="row">';
                html +=
                    '<div class="form-group col-md-4"><label for="title" class="form-label">{{ __('field_title') }} <span>*</span></label><input type="text" class="form-control" name="titles[]" id="title" value="{{ old('title') }}" required><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_title') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><label for="document" class="form-label">{{ __('field_document') }} <span>*</span></label><input type="file" class="form-control" name="documents[]" id="document" value="{{ old('document') }}" required><div class="invalid-feedback">{{ __('required_field') }} {{ __('field_document') }}</div></div>';
                html +=
                    '<div class="form-group col-md-4"><button id="removeDocument" type="button" class="btn btn-danger btn-filter"><i class="fas fa-trash-alt"></i> {{ __('btn_remove') }}</button></div>';
                html += '</div>';

                $('#newDocument').append(html);
            });

            // remove Field
            $(document).on('click', '#removeDocument', function() {
                $(this).closest('#documentFormField').remove();
            });
        }(jQuery));
    </script>

@endsection
