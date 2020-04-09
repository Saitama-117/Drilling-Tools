<?php

function readTubularData($db, $tubularID) {
    $result = array();
    $query = "SELECT OD, ID, weight FROM tubulars WHERE tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $tubularID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result['OD'], $result['ID'], $result['weight']);
    $stmt->fetch();
    $stmt->free_result();
    return $result;
}

function readAllTubulars($db) {
    // Variable declarations
    $tubularID = null;
    $OD = null;
    $ID = null;
    $weight = null;
    $results = array();
    $index = 0;

    // Read data
    $query = "SELECT tubularID, OD, ID, weight FROM tubulars";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->bind_result($tubularID, $OD, $ID, $weight);
    while ($stmt->fetch()) {
        $results[$index]['tubularID'] = $tubularID;
        $results[$index]['OD'] = $OD;
        $results[$index]['ID'] = $ID;
        $results[$index]['weight'] = $weight;
        $index += 1;
    }
    $stmt->free_result();
    return $results;
}

function checkIfTubularExists($db, $OD, $ID, $weight) {
    $return = null;
    $query = "SELECT tubularID FROM tubulars WHERE OD = ? and ID = ? and weight = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddd', $OD, $ID, $weight);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($return);
    $stmt->fetch();
    $stmt->free_result();
    return $return;
}

function insertTubular($db, $OD, $ID, $weight) {
    $query = "INSERT INTO tubulars (OD, ID, weight) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddd', $OD, $ID, $weight);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function updateTubular($db, $OD, $ID, $weight, $tubularId) {
    $query = "UPDATE tubulars SET OD = ?, ID = ?, weight = ? WHERE tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('dddd', $OD, $ID, $weight, $tubularId);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function deleteTubular($db, $tubularId){
    $query = "DELETE FROM tubulars WHERE tubularID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $tubularId);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
