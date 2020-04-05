<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Specialist Cutting Tools</title>
    <link rel="stylesheet" href="./Assets/CSS/Style.css">
    <link rel="stylesheet" href="./Assets/CSS/contact-form.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="Assets/JavaScript/contact-form.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- <img  id="Specialist Cutting Tools" src="./images/logoedited.png" alt="Specialist Cutting Tools"/> -->
<body>
<!HEADER BEGINS>
<?php include("Includes/PageComponents/header.php"); ?>
<main>
    <h2>Contact Us</h2>

    <div class="container">
      <form action="">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="First name..">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Last name..">

        <label for="country">e-Mail</label>
        <input type="text" id="email" name="email" placeholder="Enter your e-mail">

        <label for="subject">Tell us</label>
        <textarea id="subject" name="subject" placeholder="How can we help?" style="height:200px"></textarea>

      </form>
      <button id="send" class="button" >Send</button>
    </div>
</main>
<!FOOTER BEGIN>
<?php include("Includes/PageComponents/footer.php"); ?>
</body>
</html>