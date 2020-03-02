<?php

// Includes
include("../Includes/Database/db_connect.php");
include("../Includes/Database/dataQueries.php");

// Define tables if required
createToolTableIfNeeded($db);
createTubularTableIfNeeded($db);
createToolTubularLinkIfNeeded($db);

// Write tool data test
$toolOD = 3.375;
$toolMinTemp = 20;
$toolMaxTemp = 50;
$toolMinPressure = 1000;
$toolMaxPressure = 5000;
$toolExists = "Tool existed already";
if (empty(checkIfToolExists($db, $toolOD, $toolMinTemp, $toolMaxTemp, $toolMinPressure, $toolMaxPressure))) {
    insertTool($db, $toolOD, $toolMinTemp, $toolMaxTemp, $toolMinPressure, $toolMaxPressure);
    $toolExists = "Tool created";
}

// Write tubular data test
$tubularOD = 5.5;
$tubularID = 5.25;
$weight = 15.75;
$tubularExists1 = "Tubular1 existed already";
if (empty(checkIfTubularExists($db, $tubularOD, $tubularID, $weight))) {
    insertTubular($db, $tubularOD, $tubularID, $weight);
    $tubularExists1 = "Tubular1 created";
}
$tubularOD = 6.5;
$tubularID = 6.125;
$weight = 16.5;
$tubularExists2 = "Tubular2 existed already";
if (empty(checkIfTubularExists($db, $tubularOD, $tubularID, $weight))) {
    insertTubular($db, $tubularOD, $tubularID, $weight);
    $tubularExists2 = "Tubular2 created";
}

// Write cut data test
$toolIdNo = 1;
$tubularIDNo = 1;
$cutExists1 = "Cut existed already";
if (empty(checkIfToolAlreadyCutsTubular($db, $toolIdNo, $tubularIDNo))) {
    insertToolCutsTubular($db, $toolIdNo, $tubularIDNo);
    $cutExists1 = "Cut created";
}

$toolIdNo = 1;
$tubularIDNo = 2;
$cutExists2 = "Cut2 existed already";
if (empty(checkIfToolAlreadyCutsTubular($db, $toolIdNo, $tubularIDNo))) {
    insertToolCutsTubular($db, $toolIdNo, $tubularIDNo);
    $cutExists2 = "Cut2 created";
}


// Read data tests
$toolData = readToolData($db, 1);
$tubularData = readTubularData($db, 1);
$allTubulars = readAllTubulars($db);
$cuts = readTubularsToolCuts($db, 1);

$db->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tool Database Test Screen</title>
    <link rel="stylesheet" href="../Assets/CSS/database-test-page.css">
</head>
<body>
    <h1>Tool / Tubular Database Tests</h1>
    <p>Ran table create (if required) code</p>
    <h2>Data for Tool 1</h2>
    <p><?php echo $toolExists ?></p>
    <table>
        <thead>
            <tr><th>OD</th><th>Min Temp</th><th>Max Temp</th><th>Min Pressure</th><th>Max Pressure</th></tr>
        </thead>
        <tbody>
            <tr><?php echo "<td>".$toolData['OD']."</td>"."<td>".$toolData['minTemp']."</td>"."<td>".$toolData['maxTemp']."</td>"."<td>".$toolData['minPressure']."</td>"."<td>".$toolData['maxPressure']."</td>" ?></tr>
        </tbody>
    </table>

    <h2>Data for Tubular 1</h2>
    <p><?php echo $tubularExists1 ?></p>
    <p><?php echo $tubularExists2 ?></p>
    <table>
        <thead>
        <tr><th>OD</th><th>ID</th><th>Weight</th></tr>
        </thead>
        <tbody>
        <tr><?php echo "<td>".$tubularData['OD']."</td>"."<td>".$tubularData['ID']."</td>"."<td>".$tubularData['weight']."</td>" ?></tr>
        </tbody>
    </table>

    <h2>Data For All Tubulars</h2>
    <table>
        <thead>
        <tr><th>OD</th><th>ID</th><th>Weight</th></tr>
        </thead>
        <tbody>
        <?php
        $tubular = array();
        foreach ($allTubulars as $tubular) {
            echo "<tr><td>".$tubular['OD']."</td>"."<td>".$tubular['ID']."</td>"."<td>".$tubular['weight']."</td></tr>";
        }?>
        </tbody>
    </table>

    <h2>Cut Data for Tool 1</h2>
    <p><?php echo $cutExists1 ?></p>
    <p><?php echo $cutExists2 ?></p>
    <table>
        <thead>
        <tr><th>Tubular OD</th><th>Tubular ID</th><th>Weight</th></tr>
        </thead>
        <tbody>
        <?php
        $tubular = array();
        foreach ($cuts as $tubular) {
            echo "<tr><td>".$tubular['OD']."</td>"."<td>".$tubular['ID']."</td>"."<td>".$tubular['weight']."</td></tr>";
        }?>
        </tbody>
    </table>

</body>
</html>
