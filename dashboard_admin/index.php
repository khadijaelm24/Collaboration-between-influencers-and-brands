<!DOCTYPE html>
<?php
include 'database.php';
session_start();
?>
<html>

<head>
    <title>TABLEAU DE BOARD</title>
    <meta charset="UTF-8">
    <link href="admdash.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

<nav class="nav">
        <ul>
            <li>
                <a href="?choice=inf" class="lien">
                    <span class="titre ">Influenceurs</span>
                </a>
            </li>
            <li>
                <a href="?choice=mar" class="lien">

                    <span class="titre ">Marques</span>
                </a>
            </li>
            <li>
                <a href="?choice=par" class="lien">

                    <span class="titre ">Partenariats</span>
                </a>
            </li> <li>
                <a href="?choice=ofr" class="lien">

                    <span class="titre ">Offres</span>
                </a>
            </li>
            <li>
                <a href="?choice=demandeinf" class="lien">
                    <span class="titre ">Suppression-Influenceur</span>
                </a>
            </li>
            <li>
                <a href="?choice=demandemar" class="lien">
                    <span class="titre ">Suppresion-Marque</span>
                </a>
            </li>
            <li>
                <a href="?choice=msginf" class="lien">
                    <span class="titre ">Message-Influenceur</span>
                </a>
            </li>
            <li>
                <a href="?choice=msgmar" class="lien">
                    <span class="titre ">Message-Marque</span>
                </a>
            </li>
            <li>
                <a href="../profil_admin/index.php" class="lien">

                    <span class="titre ">Modifier mot de passe</span>
                </a>
            </li>
            <li>
                <a href="../index.html" class="lien">

                <span class="titre">Log out </span>
                </a>
            </li>

        </ul>
    </nav>
    <div class="cont">
        <?php
        $choice = $_GET['choice'] ?? ''; // Get the value of the 'choice' query parameter, or empty string if not set
if(empty($choice)){$choice="inf";}
        if ($choice == "inf") {
// Assuming you have established a database connection

// Check if the connecter or supprimer button is clicked
if (isset($_POST['connecter']) || isset($_POST['supprimer'])) {
    // Get the ID of the selected user
    $otherid = $_POST['otherid'];

    // Store the ID in the session variable
    $_SESSION['otherid'] = $otherid;
}

// Perform the query to fetch data from the influenceur table
$query = "SELECT * FROM influenceur";
$result = mysqli_query($conn, $query);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo '<section id="inf">';
    echo '<table>';
    echo '<caption class="table-caption"><center>INFLUENCEURS</center></caption>';
    echo '<tr>
            <th>photo</th>
            <th>id</th>
            <th>lname</th>
            <th>fname</th>
            <th>password</th>
            <th>email</th>
            <th>birth_date</th>
            <th>category_id</th>
            <th>msg</th>
            <th>suppr.</th>
        </tr>';

    // Loop through each row and populate the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><img src="' . $row['photo'] . '" class="circle-image" /></td>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['lname'] . '</td>';
        echo '<td>' . $row['fname'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['birth_date'] . '</td>';
        echo '<td>' . $row['category_id'] . '</td>';
        echo '<td>
                <form method="POST" action="../chatadmin/index.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <input type="hidden" name="othertype" value="influenceur">
                    <button type="submit" name="connecter" class="connecter" onclick="setTimeout(function(){ window.location.reload(); }, 100);">connecter</button>
                </form>
            </td>';
        echo '<td>
                <form method="POST" action="delete_influenceur.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer" onclick="setTimeout(function(){ window.location.reload(); }, 100);">supprimer</button>
                </form>
            </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</section>';
} else {
    echo 'No data found.';
}

// Close the database connection
mysqli_close($conn);

        }
        if ($choice == "mar") {
            $query = "SELECT * FROM marque";
            $result = mysqli_query($conn, $query);

// Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                echo '<section id="mar">';
                echo '<br><br><br><br>';
                echo '<table>';
                echo '<caption class="table-caption"><center>MARQUES</center></caption>';
                echo '<tr>
            <th>logo</th>
            <th>id</th>
            <th>name</th>
            <th>password</th>
            <th>email</th>
            <th>address</th>
            <th>category_id</th>
            <th>ca</th>
            <th>msg</th>
            <th>suppr.</th>
        </tr>';

                // Loop through each row and populate the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td><img src="' . $row['logo'] . '" class="circle-image" /></td>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['category_id'] . '</td>';
                    echo '<td>' . $row['ca'] . '</td>';
                    echo '<td>
                <form method="POST" action="../chatadmin/index.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <input type="hidden" name="othertype" value="marque">
                    <button type="submit" name="connecter" class="connecter" onclick="setTimeout(function(){ window.location.reload(); }, 100);">connecter</button>
                </form>
            </td>';
                    echo '<td>
                <form method="POST" action="delete_marque.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer" onclick="setTimeout(function(){ window.location.reload(); }, 100);">supprimer</button>
                </form>
            </td>';
                    echo '</tr>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</section>';
            } else {
                echo 'No data found.';
            }

