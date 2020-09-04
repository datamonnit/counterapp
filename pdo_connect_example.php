<?php
// Muokkaa tähän tiedosoon omat salasanasi ja tunnuksesi ja nimeä
// sen jälkeen uudelleen nimellä pdo_connect.php
$servername = "localhost";
$DBusername = "root";
$DBpassword = "";
$db = "countdown_app";

try {
  
    $conn = new PDO("mysql:host=$servername;dbname=$db", $DBusername, $DBpassword);
  
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}