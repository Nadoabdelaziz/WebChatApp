<?php

// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";

ini_set('session.gc_maxlifetime', 31536000);
session_start();
if(isset($_SESSION["user_id"])){
  header("Location: chat.php");
  exit();
  }

// Prüfen, ob Formular abgeschickt wurde
if (isset($_POST["user_id"]) && isset($_POST["password"])) {
  $user_id = $_POST["user_id"];
  $password = $_POST["password"];
  // Passwort verschlüsseln
  $encrypted_password = hashPassword($password);
  // Überprüfen, ob Benutzernummer bereits vergeben ist
  $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_id=?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    // Fehlermeldung anzeigen
    echo "Benutzernummer ist bereits vergeben.";
  } else {
// Benutzer in Datenbank anlegen und zur Login-Seite weiterleiten
    $stmt = $mysqli->prepare("INSERT INTO users (user_id, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_id, $encrypted_password);
    $stmt->execute();
    $_SESSION["user_id"] = $user_id;
    if(isset($_SESSION["user_id"])){
      header("Location: chat.php");
      exit();
      }
}
}
echo "<title>Registrierung</title>";
// Formular zur Registrierung anzeigen
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo "<form method='post' id='register-form'>";
echo "<input type='number' name='user_id' min=1 max=1000000 placeholder='Benutzernummer (1-100000)'>";
echo "<input type='password' name='password' placeholder='Passwort'>";
echo "<input type='submit'>";
echo "</form>";