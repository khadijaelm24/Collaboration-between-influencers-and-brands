<?php
// Include your database connection file
include('database.php');

// Check if the offer ID is received via POST
if (isset($_POST['id'])) {
    $offerId = $_POST['id'];

    // Delete the row from the "offre" table
    $deleteQuery = "DELETE FROM offre WHERE id = '$offerId'";
    mysqli_query($conn, $deleteQuery);
}

// Close the database connection
mysqli_close($conn);

// Close the page
echo '<script>window.close();</script>';
?>
