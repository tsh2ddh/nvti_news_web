<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nvtinews_db";

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
?>