<?php

function readToolData($db, $toolID) {
    $result = array();
    $query = "SELECT OD, minTemp, maxTemp, minPressure, maxPressure, CADurl FROM tools WHERE toolID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $toolID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result['OD'], $result['minTemp'], $result['maxTemp'], $result['minPressure'], $result['maxPressure'], $result['CADurl']);
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
    $query = "SELECT toolID, OD, minTemp, maxTemp, minPressure, maxPressure FROM tools ORDER BY OD ASC";
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

function checkIfToolExists($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl) {
    $result = null;
    if ($CADurl !== '') {
        $query = "SELECT toolID FROM tools WHERE OD = ? and minTemp = ? and maxTemp = ? and minPressure = ? and maxPressure = ? and CADurl = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ddddds', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    } else {
        $query = "SELECT toolID FROM tools WHERE OD = ? and minTemp = ? and maxTemp = ? and minPressure = ? and maxPressure = ? and CADurl IS NULL";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    }
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->free_result();
    return $result;
}

function insertTool($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl) {

    if ($CADurl !== '') {
        $query = "INSERT INTO tools (OD, minTemp, maxTemp, minPressure, maxPressure, CADurl) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ddddds', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    } else {
        $query = "INSERT INTO tools (OD, minTemp, maxTemp, minPressure, maxPressure, CADurl) VALUES (?, ?, ?, ?, ?, NULL)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    }

    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function updateTool($db, $toolId, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl){

    if ($CADurl !== '') {
        $query = "UPDATE tools SET OD = ?, minTemp = ?, maxTemp = ?, minPressure = ?, maxPressure = ?, CADurl = ? 
                where toolID = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('dddddsi', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl, $toolId);
    } else {
        $query = "UPDATE tools SET OD = ?, minTemp = ?, maxTemp = ?, minPressure = ?, maxPressure = ?, CADurl = NULL 
                where toolID = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('dddddi', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $toolId);
    }

    $stmt->execute();
    return($stmt->affected_rows > 0);
}

function getToolsFromTubularIdTemperatureAndPressure($db, $tubularId, $temperature, $pressure, $restriction){
    $OD = null;
    $minTemp = null;
    $maxTemp = null;
    $minPressure = null;
    $maxPressure = null;
    $CADurl = null;
    $results = array();
    $index = 0;

    $query = "SELECT tools.OD, tools.minTemp, tools.maxTemp, tools.minPressure, tools.maxPressure, tools.CADurl FROM tubulars, cuts, tools 
        WHERE cuts.tubularID = tubulars.tubularID AND tools.toolID = cuts.toolID AND cuts.tubularID = ?
        AND (tools.minTemp <= ? AND tools.maxTemp >= ?) AND (tools.minPressure <= ? AND tools.maxPressure >= ?)
        AND tools.OD < ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('iddddd', $tubularId, $temperature, $temperature, $pressure, $pressure, $restriction);
    $stmt->execute();
    $stmt->bind_result($OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    while ($stmt->fetch()) {
        $results[$index]['OD'] = $OD;
        $results[$index]['minTemp'] = $minTemp;
        $results[$index]['maxTemp'] = $maxTemp;
        $results[$index]['minPressure'] = $minPressure;
        $results[$index]['maxPressure'] = $maxPressure;
        $results[$index]['CADurl'] = $CADurl;
        $index += 1;
    }
    $stmt->free_result();
    return $results;
}

function deleteTools($db, $toolId){
    $query = "DELETE FROM tools WHERE toolID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $toolId);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}