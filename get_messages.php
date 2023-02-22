<?php
include "security/config.php";
include "security/project-security.php";
ini_set('session.gc_maxlifetime', 31536000);
session_start();
// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
	$logged_user_id = $_SESSION["user_id"];
    $stmt = $mysqli->prepare("SELECT message, sender_id, time_stamp FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY time_stamp ASC");
    $stmt->bind_param("iiii", $logged_user_id, $user_id, $user_id, $logged_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt = $mysqli->prepare("UPDATE messages SET seen = 1 WHERE receiver_id = ? AND sender_id = ?");
    $stmt->bind_param("ii", $logged_user_id, $user_id);
    $stmt->execute();
    $stmt->close();
if ($result->num_rows > 0) {
    echo '<div id="currentUser" data-currentUser="'.$user_id.'"></div>';
    while($row = $result->fetch_assoc()) {
        $sender_id = $row["sender_id"];
        $stmt = $mysqli->prepare("SELECT name FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $sender_id);
        $stmt->execute();
        $user_result = $stmt->get_result();
        $stmt->close();
        $user_row = $user_result->fetch_assoc();
        if ($sender_id == $logged_user_id) {
            echo '<div class="message mine">';
        } else {
            echo '<div class="message friend">';
            //echo '<div class="message_user">'.$user_row["name"].'</div>';
        }
        $time_stamp = $row["time_stamp"];
        $time = date("H:i", strtotime($time_stamp));
        $decrypted_message = encrypt_decrypt('decrypt',$row["message"]);
        echo '<p class="message_content">'.$decrypted_message.'<br><span>'.$time.'</span></p></div>';
    }
} else {
    echo '<div id="currentUser" data-currentUser="'.$user_id.'"></div>';
    echo "No messages found";
}
}