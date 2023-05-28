<?php
include 'database.php';

if (isset($_POST["submit"])) {
    $isSuccess = true;
    $category = $_POST['categorie'];
    switch ($category) {
        case 'fitness':
            echo 'Votre catégorie est Fitness';
            $category_id = 1;
            break;
        case 'beauté':
            echo 'Votre catégorie est Beauté';
            $category_id = 2;
            break;
        case 'commerce':
            echo 'Votre catégorie est Commerce';
            $category_id = 3;
            break;
        case 'industrie':
            echo 'Votre catégorie est Industrie';
            $category_id = 4;
            break;
        case 'autre':
            echo 'Votre catégorie ne figure pas dans cette liste';
            $category_id = 5;
            break;
        default:
            echo 'Veuillez sélectionner une catégorie';
            $isSuccess = false;
            break;
    }

    $lname = $_POST['Nom'];
    $fname = $_POST['Prénom'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $youtube = $_POST['youtube'];
    $password = $_POST['password'];
    $password_conf = $_POST['confpass'];

    if (empty($age)) {
        $isSuccess = false;
    }

    if ($password !== $password_conf) {
        $isSuccess = false;
    }

    if ($isSuccess) {
        $target_dir = "pdp/";
        $photo = $_FILES['photo']['name'];
        $target_file = $target_dir . basename($photo);
        $tmp_name = $_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp_name, $target_file);

        $photo_link = "../signup_influenceur/pdp/" . $photo;
        $sql = "INSERT INTO influenceur (lname, fname, email, facebook, instagram, youtube, password, category_id, photo,birth_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param("sssssssiss", $lname, $fname, $email, $facebook, $instagram, $youtube, $password, $category_id, $photo_link,$age);
        $statement->execute();
        $stmt = $conn->prepare("SELECT id FROM influenceur WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id = $row['id'];

        session_start();
        session_destroy();
        session_start();

        $_SESSION['user_id'] = $id;

// Store the email in a session variable
        $_SESSION['email'] = $email;

// Store the user type in a session variable
        $_SESSION['user_type'] = "influenceur";
        header('Location: ../dashboard_influenceur');

        exit();
    }

}
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>sign up influenceur</title>
    <link rel="stylesheet" href="signupinf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../index.html" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a onclick="location.href='../index.html'" class="headr">RETOUR</a></li>
                <li class="liste"><a href="#" class="headr"  onclick="location.href='../login'">LOG IN</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
    <br><br><br><br><br><br><br><br><br>
<div id="div1">
    <h1>Formulaire d'inscription d'influenceur</h1>
    <br><br><br><br>
    <center>
        <div id="formulaire">
            <form method="post" action="index.php" enctype="multipart/form-data">
                <label for="categorie">Veuillez indiquer votre catégorie:</label>
                <div class="custom-select">
                    <select id="categorie" name="categorie">
                        <option value="">Choisissez une option</option>
                        <option value="fitness">Fitness</option>
                        <option value="beauté">Beauté</option>
                        <option value="commerce">Commerce</option>
                        <option value="industrie">Industrie</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <input type="text" name="Nom" placeholder="Nom" required>
                <input type="text" name="Prénom" placeholder="Prénom" required>
                <input type="date" name="age" placeholder="Age" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="file" name="photo" id="photo">
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="confpass" placeholder="Confirmer le mot de passe" required>
                <input type="text" name="facebook" placeholder="Compte Facebook" required>
                <input type="text" name="instagram" placeholder="Compte Instagram" required>
                <input type="text" name="youtube" placeholder="Chaîne Youtube" required>
                <button type="submit" name="submit" value="submit">Envoyer</button>
                <span><button type="reset" class="button_2">Restaurer</button></span>
                <span><h4>Vous êtes déjà inscrit ?</h4></span>
                <span><a href="../login">Se connecter</a></span>
            </form>
        </div>
    </center>
</div>
<br><br><br><br><br>
    <div class="social_icons">
        <center>
            <a href="https://fr-fr.facebook.com/" class="fa fa-facebook"></a>
            <a href="https://twitter.com/login/" class="fa fa-twitter"></a>
            <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
            <a href="https://www.youtube.com/" class="fa fa-youtube"></a>
        </center>
    </div>
</section>
</body>

</html>