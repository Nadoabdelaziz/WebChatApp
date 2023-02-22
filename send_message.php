<?php
include "security/config.php";
include "security/project-security.php";
ini_set('session.gc_maxlifetime', 31536000);
session_start();

// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";
$message = $_POST['message'];
$user_id = $_POST['user_id'];
$logged_user_id = $_SESSION["user_id"];
$encrypted_message = encrypt_decrypt('encrypt',$message);
$check_conversation_query = "SELECT * FROM conversations WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)";
$check_conversation_stmt = $mysqli->prepare($check_conversation_query);
$check_conversation_stmt->bind_param("iiii", $logged_user_id, $user_id, $user_id, $logged_user_id);
$check_conversation_stmt->execute();
$check_conversation_result = $check_conversation_stmt->get_result();

if ($check_conversation_result->num_rows > 0) {
    // The sender and receiver are already in a conversation
    // pass
} else {
    // Insert the sender and receiver into the conversation
    $insert_conversation_query = "INSERT INTO conversations (sender_id, receiver_id) VALUES (?,?)";
    $insert_conversation_stmt = $mysqli->prepare($insert_conversation_query);
    $insert_conversation_stmt->bind_param("ii", $logged_user_id, $user_id);
    $insert_conversation_stmt->execute();
}
    $stmt = $mysqli->prepare("INSERT INTO messages (message, sender_id, receiver_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $encrypted_message, $logged_user_id, $user_id);
    $stmt->execute();

if ($mysqli->query($sql) === TRUE) {
    echo '<div class="message mine">';
    echo '<p class="message_content">'.$message.'<br><span>'.date("H:i").'</span></p></div>';
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}