<?php
// Otetaan tallennettavat tiedot muuttujiin
$username = $_POST['username'];
$passwd = $_POST['passwd'];
$passwd2 = $_POST['passwd2'];
$email = $_POST['email'];

// Tarkistetaan syötteet
if ($passwd == $passwd2) {
    $hash = password_hash($passwd, PASSWORD_DEFAULT);
}

// Muodostetaan tietokantayhteys
include_once('pdo_connect.php');

// Tallennetaan tiedot kantaan
// INSERT INTO `users`(`id`, `username`, `passwd`, `email`) 
// VALUES ([value-1],[value-2],[value-3],[value-4])

try {
    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `passwd`, `email`) 
                            VALUES (:username, :passwd, :email)" );

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':passwd', $hash);
    $stmt->bindParam(':email', $email);

    $stmt->execute();

} catch(PDOException $e) {

    echo "Error: " . $e->getMessage();

}

$conn = null;

// Ilmoitetaan käyttäjälle miten kävi -> ohjataan käyttäjä muualle