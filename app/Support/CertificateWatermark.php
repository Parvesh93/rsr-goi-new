<?php

namespace App\Support;

class CertificateWatermark
{
    public static function style($batch): string
    {
        if (!$batch) {
            return '';
        }

        $text = trim((string) ($batch->cc_watermark_text ?? ''));

        if ($text === '') {
            $college = (string) (($batch->cc_college ?? '') ?: ($batch->clc_college ?? ''));
            $college = preg_replace('/[^A-Za-z0-9 ]+/', ' ', $college);
            $words = preg_split('/\s+/', trim($college), -1, PREG_SPLIT_NO_EMPTY);

            $text = implode('', array_map(
                static fn ($word) => strtoupper(substr($word, 0, 1)),
                $words ?: []
            ));
        }

        $text = strtoupper($text !== '' ? $text : 'CC');
        $safeText = htmlspecialchars($text, ENT_QUOTES | ENT_XML1, 'UTF-8');

        // Tight tile width keeps the repeating text close together while
        // still covering the full certificate width and height.
        $tileWidth = max(54, (strlen($text) * 11) + 8);
        $tileHeight = 29;

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $tileWidth . '" height="' . $tileHeight . '">'
            . '<text x="1" y="20" font-family="Arial, sans-serif" font-size="17" font-weight="700" fill="#7b7b7b" fill-opacity="0.18">'
            . $safeText
            . '</text></svg>';

        $pattern = 'data:image/svg+xml;base64,' . base64_encode($svg);

        $logo = !empty($batch->clc_logo_img)
            ? asset('uploads/batch/' . $batch->clc_logo_img)
            : '';

        $logoValue = $logo !== '' ? 'url("' . e($logo) . '")' : 'none';

        // Apply the complete watermark directly on the certificate element.
        // This is intentionally inline because the print plugin may clone only
        // the printable node and can lose inherited CSS custom properties.
        return 'background-image:url("' . $pattern . '"),'
            . 'linear-gradient(rgba(255,255,255,0.925),rgba(255,255,255,0.925)),'
            . $logoValue . ' !important;'
            . 'background-repeat:repeat,no-repeat,no-repeat !important;'
            . 'background-position:left top,center center,center center !important;'
            . 'background-size:' . $tileWidth . 'px 29px,100% 100%,48% auto !important;';
    }
}
