<?php
function createTubularTableIfNeeded($db)
{
    $query = "CREATE TABLE IF NOT EXISTS tubulars (
                              tubularID int NOT NULL AUTO_INCREMENT,
                              OD float NOT NULL,
                              ID float NOT NULL,
                              weight float NOT NULL,
                              PRIMARY KEY(tubularID))";
    $result = $db->query($query);
}

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

function updateTubular($db, $OD, $ID, $weight) {
    $query = "UPDATE tubulars (OD, ID, weight) SET (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddd', $OD, $ID, $weight);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
