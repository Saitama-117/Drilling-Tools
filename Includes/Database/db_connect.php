<?php
//define('DB_SERVER', 'CSDM-WEBDEV');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', '1813014');
define('DB_PASSWORD', '1813014');
define('DB_DATABASE', 'db1813014_cmm007');
$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (mysqli_connect_errno()) {
    $feedback .= '<p>Error: Could not connect to database. Please try again later.</p>';
    exit;
}
