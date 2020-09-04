<?php

$day = $_POST['day'];
$time = $_POST['time'];
$topic = $_POST['topic'];
$message = $_POST['message'];

include_once('../pdo_connect.php');

try {
    $stmt = $conn->prepare("INSERT INTO `counters`(`count_to`, `topic`, `message`) 
                            VALUES (CONCAT(:day, ' ', :time), :topic , :message)");
    $stmt->bindParam(':day',$day);
    $stmt->bindParam(':time',$time);
    $stmt->bindParam(':topic',$topic);
    $stmt->bindParam(':message',$message);
    $stmt->execute();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;