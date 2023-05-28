<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profil_mar.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECHERCHE INFLUENCEUR</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_marque" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../dashboard_marque'" class="headr">RETOUR</a></li>
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
    <?php
    include ('database.php');
    session_start();

$marque_id =$_SESSION['user_id']; // Remplacer "1" par l'ID de l'influenceur souhaité
$sql = "SELECT * FROM marque WHERE id='$marque_id'";
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
                <img src="<?php echo $row['logo']; ?>" alt="Profile photo" style="border-radius:50%; width:50px; height:50px;">
            </div>

            <label class="photo">Logo_de_marque<span class="S0">:</span></label>
              <input type="file" id="photo" name="photo" value="<?php echo $row['logo']; ?>"><br><br>
              <div>
                <label class="chiffre">Nom<span class="S3">:</span></label>
                <input type="text" class="txtnom" name="name"  value="<?php echo $row['name']; ?>"/><br>
              </div><br>
              <div>
                <label class="chiffre">password<span class="S3">:</span></label>
                <input type="password" class="txtnom" name="password"  value="<?php echo $row['password']; ?>" /><br>
              </div><br>
              <div>
                <label class="chiffre">email<span class="S3">:</span></label>
                <input type="email" class="txtnom" name="email"  value="<?php echo $row['email']; ?>"/><br>
              </div><br>
              <div>
                <label class="chiffre">Chiffre d'affaire<span class="S3">:</span></label>
                <input type="text" class="txtnom" name="ca"  value="<?php echo $row['ca']; ?>"/><br>
              </div><br>
              <div>
                <label class="cat">Catégorie<span class="S4">:</span></label>
                <input type="text" class="txtcat" name="cat"  value="<?php echo $row['category_id']; ?>"/><br>
              </div>
              <div>
                <label class="adr">Adresse<span class="S5">:</span></label>
                <input type="text" class="txtadr"  name="address" value="<?php echo $row['address']; ?>"/><br>
              </div>
              <div>
                <button onclick="window.open('delete.php', '_blank')" class="boutons">Suppression</button>
                <button type="submit" class="boutons">Envoyer</button>
              </div>
        </form>
          <?php
include ('database.php');

$id = $_SESSION['user_id']; // l'ID de la marque à mettre à jour
$sql = "SELECT * FROM marque WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Traitement du formulaire de mise à jour
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $logo = $_POST['photo'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $ca = $_POST['ca'];
    $cat = $_POST['cat'];
    $address = $_POST['address'];

    $sql = "UPDATE marque SET name='$name', password='$password', email='$email', address='$address', category_id='$cat',ca='$ca' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    } else {
      echo "Une erreur s'est produite lors de la mise à jour des informations.";
    }

    // Récupération des informations mises à jour
    $sql = "SELECT * FROM marque WHERE id='$id'";
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
