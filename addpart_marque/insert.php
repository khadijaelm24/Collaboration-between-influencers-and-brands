<?php
include ('database.php');
session_start();

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $marqueId = $_POST['influenceur'];
    $duree = $_POST['duree'];
    $montant = $_POST['montant'];
    $content = $_POST['content'];


    // Insert the data into the "offre" table
    $sql = "INSERT INTO offre (marque_id,influencer_id, duration,content, price,sender) VALUES ('$user_id','$marqueId','$duree','$content','$duree', '$user_type')";
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("Location: index.php");
    mysqli_close($conn);
}
?>