<?php
// *******************************************************
// Development ONLY - Setup database tables and admin user
// *******************************************************

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

// If required setup tables and admin user
// ***************************************
createAdminsTableIfNeeded($db);
createToolTableIfNeeded($db);
createTubularTableIfNeeded($db);
createToolTubularLinkIfNeeded($db);

// Setup admin user if required
$result = findUser($db, 'admin'); // Attempt to find default admin
if ($result['username'] == null) {
    insertUser($db, 1, 'admin', 'password');
}

