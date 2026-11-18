@if(isset($programs))
<script>
(function ($) {
    "use strict";

    const certificateProgramDefaults = @json(
        $programs->mapWithKeys(function ($program) {
            return [(string) $program->id => (string) ($program->certificate_board_university_college ?? '')];
        })
    );

    function applyCertificateProgramDefault(force) {
        const $program = $('.program').first();
        const $collegeName = $('input[name="college_name"]').first();

        if (!$program.length || !$collegeName.length) {
            return;
        }

        const programId = String($program.val() || '');
        const defaultValue = certificateProgramDefaults[programId] || '';

        if (!defaultValue) {
            return;
        }

        // On initial load, preserve old/saved/manual values.
        // When the user changes Program, use the selected Program's default,
        // but the field remains fully editable afterwards.
        if (force || !$collegeName.val().trim()) {
            $collegeName.val(defaultValue).trigger('change');
        }
    }

    $(document).on('change', '.program', function () {
        applyCertificateProgramDefault(true);
    });

    $(function () {
        applyCertificateProgramDefault(false);
    });
})(jQuery);
</script>
@endif
