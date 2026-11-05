@php
    $watermarkText = trim((string) optional($batch)->cc_watermark_text);

    if ($watermarkText === '') {
        $watermarkCollege = (string) (optional($batch)->cc_college ?: optional($batch)->clc_college);
        $watermarkCollege = preg_replace('/[^A-Za-z0-9 ]+/', ' ', $watermarkCollege);
        $watermarkWords = preg_split('/\s+/', trim($watermarkCollege), -1, PREG_SPLIT_NO_EMPTY);

        $watermarkText = collect($watermarkWords ?: [])
            ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
            ->implode('');
    }

    $watermarkText = strtoupper($watermarkText !== '' ? $watermarkText : 'CC');
    $watermarkLength = max(1, strlen($watermarkText));

    // Tight spacing similar to the Course Completion certificate watermark.
    $tileWidth = max(58, ($watermarkLength * 12) + 10);
    $patternId = 'certificate-watermark-' . (optional($batch)->id ?? 'default') . '-' . uniqid();
@endphp

<div class="certificate-watermark-layer" aria-hidden="true">
    <svg class="certificate-watermark-svg"
         viewBox="0 0 1000 1400"
         preserveAspectRatio="none"
         xmlns="http://www.w3.org/2000/svg">
        <defs>
            <pattern id="{{ $patternId }}"
                     width="{{ $tileWidth }}"
                     height="30"
                     patternUnits="userSpaceOnUse">
                <text x="1"
                      y="21"
                      font-family="Arial, sans-serif"
                      font-size="17"
                      font-weight="700"
                      fill="#7b7b7b"
                      fill-opacity="0.18">{{ $watermarkText }}</text>
            </pattern>
        </defs>
        <rect x="-30" y="0" width="1060" height="1400" fill="url(#{{ $patternId }})" />
    </svg>

    @if(!empty(optional($batch)->clc_logo_img))
        <div class="certificate-watermark-logo">
            <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}" alt="">
        </div>
    @endif
</div>
