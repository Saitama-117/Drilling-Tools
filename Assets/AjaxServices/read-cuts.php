<?php

$dataset = IsSet($_GET) && IsSet($_GET["tubularID"]) && IsSet($_GET["temperature"]);
$dataset = $dataset && IsSet($_GET["pressure"]) && IsSet($_GET["restriction"]);

if ($dataset) {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    $tubularID = trim($_GET["tubularID"]);
    $temperature = trim($_GET["temperature"]);
    $pressure = trim($_GET["pressure"]);
    $restriction = trim($_GET["restriction"]);

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
