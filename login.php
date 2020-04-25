<?php
session_start();

// Includes
require_once "./Includes/Database/db_connect.php";
include "./Includes/Database/userQueries.php";

$userFeedback = null;

// Entry should only be from login form via POST request
if (IsSet($_POST) && IsSet($_POST["uname"]) && IsSet($_POST["psw"])) {

    // POST request and user has entered data in both form fields
    $username = trim($_POST['uname']);
    $password = trim($_POST['psw']);

    // Data in both fields so check login credentials
    $userData = checkUserLogin($db, $username, $password);
    if ($userData != null) {

        // Valid login credentials so set session variable and redirect
        $_SESSION["user"] = $username;
        $db->close();
        header("Location: ./index.php");
        exit();
        } else {

        // Invalid login credentials so inform user
            $userFeedback = "Username and password did not match.";
    }
}

// Incomplete or no data in form fields
session_destroy();
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./Assets/CSS/Style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>

<main>
    <div class="imgcontainer">
        <img src="./Assets/images/Icon.png" alt="Avatar" class="avatar">
    </div>
    <?php if ($userFeedback != null) echo '<p id="feedback">' . $userFeedback . '</p>' ?>
    <form action="" method="post">
        <div id="contentbox" class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <a href="index.php"> <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button></a>
            <span class="psw">Forgot <a href="mailto:admin@specialist.com">password?</a></span>
        </div>
    </form>
</main>

<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>

</body>
</html>
