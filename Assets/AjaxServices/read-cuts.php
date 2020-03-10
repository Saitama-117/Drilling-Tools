<?php

if (IsSet($_POST) && IsSet($_POST["toolsID"]) && IsSet($_POST["temperature"]) && IsSet($_POST["pressure"])) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/cutsQueries.php";

    createToolTubularLinkIfNeeded($db);    // DEVELOPMENT ONLY

    $toolsID = trim($_POST["toolsID"]);
    $temperature = trim($_POST["temperature"]);
    $pressure = trim($_POST["pressure"]);

    $cuts = getCutsFromTubularIdTemperatureAndPressure($db, $toolsID, $temperature, $pressure);

    header("Content-type: application/json");
    http_response_code(200);
    foreach ($cuts as $cut)       //iterate through rows in result
    {
        $toReturn[]=$cut;       //append to PHP array
    }
    echo json_encode($toReturn);

    $db->close();
} else    {
    http_response_code(400);    //does not support other methods
}
