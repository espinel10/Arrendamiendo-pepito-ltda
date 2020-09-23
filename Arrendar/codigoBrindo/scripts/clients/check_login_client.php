<?php 

//ESTE ARCHIVO ES PARA VERIFICAR CREDENCIALES (USUARIO Y CONTRASEÑA)

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($username) && !empty($username) && isset($password) && !empty($password))
{
    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");

    if (!$enlace) {
        echo "Error: No se pudo conectar al server." . PHP_EOL;
        exit;
    }


    $query = "SELECT * FROM `clients` WHERE (email='".$username."' );";    
    $result = mysqli_query($enlace, $query) or die('Error iniciando sesión: ' . mysqli_error($enlace));
    if( $result->num_rows == 1) 
    {
        $currentUser = $result->fetch_assoc();
        if(password_verify($password, $currentUser['password']) || $password == $currentUser['password']) {
        //INICIO DE SESIÓN EXITOSO
        session_name('login');
        session_start();

        date_default_timezone_set('america/bogota');    
        $_SESSION['client'] = $currentUser['id_client'];
        $_SESSION['last_time_client'] = time();    

        mysqli_close($enlace);
        header('location:../../../index.php');
        }
        else{
        $_GET['error'] = true;
        header('location:../../viewsBrindo/clients/clientLoginBrindo.php?error=true');            
        }
    }else{
    $_GET['error'] = true;
    header('location:../../viewsBrindo/clients/clientLoginBrindo.php?error=true');
    }
}else{
    $_GET['error'] = true;
    header('location:../../viewsBrindo/clients/clientLoginBrindo.php?error=true');
    mysqli_close($enlace);
    exit;
}

?>