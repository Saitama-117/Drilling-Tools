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
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="Assets/JavaScript/ajaxAddToolServices.js"></script>
</head>
<body>
<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>
<main>
    <!Sections BEGINS>
    <section id="AddTool" class="section">
        <h2>Add New Tool</h2>
        <!--    Adding Tubular Tool-->
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Input Tubular Form</h2>
            </div>
            <div class="w3-container" action="AddTool.html">
                <p>
                    <label class="w3-text-gray"><b>OD</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="tubularOD"></p>
                <p>
                    <label class="w3-text-gray"><b>ID</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="tubularID"></p>
                <p>
                <p>
                    <label class="w3-text-gray"><b>Weight</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="weight"></p>
                <p>
                    <button class="w3-btn w3-gray" id="addTubular">Submit</button></p>
            </div>
        </div>
        <!--    Adding Tool Form-->
        <div class="w3-card-4">
            <div class="w3-container w3-gray">
                <h2>Input Tool Form</h2>
            </div>
            <div class="w3-container" action="AddTool.html">
                <p>
                    <label class="w3-text-gray"><b>OD</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="toolOD"></p>
                <p>
                    <label class="w3-text-gray"><b>Min Pressure</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="minPressure"></p>
                <p>
                <p>
                    <label class="w3-text-gray"><b>Max Pressure</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="maxPressure"></p>
                <p>
                <p>
                    <label class="w3-text-gray"><b>Min Temperature</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="minTemp"></p>
                <p>
                <p>
                    <label class="w3-text-gray"><b>Max Temperature</b></label>
                    <input class="w3-input w3-border w3-sand" type="text" id="maxTemp"></p>
                <p>
                    <button class="w3-btn w3-gray" id="addTool">Submit</button></p>
            </div>
        </div>
        <!--    Tool/Tubular-->
        <div class="w3-container w3-gray">
            <h2>Tool/Tubular Link</h2>
        </div>
        <!--  LIST BEGINS-->
        <form class="w3-container w3-card-4" ID="TUBULAR" >
            <h2>LINK TOOLS</h2>
            <p>
                <input class="w3-radio" type="radio" name="gender" value="Tool1" >
                <label>Tool 1</label>
            <p>
                <input class="w3-radio" type="radio" name="gender" value="Tool2" >
                <label>Tool 2</label>
            <p>
                <input class="w3-radio" type="radio" name="gender" value="Tool3" >
                <label>Tool 3</label>
            </p>
        </form>

        <form class="w3-container w3-card-4" ID="TOOL">
            <p>
                <input class="w3-check" type="checkbox" checked="checked">
                <label>TOOL1</label></p>
            <p>
                <input class="w3-check" type="checkbox">
                <label> TOOL2</label></p>
            <p>
                <input class="w3-check" type="checkbox" >
                <label>TOOL3</p>
        </form>
        <button class="w3-btn w3-gray">Link</button></p>

    </section>
</main>
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>