<?php
include ('database.php');
session_start();

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $duree = $_POST['duration'];
    $montant = $_POST['price'];
    $content = $_POST['content'];
    $offerid = $_POST['id'];



    // Insert the data into the "offre" table
    $sql = "UPDATE offre SET duration = '$duree', content = '$content', price = '$montant', sender = '$user_type' WHERE id = '$offerid'";
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("Location: index.php");
    mysqli_close($conn);
}
    ?>