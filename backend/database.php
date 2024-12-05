<?php
$servername = "localhost";
$username = "root";
$pass = "root";
$dbname = "autoszerelo";

$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}