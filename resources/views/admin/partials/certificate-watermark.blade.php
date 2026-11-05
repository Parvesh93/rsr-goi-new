@php
    $watermarkText = trim((string) optional($batch)->cc_watermark_text);

    if ($watermarkText === '') {
        $watermarkCollege = (string) (optional($batch)->cc_college ?: optional($batch)->clc_college);
        $watermarkCollege = preg_replace('/[^A-Za-z0-9 ]+/', ' ', $watermarkCollege);
        $watermarkWords = preg_split('/\\s+/', trim($watermarkCollege), -1, PREG_SPLIT_NO_EMPTY);

        $watermarkText = collect($watermarkWords ?: [])
            ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
            ->implode('');
    }

    $watermarkText = strtoupper($watermarkText !== '' ? $watermarkText : 'CC');
    $tileWidth = max(58, (strlen($watermarkText) * 12) + 10);
    $patternId = 'wm-' . (optional($batch)->id ?? 'x') . '-' . uniqid();
@endphp

<div aria-hidden="true"
     style="position:absolute !important; inset:0 !important; z-index:0 !important; overflow:hidden !important; pointer-events:none !important;">
    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 1000 1400"
         preserveAspectRatio="none"
         style="position:absolute !important; left:0 !important; top:0 !important; width:100% !important; height:100% !important; display:block !important;">
        <defs>
            <pattern id="{{ $patternId }}" width="{{ $tileWidth }}" height="30" patternUnits="userSpaceOnUse">
                <text x="1" y="21"
                      font-family="Arial, sans-serif"
                      font-size="17"
                      font-weight="700"
                      fill="#7b7b7b"
                      fill-opacity="0.18">{{ $watermarkText }}</text>
            </pattern>
        </defs>
        <rect x="-30" y="0" width="1060" height="1400" fill="url(#{{ $patternId }})"></rect>
    </svg>

    @if(!empty(optional($batch)->clc_logo_img))
        <img src="{{ asset('uploads/batch/' . $batch->clc_logo_img) }}"
             alt=""
             style="position:absolute !important; left:50% !important; top:50% !important; transform:translate(-50%,-50%) !important; width:48% !important; max-width:430px !important; height:auto !important; opacity:0.075 !important; filter:grayscale(100%) !important; margin:0 !important; z-index:0 !important;">
    @endif
</div>
