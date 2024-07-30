<?php
function proses($val) {
    $letters = preg_replace('/\d/', '', $val);
    $numbers = preg_replace('/\D/', '', $val);

    $reversedLetters = strrev($letters);
    return $reversedLetters . $numbers;
}
$input = "NEGIE1";
$result = proses($input);
echo $result;
?>