<?php
function proses($input, $query) {
    $result = [];
    $check = array_count_values($input);

    foreach ($query as $val) {
        $result[] = isset($check[$val]) ? $check[$val] : 0;
    }
    return $result;
}

$input = ['xc', 'dz', 'bbb', 'dz'];
$query = ['bbb', 'ac', 'dz'];
$hasil = proses($input, $query);
echo "OUTPUT = [" . implode(', ', $hasil) . "]";

?>
