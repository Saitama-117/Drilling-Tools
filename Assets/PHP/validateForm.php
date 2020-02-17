<?php
session_start();
if (!IsSet($_POST)) {
    session_destroy();
    header("Location: ../HTML/Login.html");
    exit();
}

if (!IsSet($_POST["uname"]) || !IsSet($_POST["psw"])) {
    session_destroy();				//clear session
    header("Location: ../HTML/Login.html");
    exit();
}

require_once "../../Includes/Database/db_connect.php";

function valid_login($username,$password) {
    include "../../Includes/Database/userQueries.php";
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
    header("Location: ../HTML/HomeV1.html");
    exit();
}

session_destroy();
header("Location: ../HTML/Login.html");

