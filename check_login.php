<?php
session_start();

// Otetaan käyttäjän syöte
$username = $_POST['username'];
$passwd = $_POST['passwd'];

// Muodostetaan tietokantayhteys
include_once('pdo_connect.php');

// Haetaan käyttäjän tiedot nimen perusteella kannasta
$stmt = $conn->prepare("SELECT `id`, `username`, `passwd`, `email`
                        FROM `users`
                        WHERE username = ?;");
$stmt->execute([$username]);

$data = $stmt->fetch();

var_dump($data);

if ($data == false) {
    echo "Käyttäjää ei löytynyt";
    header('Location: login.php');
    die();
}

// Tarkistetaan onko salasana oikea
$login_pass = password_verify($passwd, $data['passwd']);

if ($login_pass) {
    echo "Käyttäjä löytyi ja salasana oli oikea!";
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;
    header('Location: admin/');
} else {
    echo "Käyttäjä löytyi, mutta salasana oli väärä!";
    header('Location: login.php');
}

