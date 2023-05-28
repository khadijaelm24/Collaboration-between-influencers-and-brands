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
    echo "<alert>{$_FILES['photo']}</alert>";

    if (empty($age)) {
        $isSuccess = false;
    }

    if ($password !== $password_conf) {
        $isSuccess = false;
    }

    if ($isSuccess) {
        $tempFilePath = $_FILES['photo']['tmp_name'];
        $targetFileName = basename($_FILES['photo']['name']);
        $targetFilePath = __DIR__ . '/pdp/' . $targetFileName;

            $sql = "INSERT INTO influenceur (lname, fname, email, facebook, instagram, youtube, password, category_id) 
                    VALUES ($lname, $fname, $email, $facebook, $instagram, $youtube, $password, $category_id)";
            $conn->mysqli_query($sql);

            header('Location: http://localhost/dashboard');
        exit();
        }



}
?>