// Close the database connection

            mysqli_close($conn);
       ;}
        if ($choice == "ofr") {
            $query = "SELECT * FROM offre";
            $result = mysqli_query($conn, $query);

// Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                echo '<section id="par">';
                echo '<br><br><br><br>';
                echo '<table>';
                echo '<caption class="table-caption"><center>OFFRES</center></caption>';
                echo '<tr>
            <th>id</th>
            <th>influencer_id</th>
            <th>marque_id</th>
            <th>date_added</th>
            <th>duration</th>
            <th>content</th>
            <th>price</th>
            <th>sender</th>
            <th>supprimer</th>
        </tr>';

                // Loop through each row and populate the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['influencer_id'] . '</td>';
                    echo '<td>' . $row['marque_id'] . '</td>';
                    echo '<td>' . $row['date_added'] . '</td>';
                    echo '<td>' . $row['duration'] . '</td>';
                    echo '<td>' . $row['content'] . '</td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>' . $row['sender'] . '</td>';
                    echo '<td>
                <form method="POST" action="delete_offre.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer" onclick="setTimeout(function(){ window.location.reload(); }, 100);">supprimer</button>
                </form>
            </td>';                    echo '</tr>';
                }

                echo '</table>';
                echo '</section>';
            } else {
                echo 'No data found.';
            }

// Close the database connection
            mysqli_close($conn);}
        if ($choice == "par") {
            $query = "SELECT * FROM contrat";
            $result = mysqli_query($conn, $query);

// Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                echo '<section id="par">';
                echo '<br><br><br><br>';
                echo '<table>';
                echo '<caption class="table-caption"><center>PARTENARIATS</center></caption>';
                echo '<tr>
            <th>id</th>
            <th>influencer_id</th>
            <th>marque_id</th>
            <th>date_added</th>
            <th>duration</th>
            <th>content</th>
            <th>price</th>
            <th>supprimer</th>
        </tr>';

                // Loop through each row and populate the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['influencer_id'] . '</td>';
                    echo '<td>' . $row['marque_id'] . '</td>';
                    echo '<td>' . $row['date_added'] . '</td>';
                    echo '<td>' . $row['duration'] . '</td>';
                    echo '<td>' . $row['content'] . '</td>';
                    echo '<td>' . $row['price'] . '</td>';
                    echo '<td>
                <form method="POST" action="delete_contract.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer" onclick="setTimeout(function(){ window.location.reload(); }, 100);">supprimer</button>
                </form>
            </td>';                    echo '</tr>';
                }

                echo '</table>';
                echo '</section>';
            } else {
                echo 'No data found.';
            }

// Close the database connection
            mysqli_close($conn);}
        if ($choice == "demandeinf") {
            $query = "SELECT d.id, d.sender_id, d.date, d.sender_type, i.photo, i.email,i.fname,i.lname
          FROM demsup AS d
          INNER JOIN influenceur AS i ON d.sender_id = i.id where d.sender_type='influenceur'";
            $result = mysqli_query($conn, $query);

// Generate the table HTML with the fetched data
            echo '
<section id="demandeinf">
    <br><br><br><br>
    <table>
        <caption class="table-caption"><center>DEMANDE DE SUPPRESSION - INFLUENCEURS</center></caption>
        <tr>
            <th>photo</th>
            <th>sender id</th>
            <th>date</th>
            <th>name</th>
            <th>email</th>
            <th>suppr.</th>
        </tr>';
            if (mysqli_num_rows($result)==0) {
                echo '<tr>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>';
            }
// Loop through the query result and populate the table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
        <td><img src="' . $row['photo'] . '" class="circle-image" /></td>
        <td>' . $row['sender_id'] . '</td>
        <td>' . $row['date'] . '</td>
        <td>' . $row['lname'] ." ". $row['fname'] .  '</td>
        <td>' . $row['email'] . '</td>';
                echo '<td>
                <form method="POST" action="delete_marque.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer" onclick="setTimeout(function(){ window.location.reload(); }, 100);">supprimer</button>
                </form>
            </td>';
echo'    </tr>';
            }

            echo '</table>
