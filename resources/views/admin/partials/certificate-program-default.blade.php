<script>
(function () {
    "use strict";

    const defaultUrlTemplate = @json(route('filter-certificate-program-default', ['program' => '__PROGRAM__']));

    function getElements() {
        return {
            program: document.querySelector('.program'),
            collegeName: document.querySelector('input[name="college_name"]')
        };
    }

    async function applyCertificateProgramDefault(force) {
        const { program, collegeName } = getElements();

        if (!program || !collegeName) {
            return;
        }

        const programId = String(program.value || '').trim();

        if (!programId || programId === '0') {
            return;
        }

        // On initial load preserve an already-saved/manual value.
        if (!force && collegeName.value.trim()) {
            return;
        }

        try {
            const url = defaultUrlTemplate.replace('__PROGRAM__', encodeURIComponent(programId));
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            const defaultValue = String(data.certificate_board_university_college || '').trim();

            if (!defaultValue) {
                return;
            }

            // If Program was changed while the request was in flight, do not
            // apply the old Program's value.
            if (String(program.value || '') !== programId) {
                return;
            }

            collegeName.value = defaultValue;
            collegeName.dispatchEvent(new Event('change', { bubbles: true }));
        } catch (error) {
            // Leave the editable field untouched if the lookup fails.
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
