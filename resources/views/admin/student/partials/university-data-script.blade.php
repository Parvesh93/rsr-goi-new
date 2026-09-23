@if (!empty($programCondition))
<script>
    (function ($) {
        'use strict';

        const initialProgramId = @json(isset($row) ? ($row->program_id ?: optional($row->currentEnroll)->program_id) : old('program'));

        function periodOptions(type) {
            let html = '<option value="">Select</option>';
            for (let i = 1; i <= 8; i++) {
                const text = type === 'nursing' ? ('Semester ' + i) : ('Year ' + i);
                html += '<option value="' + i + '">' + text + '</option>';
            }
            return html;
        }

        function refreshUniversitySection(programId) {
            let matched = false;

            $('.university-program-section').each(function () {
                const sectionProgramId = String($(this).data('program-id') || '');
                const show = sectionProgramId !== '' && String(programId || '') === sectionProgramId;
                $(this).toggle(show);
                matched = matched || show;
            });

            $('.university-data-empty').toggle(!matched);
        }

        $(document).on('change', '#program, #program1', function () {
            refreshUniversitySection($(this).val());
        });

        $(document).on('click', '.add-university-row', function () {
            const type = $(this).data('type');
            const names = {
                nursing: ['nursing_years[]', 'nursing_semester_marksheets[]', 'nursing_admit_cards[]', 'Semester'],
                gnm: ['gnm_years[]', 'gnm_marksheets[]', 'gnm_admit_cards[]', 'Year'],
                anm: ['anm_years[]', 'anm_marksheets[]', 'anm_admit_cards[]', 'Year']
            };

            const c = names[type];
            if (!c) return;

            const html = `
                <div class="row university-row mb-3">
                    <input type="hidden" name="${type}_ids[]" value="">
                    <div class="form-group col-md-4">
                        <label>${c[3]}</label>
                        <select class="form-control" name="${c[0]}">
                            ${periodOptions(type)}
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Marksheet</label>
                        <input type="file" class="form-control" name="${c[1]}">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Admit Card</label>
                        <input type="file" class="form-control" name="${c[2]}">
                    </div>
                    <div class="form-group col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-university-row">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;

            $('#universityRows_' + type).append(html);
        });

        $(document).on('click', '.remove-university-row', function () {
            $(this).closest('.university-row').remove();
        });

        $(function () {
            const currentProgram = $('#program').val() || $('#program1').val() || initialProgramId;
            refreshUniversitySection(currentProgram);
        });
    })(jQuery);
</script>
@endif
