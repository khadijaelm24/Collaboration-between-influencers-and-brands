<?php
// Start the session
session_start();

// Include your database connection file
include('database.php');

// Retrieve the sender ID and sender type from the session variables
$senderId = $_SESSION['user_id'];
$senderType = $_SESSION['user_type'];

// Insert the suppression request into the "demsup" table
$insertQuery = "INSERT INTO demsup (sender_id, sender_type) VALUES ('$senderId', '$senderType')";
if (mysqli_query($conn, $insertQuery)) {
    echo "Suppression request inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

echo '<script>window.close();</script>';

?>
