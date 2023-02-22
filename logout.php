<?php
ini_set('session.gc_maxlifetime', 31536000);
session_start();
session_unset(); // unset all session variables
session_destroy(); // destroy the session
header("Location: index.php"); // redirect to the login page
exit();