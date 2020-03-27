<?php

$data = IsSet($_POST) && IsSet($_POST["toolID"]);

if($data){
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    $toolId = trim($_POST["toolID"]);

    $isNumeric = is_numeric($toolId);
    $notInDatabase = empty(readToolData($db, $toolId));

    $message = "";

    if($isNumeric && !$notInDatabase){
        deleteTools($db, $toolId);
        $message = "Deleted Successfully";
        http_response_code(200);
    } else {
        if (!$isNumeric) $message = "Error in Tool Data";
        if ($notInDatabase) $message = "ToolID not present in Tool Data";

        http_response_code(400);
    }
    echo json_encode(['message' => $message]);
    $db -> close();
}