</section>';

// Close the database connection
            mysqli_close($conn);
       }
        if ($choice == "demandemar") {

// Assuming you have established a database connection

// Perform the query to fetch data from the demsup and marque tables
            $query = "SELECT d.id, d.sender_id, d.date, d.sender_type, m.logo, m.email, m.name
          FROM demsup AS d
          INNER JOIN marque AS m ON d.sender_id = m.id
          WHERE d.sender_type='marque'";
            $result = mysqli_query($conn, $query);

// Generate the table HTML with the fetched data
            echo '
<section id="demandemar">
    <br><br><br><br>
    <table>
        <caption class="table-caption"><center>DEMANDE DE SUPPRESSION - MARQUES</center></caption>
        <tr>
            <th>logo</th>
            <th>sender id</th>
            <th>date</th>
            <th>name</th>
            <th>email</th>
            <th>suppr.</th>
        </tr>';

// Check if there are no rows returned
            if (mysqli_num_rows($result) == 0) {
                echo '<tr>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>';
            }

// Loop through the query result and populate the table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
        <td><img src="' . $row['logo'] . '" class="circle-image" /></td>
        <td>' . $row['sender_id'] . '</td>
        <td>' . $row['date'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] . '</td>';
         echo '<td>
                <form method="POST" action="delete_marque.php">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <button type="submit" name="supprimer" class="supprimer">supprimer</button>
                </form>
            </td>';
echo'    </tr>';
            }

            echo '</table>
</section>';

// Close the database connection
            mysqli_close($conn);


        }
        if ($choice == "msginf") {
            $query = "SELECT m.id, i.photo, i.id AS sender_id, CONCAT(i.lname, ' ', i.fname) AS sender_name, i.email, m.content, m.date
          FROM messages AS m
          INNER JOIN influenceur AS i ON m.sender_id = i.id
          WHERE m.sender_type = 'influenceur' AND m.receiver_type = 'admin'";
            $result = mysqli_query($conn, $query);

// Generate the table HTML with the fetched data
            echo '
<section id="msginf">
    <br><br><br><br>
    <table>
        <caption class="table-caption"><center>MESSAGES RECUS - INFLUENCEUR</center></caption>
        <tr>
            <th>photo</th>
            <th>sender id</th>
            <th>sender name</th>
            <th>sender email</th>
            <th>content</th>
            <th>date</th>
            <th>reply</th>
        </tr>';

// Check if there are no rows returned
            if (mysqli_num_rows($result) == 0) {
                echo '<tr>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>';
            }

// Loop through the query result and populate the table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
        <td><img src="' . $row['photo'] . '" class="circle-image" /></td>
        <td>' . $row['sender_id'] . '</td>
        <td>' . $row['sender_name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['content'] . '</td>
        <td>' . $row['date'] . '</td>';
                echo '<td>
                <form method="POST" action="../chatadmin/index.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['id'] . '">
                    <input type="hidden" name="othertype" value="influenceur">
                    <button type="submit" name="connecter" class="connecter" onclick="setTimeout(function(){ window.location.reload(); }, 100);">connecter</button>
                </form>
            </td>';


            }

            echo '</table>
</section>';

