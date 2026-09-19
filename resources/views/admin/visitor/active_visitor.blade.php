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
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_purpose') }}</th>
                                        <th>{{ __('field_department') }}</th>
                                        <th>{{ __('field_token') }}</th>
                                        <th>{{ __('field_date') }}</th>
                                        <th>{{ __('field_in_time') }}</th>
                                        <th>{{ __('field_out_time') }}</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->purpose->title ?? '' }}</td>
                                        <td>{{ $row->department->title ?? '' }}</td>
                                        <td>{{ $print->prefix ?? '' }}{{ $row->token }}</td>
                                        <td>
                                            @if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->date)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->date)) }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success">
                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->in_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->in_time)) }}
                                            @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if(isset($row->out_time))
                                            <span class="badge badge-pill badge-danger">
                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->out_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->out_time)) }}
                                            @endif
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($row->out_time))
                                            @can($access.'-print')
                                            @if(isset($print))
                                            <a href="#" class="btn btn-dark btn-sm" onclick="PopupWin('{{ route($route.'.token.print', $row->id) }}', '{{ $title }}', 800, 500);">
                                                <i class="fas fa-print"></i> {{ __('field_token') }}
                                            </a>
                                            @endif
                                            @endcan

                                            <button type="button" class="btn btn-icon btn-secondary btn-sm" title="Visitor Exit" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $row->id }}">
                                                <i class="fas fa-sign-out-alt"></i>
                                            </button>
                                            <!-- Include Confirm modal -->
                                            @include($view.'.confirm')
                                            <br/>
                                            @endif

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