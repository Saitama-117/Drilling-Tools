<?php

$data = IsSet($_POST) && IsSet($_POST["tubularID"]);

if($data){
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/tubularQueries.php";
    include "../../Includes/Database/cutsQueries.php";

    $tubularId = trim($_POST["tubularID"]);

    $isNumeric = is_numeric($tubularId);
    $notInDatabase = empty(readTubularData($db, $tubularId));
    $message = "";

    if($isNumeric && !$notInDatabase){
        deleteCutsByTubularId($db, $tubularId);
        deleteTubular($db, $tubularId);
        $message = "Deleted Successfully";
        http_response_code(200);
    } else {
        if (!$isNumeric) $message = "Error in Tubular Data";
        if ($notInDatabase) $message = "TubularID not present in Tubular Data";

        http_response_code(400);
    }
    echo json_encode(['message' => $message]);
    $db -> close();
}
