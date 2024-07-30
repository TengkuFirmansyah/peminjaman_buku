<?php
function proses($matrix) {
    $n = count($matrix);
    $angka1 = 0;
    $angka2 = 0;

    for ($i = 0; $i < $n; $i++) {
        $angka1 += $matrix[$i][$i];
        $angka2 += $matrix[$i][$n - $i - 1];
    }
    return abs($angka1 - $angka2);
}

$matrix = [
    [1, 2, 0],
    [4, 5, 6],
    [7, 8, 9]
];

$hasil = proses($matrix);
echo "Hasil = $hasil";
?>
