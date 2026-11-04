@extends('admin.layouts.master')
@section('title', $title)
@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h5>{{ $title }} List</h5></div>
                    <div class="card-block">
                        @can($access . '-create')
                            <a href="{{ route('admin.course-completion.create', ['type' => $type]) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('btn_add_new') }}
                            </a>
                        @endcan
                        <a href="{{ route('admin.course-completion.index', ['type' => $type]) }}" class="btn btn-info">
                            <i class="fas fa-sync-alt"></i> {{ __('btn_refresh') }}
                        </a>
                    </div>

                    <div class="card-block">
                        <form method="get" action="{{ route('admin.course-completion.index', ['type' => $type]) }}">
                            <div class="row gx-2">
                                <div class="form-group col-md-3">
                                    <label>College Department</label>
                                    <select class="form-control" name="department">
                                        <option value="0">{{ __('all') }}</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" @selected($selected_department == $department->id)>{{ $department->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('field_faculty') }}</label>
                                    <select class="form-control" name="faculty">
                                        <option value="0">{{ __('all') }}</option>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->id }}" @selected($selected_faculty == $faculty->id)>{{ $faculty->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('field_program') }}</label>
                                    <select class="form-control" name="program">
                                        <option value="0">{{ __('all') }}</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" @selected($selected_program == $program->id)>{{ $program->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('field_session') }}</label>
                                    <select class="form-control" name="session">
                                        <option value="0">{{ __('all') }}</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}" @selected($selected_session == $session->id)>{{ $session->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>{{ __('field_student_id') }}</label>
                                    <input type="text" class="form-control" name="student_id" value="{{ $selected_student_id }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Registration No</label>
                                    <input type="text" class="form-control" name="student_regi" value="{{ $selected_student_regi }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info btn-filter"><i class="fas fa-search"></i> {{ __('btn_search') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="export-table" class="display table nowrap table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('field_serial_no') }}</th>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>Registration No</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_program') }}</th>
                                        <th>{{ __('field_session') }}</th>
                                        <th>Certificate</th>
                                        <th>{{ __('field_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_pad((int) $row->serial_no, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $row->student_id }}</td>
                                            <td>{{ $row->registration_no }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->program->title ?? '' }}</td>
                                            <td>{{ $row->session->title ?? '' }}</td>
                                            <td>
                                                <a href="#" class="btn btn-icon btn-dark btn-sm"
                                                    onclick="PopupWin('{{ route('admin.course-completion.print', ['type' => $type, 'courseCompletion' => $row->id]) }}', 'CourseCompletionCertificate', 1000, 700);">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @can($access . '-edit')
                                                    <a href="{{ route('admin.course-completion.edit', ['type' => $type, 'courseCompletion' => $row->id]) }}" class="btn btn-icon btn-primary btn-sm">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can($access . '-delete')
                                                    <form action="{{ route('admin.course-completion.destroy', ['type' => $type, 'courseCompletion' => $row->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this certificate record?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
