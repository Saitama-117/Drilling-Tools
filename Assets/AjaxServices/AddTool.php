<?php
function validToolData($toolOD, $minPressure, $maxPressure, $minTemp, $maxTemp) {
    $areNumeric = is_numeric($toolOD) && is_numeric($minPressure) && is_numeric($maxPressure);
    $areNumeric = $areNumeric && is_numeric($minTemp) && is_numeric($maxTemp);
    $isPhysical = ($maxPressure > $minPressure) && ($maxTemp > $minTemp);
    return  $areNumeric && $isPhysical;
}

if (IsSet($_POST) && IsSet($_POST["toolOD"]) && IsSet($_POST["minPressure"])
        && IsSet($_POST["maxPressure"]) && IsSet($_POST["minTemp"]) && IsSet($_POST["maxTemp"])) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    // POST request and user has entered data in both form fields
    $toolOD = trim($_POST['toolOD']);
    $minPressure = trim($_POST['minPressure']);
    $maxPressure = trim($_POST['maxPressure']);
    $minTemp = trim($_POST['minTemp']);
    $maxTemp = trim($_POST['maxTemp']);

    header("Content-type: application/json");
    $message = "";
    $validData = validToolData($toolOD, $minPressure, $maxPressure, $minTemp, $maxTemp);
    $notInDatabase = empty(checkIfToolExists($db, $toolOD, $minTemp, $maxTemp, $minPressure, $maxPressure));

    if ($validData && $notInDatabase) {
        insertTool($db, $toolOD, $minTemp, $maxTemp, $minPressure, $maxPressure);
        $message = "Tool Added";
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