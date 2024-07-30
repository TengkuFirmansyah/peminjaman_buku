<?php
function proses($val) {
    $arr = explode(' ', $val);
    $long = '';
    
    foreach ($arr as $text) {
        if (strlen($text) > strlen($long)) {
            $long = $text;
        }
    }
    return $long;
}

$kalimat = "Saya sangat senang mengerjakan soal algoritma";
$long = proses($kalimat);
echo $long.' : '.strlen($long).' character';
?>
