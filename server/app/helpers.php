<?php

use NumberToWords\NumberToWords;

if (!function_exists('number_to_currency_words')) {
    function number_to_currency_words($number, $locale = 'en', $currency = 'dirhams', $subunit = 'centimes') {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer($locale);
        
        // Split the number into the integer part and the decimal part
        $parts = explode('.', number_format($number, 2, '.', ''));
        $integerPart = (int)$parts[0];
        $decimalPart = (int)$parts[1];

        // Convert each part to words
        $integerPartInWords = $numberTransformer->toWords($integerPart);
        $decimalPartInWords = $numberTransformer->toWords($decimalPart);

        return "{$integerPartInWords} {$currency} and {$decimalPartInWords} {$subunit}";
    }

}
