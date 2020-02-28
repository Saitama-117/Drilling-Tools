<?php
session_start();
session_destroy();

// Redirect to Welcome screen
header('Location: index.php');
