<?php

namespace App\Support;

class CertificateWatermark
{
    public static function data($batch): array
    {
        if (!$batch) {
            return [
                'style' => '',
                'logo' => '',
            ];
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

        $tileWidth = max(58, (strlen($text) * 12) + 10);
        $tileHeight = 30;

        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $tileWidth . '" height="' . $tileHeight . '">'
            . '<text x="1" y="21" font-family="Arial, sans-serif" font-size="17" font-weight="700" fill="#7b7b7b" fill-opacity="0.18">'
            . $safeText
            . '</text></svg>';

        $pattern = 'data:image/svg+xml;base64,' . base64_encode($svg);

        return [
            'style' => 'background-image:url("' . $pattern . '") !important;'
                . 'background-repeat:repeat !important;'
                . 'background-position:left top !important;'
                . 'background-size:' . $tileWidth . 'px ' . $tileHeight . 'px !important;'
                . '-webkit-print-color-adjust:exact !important;'
                . 'print-color-adjust:exact !important;',
            'logo' => !empty($batch->clc_logo_img)
                ? asset('uploads/batch/' . $batch->clc_logo_img)
                : '',
        ];
    }

    public static function style($batch): string
    {
        return self::data($batch)['style'];
    }
}
