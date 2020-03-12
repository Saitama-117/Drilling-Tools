<?php

$dataset = IsSet($_POST) && IsSet($_POST["tubularID"]) && IsSet($_POST["temperature"]);
$dataset = $dataset && IsSet($_POST["pressure"]) && IsSet($_POST["restriction"]);

if ($dataset) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    //createToolTubularLinkIfNeeded($db);    // DEVELOPMENT ONLY

    $tubularID = trim($_POST["tubularID"]);
    $temperature = trim($_POST["temperature"]);
    $pressure = trim($_POST["pressure"]);
    $restriction = trim($_POST["restriction"]);

    $areNumeric = is_numeric($pressure) && is_numeric($temperature) && is_numeric($restriction);
    http_response_code(200);

    $toReturn = array();
    if ($areNumeric) {
        $tools = getToolsFromTubularIdTemperatureAndPressure($db, $tubularID, $temperature, $pressure, $restriction);

        header("Content-type: application/json");
        foreach ($tools as $tool)       //iterate through rows in result
        {
            $toReturn[]=$tool;       //append to PHP array
        }
        echo json_encode(['message' => "Validation Passed", 'tools' => $toReturn]);
        //echo json_encode($toReturn);

        $db->close();
    } else {
        echo json_encode(['message' => "Error in tool selection data", 'tools' => $toReturn]);
    }
} else    {
    echo json_encode("Error in post array");
    http_response_code(400);    //does not support other methods
}
