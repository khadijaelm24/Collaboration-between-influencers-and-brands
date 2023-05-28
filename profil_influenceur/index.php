<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profil_inf.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECHERCHE INFLUENCEUR</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_influenceur" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../dashboard_influenceur'" class="headr">RETOUR</a></li>
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
    <?php
include ('database.php');

    session_start();
    function logout()
    {
        session_start();
        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session.
        session_destroy();

        // Redirect to the main index
        header('Location: ..project/');
        exit();
    }
$influenceur_id = $_SESSION['user_id']; // Remplacer "1" par l'ID de l'influenceur souhaité
$sql = "SELECT * FROM influenceur WHERE id='$influenceur_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
} else {
  echo "Aucun résultat trouvé";
  echo '<br>';
}

mysqli_close($conn);
?>
<section>
        <form method="POST">
            <div class="pdp">
                <img src="<?php echo $row['photo']; ?>" alt="Profile photo" style="border-radius:50%; width:50px; height:50px;">
            </div>

            <div>
            <h1>Mes informations</h1><br><br><br>
          </div><label class="photo">Photo de profil<span class="S0">:</span></label>
            <input type="file" id="photo" name="photo" name="photo" value="<?php echo $row['photo']; ?>"><br><br>
            <div>
              <label class="nm">Nom<span class="S1">:</span></label>
              <input type="text" placeholder="Nom" class="txtnom" name="lname" value="<?php echo $row['lname']; ?>"/><br>
            </div>
            <div>
              <label class="pnm">Prénom<span class="S2">:</span></label>
              <input type="text" placeholder="Prénom" class="txtprenom" name="fname" value="<?php echo $row['fname']; ?>"/><br>
            </div>
            <div>
              <label class="age">Date de naissance:<span class="S3">:</span></label>
              <input type="date" name="age" >
            </div>
            <div class="mail">
              <label class="ml">Email<span class="S4">:</span></label>
              <input type="email" placeholder="Email" name="email" value="<?php echo $row['email']; ?>"/>
            </div>
            <div>
              <label class="S5">Mot de passe<span class="S5">:</span></label>
              <input type="password" id="mdp-courant" placeholder="Mdp_courant" name="mdp-courant" value="<?php echo $row['password']; ?>"/>
            </div>
            <div>
              <label class="S6">Instagram<span class="S6">:</span></label>
              <input type="text"placeholder="instagram-id" name="instagram" value="<?php echo $row['instagram']; ?>"/><br>
            </div>
            <div>
              <label class="S7">Facebook<span class="S7">:</span></label>
              <input type="text"placeholder="facebook-id" name="facebook" value="<?php echo $row['facebook']; ?>"/><br>
            </div>
            <div>
              <label class="S8">youtube<span class="S8">:</span></label>
              <input type="text"placeholder="tweeter-id" name="youtube" value="<?php echo $row['youtube']; ?>"/><br>
            </div>
            <div>
                <button onclick="window.open('delete.php', '_blank')" class="boutons">Suppression</button> 
                <button type="submit" class="boutons">Envoyer</button>
            </div>
          </form>
          <?php
include ('database.php');

$id = $_SESSION['user_id']; // l'ID de l'influenceur à mettre à jour
$sql = "SELECT * FROM influenceur WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Traitement du formulaire de mise à jour
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $photo = $_POST['photo'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp-courant'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
//      $target_dir = "pdp/";
//      $photo = $_FILES['photo']['name'];
//      $target_file = $target_dir . basename($photo);
//      $tmp_name = $_FILES['photo']['tmp_name'];
//      move_uploaded_file($tmp_name, $target_file);

      $photo_link = "../signup_influenceur/pdp/" . $photo;
    $sql = "UPDATE influenceur SET lname='$lname', fname='$fname', email='$email', password='$mdp', instagram='$instagram', facebook='$facebook', youtube='$youtube' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    } else {
      echo "Une erreur s'est produite lors de la mise à jour des informations.";
    }

    // Récupération des informations mises à jour
    $sql = "SELECT * FROM influenceur WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  }
} else {
  echo "Aucun résultat trouvé";
  echo '<br>';
}

mysqli_close($conn);
?>

</section>
    </body>
</html>

