<?php

//includes
include("../Includes/Database/db_connect.php");
include("../Includes/Database/userQueries.php");
include("../Includes/Utilities/DataValidation.php");

// Define admin credentials
$username = 'admin';
$password = 'password';

// First time the web app is used there may not be an Admins DB table
createAdminsTableIfNeeded($db);

// Test to see if admin is in database and add admin in if required
$result = findUser($db, $username);
if ($result['username'] == null) {
    $userCreateFeedback = "Created Admin user";
    insertUser($db, 1, $username, $password);
} else {
    $userCreateFeedback = "Did not need to created Admin user";
}

// Can VALID admin credentials be found?
if (checkUserLogin($db,$username, $password) !== null) {
    $userLoginFeedback = "Found credentials of user: " . $username;
} else {
    $userLoginFeedback = "Could not find credentials of user: " . $username;
}

// Can INVALID admin credentials be found?
$username = 'Hacker';
$paswword = 'Wrong Passsword';
if (checkUserLogin($db,$username, '$password') !== null) {
    $attackFeedback = "Found credentials of user: " . $username;
} else {
    $attackFeedback = "Could not find credentials of user: " . $username;
}

$db->close();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Database Test Screen</title>
        <link rel="stylesheet" href="../Assets/CSS/database-test-page.css">
    </head>
    <body>
        <h1>Database Tests</h1>
        <p>Admin create result - <?php echo $userCreateFeedback ?></p>
        <p>Admin valid login result - <?php echo $userLoginFeedback ?></p>
        <p>Hacker login result - <?php echo $attackFeedback ?></p>
    </body>
</html>
