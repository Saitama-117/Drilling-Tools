<?php

$data = IsSet($_GET) && IsSet($_GET["tool-id"]);

if($data){
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    $toolId = trim($_GET["tool-id"]);

    $isNumeric = is_numeric($toolId);

    if($isNumeric){
        $toolDetails = readToolData($db, $toolId);
        echo json_encode($toolDetails);
        $db -> close();
    }

}

