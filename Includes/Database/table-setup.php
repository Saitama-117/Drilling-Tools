<?php
// *******************************************************
// Development ONLY - Setup database tables and admin user
// *******************************************************

include "./Includes/Database/userQueries.php";
include "./Includes/Database/toolQueries.php";
include "./Includes/Database/tubularQueries.php";
include "./Includes/Database/cutsQueries.php";

// Database Setup functions
// ************************
function createAdminsTableIfNeeded($db)
{
    $query = "CREATE TABLE IF NOT EXISTS admins (
                              userid int NOT NULL,
                              username nvarchar(20),
                              password nvarchar(256),
                              PRIMARY KEY(userid))";
    $result = $db->query($query);
}

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

function alterToolTableIfNeeded($db) {

    $answer = "";
    $query = "SELECT IF(
                    (SELECT COUNT(*) FROM information_schema.columns 
                    WHERE table_name = 'tools' AND table_schema = 'db1813014_database' AND column_name = 'CADurl') > 0,
              '',
              'ALTER TABLE tools ADD CADurl NVARCHAR(200);')";
    $result = $db->query($query);
    $answer = implode($result->fetch_assoc());
    if ($answer !== '') {
        $result = $db->query($answer);
    }
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

// ***************************
// Database populate functions
// ***************************

function insertToolIfRequired($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl) {
    $result = checkIfToolExists($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    if ($result == null) {
        insertTool($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    }
    $result = checkIfToolExists($db, $OD, $minTemp, $maxTemp, $minPressure, $maxPressure, $CADurl);
    return $result;
}

function insertTubularIfRequired($db, $OD, $ID, $weight) {
    $result = checkIfTubularExists($db, $OD, $ID, $weight);
    if ($result == null) {
        insertTubular($db, $OD, $ID, $weight);
    }
    $result = checkIfTubularExists($db, $OD, $ID, $weight);
    return $result;
}

function insertCutIfRequired($db, $toolID, $tubularID) {
    $result = checkIfToolAlreadyCutsTubular($db, $toolID, $tubularID);
    if ($result == null) {
        insertToolCutsTubular($db, $toolID, $tubularID);
    }
}

// If required setup tables and admin user
// ***************************************
createAdminsTableIfNeeded($db);
createToolTableIfNeeded($db);
alterToolTableIfNeeded($db);
createTubularTableIfNeeded($db);
createToolTubularLinkIfNeeded($db);

// Populate admin user if required
// *******************************
$result = findUser($db, 'admin'); // Attempt to find default admin
if ($result['username'] == null) {
    insertUser($db, 1, 'admin', 'password');
}

// Populate tools table if required
// ********************************
$tool1ID = insertToolIfRequired($db, 3.5, 20, 150, 1000, 4000,
    'https://www.3dvieweronline.com/members/Idb8ab596fde54c47e4b01c9936389dccc/m82oszB5DtKsLmc');
$tool2ID = insertToolIfRequired($db, 4,50,200,1000,10000,
    'https://www.3dvieweronline.com/members/Idb8ab596fde54c47e4b01c9936389dccc/8NhEmWBm8ULDDde');
$tool3ID = insertToolIfRequired($db, 5.25, 20, 250, 200, 8000,
    'https://www.3dvieweronline.com/members/Idb8ab596fde54c47e4b01c9936389dccc/k2oGoQtuXeIZElo');
$tool4ID = insertToolIfRequired($db, 6, 20, 200, 500, 9500,
    'https://www.3dvieweronline.com/members/Idb8ab596fde54c47e4b01c9936389dccc/TnAYek0rTqQVA5G');
$tool5ID = insertToolIfRequired($db,6.25, 20, 250, 1000, 10000, '');

// Populate tubular table if required
// **********************************
$tubular1ID = insertTubularIfRequired($db, 5.5, 4.56, 11.5);
$tubular2ID = insertTubularIfRequired($db, 6.625, 6.135, 17);
$tubular3ID = insertTubularIfRequired($db, 7.625, 7.125, 20);

// Populate cuts table if required
// *******************************
// Tools that cut for tubular 1
insertCutIfRequired($db, $tool1ID, $tubular1ID);
insertCutIfRequired($db, $tool2ID, $tubular1ID);
// Tools that cut for tubular 2
insertCutIfRequired($db, $tool3ID, $tubular2ID);
insertCutIfRequired($db, $tool4ID, $tubular2ID);
// Tools that cut for tubular 3
insertCutIfRequired($db, $tool4ID, $tubular3ID);
insertCutIfRequired($db, $tool5ID, $tubular3ID);
