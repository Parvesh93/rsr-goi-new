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
                        <div class="card-header">
                            <h5>{{ $title }} {{ __('list') }}</h5>
                        </div>
                        <div class="card-block">
<a href="{{ route($route . '.index') }}" class="btn btn-info"><i class="fas fa-sync-alt"></i>
                                {{ __('btn_refresh') }}</a>

                        </div>

                        <div class="card-block">
                            <form class="needs-validation" novalidate method="get" action="{{ route($route . '.index') }}">
                                <div class="row gx-2">
                                    <div class="form-group col-md-2">
                                        <label for="department">{{ __('field_department') }}</label>
                                        <select class="form-control" name="department" id="department">
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if ($selected_department == $department->id) selected @endif>
                                                    {{ $department->title }}</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_department') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="designation">{{ __('field_designation') }}</label>
                                        <select class="form-control" name="designation" id="designation">
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}"
                                                    @if ($selected_designation == $designation->id) selected @endif>
                                                    {{ $designation->title }}</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_designation') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="role">{{ __('field_role') }}</label>
                                        <select class="form-control" name="role" id="role">
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @if ($selected_role == $role->id) selected @endif>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_role') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="contract_type">{{ __('field_contract_type') }} </label>
                                        <select class="form-control" name="contract_type" id="contract_type">
                                            <option value="0">{{ __('all') }}</option>
                                            <option value="1" {{ $selected_contract == 1 ? 'selected' : '' }}>
                                                {{ __('contract_type_full_time') }}</option>
                                            <option value="2" {{ $selected_contract == 2 ? 'selected' : '' }}>
                                                {{ __('contract_type_part_time') }}</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_contract_type') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="shift">{{ __('field_work_shift') }}</label>
                                        <select class="form-control" name="shift" id="shift">
                                            <option value="0">{{ __('all') }}</option>
                                            @foreach ($work_shifts as $shift)
                                                <option value="{{ $shift->id }}"
                                                    @if ($selected_shift == $shift->id) selected @endif>{{ $shift->title }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            {{ __('required_field') }} {{ __('field_work_shift') }}
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
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
                                    <table id="export-table" class="display table nowrap table-striped table-hover"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('field_staff_id') }}</th>
                                                <th>{{ __('field_photo') }}</th>
                                                <th>{{ __('field_name') }}</th>
                                                <th>{{ __('field_department') }}</th>
                                                <th>{{ __('field_designation') }}</th>
                                                <th>{{ __('field_role') }}</th>
                                                <th>{{ __('field_salary_type') }}</th>
                                                <th>{{ __('field_status') }}</th>
                                                <th>{{ __('field_action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rows as $key => $row)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.user.show', $row->id) }}">
                                                            {{ $row->staff_id }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <img class="rounded-circle" style="width:40px;"
                                                            src="{{ asset('uploads/' . $path . '/' . $row->photo) }}"
                                                            @if ($row->gender == 1) onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';" @else  onerror="this.src='{{ asset('dashboard/images/user/avatar-1.jpg') }}';" @endif
                                                            alt="{{ $row->staff_id }}">
                                                    </td>
                                                    <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                                    <td>{{ $row->department->title ?? '' }}</td>
                                                    <td>{{ $row->designation->title ?? '' }}</td>
                                                    <td>
                                                        @foreach ($row->roles as $role)
                                                            {{ $role->name ?? '' }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($row->salary_type == 1)
                                                            {{ __('salary_type_fixed') }}
                                                        @elseif($row->salary_type == 2)
                                                            {{ __('salary_type_hourly') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($row->status == 1)
                                                            <span
                                                                class="badge badge-pill badge-success">{{ __('status_active') }}</span>
                                                        @else
                                                            <span
                                                                class="badge badge-pill badge-danger">{{ __('status_inactive') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>



                                                        @can('user-view')
                                                           
                                                                <a href="#" class="btn btn-icon btn-dark btn-sm"
                                                                    onclick="PopupWin('{{ route($route . '.print', ['id' => $row->id]) }}', '{{ $title }}', 1000, 600);">
                                                                    <i class="fas fa-print"></i>
                                                                </a>
                                                            
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
