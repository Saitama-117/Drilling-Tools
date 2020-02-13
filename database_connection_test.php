<?php

//includes
include("Includes/Database/db_connect.php");
include("Includes/Database/userQueries.php");
include("Includes/Utilities/DataValidation.php");

// First time the app is used there may not be aAdmins DB table
createAdminsTableIfNeeded($db);

// Test to see if admin is in database and add admin in if required
$username = 'admin';
$password = 'password';
if (findUser($db, $username) != null) {
    insertUser($db, 1, $username, $password);
}

$db->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Database Test Screen</title>
        <link rel="stylesheet" href="Assets/CSS/database-test-page.css">
    </head>
    <body>
        <h1>Database Test</h1>
    </body>
</html>
