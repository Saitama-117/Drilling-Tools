<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tools</title>
    <link rel="stylesheet" href="./Assets/CSS/Style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header></header>
<main>
    <!Sections BEGINS>
    <section id="findtool" class="section">
        <h2>FIND YOUR TOOL</h2>
        <div id="Targetbox">
            <form action="../Assets/AjaxServices/read-cuts.php" method="post">
                <h3> Target</h3>
                <input type="number" name="tubularID">
                <h3> Well Pressure (psi) </h3>
                <input type="number" name="pressure">
                <h3> Well Temperature (&#8451)</h3>
                <input type="number" name="temperature">
                <h3> Minimum Restriction (in)</h3>
                <input type="number" name="restriction">
                <p>
                    <input type="submit" value="search">
                </p>
            </form>
        </div>
    </section>
</main>
<footer></footer>
</body>
</html>