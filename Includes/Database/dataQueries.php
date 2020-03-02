<?php

// ==============================
// Create Data Tables if Required
// ==============================

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

function createToolTubularLinkIfNeeded($db)
{
    $query = "CREATE TABLE IF NOT EXISTS cuts (
                              toolID int NOT NULL,
                              tubularID int NOT NULL,
                              PRIMARY KEY(toolID, tubularID),
                              FOREIGN KEY(toolID) REFERENCES tools(toolID) ON DELETE CASCADE, 
                              FOREIGN KEY(tubularID) REFERENCES tubulars(tubularID) ON DELETE CASCADE)";
    $result = $db->query($query);
}

// ================
// Read data tables
// ================

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
    $OD = null;
    $ID = null;
    $weight = null;
    $results = array();
    $index = 0;

    // Read data
    $query = "SELECT OD, ID, weight FROM tubulars";
    $stmt = $db->prepare($query);
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

// ==============================
// CHeck if Data Already in table
// ==============================

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

// ====================
// Write data to tables
// ====================

function insertTool($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure) {
    $query = "INSERT INTO tools (OD, minTemp, maxTemp, minPressure, maxPressure) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddddd', $OD, $minTemp, $maxTemp, $minPressure, $maxPressure);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function insertTubular($db, $OD, $ID, $weight) {
    $query = "INSERT INTO tubulars (OD, ID, weight) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ddd', $OD, $ID, $weight);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function insertToolCutsTubular($db, $toolID, $tubularID) {
    $query = "INSERT INTO cuts (toolID, tubularID) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $toolID, $tubularID);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
