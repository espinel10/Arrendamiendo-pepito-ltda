<?php 

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && !empty($username) && isset($password) && !empty($password))
{
    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");

    if (!$enlace) {
        echo "Error: No se pudo conectar al server." . PHP_EOL;
        exit;
    }
 
    $query = "SELECT * FROM `employees` WHERE (id_employee='".$username."');";    
    $result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));

    if( $result->num_rows == 1) 
    {
        $currentUser = $result->fetch_assoc();
        echo password_verify($password, $currentUser['password']);
        if(password_verify($password, $currentUser['password']) || $password == $currentUser['password']){
        //INICIO DE SESIÓN EXITOSO
        //CREAMOS LA SESIÓN PARA EL EMPLEADO
        session_name('login');
        session_start();

        date_default_timezone_set('america/bogota');    
        $_SESSION['employee'] = $currentUser['id_employee'];
        $_SESSION['last_time_employee'] = time();        
 
        mysqli_close($enlace);
        header('location:../../../index.php');
        }
        else{ 
        $_GET['error'] = true;
        header('location:../../viewsBrindo/employees/employeeLoginBrindo.php?error=true&password=' .  $currentUser['password']);
        }
    }else{            
    $_GET['error'] = true;
    header('location:../../viewsBrindo/employees/employeeLoginBrindo.php?error=true&message=asdasd');

    }

}else{
    $_GET['error'] = true;
    header('location:../../viewsBrindo/employees/employeeLoginBrindo.php?error=true');
    mysqli_close($enlace);
    exit;
}


?>