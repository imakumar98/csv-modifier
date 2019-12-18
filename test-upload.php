<?php 

session_start();



$csv_file = fopen('file.csv', 'r');

$current_row = 0;

// session_start();
$_SESSION['data'] = array();
$result_array = array();

$correct_records = 0;

while (($data = fgetcsv($csv_file, 1000, ",")) !== FALSE) 
{
    
    if($current_row!=0) {

        $_SESSION['data'][] = $data;
 
    }


       


        


    $current_row++;

    
    
}



    




?>