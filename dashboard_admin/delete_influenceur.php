<?php
// Assuming you have established a database connection
include 'database.php';

// Start the session
session_start();
$otherid=$_POST['otherid'];
$_SESSION['otherid']=$otherid;

// Check if the user is logged in and the otherid is set in the session
if (!empty($otherid)) {
    // Get the otherid from the session
    $_SESSION['otherid']=$otherid;

    // Perform the deletion query
    $query = "DELETE FROM influenceur WHERE id = '$otherid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Deletion successful
        echo "Influenceur with ID $otherid has been deleted.";
    } else {
        // Deletion failed
        echo "Failed to delete influenceur with ID $otherid.";
    }

    // Clear the otherid from the session
    unset($_SESSION['otherid']);
} else {
    // Handle the case where the otherid is not set in the session
    echo "No influenceur selected for deletion.";
}

// Close the database connection
mysqli_close($conn);
echo '<script>window.close();</script>';?>
