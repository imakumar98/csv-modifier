<?php

require_once('includes/classes/Database.php');
require_once('includes/classes/College.php');


session_start();





if(isset($_POST['addCollege'])) {

    $college_name = Database::escaped_string($_POST['college_name']);

    $index = $_POST['index'];

    $college = College::save_v2(array(
        "name"=>$college_name
    ));

    if($college) {

        // session_start();
        $_SESSION['data'][$index][0] = $college_name;

        echo "1";

        
    }




}




?>