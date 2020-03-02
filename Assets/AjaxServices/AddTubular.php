<?php

function validTubularData($tubularOD, $tubularID, $weight) {
    $areNumeric = is_numeric($tubularOD) && is_numeric($tubularID) && is_numeric($weight);
    $isPhysical = ($tubularOD > $tubularID);
    return  $areNumeric && $isPhysical;
}

if (IsSet($_POST) && IsSet($_POST["tubularOD"]) && IsSet($_POST["tubularID"]) && IsSet($_POST["weight"])) {
        // Open database connection and get includes
        require_once "../../Includes/Database/db_connect.php";
        include "../../Includes/Database/dataQueries.php";

        // DEVELOPMENT ONLY
        createTubularTableIfNeeded($db);

        // POST request and user has entered data in both form fields
        $tubularOD = trim($_POST['tubularOD']);
        $tubularID = trim($_POST['tubularID']);
        $weight = trim($_POST['weight']);

        header("Content-type: application/json");
        if (validTubularData($tubularOD, $tubularID, $weight)
            && empty(checkIfTubularExists($db, $tubularOD, $tubularID, $weight))) {
            insertTubular($db, $tubularOD, $tubularID, $weight);
            echo json_encode(['message' => 'Tubular Added']);
        } else {
            echo json_encode(['message' => 'Tubular Not Added']);
        }
        http_response_code(200);

        $db->close();
} else  {
    http_response_code(400);    //does not support other methods
}

