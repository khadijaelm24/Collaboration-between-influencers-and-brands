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
        $utype = validData("admin");
        $uname = validData($_POST["email"]);
        $pass = validData($_POST["password"]);
        if(!empty($uname) and !empty($pass))
        {
                $sql = "SELECT * FROM admin WHERE email=? and password=?";
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

                        header('Location: ../dashboard_admin');

                    exit();
                }
                else {
                    $err = "Wrong Username and/or Password";
                    $script = "alert('$err');";
                    echo "<script>$script</script>";
                }
            }
        }

    $conn->close();
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylead.css"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li class="liste"><a href="../index.html" class="headr">RETOUR</a></li>
                <li class="liste"><a class="headr" onclick="location.href='../admin'">LOG IN</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
<br><br><br><br><br><br><br><br><br><br>
        <div>
            <form action="index.php" method="POST">
                <h1>Login</h1>

                <input type="text" placeholder="Identifiant" name="email" required/>
                <input type="password" placeholder="Mot de passe" name="password" required/>
                <input type="submit" value="Valider" name="Valider"/>
                <input type="reset" value="Annuler"/>
        </form>
        </div>
        
</section>
    </body>
    </html>