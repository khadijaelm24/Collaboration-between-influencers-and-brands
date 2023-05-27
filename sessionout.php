<?php

// Start the session
session_start();

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve the email from the session
$email = $_SESSION['email'];

// Retrieve the user type from the session
$user_type = $_SESSION['user_type'];
echo"$user_type, $user_id ,$email"
?>