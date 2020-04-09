<?php

if (IsSet($_POST) && IsSet($_POST["toolOD"]) && IsSet($_POST["minPressure"]) && IsSet($_POST["CADurl"])
    && IsSet($_POST["maxPressure"]) && IsSet($_POST["minTemp"]) && IsSet($_POST["maxTemp"])
        && IsSet($_POST["toolID"])) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";
    include "../../Includes/Database/cutsQueries.php";
    include "../../Includes/Utilities/validate-tool-data.php";

    // POST request and user has entered data in both form fields
    $toolID = trim($_POST["toolID"]);
    $toolOD = trim($_POST['toolOD']);
    $minPressure = trim($_POST['minPressure']);
    $maxPressure = trim($_POST['maxPressure']);
    $minTemp = trim($_POST['minTemp']);
    $maxTemp = trim($_POST['maxTemp']);
    $CADurl = trim($_POST['CADurl']);

    header("Content-type: application/json");
    $message = "";
    $validData = validToolData($toolOD, $minPressure, $maxPressure, $minTemp, $maxTemp, $CADurl);
    $notInDatabase = empty(checkIfToolExists($db, $toolOD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl));

    if ($validData && $notInDatabase) {
        updateTool($db, $toolID, $toolOD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
        deleteCutsByToolId($db, $toolID);
        $message = "Tool Modified - Please Recreate Tool/Tubular Link(s) Below ";
    } else {
        if (!$validData) $message = "Error in Tool Data";
        if (!$notInDatabase) $message = "Tool Already in Database";
    }
    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
} else  {
    http_response_code(400);    //does not support other methods
}