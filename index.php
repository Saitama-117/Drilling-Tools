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
<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>
<main>
    <!Sections BEGINS>
    <section id="findtool" class="section">
        <h2>FIND YOUR TOOL</h2>
        <div id="Targetbox">
            <form>
                <h3> Target</h3>
                <input type="text" name="Target>
        <input type="submit" value="Enter Target">
            </form>
        </div>

        <div id="Pressure Range">
            <form>
                <h3> Pressure Range</h3>
                <input type="text" name="Pressure Range>
            <input type="submit" value="Pressure Range">
            </form>
        </div>

        <div>
            <form>
                <h3> Temperature Range</h3>
                <input type="text" name="Temperature Range>
            <input type="submit" value="Temperature Range">
            </form>
        </div>
        <p>
            <input type="submit" value="search">
        </p>
    </section>
</main>
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>