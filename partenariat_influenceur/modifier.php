<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="partnership.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARTENARIAT</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../partenariat_influenceur" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../partenariat_influenceur'" class="headr">RETOUR</a></li>
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="div_1">
    <center>
        <div id="formulaire">
            <form method="POST" action="insert.php">
                <h2>PARTENARIAT</h2>
                <?php
                // Assuming you have a database connection
                include ('database.php');

                $offerid = $_POST['id'];

                // Retrieve the offer information from the "offre" table
                $query = "SELECT * FROM offre WHERE id = '$offerid'";
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

                    // Retrieve the marque name from the "marque" table
                    $marqueQuery = "SELECT name FROM marque WHERE id = '$marqueId'";
                    $marqueResult = mysqli_query($conn, $marqueQuery);
                    $marqueData = mysqli_fetch_assoc($marqueResult);
                    $marqueName = $marqueData['name'];
                }
                ?>
                <input type="text" name="marqueName" placeholder="Marque Name" required disabled value="<?php echo $marqueName; ?>" style="color: black;">
                <input type="text" name="content" placeholder="Content" required  value="<?php echo $content; ?>">
                <input type="text" hidden="hidden" name="id" placeholder="Content" required  value="<?php echo $offerid; ?>">

                <input type="text" name="duration" placeholder="Duration" required value="<?php echo $duration; ?>">
                <input type="number" name="price" placeholder="Price" required value="<?php echo $price; ?>">
                <span><button type="submit" name="envoyer" class="button_2">Envoyer</button></span>
                <span><button type="reset" class="button_2">Restaurer</button></span>
            </form>
        </div>
    </center>
</div>
            </section>
</body>
</html>
