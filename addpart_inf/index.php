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
                <li class="listee"><a href="../dashboard_influenceur" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a href="#" class="headr" onclick="location.href='../partenariat_influenceur'">RETOUR</a></li>
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

                <form method="POST" action="insert.php" >
                    <h2>PARTENARIAT</h2>
                 <select name="marque" required>
                        <?php
                        // Assuming you have a database connection
                        include ('database.php');

                        $result = mysqli_query($conn, "SELECT * FROM marque");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        ?>
                    </select>
                    <input type="text" name="content" placeholder="content" required>
                    <input type="number" name="duree" placeholder="Durée de partenariat (jours)" required>
                    <input type="number" name="montant" placeholder="Montant" required>
                    <span><button type="submit" name="envoyer" class="button_2">Envoyer</button></span>
                    <span><button type="reset" class="button_2">Restaurer</button></span>
                </form>



            </div>
         </center>
    </div>
    </section>
</body>
</html>