<?php

if ($_SERVER["REQUEST_METHOD"]=="GET") {
    // Open database connection and get includes
    require_once "../../Includes/Database/db_connect.php";
    include "../../Includes/Database/toolQueries.php";

    createToolTableIfNeeded($db);    // DEVELOPMENT ONLY
    $tools = readAllTools($db);

    header("Content-type: application/json");
    http_response_code(200);
    $toReturn = array();
    foreach ($tools as $tool)       //iterate through rows in result
    {
        $toReturn[]=$tool;       //append to PHP array
    }
    echo json_encode($toReturn);

    $db->close();
} else    {
    http_response_code(400);    //does not support other methods
}
