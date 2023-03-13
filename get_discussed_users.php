<?php
include "security/config.php";
include "security/project-security.php";
ini_set('session.gc_maxlifetime', 31536000);
session_start();
// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden

include "config.php";

$logged_user_id = $_SESSION["user_id"];
$stmt = $mysqli->prepare("SELECT DISTINCT user_id FROM (SELECT sender_id as user_id FROM conversations WHERE receiver_id = ? UNION SELECT receiver_id as user_id FROM conversations WHERE sender_id = ?) as temp WHERE user_id != ?");
$stmt->bind_param("iii", $logged_user_id, $logged_user_id, $logged_user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
        $stmt = $mysqli->prepare("SELECT COUNT(*) as unread FROM messages WHERE receiver_id = ? AND seen = 0 AND sender_id = ?");
        $stmt->bind_param("ii", $logged_user_id, $user_id);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $unreadRow = $result1->fetch_assoc();
        $stmt->close();
        $unread_count = $unreadRow['unread'];
        if ( $unread_count > 0 ){
            echo '<div class="discussed_user" data-user-id="'.$user_id.'"><span style="color: green;font-size: 32px;" class="fa fa-comment" aria-hidden="true"></span> <span style="font-size: 24px;">'.$user_id.'</span><span class="badge">'.$unread_count.'</span></div>';
        }
        else {
            echo '<div class="discussed_user" data-user-id="'.$user_id.'"><span style="color: green;font-size: 32px;" class="fa fa-comment" aria-hidden="true"></span> <span style="font-size: 24px;">'.$user_id.'</span><span class="badge"></span></div>';
        }
    }
} else {
    echo "No discussed users found";
}