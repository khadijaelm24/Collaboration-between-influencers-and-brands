<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    function validData($x)
    {
        $x = trim($x);
        $x = stripslashes($x);
        $x = htmlspecialchars($x);
        return $x;
    }
    $conn = new mysqli("localhost:3308", "root", "", "projet");
    if(!$conn->connect_errno)
    {
        $utype = validData($_POST["user_type"]);
        $uname = validData($_POST["email"]);
        $pass = validData($_POST["password"]);
        if(!empty($uname) and !empty($pass))
        {
            if($utype == "marque") {
                $sql = "SELECT * FROM marque WHERE email=? and password=?";
            } elseif($utype == "influenceur") {
                $sql = "SELECT * FROM influenceur WHERE email=? and password=?";
            }
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $uname, $pass);
            if($stmt->execute())
            {
                $result = $stmt->get_result();
                if($result->num_rows)
                {
                    session_start();
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                    $id = $row['id'];
                    $_SESSION['user_type'] = $utype; // Store the user type in a session variable
                    $_SESSION['user_id'] = $id; // Store the user ID in a session variable
                    $_SESSION['email'] = $email; // Store the email in a session variable
                    if($utype == "influenceur") {
                        header('Location: ../dashboard_influenceur');
                    } elseif($utype == "marque") {
                        header('Location: ../dashboard_marque');
                    } 
                    exit();
                }
                else {
                    $err = "Wrong Username and/or Password";
                    $script = "alert('$err');";
                    echo "<script>$script</script>";
                }
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="stylee.css">
        <link rel="stylesheet" href="config.php">
        <title>LOGIN</title>
    </head>
    <body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../index.html" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../index.html'" class="headr">RETOUR</a></li>
                <li class="liste"><a href="#" class="headr" onclick="location.href='../signup_boutons'">LOG IN</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
<center><div>
  <form action="index.php" method="POST" class="login-form">
    <h1>Login</h1>
    <br>
    <label for="login">Vous êtes:</label>
    <select id="login" name="user_type">
      <option value="influenceur">Influenceur</option>
      <option value="marque">Marque</option>
    </select>
    <input type="email" placeholder="Identifiant" name="email" required/>
    <input type="password" placeholder="Mot de passe" name="password" required/>
    <input type="submit" value="Valider" name="Valider"/>
    <input type="reset" value="Annuler"/>
    <br>
    <a href="" class="signup-link">N'est pas un membre? Inscrivez-vous maintenant!!</a>
  </form>
</div>
</center>
</section>
    </body>