<?php
$username = "gunbladeii";
$password = "Sh@ti5620";
$hostname = "42.1.60.115";
$db_name = "afms";

//connection to the database
$mysqli = new mysqli($hostname, $username, $password, $db_name);
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
