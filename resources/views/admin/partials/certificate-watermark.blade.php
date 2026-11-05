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

    if ($watermarkLength <= 5) {
        $watermarkColumns = 12;
    } elseif ($watermarkLength <= 8) {
        $watermarkColumns = 9;
    } elseif ($watermarkLength <= 12) {
        $watermarkColumns = 7;
    } else {
        $watermarkColumns = 5;
    }
@endphp

<div class="certificate-watermark-layer" aria-hidden="true">
    <div class="certificate-watermark-text"
         style="grid-template-columns: repeat({{ $watermarkColumns }}, minmax(0, 1fr));">
        @for($i = 0; $i < 1200; $i++)
            <span>{{ $watermarkText }}</span>
        @endfor
    </div>

    @if(!empty(optional($batch)->clc_logo_img))
        <div class="certificate-watermark-logo">
            <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}" alt="">
        </div>
    @endif
</div>
