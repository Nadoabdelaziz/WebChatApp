<?php

// Verbindung zu MySQL-Datenbank herstellen
$host = "localhost";
$db_username = "kd1125testchat";
$db_password = "mykTirpYoatLeg$";
$db_name = "kd1125testchat";
// $host = "localhost";
// $db_username = "root";
// $db_password = "";
// $db_name = "fertig";
$mysqli = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
} 
delete_messages();
// Users table
$sql = "CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
name VARCHAR(255)
)";

// Messages table
$sql = "CREATE TABLE IF NOT EXISTS messages (
id INT AUTO_INCREMENT PRIMARY KEY,
message TEXT NOT NULL,
sender_id INT NOT NULL,
receiver_id INT NOT NULL,
time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
seen TINYINT DEFAULT 0,
FOREIGN KEY (sender_id) REFERENCES users(user_id),
FOREIGN KEY (receiver_id) REFERENCES users(user_id)
)";
$sql = "CREATE TABLE IF NOT EXISTS conversations (
  conversation_id INT AUTO_INCREMENT PRIMARY KEY,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  UNIQUE (sender_id, receiver_id)
)";
// $mysqli->query($sql);
// Trigger for conversations
// $create_trigger = "CREATE TRIGGER tr_insert_conversation
// AFTER INSERT ON messages
// FOR EACH ROW
// BEGIN
//     INSERT INTO conversations (sender_id, receiver_id)
//     VALUES (NEW.sender_id, NEW.receiver_id);
// END;";
// Executed Once
// $mysqli->query("DROP TRIGGER IF EXISTS `tr_insert_conversation`");
// Funktion zum Verschlüsseln von Passwörtern mit Salt
function hashPassword($password) {
  // Generate a salt using the bcrypt algorithm
  $salt = password_hash($password, PASSWORD_BCRYPT);
  return $salt;
}

// Funktion zum Löschen von Nachrichten nach 3 Stunden
function delete_messages() {
  global $mysqli;
  $mysqli->query("DELETE FROM messages WHERE time_stamp < DATE_SUB(NOW(), INTERVAL 3 HOUR)");
}




// Funktion zum Abspielen eines Sounds bei neuer Nachricht
function play_sound() {
  // Code zum Abspielen des Sounds
}
function encrypt_decrypt($action, $string) {
  $output = false;

  $encrypt_method = "AES-256-CBC";
  $secret_key = 'x!A%C*F-JaNdRgUkXp2s5v8y/B?E(G+K';
  $secret_iv = 'SgVkYp3s6v9y$B?E(H+MbQeThWmZq4t7';

  // hash
  $key = hash('sha256', $secret_key);
  
  // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
  $iv = substr(hash('sha256', $secret_iv), 0, 16);

  if( $action == 'encrypt' ) {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
  }
  else if( $action == 'decrypt' ){
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }

  return $output;
}
