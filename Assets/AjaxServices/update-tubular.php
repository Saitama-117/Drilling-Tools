<?php

function validTubularData($tubularOD, $tubularID, $weight) {
    $areNumeric = is_numeric($tubularOD) && is_numeric($tubularID) && is_numeric($weight);
    $isPhysical = ($tubularOD > $tubularID);
    return  $areNumeric && $isPhysical;
}

if (IsSet($_POST) && IsSet($_POST["tubularOD"]) && IsSet($_POST["tubularID"]) && IsSet($_POST["weight"])
        && IsSet($_POST['tubularId'])) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/tubularQueries.php";
    include "../../Includes/Database/cutsQueries.php";

    // POST request and user has entered data in both form fields
    $tubularOD = trim($_POST['tubularOD']);
    $tubularID = trim($_POST['tubularID']);
    $weight = trim($_POST['weight']);
    $tubularId = trim($_POST['tubularId']);

    header("Content-type: application/json");
    $message = "";
    $validData = validTubularData($tubularOD, $tubularID, $weight);
    $notInDatabase = empty(checkIfTubularExists($db, $tubularOD, $tubularID, $weight));

    if ($validData && $notInDatabase) {
        updateTubular($db, $tubularOD, $tubularID, $weight, $tubularId);
        deleteCutsByTubularId($db, $tubularId);
        $message = "Tubular Modified";
    } else {
        if (!$validData) $message = "Error in Tubular Data";
        if (!$notInDatabase) $message = "Tubular Already in Database";
    }
    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
} else  {
    http_response_code(400);    //does not support other methods
}

