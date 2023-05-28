<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="stylechatmar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_marque" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a href="../dashboard_marque" class="headr">RETOUR</a></li>
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
<br><br><br><br><br><br><br><br><br><br>
    <?php
    session_start();

    // Check if the session variables are set
    if (isset($_SESSION['otherid'])) {
        unset($_SESSION['otherid']);
    }
    if (isset($_SESSION['othertype'])) {
        unset($_SESSION['othertype']);
    }
    if (isset($_SESSION['othername'])) {
        unset($_SESSION['othername']);
    }
    ?>

    <?php
include ('database.php');
// Exécuter une requête SELECT pour récupérer toutes les valeurs de la colonne "nom"

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Exécuter une requête SELECT pour récupérer toutes les valeurs de la colonne "nom"
$sql = "SELECT DISTINCT influenceur.fname, influenceur.lname, influenceur.id 
FROM messages
JOIN influenceur ON (messages.receiver_id = influenceur.id AND messages.receiver_type = 'influenceur')
    OR (messages.sender_id = influenceur.id AND messages.sender_type = 'influenceur')
WHERE messages.sender_type = 'marque'
    AND messages.sender_id = $user_id
    OR messages.receiver_type = 'marque'
    AND messages.receiver_id = $user_id;
";
$result = mysqli_query($conn, $sql);

echo "<br><br><br><br><br>";

echo '<div style="display:flex; justify-content:center; align-items:center;">';
echo '<input type="text" id="search" onkeyup="filterNames()" placeholder="Rechercher un nom..." style="width: 700px; height: 50px; margin-bottom: 30px; border-radius: 25px;">';
echo '</div>';
echo '<div id="names">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div style="color:black; font-weight:bold; padding-left:25px;width:720px; height:70px; border:none; background-color:gray; border-radius:3px; display:block; margin-left:auto; margin-right:auto;">' .
        '<br>' .
        $row['lname'] .' '. $row['fname'] .
        '<form method="post" action="../message_mar/index.php">' .
        '<input type="hidden" name="id" value="' . $row['id'] . '">' .
        '<input type="hidden" name="name" value="' . $row['lname'] . ' '.$row['fname'] . '">' .
        '<button type="submit" style="width:100px; height:30px; border:none; background-color:lightblue; border-radius:3px; float:right; margin-right:20px;margin-top:-15px;">Connecter</button>' .
        '</form></div>';    echo "<br>";
}

echo '</div>';

echo '<script>';
echo 'function filterNames() {';
echo '  var input, filter, names, i;';
echo '  input = document.getElementById("search");';
echo '  filter = input.value.toUpperCase();';
echo '  names = document.getElementById("names").getElementsByTagName("div");';
echo '  for (i = 0; i < names.length; i++) {';
echo '    if (names[i].innerHTML.toUpperCase().indexOf(filter) > -1) {';
echo '      names[i].style.display = "";';
echo '    } else {';
echo '      names[i].style.display = "none";';
echo '    }';
echo '  }';
echo '}';
echo '</script>';



// Fermer la connexion
mysqli_close($conn);
?>  
</section>
</body>
</html>