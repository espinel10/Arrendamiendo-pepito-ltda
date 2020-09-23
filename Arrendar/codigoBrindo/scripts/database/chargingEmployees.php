<?php
// ESTE SCRIPT SE USA PARA CARGAR USUARIOS DESDE UN ".TXT"
$enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// El siguiente while, lee el archivo inser_empleados.txt
$file = fopen("inser_empleados.txt", "r");
while(!feof($file)) {

    $string =fgets($file). "<br />";// almacena la linea de caracteres
    $tok = strtok($string, " \n\t");// separa cada linea por "toks" que seria cada palabra entre espacios
    $contadorValores=0;
    while ($tok !== false) {
        $valor[$contadorValores]=$tok;// cada palabra la almacenamos en un array
        $tok = strtok(" \n\t");

        $contadorValores++;
    }
    $password=password_hash($valor[4],PASSWORD_DEFAULT);// encriptamos la contraseña
    
    //Hacemos el insert con el array almacenado.
    $query = "INSERT INTO `employees` (`id_employee`,`first_name`, `last_name`, `CC`, `password`, `phone`,`age`,`address`) 

    VALUES ( '".$valor[0]."','".$valor[1]."', '".$valor[2]."', '".$valor[3]."','". $password."', '".$valor[5]."', '".$valor[6]."', '".$valor[7]."');";

    //  imprimimos el insert    
    
    $resultado = mysqli_query($enlace, $query) or die('Consulta no válida: ' . mysqli_error($enlace));
}

fclose($file);





//INSERTA LAS CATEGORÍAS


echo('Empleados creados!!');
mysqli_close($enlace);

?>