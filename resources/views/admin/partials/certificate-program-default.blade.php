@if(isset($programs))
<script>
(function () {
    "use strict";

    const certificateProgramDefaults = @json(
        $programs->mapWithKeys(function ($program) {
            return [(string) $program->id => (string) ($program->certificate_board_university_college ?? '')];
        })
    );

    function applyCertificateProgramDefault(force) {
        const program = document.querySelector('.program');
        const collegeName = document.querySelector('input[name="college_name"]');

        if (!program || !collegeName) {
            return;
        }

        const programId = String(program.value || '');
        const defaultValue = certificateProgramDefaults[programId] || '';

        if (!defaultValue) {
            return;
        }

        // Preserve an existing saved/manual value on initial load.
        // If the Program is changed, populate the newly selected Program's
        // default. The field remains editable afterwards.
        if (force || !collegeName.value.trim()) {
            collegeName.value = defaultValue;
            collegeName.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }

    document.addEventListener('change', function (event) {
        if (event.target && event.target.matches('.program')) {
            applyCertificateProgramDefault(true);
        }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            applyCertificateProgramDefault(false);
        });
    } else {
        applyCertificateProgramDefault(false);
    }
})();
</script>
@endif
