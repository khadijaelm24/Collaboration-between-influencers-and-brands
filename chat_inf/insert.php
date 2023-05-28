<?php

$db_server="localhost:3308";
$db_user="root";
$db_pass="";
$db_name="projet";
$conn="";
$conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
if($conn){}
else{echo "connection error!";}

    $isSuccess=true;
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $ca = $_REQUEST['ca'];
    $pass = $_REQUEST['pass'];
    $confpass = $_REQUEST['confpass'];
    $adress =  $_REQUEST['adress'];
    $category_id = $_REQUEST['category_id'];



    if( $conn) {
        $sql = "
        INSERT INTO marque(name, email, ca,password , address , category_id) VALUES ('$name','$email',$ca,'$pass', '$adress', 2)
        ";
        if (mysqli_query($conn,$sql))
            {

                    echo "Database created successfully";

            }
         else {
            echo "Error creating database: " . $conn->error;
        }
        mysqli_close($conn);

}
    ?>