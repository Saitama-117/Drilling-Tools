<?php

$data = IsSet($_GET) && IsSet($_GET["tubular-id"]);

if($data){
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/tubularQueries.php";

    $tubularId = trim($_GET["tubular-id"]);

    $isNumeric = is_numeric($tubularId);

    if($isNumeric){
        $tubularDetails = readTubularData($db, $tubularId);
        echo json_encode($tubularDetails);
        $db -> close();
    }

}
