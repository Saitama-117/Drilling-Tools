<?php
function createToolTableIfNeeded($db)
{
    $query = "CREATE TABLE IF NOT EXISTS tools (
                              toolID int NOT NULL AUTO_INCREMENT,
                              OD float NOT NULL,
                              minTemp float NOT NULL,
                              maxTemp float NOT NULL,
                              minPressure float NOT NULL,
                              maxPressure float NOT NULL,
                              PRIMARY KEY(toolID))";
    $result = $db->query($query);
}

function readToolData($db, $toolID) {
    $result = array();
    $query = "SELECT OD, minTemp, maxTemp, minPressure, maxPressure FROM tools WHERE toolID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $toolID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result['OD'], $result['minTemp'], $result['maxTemp'], $result['minPressure'], $result['maxPressure']);
    $stmt->fetch();
    $stmt->free_result();
    return $result;
}

function readAllTools($db) {
    // Variable declarations
    $toolID = null;
    $OD = null;
    $minTemp = null;
    $maxTemp = null;
    $minPressure = null;
    $maxPressure = null;
    $results = array();
    $index = 0;

    // Read data
    $query = "SELECT toolID, OD, minTemp, maxTemp, minPressure, maxPressure FROM tools";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->bind_result($toolID, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    while ($stmt->fetch()) {
        $results[$index]['toolID'] = $toolID;
        $results[$index]['OD'] = $OD;
        $results[$index]['minTemp'] = $minTemp;
        $results[$index]['maxTemp'] = $maxTemp;
        $results[$index]['minPressure'] = $minPressure;
        $results[$index]['maxPressure'] = $maxPressure;
        $index += 1;
    }
    $stmt->free_result();
    return $results;
}

function updatingTool ($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure) {
    $query = "UPDATE tools (OD, minTemp, maxTemp, minPressure, maxPressure) SET (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}