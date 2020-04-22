<?php

function readTubularsToolCuts($db, $toolID) {
    // Variable declarations
    $OD = null;
    $ID = null;
    $weight = null;
    $results = array();
    $index = 0;

    // Read data
    $query = "SELECT tubulars.OD, tubulars.ID, tubulars.weight FROM tubulars, cuts WHERE cuts.tubularID = tubulars.tubularID AND cuts.toolID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $toolID);
    $stmt->execute();
    $stmt->bind_result($OD, $ID, $weight);
    while ($stmt->fetch()) {
        $results[$index]['OD'] = $OD;
        $results[$index]['ID'] = $ID;
        $results[$index]['weight'] = $weight;
        $index += 1;
    }
    $stmt->free_result();
    return $results;
}

function readAllCuts($db){
    $toolID = null;
    $tubularID = null;
    $toolOD = null;
    $minTemp = null;
    $minPressure = null;
    $maxTemp = null;
    $maxPressure = null;
    $OD = null;
    $ID = null;
    $weight = null;
    $results = array();
    $index = 0;

    // Read data
    $query = "SELECT cuts.toolID, cuts.tubularID, tools.OD AS 'toolOD', tools.minTemp, tools.maxTemp, tools.minPressure,
                tools.maxPressure, tubulars.OD, tubulars.ID, tubulars.weight FROM tools, tubulars, cuts 
                WHERE cuts.tubularID = tubulars.tubularID AND cuts.toolID = tools.toolID ORDER BY tools.OD";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->bind_result($toolID, $tubularID, $toolOD, $minTemp, $maxTemp, $minPressure, $maxPressure, $OD, $ID, $weight);
    while ($stmt->fetch()) {
        $results[$index]['toolID'] = $toolID;
        $results[$index]['tubularID'] = $tubularID;
        $results[$index]['toolOD'] = $toolOD;
        $results[$index]['minTemp'] = $minTemp;
        $results[$index]['maxTemp'] = $maxTemp;
        $results[$index]['minPressure'] = $minPressure;
        $results[$index]['maxPressure'] = $maxPressure;
        $results[$index]['OD'] = $OD;
        $results[$index]['ID'] = $ID;
        $results[$index]['weight'] = $weight;
        $index += 1;
    }
    $stmt->free_result();
    return $results;
}

function checkIfToolAlreadyCutsTubular($db, $toolID, $tubularID) {
    $return = null;
    $query = "SELECT tubularID FROM cuts WHERE toolID = ? and tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $toolID, $tubularID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($return);
    $stmt->fetch();
    $stmt->free_result();
    return $return;
}

function insertToolCutsTubular($db, $toolID, $tubularID) {
    $query = "INSERT INTO cuts (toolID, tubularID) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $toolID, $tubularID);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function deleteCutsByToolId($db, $toolID){
    $query = "DELETE FROM cuts WHERE toolID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $toolID);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function deleteCutsByTubularId($db, $tubularID){
    $query = "DELETE FROM cuts WHERE tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $tubularID);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function deleteCutsByTubularIdAndToolId($db, $toolId, $tubularID){
    $query = "DELETE FROM cuts WHERE toolID = ? AND tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $toolId, $tubularID);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
