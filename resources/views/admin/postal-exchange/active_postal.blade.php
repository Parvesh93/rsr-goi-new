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
                            <table id="export-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_type') }}</th>
                                        <th>{{ __('field_title') }}</th>
                                        <th>{{ __('field_category') }}</th>
                                        <th>{{ __('field_reference') }}</th>
                                        <th>{{ __('field_date') }}</th>
                                        <th>{{ __('field_status') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if( $row->type == 1 )
                                            <span class="badge badge-success"><i class="fas fa-download"></i></span> 
                                            {{ __('exchange_type_import') }}
                                            @elseif( $row->type == 2 )
                                            <span class="badge badge-danger"><i class="fas fa-upload"></i></span> 
                                            {{ __('exchange_type_export') }}
                                            @endif
                                        </td>
                                        <td>{!! str_limit($row->title, 50, ' ...') !!}</td>
                                        <td>{{ $row->category->title ?? '' }}</td>
                                        <td>{!! str_limit($row->reference, 30, ' ...') !!}</td>
                                        <td>
                                            @if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->date)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->date)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-primary">{{ __('status_on_hold') }}</span>
                                            @elseif( $row->status == 2 )
                                            <span class="badge badge-pill badge-info">{{ __('status_progress') }}</span>
                                            @elseif( $row->status == 3 )
                                            <span class="badge badge-pill badge-success">{{ __('status_received') }}</span>
                                            @elseif( $row->status == 4 )
                                            <span class="badge badge-pill badge-danger">{{ __('status_delivered') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown show d-inline-block">
                                                <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="statusMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-question"></i>
                                                </a>

                                                <div class="dropdown-menu" aria-labelledby="statusMenuLink">
                                                    <a class="dropdown-item" href="#" onclick="document.getElementById('status_on_hold_{{ $row->id }}').submit();">{{ __('status_on_hold') }}</a>
                                                    <a class="dropdown-item" href="#" onclick="document.getElementById('status_progress_{{ $row->id }}').submit();">{{ __('status_progress') }}</a>
                                                    <a class="dropdown-item" href="#" onclick="document.getElementById('status_received_{{ $row->id }}').submit();">{{ __('status_received') }}</a>
                                                    <a class="dropdown-item" href="#" onclick="document.getElementById('status_delivered_{{ $row->id }}').submit();">{{ __('status_delivered') }}</a>
                                                </div>

                                                <form action="{{ route($route.'.status', $row->id) }}" method="post" id="status_on_hold_{{ $row->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="1">
                                                </form>
                                                <form action="{{ route($route.'.status', $row->id) }}" method="post" id="status_progress_{{ $row->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="2">
                                                </form>
                                                <form action="{{ route($route.'.status', $row->id) }}" method="post" id="status_received_{{ $row->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="3">
                                                </form>
                                                <form action="{{ route($route.'.status', $row->id) }}" method="post" id="status_delivered_{{ $row->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="4">
                                                </form>
                                            </div>

                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-{{ $row->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Include Show modal -->
                                            @include($view.'.show')

                                            @if(is_file('uploads/'.$path.'/'.$row->attach))
                                            <a href="{{ asset('uploads/'.$path.'/'.$row->attach) }}" class="btn btn-icon btn-dark btn-sm" download><i class="fas fa-download"></i></a>
                                            @endif

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