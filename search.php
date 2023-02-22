<?php
include "security/config.php";
include "security/project-security.php";
$query = $_GET['q'];
ini_set('session.gc_maxlifetime', 31536000);
session_start();

// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";
$logged_user_id = $_SESSION["user_id"];
// Perform the search
$stmt = $mysqli->prepare("SELECT id, user_id FROM users WHERE user_id LIKE ?");
$like_query = "%".$query."%";
$stmt->bind_param("s", $like_query);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results as an array
$users = array();
while ($row = $result->fetch_assoc()) {
  if ($row['user_id'] != $logged_user_id ){
    $users[] = $row;
  }
}

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($users);