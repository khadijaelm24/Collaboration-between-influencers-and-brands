<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="profil_a.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECHERCHE INFLUENCEUR</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_admin" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../dashboard_admin'" class="headr">RETOUR</a></li>
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
    header('Location: ../project/');
    exit();
}
$admin_id= $_SESSION['user_id']; // Remplacer "1" par l'ID de l'influenceur souhaité
$sql = "SELECT * FROM admin WHERE id='$admin_id'";
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
            <div>
            <h1>Mes informations</h1><br><br><br>
          </div>
            <div>
              <label class="nm">Nom<span class="S1">:</span></label>
              <input type="text" placeholder="Nom" class="txtnom" name="lname" value="<?php echo $row['lname']; ?>"/><br>
            </div>
            <div>
              <label class="pnm">Prénom<span class="S2">:</span></label>
              <input type="text" placeholder="Prénom" class="txtprenom" name="fname" value="<?php echo $row['fname']; ?>"/><br>
            </div>
            <div>
              <label class="S5">Mot de passe<span class="S5">:</span></label>
              <input type="password" id="mdp-courant" placeholder="Mdp_courant" name="mdp-courant" value="<?php echo $row['password']; ?>"/>
            </div>
            <br>
            <div>
              <input type="reset" value="Supprimer" class="boutons"/>
            </div>
            <div>
              <input type="submit" value="Envoyer" class="boutons"/>
            </div>
          </form>
</section>
          <?php
include ('database.php');

$id = $_SESSION['user_id']; // l'ID de l'influenceur à mettre à jour
$sql = "SELECT * FROM admin WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);

  // Traitement du formulaire de mise à jour
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mdp = $_POST['mdp-courant'];

    $sql = "UPDATE admin SET lname='$lname', fname='$fname',password='$mdp' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
    } else {
      echo "Une erreur s'est produite lors de la mise à jour des informations.";
    }

    // Récupération des informations mises à jour
    $sql = "SELECT * FROM admin WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
      header("Refresh: 0");

  }
} else {
  echo "Aucun résultat trouvé";
  echo '<br>';
}

mysqli_close($conn);
?>
    </body>
</html>

