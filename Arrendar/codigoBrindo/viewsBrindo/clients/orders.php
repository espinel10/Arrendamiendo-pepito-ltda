<?php 
    //SI LA SESIÓN NO ES VÁLIDA LO REDIRIGE AL INICIO
    include_once '../../scripts/clients/client_login_functions.php';
    isClientLoggedIn();    
?>


<?php
// MUESTRA UNA TABLA CON LOS PEDIDOS SI EXISTEN PARA CONFIRMAR

include_once '../../scripts/clients/queries_clients.php';
    listOrders();
    
    if ($_POST['order']){
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo    ' <meta charset="UTF-8">';
        echo    ' <meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo     '<title>Tu pedido</title>';
        echo '</head>';
        echo '<body >';
        echo '<form action="javascript:void(0);" method="post">';
        echo '<div class="card" style="width: 30%;margin:0px auto;">';
        echo '    <button type="submit" class="btn btn-primary"  name="confirmOrder" value="Confirmar pedido" onclick="confirmarFactura()">Confirmar pedido</button>';
        echo '    <button type="submit" class="btn btn-primary"  name="cancelOrder" value="Cancelar" onclick="cancelarFacturar()">Cancelar</button><br>';
        echo '</div >';    
        echo     '</form>';
        echo '</body>';
        echo '</html>';
    }

include_once '../../scripts/clients/queries_clients.php'; 
$orderID = $_COOKIE['currentOrder'];

if ($_POST['confirmOrder']){
    $statusOrder = confirmOrder($orderID);
    echo $statusOrder ? '<script>alert("Tu pedido ha sido realizado de manera exitosa")</script>' : 'Error, intenta de nuevo';    
    echo '<div class="alert alert-success" role="alert" style="text-align:center">
            Pedido realizado ! Esperamos que lo disfrutes :D
          </div>';
}

if ($_POST['cancelOrder']){
    
    $statusOrder = deleteOrder($orderID);
    echo $statusOrder ? '<script>alert("Tu pedido ha sido realizado de manera exitosa")</script>' : 'Error, intenta de nuevo';

}
?>