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
    <section id="about" class="section clear">
        <h1>ABOUT US</h1>
        <div class="w3-container w3-padding-64 w3-center" id="team">
    <h2>SUPER AWESOME TEAM</h2>
    <p>Meet the people behind this great project:</p>
    
    <div class="w3-row"><br>
    
    <div class="w3-quarter">
      <img src="./Assets/HTML/images/Profile/Nick.png" alt="CEO" style="width:45%" class="w3-circle w3-hover-opacity">
      <h3>Nick Harle</h3>
      <p>CEO and Brain Master</p>
    </div>
    
    <div class="w3-quarter">
      <img src="./Assets/HTML/images/Profile/Leke.png" alt="Sales" style="width:45%" class="w3-circle w3-hover-opacity">
      <h3>Adeleke Omotayo Awonuga</h3>
      <p>Sales and Social Support</p>
    </div>
    
    <div class="w3-quarter">
      <img src="./Assets/HTML/images/Profile/Abhinav.jpg" alt="Tester" style="width:45%" class="w3-circle w3-hover-opacity">
      <h3>Abhinav Peddi</h3>
      <p>Tester and Deungeon Developer</p>
    </div>
    
    <div class="w3-quarter">
      <img src="./Assets/HTML/images/Profile/Hari.jpg" alt="Developer" style="width:45%" class="w3-circle w3-hover-opacity">
      <h3>Hari Saravanan Mohandoss</h3>
      <p>PHP, JASON Developer and Party Master</p>
    </div>

    <div class="w3-quarter">
        <img src="./Assets/HTML/images/Profile/Luis2.png" alt="Pro-gamer" style="width:45%" class="w3-circle w3-hover-opacity">
        <h3>Luis Cruz Kim</h3>
        <p>Front-End Wanna be Developer and Semi Pro-gamer</p>
      </div>
    
    </div>
    </div>
    </section>
</main>
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>
