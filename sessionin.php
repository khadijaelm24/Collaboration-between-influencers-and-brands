<?php

// Start the session
session_start();
// Store the user ID in a session variable
$_SESSION['user_id'] = $user_id;

// Store the email in a session variable
$_SESSION['email'] = $email;

// Store the user type in a session variable
$_SESSION['user_type'] = $user_type;

?>