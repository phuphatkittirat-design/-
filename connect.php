<?php
// connect.php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "phu";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("❌ การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
