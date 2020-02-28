<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}
?>
<header id="mast">
    <img id="Specialist Cutting Tools" src="./Assets/images/header1.gif" alt="Specialist Cutting Tools"/>
    <div>
        <nav id="nav">
            <ul>
                <li><a href="index.php" class="active">Home</a> </li>
                <li><a href="about.php">About</a></li>
                <!-- <li><a href="#findtool">Find a Tool</a></li> -->
                <li><a href="#contact">Contact Us</a></li>
                <?php if ($user != null) {
                    echo "<li><a href=\"logout.php\">Logged in as: " . $user . " (Logout)</a></li>";
                }  else {
                    echo "<li><a href=\"login.php\">Log in</a> </li>";
                }
                ?>
            </ul>
        </nav>
    </div>
</header>
