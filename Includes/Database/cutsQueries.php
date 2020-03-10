<?php

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
