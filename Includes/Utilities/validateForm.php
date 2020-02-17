<?php
session_start();

if (!IsSet($_POST)) {
    session_destroy();
    header("Location: ./login.php");
    exit();
}

if (!IsSet($_POST["uname"]) || !IsSet($_POST["psw"])) {
    session_destroy();				//clear session
    header("Location: ./login.php");
    exit();
}

require_once "./Includes/Database/db_connect.php";
include "./Includes/Database/userQueries.php";

// =========================
// DEVELOPMENT ONLY
$username = 'admin';
$password = 'password';
createAdminsTableIfNeeded($db);     // First time the web app is used there may not be an Admins DB table
$result = findUser($db, $username); // Test to see if admin is in database and add admin in if required
if ($result['username'] == null) {
    insertUser($db, 1, $username, $password);
}
// =========================

function valid_login($username,$password) {
     global $db;
    $userData = checkUserLogin($db, $username, $password);

    if($userData != null)
        return true;
    return false;
}

$username=$_POST["uname"];
$password=$_POST["psw"];
if (valid_login($username,$password))
{
    $_SESSION["user"]=$username;
    header("Location: ./index.php");
} else {
    session_destroy();
    header("Location: ./login.php");
}


