<?php
session_start();

// THIS SECTION DEVELOPMENT ONLY
require_once "./Includes/Database/db_connect.php";
include "./Includes/Database/userQueries.php";
include "./Includes/Database/table-setup.php";
$db->close();
// THIS SECTION DEVELOPMENT ONLY
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Specialist Cutting Tools</title>
    <link rel="stylesheet" href="./Assets/CSS/Style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="Assets/JavaScript/FindTubular.js"></script>
</head>
<body>
<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>
<main>
    <!Sections BEGINS>
    <section id="findtool" class="section">
        <h2>Cutting Tool Selection</h2>
        <div id="Targetbox">
            <!-- <form action="Assets/AjaxServices/read-cuts.php" method="post"> -->

                <div class="w3-card-4">
                    <div class="w3-container w3-gray">
                        <h3>Target Tubular</h3>
                    </div>
                    <div class="w3-container" id="TUBULAR">
                        <p>
                            <input class="w3-check" type="checkbox" name="tubularID" value="1" checked="checked">
                            <label>OD: 25.5 in, ID: 5.25 in, Weight: 15.75 ppf</label>
                        </p>
                        <p>
                            <input class="w3-check" type="checkbox" name="tubularID" value="2">
                            <label>OD: 35.5 in, ID: 6.125 in, Weight: 16.5 ppf</label>
                        </p>
                    </div>
                </div>

                <div class="w3-card-4">
                    <div class="w3-container w3-gray">
                        <h3> Well Pressure </h3>
                    </div>
                    <div class="w3-container">
                        <p>
                            <label class="w3-text-gray"><b>Enter well pressure at cut depth in psi</b></label>
                            <input type="text" name="pressure" id="PRESSURE">
                        </p>
                    </div>
                </div>

                <div class="w3-card-4">
                    <div class="w3-container w3-gray">
                        <h3> Well Temperature</h3>
                    </div>
                    <div class="w3-container">
                        <p>
                            <label class="w3-text-gray"><b>Enter well temperature at cut depth in &#8451</b></label>
                            <input type="text" name="temperature" id="TEMPERATURE">
                        </p>
                    </div>
                </div>

                <div class="w3-card-4">
                    <div class="w3-container w3-gray">
                        <h3> Minimum Restriction</h3>
                    </div>
                    <div class="w3-container">
                        <p>
                            <label class="w3-text-gray"><b>Enter well minimum restriction in inches</b></label>
                            <input type="text" name="restriction" id="RESTRICTION">
                        </p>
                        <p>
                            <button class="w3-btn w3-gray" id="searchTool">Search</button>
                        </p>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </section>

    <section>
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Available Tools</h2>
            </div>
            <div class="w3-container" ID="TOOLS">
                <p>
                    Enter tubular and well details and then click the search button
                </p>
            </div>
        </div>
    </section>
</main>
    <!-- hitwebcounter Code START -->
<a  target="_blank">
    <img src="https://hitwebcounter.com/counter/counter.php?page=7214524&style=0006&nbdigits=3&type=page&initCount=0" title="User Stats" Alt="PHP Hits Count"   border="0" >
    </a> 
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>
