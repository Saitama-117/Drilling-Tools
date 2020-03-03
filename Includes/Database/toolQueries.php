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

function checkIfToolExists($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure) {
    $return = null;
    $query = "SELECT toolID FROM tools WHERE OD = ? and minTemp = ? and maxTemp = ? and minPressure = ? and maxPressure = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($return);
    $stmt->fetch();
    $stmt->free_result();
    return $return;
}

function insertTool($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure) {
    $query = "INSERT INTO tools (OD, minTemp, maxTemp, minPressure, maxPressure) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}