<?php
session_start();
// Retrieve the receiver ID and type from the form
$receiver_id = $_SESSION['otherid'];
$receiver_name = $_POST['name'];
$receiver_type = $_SESSION['othertype'];

include('database.php');

// Retrieve the user ID from the session
$sender_id = $_SESSION['user_id'];

// Retrieve the sender type from the session
$sender_type = $_SESSION['user_type'];

// Retrieve the message content from the form
$message = $_POST['message'];

// Insert the new message into the database
$sql = "INSERT INTO messages (sender_id, sender_type, receiver_id, receiver_type, content)
        VALUES ('$sender_id', '$sender_type', '$receiver_id', '$receiver_type', '$message')";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo '<script>window.close();</script>'; // Close the window using JavaScript
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
