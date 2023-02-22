<?php 

ini_set('session.gc_maxlifetime', 31536000);

session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
}
        echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    echo '<meta charset="UTF-8">';
   echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>SafeChat</title>';
   echo '<link rel="stylesheet" href="chat.css" type="text/css">';
    echo '<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>';

echo '</head>';
echo '<body>';
   echo '<aside>';
        echo '<div id="loggedUser" data-loggedUser="'.$_SESSION["user_id"].'"></div>' 
        ?>

<!-- Auto refresh by k alle 5 minuten-->
<script type="text/javascript">
setTimeout(function() {
    location = ''
}, 300000)
</script>
<!-- Auto refresh by k alle 5 minuten-->
<div id="search">
    <input type="text" id="search-query" onfocus="check()" placeholder="Search for a user">
    <ul class="list-group" id="myList">
    </ul>
</div>
<div id="discussed_users">

</div>
<div style="padding: .2rem 3rem;">
    <a id="logout" href="logout.php"><svg fill="#FFF" viewBox="-8 0 32 32" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <title>turn-off</title>
            <path
                d="M8.080 25.44c-4.48 0-8.080-3.6-8.080-8.080 0-3.24 1.92-6.16 4.88-7.4 0.44-0.2 0.92 0 1.12 0.44s0 0.92-0.44 1.12c-2.36 1-3.88 3.32-3.88 5.84 0 3.52 2.88 6.4 6.4 6.4s6.4-2.88 6.4-6.4c0-2.56-1.52-4.88-3.88-5.88-0.44-0.2-0.64-0.68-0.44-1.12s0.68-0.64 1.12-0.44c2.96 1.28 4.88 4.2 4.88 7.4-0.040 4.52-3.64 8.12-8.080 8.12zM8.080 15.2c-0.48 0-0.84-0.36-0.84-0.84v-6.96c0-0.48 0.36-0.84 0.84-0.84s0.84 0.36 0.84 0.84v7c0 0.44-0.4 0.8-0.84 0.8z" />
        </svg></a>

    <!-- zizo added here-->

    <!-- <input type="button" value="notification" onClick="notification()" /> -->


</div>
</aside>
<section id="chat">
    <div id="activeUser">
        <!-- <span></span> -->
    </div>
    <div id="messages"></div>
    <div id="input_container">
        <input type="text" id="input_message" placeholder="Type your message here">
        <button id="send_button">Send</button>
    </div>
    <audio id="new-message-sound" controls style="display:none;">
        <source src="beep.mp3" type="audio/mpeg" />
        <source src="beep.ogg" type="audio/wav" />
    </audio>
</section>
<script>
var current_user_id;
var messagesDiv = document.getElementById("messages");
var activeUserBar = document.getElementById("activeUser");
// Send messages
$(document).on("click", "#send_button", function() {
    sendMessage();
});
$(document).on("keyup", function(e) {
    if (e.keyCode == 13) {
        sendMessage();
    }
});
var lastCheck = new Date();

// function showAndroidToast(toast) {
//     Android.showToast("new message arrived");
// }

function notification() {
    Android.notifyme();
}

function playBeep() {
    $.ajax({
        url: "check_messages.php",
        data: {
            last_check: lastCheck.toISOString()
        },
        success: function(data) {
            lastCheck = new Date();
            var db = JSON.parse(data);
            var loggedUser = $('#loggedUser').attr("data-loggedUser");
            // if(db.has_new_message && db.receiver_id == loggedUser )
            if (db.has_new_message && db.receiver_id == loggedUser) {
                if (Notification.permission === "granted") {
                    var notification = new Notification("New message", {
                        body: "You have a new message in Chat"
                    });
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function(permission) {
                        if (permission === "granted") {
                            var notification = new Notification("New message", {
                                body: "You have a new message in Chat "
                            });
                        }
                    });
                }
                var sound = document.getElementById("new-message-sound");
                sound.play();
            }
        }
    });
}

