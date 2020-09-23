<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir productos</title>
</head>
<body>-->
    <?php 
    include_once '../../scripts/clients/client_login_functions.php';
    isClientLoggedIn();
    ?>
    <!--
    <form action="<?php// echo $_SERVER['PHP_SELF']?>" method="post">
    <label for="">Producto ID</label>
    <input type="text" name="productID">
    <label for="">Cantidad</label>
    <input type="text" name="quantity"><br>
    <input type="submit" name="list" value="Mostrar productos"><br>
    <input type="submit" name="add" value="Crear"><br>
    <input type="submit" name="increment" value="Incrementar"><br>
    <input type="submit" name="decrement" value="Decrementar"><br>
    <input type="submit" name="remove" value="Borrar"><br>
    <input type="submit" name="removeAll" value="Borrar todo"><br>
    <input type="submit" name="order" value="Ordenar" style="font-weight:bold"><br>
    </form>
    <a href="orders.php">Ver mis pedidos</a>
    <button type="button"  onclick="addProduct('1000', '1');" value="Crear"></button> <br>
     -->
<?php 
include_once '../../scripts/clients/add_product_to_cart.php';
$productID = $_POST['productID'];
$quantity = $_POST['quantity'];
echo "<br>";
echo "<br>";


if ($_POST['list']){

    echo '<table class="table" style="text-align: center"> ';
    echo '<caption>Carrito</caption> ';
    echo '    <thead> ';
    echo '        <tr> ';
    echo '        <th scope="col">#</th> ';
    echo '        <th scope="col">Producto</th> ';
    echo '        <th scope="col">Botones</th> ';
    echo '        </tr> ';
    echo '    </thead> ';
    echo '    <tbody> ';
    getProducts();
    echo '</tbody>';
    echo '</table>';    
 
}


if ($_POST['order']){
    //RECUPERAMOS EL ID DEL CLIENTE DE LA SESIÓN
    $clientID = $_SESSION['client'];
    print_r ($clientID);
    checkNotNullProducts();
    $orderStatus = viewOrder($clientID);    
    if($orderStatus){
    // LIMPIA EL CARRITO SI LA ORDEN FUE CORRECTA
    removeAll();
    echo "ORDEN CORRECTA!!";
    }else{
    echo "Algo salió mal con tu orden, intenta de nuevo :(";
    }

}

if ($_POST['add']){
    
    addProduct($productID, $quantity);
    getProducts();    

}

if ($_POST['increment']){

    incrementProductQuantity($productID);
    getProducts();    


}

if ($_POST['decrement']){

    decrementProductQuantity($productID);
    getProducts();    
}


if ($_POST['remove']){

    removeProduct($productID);
    getProducts();    
}

if ($_POST['removeAll']){

    removeAll();
    getProducts();    
}

?>
<!--
</body>
</html>
-->