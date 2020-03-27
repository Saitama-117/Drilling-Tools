<?php

$data = IsSet($_POST) && IsSet($_POST["toolID"]) && IsSet($_POST["tubularID"]);

if($data){
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/cutsQueries.php";

    $toolId = trim($_POST["toolID"]);
    $tubularId = trim($_POST["tubularID"]);

    $isNumeric = is_numeric($toolId) && is_numeric($tubularId);
    $notInDatabase = empty(checkIfToolAlreadyCutsTubular($db, $toolId, $tubularId));

    $message = "";

    if($isNumeric && !$notInDatabase){
        deleteCutsByTubularIdAndToolId($db, $toolId, $tubularId);
        $message = "Deleted Successfully";
        http_response_code(200);
    } else {
        if (!$isNumeric) $message = "Error in Cuts Data";
        if ($notInDatabase) $message = "Cut type not present in Cuts Data";

        http_response_code(400);
    }
    echo json_encode(['message' => $message]);
    $db -> close();
}