function sendMessage() {
    var message = $("#input_message").val();
    current_user_id = $('#currentUser').attr("data-currentUser");
    if (message === "notfall1337") {
        $.ajax({
            type: "GET",
            url: "notfall1337.php",
            success: function() {
                $.ajax({
                    type: "GET",
                    url: "get_messages.php",
                    data: {
                        user_id: current_user_id
                    },
                    success: function(data) {
                        $("#input_message").val('');
                        $('#messages').html(data);
                        messagesDiv.scrollTo(0, messagesDiv.scrollHeight);
                    }
                });
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: "send_message.php",
            data: {
                message: message,
                user_id: current_user_id
            },
            success: function(data) {
                $("#input_message").val('');
                getMessages(current_user_id);
            }
        });
    }
}
// search users
$(document).ready(function() {
    $('#search-query').keyup(function() {
        var query = $(this).val();
        $.ajax({
            url: 'search.php',
            type: 'GET',
            data: {
                q: query
            },
            success: function(data) {
                // Parse the JSON and display the results in a dropdown menu
                var results = data;
                let html = '';
                $.each(results, function(index, value) {
                    html += '<li class="list-group-item" data-user-id="' + value
                        .user_id + '">' + value.user_id + '</li>';
                });
                document.querySelector('ul').innerHTML = html;
            }
        });
    });
});
$(document).ready(function() {
    getUsers();
});

function getUsers() {
    $.ajax({
        type: "GET",
        url: "get_discussed_users.php",
        success: function(data) {
            $('#discussed_users').html(data);
            $("div[data-user-id='" + current_user_id + "']").addClass("active");
        }
    });
}
// select user to chat
$(document).on("click", ".discussed_user", function() {
    var user_id = $(this).attr("data-user-id");
    $('.discussed_user').removeClass('active');
    $(this).addClass("active");
    current_user_id = user_id;
    $.ajax({
        type: "GET",
        url: "get_messages.php",
        data: {
            user_id: user_id
        },
        success: function(data) {
            $('#messages').html(data);
            activeUserBar.innerHTML = '<span>' + user_id + '</span>'
            messagesDiv.scrollTo(0, messagesDiv.scrollHeight);
            check();
        }
    });
});
$(document).on("click", ".list-group-item", function() {
    var user_id = $(this).attr("data-user-id");
    $('.discussed_user').removeClass('active');
    $(this).addClass("active");
    current_user_id = user_id;
    $.ajax({
        type: "GET",
        url: "get_messages.php",
        data: {
            user_id: user_id
        },
        success: function(data) {
            $('#messages').html(data);
            activeUserBar.innerHTML = '<span>' + user_id + '</span>'
            messagesDiv.scrollTo(0, messagesDiv.scrollHeight);
            check();
        }
    });
});
setInterval(function() {
    current_user_id = $('#currentUser').attr("data-currentUser");
    getUsers();
    getMessages(current_user_id);
}, 1500);
setInterval(function() {
    playBeep();
    // showAndroidToast();
    notification();
}, 1800);

function getMessages(user_id) {
    $.ajax({
        type: "GET",
        url: "get_messages.php",
        data: {
            user_id: user_id
        },
        success: function(data) {
            $('#messages').html(data);
            // check();
        }
    });
}
const input = document.getElementById("search-query");
input.addEventListener("focusout", function() {
    setTimeout(function() {
        document.querySelector('ul').innerHTML = "";
    }, 300);
});
$("#input_message").focusin(function() {
    check()
});

function check() {
    if ($("#currentUser").length) {
        $("#input_message").prop("disabled", false);
        $("#input_message").attr("placeholder", "Type your message here");
    } else {
        $("#input_message").prop("disabled", true);
        $("#input_message").attr("placeholder", "Select a user to initiate conversation");
    }
}
</script>
</body>

</html>