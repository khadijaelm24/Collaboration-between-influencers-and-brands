<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>RECHERCHER PARTENARIATS INF</title>
    <link rel="stylesheet" href="recherchepinf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
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
<section>
    <br><br><br><br><br><br><br><br><br>

    <br><br><br><br><br><br>

    <table class="new-offer-table">
        <tr>
            <td class="button-cell" onclick="window.open('../addpart_marque', '_blank');">
                Make New Offer
            </td>
        </tr>
    </table>

    <br><br><br><br><br><br>

    <table>
        <caption><center>PARTENARIATS DEJA SIGNES</center></caption>
        <tr>
            <th>id</th>
            <th>influenceur</th>
            <th>date_added</th>
            <th>duration</th>
            <th>content</th>
            <th>price</th>
            <th>status</th>
        </tr>
        <?php
        // Include your database connection file
        include('database.php');
        session_start();

        // Retrieve the user ID from the session
        $user_id = $_SESSION['user_id'];

        // Retrieve the email from the session
        $email = $_SESSION['email'];

        // Retrieve the user type from the session
        $user_type = $_SESSION['user_type'];
        // Perform the database query to retrieve data from the "contact", "marque", and "influenceur" tables
        $query = "SELECT c.id, i.fname, i.lname, m.name AS marque, c.date_added, c.duration, c.content, c.price, c.status
              FROM contrat c
              INNER JOIN marque m ON c.marque_id = m.id
              INNER JOIN influenceur i ON c.influencer_id = i.id
             where c.marque_id='$user_id';";
        $result = mysqli_query($conn, $query);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                echo '<td>' . $row['date_added'] . '</td>';
                echo '<td>' . $row['duration'] .' Jours'. '</td>';
                echo '<td>' . $row['content'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8">No records found.</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </table>

    <br><br><br><br><br><br>
    <table>
        <caption><center>OFFRES RECUS</center></caption>
        <tr>
            <th>id</th>
            <th>influenceur</th>
            <th>date_added</th>
            <th>duration</th>
            <th>content</th>
            <th>price</th>
            <th>accepter</th>
            <th>rejeter</th>
            <th>modifier</th>
        </tr>
        <?php
        // Include your database connection file
        include('database.php');

        $query = "SELECT o.id, i.fname, i.lname, m.name AS marque, o.date_added, o.duration, o.content, o.price
              FROM offre o
              INNER JOIN marque m ON o.marque_id = m.id
              INNER JOIN influenceur i ON o.influencer_id = i.id
              WHERE o.marque_id = '$user_id' and o.sender='influenceur';";
        $result = mysqli_query($conn, $query);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                echo '<td>' . $row['date_added'] . '</td>';
                echo '<td>' . $row['duration'] . ' Jours' . '</td>';
                echo '<td>' . $row['content'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td><form action="accepter.php" method="post" target="_blank">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="a" onclick="window.open(\'accepter.php)">accepter</button>';
                echo '</form></td>';

                echo '<td><form action="rejeter.php" method="post" target="_blank">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="r" onclick="window.open(\'rejeter.php)">rejeter</button>';
                echo '</form></td>';

                echo '<td><form action="modifier.php" method="post" target="_blank">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="m" onclick="window.open(\'modifier.php)">modifier</button>';
                echo '</form></td>';




                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="10">No records found.</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </table>
    <br><br><br><br><br><br>
    <table>
        <caption><center>OFFRES ENVOYEES</center></caption>
        <tr>
            <th>id</th>
            <th>influenceur</th>
            <th>date_added</th>
            <th>duration</th>
            <th>content</th>
            <th>price</th>
            <th>Annuler</th>
            <th>modifier</th>
        </tr>
    <?php
    // Include your database connection file
    include('database.php');

    $query = "SELECT o.id, i.fname, i.lname, m.name AS marque, o.date_added, o.duration, o.content, o.price
              FROM offre o
              INNER JOIN marque m ON o.marque_id = m.id
              INNER JOIN influenceur i ON o.influencer_id = i.id
              WHERE o.marque_id = '$user_id' and o.sender='marque';";
    $result = mysqli_query($conn, $query);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row and display the data in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
            echo '<td>' . $row['date_added'] . '</td>';
            echo '<td>' . $row['duration'] . ' Jours' . '</td>';
            echo '<td>' . $row['content'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';

            echo '<td><form action="rejeter.php" method="post" target="_blank">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="r" onclick="window.location.reload()">Annuler</button>';
            echo '</form></td>';

            echo '<td><form action="modifier.php" method="post" target="_blank">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="m" onclick="window.location.reload()">modifier</button>';
            echo '</form></td>';


            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="10">No records found.</td></tr>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    </table>


    <br><br><br><br><br><br>
</section>
</body>
</html>