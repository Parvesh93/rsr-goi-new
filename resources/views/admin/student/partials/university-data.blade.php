@if (!empty($programCondition))
    @php
        $selectedProgramId = isset($row)
            ? ($row->program_id ?: optional($row->currentEnroll)->program_id)
            : old('program');
    @endphp

    <h3>University Data</h3>
    <content class="form-step">
        <div class="alert alert-info university-data-empty mb-3">
            Select a configured B.Sc Nursing, GNM or ANM program to manage its semester/year documents.
        </div>

        <div class="university-program-section" data-program-id="{{ $programCondition->bsc_nursing_id }}" data-type="nursing" style="display:none;">
            <fieldset class="row scheduler-border">
                <legend>B.Sc Nursing - Semester Documents</legend>
                <div class="col-md-12 university-rows" id="universityRows_nursing">
                    @if (isset($row))
                        @foreach ($row->nursingData as $record)
                            <div class="row university-row mb-3">
                                <input type="hidden" name="nursing_ids[]" value="{{ $record->id }}">
                                <div class="form-group col-md-4">
                                    <label>Semester</label>
                                    <select class="form-control" name="nursing_years[]">
                                        <option value="">Select</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" @selected($record->year == $i)>{{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Semester</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Semester Marksheet</label>
                                    <input type="file" class="form-control" name="nursing_semester_marksheets[]">
                                    @if (!empty($record->marksheet))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->marksheet) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Admit Card</label>
                                    <input type="file" class="form-control" name="nursing_admit_cards[]">
                                    @if (!empty($record->admit_card))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->admit_card) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-info add-university-row" data-type="nursing">
                        <i class="fas fa-plus"></i> Add Semester
                    </button>
                </div>
            </fieldset>
        </div>

        <div class="university-program-section" data-program-id="{{ $programCondition->gnm_id }}" data-type="gnm" style="display:none;">
            <fieldset class="row scheduler-border">
                <legend>GNM - Year Documents</legend>
                <div class="col-md-12 university-rows" id="universityRows_gnm">
                    @if (isset($row))
                        @foreach ($row->gnmData as $record)
                            <div class="row university-row mb-3">
                                <input type="hidden" name="gnm_ids[]" value="{{ $record->id }}">
                                <div class="form-group col-md-4">
                                    <label>Year</label>
                                    <select class="form-control" name="gnm_years[]">
                                        <option value="">Select</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" @selected($record->year == $i)>Year {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Marksheet</label>
                                    <input type="file" class="form-control" name="gnm_marksheets[]">
                                    @if (!empty($record->marksheet))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->marksheet) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Admit Card</label>
                                    <input type="file" class="form-control" name="gnm_admit_cards[]">
                                    @if (!empty($record->admit_card))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->admit_card) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-info add-university-row" data-type="gnm">
                        <i class="fas fa-plus"></i> Add Year
                    </button>
                </div>
            </fieldset>
        </div>

        <div class="university-program-section" data-program-id="{{ $programCondition->anm_id }}" data-type="anm" style="display:none;">
            <fieldset class="row scheduler-border">
                <legend>ANM - Year Documents</legend>
                <div class="col-md-12 university-rows" id="universityRows_anm">
                    @if (isset($row))
                        @foreach ($row->anmData as $record)
                            <div class="row university-row mb-3">
                                <input type="hidden" name="anm_ids[]" value="{{ $record->id }}">
                                <div class="form-group col-md-4">
                                    <label>Year</label>
                                    <select class="form-control" name="anm_years[]">
                                        <option value="">Select</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" @selected($record->year == $i)>Year {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Marksheet</label>
                                    <input type="file" class="form-control" name="anm_marksheets[]">
                                    @if (!empty($record->marksheet))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->marksheet) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Admit Card</label>
                                    <input type="file" class="form-control" name="anm_admit_cards[]">
                                    @if (!empty($record->admit_card))
                                        <a class="btn btn-sm btn-dark mt-1" href="{{ asset('uploads/' . $path . '/' . $record->admit_card) }}" target="_blank">View Current</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-info add-university-row" data-type="anm">
                        <i class="fas fa-plus"></i> Add Year
                    </button>
                </div>
            </fieldset>
        </div>
    </content>
@endif
