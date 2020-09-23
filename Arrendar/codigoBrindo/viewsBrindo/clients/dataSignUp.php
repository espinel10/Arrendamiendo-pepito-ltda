<?php 

$enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$cc = $_POST['CC'];
$email = $_POST['email'];
$password =  password_hash($_POST['password'],PASSWORD_DEFAULT);
$phone = $_POST['phone'];
$date = CalculaEdad( $_POST['date'] );
$address = $_POST['address'];

function CalculaEdad( $date ) {
    list($Y,$m,$d) = explode("-",$date);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

$query = "INSERT INTO `clients` (`first_name`, `last_name`, `CC`, `email`,`password`, `phone`,`age`,`address`) 
VALUES ('".$first_name."', '".$last_name."', '".$cc."', '".$email."', '".$password."', '".$phone."', '".$date."', '".$address."');";

$resultado = mysqli_query($enlace, $query) or die('Consulta no válida: ' . mysqli_error($enlace));
echo $query;
echo ('	cliente creado!!');

mysqli_close($enlace);

?>