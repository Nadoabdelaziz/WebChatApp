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

  // Überprüfen, ob Benutzer in Datenbank existiert
  $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_id=?");
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $hashed_password_db = $row['password'];
  // echo $result;
  if ($result->num_rows > 0 && password_verify($password, $hashed_password_db)) {
    // Benutzer einloggen und zur Chat-Seite weiterleiten
    $_SESSION["user_id"] = $user_id;
    if(isset($_SESSION["user_id"])){
      header("Location: chat.php");
      exit();
      }
  }
  else {
    // Fehlermeldung anzeigen
    echo "Benutzername oder Passwort ist falsch.";
  }
}
// Formular zum Einloggen anzeigene
echo '<link rel="stylesheet" href="style.css" type="text/css">';
echo "<form method='post' id='login-form'>";
echo "<input type='text' name='user_id' placeholder='Benutzername'>";
echo "<input type='password' name='password' placeholder='Passwort'>";
echo "<input type='submit'>";
echo "</form>";

