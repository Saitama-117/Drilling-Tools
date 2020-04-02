<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    $user = null;
}
?>
<img id="Specialist Cutting Tools" src="./Assets/images/logoedited.png" alt="Specialist Cutting Tools"/>
<div class="container">
    <header id="mast">
        <div>
            <?php if($user != null){
                echo "<nav id='nav' style='height:75px;'>";
            } else{
                echo "<nav id='nav'>";
            }
            ?>
                <ul>
                    <li><a href="index.php" class="active">Home</a> </li>
                    <li><a href="about.php">About</a></li>
                    <!-- <li><a href="#findtool">Find a Tool</a></li> -->
                    <li><a href="#contact">Contact Us</a></li>
                    <?php if ($user != null) {
                        echo "<li><a href=\"addTool.php\">Add Tool/Tubular Data</a></li>";
                        echo "<li><a href='modify-tools.php'>Modify Tool/Tubular Data</a></li>";
                        echo "<li><a href='delete-tools.php'>Delete Tool/Tubular Data</a></li>";
                        echo "<li><a href=\"logout.php\">Logged in as: " . $user . " (Logout)</a></li>";
                    }  else {
                        echo "<li><a href=\"login.php\">Log in</a> </li>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>
</div>