// Close the database connection
            mysqli_close($conn);
        }
        if ($choice == "msgmar") {
            // Assuming you have established a database connection

// Perform the query to fetch data from the messages and marque tables
            $query = "SELECT m.id, m.sender_id, CONCAT(marque.name, ' (ID: ', m.sender_id, ')') AS sender_name, marque.email, m.content, m.date
          FROM messages AS m
          INNER JOIN marque ON m.sender_id = marque.id
          WHERE m.sender_type = 'marque' AND m.receiver_type = 'admin'";
            $result = mysqli_query($conn, $query);

// Generate the table HTML with the fetched data
            echo '
<section id="msgmar">
    <br><br><br><br>
    <table>
        <caption class="table-caption"><center>MESSAGES RECUS - MARQUES</center></caption>
        <tr>
            <th>sender id</th>
            <th>sender name</th>
            <th>sender email</th>
            <th>content</th>
            <th>date</th>
            <th>reply</th>
        </tr>';

// Check if there are no rows returned
            if (mysqli_num_rows($result) == 0) {
                echo '<tr>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
        <td>N/A</td>
    </tr>';
            }

// Loop through the query result and populate the table rows
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
        <td>' . $row['sender_id'] . '</td>
        <td>' . $row['sender_name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['content'] . '</td>
        <td>' . $row['date'] . '</td>
        ';

                echo '<td>
                <form method="POST" action="../chatadmin/index.php" target="_blank">
                    <input type="hidden" name="otherid" value="' . $row['sender_id'] . '">
                    <input type="hidden" name="othertype" value="marque">
                    <button type="submit" name="connecter" class="connecter" onclick="setTimeout(function(){ window.location.reload(); }, 100);">connecter</button>
                </form>
            </td>';
                echo ' </td>';
            }

            echo '</table>
</section>';

// Close the database connection
            mysqli_close($conn);

        }?>
</div>

<style>
    th{
        width:40px;
    }
    td{
        width:40px;
    }
    button{
        padding:0%;
        height:30px;
    }
    .connecter{
        background-color:green;
    }
    .supprimer{
        background-color:red;
    }
    .circle-image {
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }
    .table-caption{
        font-weight:bold;
        font-size:20px;
        background-color: rgb(52, 52, 54, 0.99);
    }
    
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital@1&display=swap');
body {
    width: 100%;
    justify-content: center;
    font-family: 'Roboto', sans-serif;
    background-image:url('bg.jpg');
}
nav {
    width: 13rem;
    height: auto;
    position: fixed;
    top: 0px;
    left: 0px;
    bottom: 0px;
    background: rgb(52, 52, 54, 0.99);
    box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
    transition: 1s ease;
}
h1{
    color: rgba(255, 255, 255, 0.737);
}

ul {
    list-style: none;
    padding: 0;
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-y:auto;
    height:600px;
}

li {
    width: 100%;
    transition: 1s;
    color: bisque;
    font-size: 15px;
}

.lien {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    height: 5rem;
    width: 100%;
    text-decoration: none;
}

