
<?php


/**
 * Convert Persian/Arabic numbers to English numbers
 * @link https://stackoverflow.com/a/22252878/3578287
 *
 * @param String $string
 * @return String
 */
function to_english_numbers(String $string): String {
    $persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $allPersianDigits = array_merge($persinaDigits1, $persinaDigits2);
    $replaces = [...range(0, 9), ...range(0, 9)];

    return str_replace($allPersianDigits, $replaces , $string);
}

function convertToPersianNumber($str){
    $english = array('0','1','2','3','4','5','6','7','8','9');
    $persian = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

    $convertedStr = str_replace($english, $persian, $str);
    return $convertedStr;
}