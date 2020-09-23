<?php 
include_once '../constants.php';

function isEmployeeLoggedIn(){
    session_name('login');
    session_start();
    
    $employeeSession = $_SESSION['employee'];
    $lastTimeEmployee = $_SESSION['last_time_employee'];

    date_default_timezone_set('america/bogota');    
    if (isset($employeeSession) && !empty($employeeSession) && (time() - $lastTimeEmployee) < (60 * 60))
    {
        // SI INICIÓ SESIÓN DE MANERA CORRECTA
        //PRIMERO ACTUALIZAMOS EL TIEMPO DE EXPIRACIÓN
        $_SESSION['last_time_employee'] = time();                    
    }else{
        header('location:../../../index.php');
    }
    
}

function logoutEmployee(){
    session_name('login');
    session_start();

    //cierra sesión
    session_destroy();
    session_unset();

    unset($_SESSION['employee']);
    unset($_SESSION['last_time_employee']);

        header('location:../../../index.php');    
}
?>