.logo {
    font-size: 15px;
    margin-left: 1.5rem;
    color: beige;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

.titre {
    font-size: 15px;
    margin-left: 1.5rem;
    color: beige;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

li:hover {
    background-color: rgba(192, 180, 171, 0.8);
}

table {
    background-color: rgb(146, 141, 135);
    border-collapse: collapse;
    border: transparent;
    width: 100%;
}

button {
    outline: none;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    padding: 10px;
    color: #201f1f;
}

thead th {
    position: sticky;
    top: 0;
    background-color: #6d6d6e;
    color: #0c0d0d;
    font-size: 15px;
    width: 70px;
}

th,
td {
    border-bottom: 1px solid #dddddd;
    padding: 10px 15px;
    text-align: center;
}

tr:hover td {
    color: #e4dfd9;
    border: #3d3c3b;
    background-color: #3d3c3b;
}

.spr {
    border: none;
    padding: 7px 20px;
    border-radius: 20px;
    background-color: black;
    color: #e6e7e8;
}

.cont {
    padding-left: 13rem;
}
/* styles for larger screens */
nav {
  width: 13rem;
  position: fixed;
  top: 0px;
  left: 0px;
  bottom: 0px;
  background: rgb(52, 52, 54, 0.99);
  box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
  transition: 1s ease;
}

/* styles for smaller screens */
@media only screen and (max-width: 768px) {
  nav {
    width: 100%;
    height: auto;
    position: relative;
    box-shadow: none;
  }
  
  ul {
    flex-direction: row;
    justify-content: space-between;
  }
  
  li {
    width: auto;
    padding: 0 10px;
    font-size: 12px;
  }
  
  .cont {
    padding-left: 0;
  }
}
/* styles for larger screens */
nav {
  width: 13rem;
  position: fixed;
  top: 0px;
  left: 0px;
  bottom: 0px;
  background: rgb(52, 52, 54, 0.99);
  box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
  transition: 1s ease;
}

/* styles for smaller screens */
@media only screen and (max-width: 768px) {
  nav {
    width: 100%;
    height: auto;
    position: relative;
    box-shadow: none;
  }
  
  ul {
    flex-direction: row;
    justify-content: space-between;
  }
  
  li {
    width: auto;
    padding: 0 10px;
    font-size: 12px;
  }
  
  .cont {
    padding-left: 0;
  }
}/* styles for larger screens */
nav {
  width: 13rem;
  position: fixed;
  top: 0px;
  left: 0px;
  bottom: 0px;
  background: rgb(52, 52, 54, 0.99);
  box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
  transition: 1s ease;
}

/* styles for smaller screens */
@media only screen and (max-width: 768px) {
  nav {
    width: 100%;
    height: auto;
    position: relative;
    box-shadow: none;
  }
  
  ul {
    flex-direction: row;
    justify-content: space-between;
  }
  
  li {
    width: auto;
    padding: 0 10px;
    font-size: 12px;
  }
  
  .cont {
    padding-left: 0;
  }
}
/* styles for larger screens */
nav {
    width: 13rem;
    position: fixed;
    top: 0px;
    left: 0px;
    bottom: 0px;
    background: rgb(52, 52, 54, 0.99);
    box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
    transition: 1s ease;
  }
  
  /* styles for smaller screens */
  @media only screen and (max-width: 768px) {
    nav {
      width: 100%;
      height: auto;
      position: relative;
      box-shadow: none;
    }
    
    ul {
      flex-direction: row;
      justify-content: space-between;
    }
    
    li {
      width: auto;
      padding: 0 10px;
      font-size: 12px;
    }
    
    .cont {
      padding-left: 0;
    }
  }
  /* For screens smaller than 768px */
@media only screen and (max-width: 767px) {
    /* Add padding to body to avoid content being hidden behind fixed header */
    body {
      padding-top: 50px;
    }
    /* Fix header to top of screen */
    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background-color: rgb(52, 52, 54, 0.99);
      box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
      z-index: 1;
    }
    /* Hide nav off-screen initially */
    nav {
      position: fixed;
      top: 50px;
      left: 0;
      bottom: 0;
      width: 100%;
      transform: translateX(-100%);
      transition: transform 0.3s ease-in-out;
    }
    /* Show nav when menu is open */
    body.menu-open nav {
      transform: translateX(0);
    }
    /* Style the list items */
    ul {
      flex-direction: row;
      margin-top: 0;
      justify-content: space-between;
    }
    li {
      width: auto;
      color: bisque;
      font-size: 15px;
    }
    /* Style the links */
    .lien {
      height: auto;
      padding: 10px;
      font-size: 14px;
    }
    /* Style the header text */
    .titre {
      margin-left: 0.5rem;
    }
    /* Style the logo */
    .logo {
      font-size: 18px;
      margin-left: 0.5rem;
      margin-right: auto;
    }
    /* Add padding to content to avoid content being hidden behind fixed header */
    .cont {
      padding-top: 100px;
      padding-left: 0;
    }
  }
  
  /* For screens 768px and larger */
  @media only screen and (min-width: 768px) {
    /* Fix nav to left side of screen */
    nav {
      width: 13rem;
      position: fixed;
      top: 0px;
      left: 0px;
      bottom: 0px;
      background: rgb(52, 52, 54, 0.99);
      box-shadow: rgba(20, 20, 19, 0.2) 0 4px 14px;
      transition: 1s ease;
    }
    /* Style the list */
    ul {
      list-style: none;
    }
    button:hover {
    cursor: pointer;
    }
    .cont {
    padding-top: 50px;
    padding-left: 15rem;
    padding-right: 3rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    }
    .cont table {
    margin-top: 1rem;
    }
    .cont h2 {
    margin-top: 2rem;
    margin-bottom: 1.5rem;
    font-size: 24px;
    font-weight: 600;
    color: rgba(50, 49, 48, 0.9);
    }
    .cont p {
    margin-bottom: 1rem;
    font-size: 16px;
    line-height: 1.5;
    color: rgba(50, 49, 48, 0.8);
    }
    .cont .btn-container {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
    }
    .cont .btn-container button {
    padding: 0.5rem 2rem;
    font-size: 16px;
    font-weight: 600;
    color: white;
    background-color: #007bff;
    border-radius: 4px;
    border: none;
    margin-right: 1rem;
    transition: background-color 0.3s ease;
    }
    .cont .btn-container button:hover {
    background-color: #0069d9;
    cursor: pointer;
    }
    }
</style>
</body>

</html>