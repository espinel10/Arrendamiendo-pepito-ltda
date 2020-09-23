<?php

//ESTE ARCHIVO TIENE LA FUNCIÒN PARA VERIFICAR SI ESTÁ AUTENTICADO Y PARA EL LOGOUT


function isClientLoggedIn(){

    session_name('login');
    session_start();

    $clientSession = $_SESSION['client'];
    $lastTimeClient = $_SESSION['last_time_client'];

    date_default_timezone_set('america/bogota');
    if (isset($clientSession) && !empty($clientSession) && (time() - $lastTimeClient) < (60 * 60))
    {
        // SI INICIÓ SESIÓN DE MANERA CORRECTA
        //PRIMERO ACTUALIZAMOS EL TIEMPO DE EXPIRACIÓN
        $_SESSION['last_time_client'] = time();
    }else{
        header('location:../../../index.php');
    }

}

function logoutClient(){
    session_name('login');
    session_start();

    //cierra sesión
    session_destroy();
    session_unset();

    unset($_SESSION['client']);
    unset($_SESSION['last_time_client']);

        header('location:../../../index.php');
}
?>
