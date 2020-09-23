<?php

$username = $_POST['username'];
$gender = $_POST['gender'];
$email =$_POST['email'];
$phone =$_POST['phone'];
$education =$_POST['education'];
$type_use=$_POST['type_use'];
$pages=$_POST['pages'];
$hours=$_POST['hours'];
$message=$_POST['message'];

if (isset($username) && !empty($username) && isset($gender) && !empty($gender)
 && isset($email) && !empty($email) && isset($phone) && !empty($phone)
 && isset($education) && !empty($education) && isset($type_use) && !empty($type_use)
 && isset($pages) && !empty($pages) && isset($hours) && !empty($hours) && isset($message) && !empty($message)
)
{
    $enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");

    if (!$enlace) {
        echo "Error: No se pudo conectar al server." . PHP_EOL;
        exit;
    }
    $query = "SELECT * FROM `encuesta` WHERE (name='".$username."');";
    $result = mysqli_query($enlace, $query);
    if( $result->num_rows == 0){
      $query= "INSERT INTO `encuesta`(name,gender,email,phone,learning,tipo_uso,pages,hours,menssage) VALUES ('".$username."','".$gender."','".$email."','".$phone."','".$education."','".$type_use."','".$pages."','".$hours."','".$message."');";
      $result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));
    //}else{

    }else{
    $query= "UPDATE `encuesta` SET gender='".$gender."',email='".$email."',phone='".$phone."',learning='".$education."',tipo_uso='".$type_use."',pages='".$pages."',hours='".$hours."',menssage='".$message."' WHERE (name='".$username."');";
    $result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));

    }

  mysqli_close($enlace);
  header('location:../../index.php');


}else{
    echo "Valores incorrectos";
    mysqli_close($enlace);
    exit;
}

?>
