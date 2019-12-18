<?php



session_start();



// $_SESSION['ambassadors_data']);


$list = $_SESSION['data'];

// $fp = fopen('file.csv', 'w');

// foreach ($list as $fields) {
//     fputcsv($fp, $fields);
// }

// fclose($fp);

print_r($list);




?>