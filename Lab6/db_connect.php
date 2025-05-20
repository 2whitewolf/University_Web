<?php
// db_connect.php - Database connection
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '11223344');
define('DB_NAME', 'event_platform');

function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>