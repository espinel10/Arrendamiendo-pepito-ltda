<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';

$username = $_REQUEST["q"];

$largo=20;
$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$cadena_base .= '0123456789' ;
$cadena_base .= '!@#%^&*()_,./<>?;:[]{}\|=+';

$new_password = '';
$limite = strlen($cadena_base) - 1;
for ($i=0; $i < $largo; $i++){
$new_password .= $cadena_base[rand(0, $limite)];
}

$enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
if (!$enlace) {
    echo "Error: No se pudo conectar al server." . PHP_EOL;
    exit;
}

$query = "SELECT * FROM `clients` WHERE (email='".$username."');";
$result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));
////////////////////uso del phpmailer//////////////////
if( $result->num_rows == 1){
$query= "UPDATE `clients` SET password='".$new_password."' WHERE (email='".$username."');";
$result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));

$mail= new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug=0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth=true;
$mail->Username="restaurantebrindo@gmail.com";
$mail->Password="asdfbasjfbasdjkfnlk.65415615";
$mail->setFrom('restaurantebrindo@gmail.com','Pepito Ltda tu mejor opcion para arrendar alrededor del mundo');
$mail->addAddress($username,'Usuario de brindo');
$mail->Subject='RESTABLECIMIENTO DE CLAVE';
$mail->Body="DEBIDO A LOS INCONVENIENTES LE INFORMAMOS QUE LA CLAVE NUEVA ES :  ".$new_password;

if (!$mail->send()){
echo "Error en el correo" .$mail->ErrorInfo;
}else{
echo "Exitoso revise el correo";
}
/////////////////////////////////////////////////////////
}else{

echo "Error no existe ese correo";
}

mysqli_close($enlace);


?>
