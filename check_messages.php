<?php

include "security/config.php";
include "security/project-security.php";
// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden
include "config.php";
    $last_check = $_GET['last_check'];
    $query = "SELECT * FROM messages WHERE time_stamp > DATE_SUB(NOW(), INTERVAL 2 SECOND)";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $receiver_id = $row['receiver_id'];
        //update the message status to read
        // $update_query = "UPDATE messages SET seen = 1 WHERE seen = 0 AND time_stamp > '$last_check'";
        // $mysqli->query($update_query);
        echo json_encode(array("has_new_message" => true, "receiver_id" => $receiver_id));
    } else {
        echo json_encode(array("has_new_message" => false));
    }