<?php

if (IsSet($_POST) && IsSet($_POST["toolID"]) && IsSet($_POST["tubulars"])) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/cutsQueries.php";

    // DEVELOPMENT ONLY
    createToolTubularLinkIfNeeded($db);

    // POST request and user has entered data in both form fields
    $toolID = $_POST['toolID'];
    $tubulars = array();
    $tubulars = $_POST['tubulars'];

    header("Content-type: application/json");
    $message = "Cut(s) Already in Database";
    $index = 0;

    foreach ($tubulars as $tubular) {
        //$validData = validTubularData($tubularOD, $tubularID, $weight);
        $tubularID = $tubular[$index];
        $notInDatabase = empty(checkIfToolAlreadyCutsTubular($db, $toolID, $tubularID));

        if ($notInDatabase) {
            insertToolCutsTubular($db, $toolID, $tubularID);
            $message = "Cut(s) Added";
        }
    }

    echo json_encode(['message' => $message]);
    http_response_code(200);

    $db->close();
} else  {
    http_response_code(400);    //does not support other methods
}