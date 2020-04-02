<?php
session_start();
include("Includes/Utilities/LoginCheck.php");
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
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="Assets/JavaScript/ajax-delete-tool-service.js"></script>
</head>
<body>
<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>
<main>
    <!Sections BEGINS>
    <section id="delete-section" class="section">
        <h2>Delete Tool/Tubular Data</h2>
        <!--    Updating Tubular Tool-->
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Delete Tubular Form</h2>
            </div>
            <div class="w3-container">
                <p>
                    <label class="w3-text-gray"><b>Select Tubular</b></label>
                    <select class="w3-select w3-border" id="tubular-list">
                        <option>Tubular 1</option>
                        <option>Tubular 2</option>
                        <option>Tubular 3</option>
                    </select>
                </p>
                <p>
                    <label class="w3-text-gray"><b>Outer Diameter (in.)</b></label>
                    <input type="hidden" id="tubular-id">
                    <input class="w3-input w3-border w3-sand" type="text" id="tubularOD">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Inner Diameter (in.)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="tubularID">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Weight (ppf)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="weight">
                </p>
                <p>
                    <button class="w3-btn w3-gray" id="delete-tubular">Submit</button>
                </p>
            </div>
        </div>
        <!--    Updating Tool Form-->
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Delete Tool Form</h2>
            </div>
            <div class="w3-container">
                <p>
                    <label class="w3-text-gray"><b>Select Tool</b></label>
                    <select class="w3-select w3-border" id="tool-list">
                        <option>Tool 1</option>
                        <option>Tool 2</option>
                        <option>Tool 3</option>
                    </select>
                </p>
                <p>
                    <label class="w3-text-gray"><b>Outer Diameter (in.)</b></label>
                    <input type="hidden" id="tool-id">
                    <input class="w3-input w3-border w3-sand" type="text" id="toolOD">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Min Pressure (psi)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="minPressure">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Max Pressure (psi)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="maxPressure">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Min Temperature (&#8451)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="minTemp">
                </p>
                <p>
                    <label class="w3-text-gray"><b>Max Temperature (&#8451)</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="maxTemp">
                </p>
                <p>
                    <button class="w3-btn w3-gray" id="delete-tool">Submit</button>
                </p>
            </div>
        </div>
        <!-- This gives the list of available cuts in the database -->
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Stored Tool/Tubular Link(s)</h2>
            </div>
            <div class="w3-container">
                <p>
                <table class="w3-table w3-striped w3-bordered" id="available-links">
                </table>
                </p>
            </div>
        </div>

    </section>
</main>
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>