<?php
// Include your database connection file
include('database.php');

// Check if the offer ID is received via POST

    $offerId = $_POST['id'];

    // Retrieve the offer information from the "offre" table
    $query = "SELECT * FROM offre WHERE id = '$offerId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the offer data
        $offerData = mysqli_fetch_assoc($result);
        // Extract the offer data
        $influencerId = $offerData['influencer_id'];
        $marqueId = $offerData['marque_id'];
        $duration = $offerData['duration'];
        $content = $offerData['content'];
        $price = $offerData['price'];
        $status = "active";

        // Insert the offer data into the "contrat" table
        $insertQuery = "INSERT INTO contrat (influencer_id, marque_id, duration, content, price, status)
                        VALUES ('$influencerId', '$marqueId', '$duration', '$content', '$price', '$status')";
        mysqli_query($conn, $insertQuery);

//        // Delete the row from the "offre" table
        $deleteQuery = "DELETE FROM offre WHERE id = '$offerId'";
        mysqli_query($conn, $deleteQuery);
    }


// Close the database connection
mysqli_close($conn);

// Close the page
echo '<script>window.close();</script>';
?>
