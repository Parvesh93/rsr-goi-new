@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            
            
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="checkbox checkbox-success d-inline">
                                                <input type="checkbox" id="checkbox" class="all_select">
                                                <label for="checkbox" class="cr" style="margin-bottom: 0px;"></label>
                                            </div>
                                        </th>
                                        <th>{{ __('field_title') }}</th>
                                        <th>{{ __('field_isbn') }}</th>
                                        <th>{{ __('field_category') }}</th>
                                        <th>{{ __('field_author') }}</th>
                                        <th>{{ __('field_location') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>
                                            <div class="checkbox checkbox-primary d-inline">
                                                <input type="checkbox" data_id="{{ $row->id }}" id="checkbox-{{ $row->id }}" value="{{ $row->id }}">
                                                <label for="checkbox-{{ $row->id }}" class="cr"></label>
                                            </div>
                                        </td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->isbn }}</td>
                                        <td>{{ $row->category->title ?? '' }}</td>
                                        <td>{{ $row->author }}</td>
                                        <td>
                                            {{ __('field_rack') }}: {{ $row->section }} <br> {{ __('field_column') }}: {{ $row->column }} <br> {{ __('field_row') }}: {{ $row->row }}
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">{{ __('status_available') }}</span>
                                            @elseif( $row->status == 2 )
                                            <span class="badge badge-pill badge-warning">{{ __('status_damage') }}</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">{{ __('status_lost') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can($access.'-print')
                                            <a href="#" class="btn btn-dark btn-sm" onclick="PopupWin('{{ route($route.'.token.print', $row->id) }}', '{{ $title }}', 800, 500);">
                                                <i class="fas fa-print"></i> {{ __('field_token') }}
                                            </a>
                                            @endcan
                                            
                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-{{ $row->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            @include($view.'.show')

                                            @can($access.'-edit')
                                            <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
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
                alert("{{ __('select') }} {{ __('field_book') }}");
            }

            var books = [];
            $.each($("input[data_id]:checked"), function(){
                books.push($(this).val());
            });

            $(".books").val( books.join(',') );
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