<?php

require_once('includes/classes/Database.php');
require_once('includes/classes/College.php');


session_start();


if(isset($_POST['college_name']) && isset($_POST['index'])) {

    $college_name = $_POST['college_name'];

    $index = $_POST['index'];

    // session_start();

    $_SESSION['data'][$index][0] = $college_name;


    echo "1";


}






?>