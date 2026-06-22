<?php
$host = "localhost";
$db_user = "root"; # System environment variables
$db_pass = "changepassword"; # System environment variables
$db_name = "oscp_db"; # System environment variables

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("DB Connection Fail: " . $conn->connect_error);
}
?>