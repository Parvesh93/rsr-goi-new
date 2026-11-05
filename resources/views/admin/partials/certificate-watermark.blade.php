@php
    $watermarkData = \App\Support\CertificateWatermark::data($batch);
@endphp

@if(!empty($watermarkData['logo']))
    <div class="certificate-watermark-logo" aria-hidden="true">
        <img src="{{ $watermarkData['logo'] }}" alt="">
    </div>
@endif
