<?php
include 'database.php'; // Inclusion du fichier "database.php" qui contient les informations de connexion à la base de données.

if (isset($_POST["submit"])) { // Vérification si le formulaire a été soumis.

    $isSuccess = true; // Variable pour indiquer si le formulaire est valide ou non.
    $category = $_POST['categorie']; // Récupération de la valeur du champ "categorie" du formulaire.
    
    // Switch case pour vérifier la valeur de la catégorie sélectionnée.
    switch ($category) {
        case 'fitness':
            echo 'Votre catégorie est Fitness'; // Affichage d'un message si la catégorie est "fitness".
            $category_id = 1; // Attribution de l'ID de catégorie correspondant.
            break;
        case 'beauté':
            echo 'Votre catégorie est Beauté'; // Affichage d'un message si la catégorie est "beauté".
            $category_id = 2; // Attribution de l'ID de catégorie correspondant.
            break;
        case 'commerce':
            echo 'Votre catégorie est Commerce'; // Affichage d'un message si la catégorie est "commerce".
            $category_id = 3; // Attribution de l'ID de catégorie correspondant.
            break;
        case 'industrie':
            echo 'Votre catégorie est Industrie'; // Affichage d'un message si la catégorie est "industrie".
            $category_id = 4; // Attribution de l'ID de catégorie correspondant.
            break;
        case 'autre':
            echo 'Votre catégorie ne figure pas dans cette liste'; // Affichage d'un message si la catégorie est "autre".
            $category_id = 5; // Attribution de l'ID de catégorie correspondant.
            break;
        default:
            echo 'Veuillez sélectionner une catégorie'; // Affichage d'un message par défaut si aucune catégorie n'est sélectionnée.
            $isSuccess = false; // Le formulaire n'est pas valide car aucune catégorie n'a été sélectionnée.
            break;
    }

    $name = $_POST['Nom']; // Récupération de la valeur du champ "Nom" du formulaire.
    $address = $_POST['address']; // Récupération de la valeur du champ "address" du formulaire.
    $email = $_POST['email']; // Récupération de la valeur du champ "email" du formulaire.
    $ca = $_POST['ca']; // Récupération de la valeur du champ "ca" du formulaire.
    $password = $_POST['password']; // Récupération de la valeur du champ "password" du formulaire.
    $password_conf = $_POST['confpass']; // Récupération de la valeur du champ "confpass" du formulaire.


    if ($password !== $password_conf) { // Vérification si les mots de passe saisis correspondent.
        $isSuccess = false; // Le formulaire n'est pas valide car les mots de passe ne correspondent pas.
    }

    if ($isSuccess) { // Si le formulaire est valide.
        $target_dir = "pdp/"; // Répertoire de destination pour les fichiers téléchargés.
        $photo = $_FILES['photo']['name']; // Nom du fichier téléchargé.
        $target_file = $target_dir . basename($photo); // Chemin complet du fichier de destination.
        $tmp_name = $_FILES['photo']['tmp_name']; // Nom temporaire du fichier téléchargé.
        move_uploaded_file($tmp_name, $target_file); // Déplacement du fichier téléchargé vers le répertoire de destination spécifié.
        $photo_link = "../signup_marque/pdp/" . $photo; // Lien relatif vers l'image de profil de la marque.

        $sql = "INSERT INTO marque (name, email, ca, address, password, category_id, logo) 
                VALUES (?, ?, ?, ?, ?, ?, ?)"; // Requête SQL pour insérer les données de la marque dans la table "marque".
        $statement = $conn->prepare($sql); // Préparation de la requête SQL.
        $statement->bind_param("ssissis", $name, $email, $ca, $address, $password, $category_id, $photo_link); // Liaison des paramètres à la requête préparée.
        $statement->execute(); // Exécution de la requête préparée.
        
        $stmt = $conn->prepare("SELECT id FROM marque WHERE email = ?"); // Requête SQL pour récupérer l'ID de la marque nouvellement créée.
        $stmt->bind_param("s", $email); // Liaison des paramètres à la requête préparée.
        $stmt->execute(); // Exécution de la requête préparée.
        $result = $stmt->get_result(); // Récupération du résultat de la requête.
        $row = $result->fetch_assoc(); // Récupération de la ligne de résultat sous forme de tableau associatif.
        $id = $row['id']; // Récupération de l'ID de la marque.
    
        session_start(); // Démarrage d'une session.
        session_destroy(); // Destruction de la session existante.
        session_start(); // Démarrage d'une nouvelle session.
    
        $_SESSION['user_id'] = $id; // Attribution de l'ID de la marque à la variable de session.
        $_SESSION['email'] = $email; // Attribution de l'email de la marque à la variable de session.
        $_SESSION['user_type'] = "marque"; // Attribution du type d'utilisateur à la variable de session.
        header('Location: ../dashboard_marque'); // Redirection vers la page de tableau de bord de la marque.
        exit(); // Arrêt du script.
    
    }
}
?>    
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>sign up influenceur</title>
    <link rel="stylesheet" href="signup.css">
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
    <h1>Formulaire d'inscription d'un marque</h1> <!-- Titre du formulaire d'inscription d'une marque -->
    <br><br><br><br>
    <center> <!-- Début de la balise centrale pour centrer le contenu -->
        <div id="formulaire">
            <form method="post" action="index.php" enctype="multipart/form-data"> <!-- Début du formulaire avec la méthode POST qui sera envoyé vers index.php et enctype pour gérer les fichiers multimédias -->
                <label for="categorie">Veuillez indiquer votre catégorie:</label> <!-- Étiquette pour le champ de sélection de catégorie -->
                <div class="custom-select"> <!-- Début de la classe personnalisée pour le champ de sélection -->
                    <select id="categorie" name="categorie"> <!-- Champ de sélection pour la catégorie avec un identifiant "categorie" et un nom "categorie" -->
                        <option value="">Choisissez une option</option> <!-- Option par défaut pour sélectionner une option -->
                        <option value="fitness">Fitness</option> <!-- Option "Fitness" -->
                        <option value="beauté">Beauté</option> <!-- Option "Beauté" -->
                        <option value="commerce">Commerce</option> <!-- Option "Commerce" -->
                        <option value="industrie">Industrie</option> <!-- Option "Industrie" -->
                        <option value="autre">Autre</option> <!-- Option "Autre" -->
                    </select>
                </div>
                <input type="text" name="Nom" placeholder="Nom" required> <!-- Champ de saisie de texte pour le nom avec une étiquette "Nom" et requis -->
                <input type="email" name="email" placeholder="E-mail" required> <!-- Champ de saisie de texte pour l'adresse e-mail avec une étiquette "E-mail" et requis -->
                <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png"> <!-- Champ de sélection de fichier pour la photo avec un identifiant "photo" et accepte les fichiers avec les extensions .jpg, .jpeg et .png -->
                <input type="password" name="password" placeholder="Mot de passe" required> <!-- Champ de saisie de mot de passe avec une étiquette "Mot de passe" et requis -->
                <input type="password" name="confpass" placeholder="Confirmer le mot de passe" required> <!-- Champ de saisie de confirmation de mot de passe avec une étiquette "Confirmer le mot de passe" et requis -->
                <input type="number" name="ca" placeholder="Chiffre d'affaire" required> <!-- Champ de saisie de nombre pour le chiffre d'affaires avec une étiquette "Chiffre d'affaire" et requis -->
                <input type="text" name="address" placeholder="adresse" required> <!-- Champ de saisie de texte pour l'adresse avec une étiquette "Adresse" et requis -->
                <button type="submit" name="submit" value="submit">Envoyer</button> <!-- Bouton de soumission du formulaire avec une étiquette "Envoyer" -->
                <span><button type="reset" class="button_2">Restaurer</button></span> <!-- Bouton de réinitialisation du formulaire avec une classe "button_2" -->
                <span><h4>Vous êtes déjà inscrit ?</h4></span> <!-- Message indicant que vous êtes déjà inscrit -->
                <span><a href="../login">Se connecter</a></span> <!-- Lien vers la page de connexion avec l'étiquette "Se connecter" et une URL "../login" -->
            </form>
        </div>
    </center> <!-- Fin de la balise centrale -->
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
</html> <!-- Fin du code HTML -->