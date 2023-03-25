<?php
include "security/config.php";
include "security/project-security.php";
ini_set('session.gc_maxlifetime', 31536000);
session_start();
// Verbindung zu MySQL-Datenbank herstellen und Config-Datei einbinden

include "config.php";

$logged_user_id = $_SESSION["user_id"];
if(isset($_GET["indexPage"])){
    $indexPage = $_GET["indexPage"];

}

if(isset($_GET["alertbox"])){
    $alertbox = $_GET["alertbox"];

}



$stmt = $mysqli->prepare("SELECT DISTINCT user_id FROM (SELECT sender_id as user_id FROM conversations WHERE receiver_id = ? UNION SELECT receiver_id as user_id FROM conversations WHERE sender_id = ?) as temp WHERE user_id != ?");
$stmt->bind_param("iii", $logged_user_id, $logged_user_id, $logged_user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$msgcount = 0;


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


            
        $query = $mysqli->prepare("SELECT message FROM messages WHERE ( (receiver_id = ?) or (sender_id = ?) ) and ( (sender_id = ?) or (receiver_id = ?) )  ORDER BY time_stamp Desc LIMIT 1");
        $query->bind_param("iiii", $logged_user_id ,$logged_user_id , $user_id, $user_id);
        $query->execute();
        $queryresult = $query->get_result();
        $query->execute();
        $query->close();
        $rowmsg = $queryresult->fetch_assoc();
        if(isset($rowmsg)){
            $the_msg = encrypt_decrypt('decrypt',$rowmsg['message']);

        }

        // print_r($the_msg);

        if ( $unread_count > 0 ){
            $msgcount++;

        }


        if (isset($alertbox) && isset($the_msg) && $msgcount > 0) {
            // print_r($unread_count);
            # code...
            // echo '<h3> '.$msgcount.') '.$user_id.' : </h3> <p style="color:#12766a;">"'.$the_msg.'"</p>';
            echo ' <h4> - '.$msgcount.' new messages from '.$user_id.'. </h4>';
            
        }

        // if (isset($alertbox) && isset($the_msg)) {
        //     # code...
        //     print_r($unread_count);
        //     $body = '<h3> - '.$user_id.' : &nbsp; "'.$the_msg.'" </h3>';
        //     $header = 'You have '.$msgcount.' new unread messages from '.$unread_count.' users.';
        //     echo $body."|".$header;

            // echo json_encode(array($body, $header));

        // }
        
       if (!isset($indexPage) && !isset($alertbox))
        {
            if ( $unread_count > 0 ){            
                echo '<div class="discussed_user" data-user-id="'.$user_id.'"><span style="color: green;font-size: 42px;" class="fa fa-comment" aria-hidden="true"></span> <span style="font-size: 34px;">'.$user_id.'</span><span style="margin: 15px;vertical-align: super;font-size: 22px;" class="badge">'.$unread_count.'</span><br><br> <span style="padding-left: 55px;color: darkgrey;font-size: 19px;"> '.$the_msg.' </span> </div>';
            }
            else {
                echo '<div class="discussed_user" data-user-id="'.$user_id.'"><span style="color: green;font-size: 32px;" class="fa fa-comment" aria-hidden="true"></span> <span style="font-size: 24px;">'.$user_id.'</span><span class="badge"></span><br><br> <span style="padding-left: 55px;color: darkgrey;font-size: 19px;"> '.$the_msg.' </span> </div>';
            }
        }
    }


    if(isset($indexPage) && !isset($alertbox)){
        if ( $msgcount > 0 ){
            echo '<span class="icon"><i class="fas fa-user"></i></span>
            <span class="item">Chats</span><span style="margin: 15px;" class="badge">'.$msgcount.'</span>';
        }
        else {
            echo '<span class="icon"><i class="fas fa-user"></i></span>
            <span class="item">Chats</span>';
        }
    }


} else {
    echo "No discussed users found";
}