<?php 


// ESTE ARCHIVO TIENE LAS FUNCIONES DE SQL PARA EL CARRITO Y LOS PEDIDOS

function getProductName($productID){

    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
    
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    
    $queryProductName = "SELECT name FROM `products` WHERE (id_product='".$productID."' );";    
    $result = mysqli_query($enlace, $queryProductName);
    
    if (!$result) {
        die('Error buscando los productos en la BD');
    }
    
    $productName = $result->fetch_assoc();
    mysqli_close($enlace);
    
    
    
    return $productName['name'];
    }


function didProductExist($productID){

    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
    
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    
    $queryProductName = "SELECT * FROM `products` WHERE (id_product='".$productID."' );";    
    $result = mysqli_query($enlace, $queryProductName);
    
    if (!$result) {
        die('Error buscando los productos en la BD');
    }
    
    $productName = $result->fetch_assoc();

    if( $result->num_rows != 1) 
    {
        die('Producto no existe');
    }
    mysqli_close($enlace);
        
    }

    function getClientById($clientID){
        $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
    
    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    
    $queryProductName = "SELECT * FROM `clients` WHERE (id_client='".$clientID."' );";    
    $result = mysqli_query($enlace, $queryProductName);
    mysqli_close($enlace);
    
    if (!$result) {

        die('Vuelve a intentar, hubo un error');
    }
    if( $result->num_rows != 1) 
    {
        header('location:../../../index.php');
    }
    //OBTENEMOS A UN CLIENTE EN UN ARRAY ASOCIATIVO CON SU ID
    else{
        $client = $result->fetch_assoc();
        return $client;
    }
     
}

    function viewOrder($clientID){
        $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
    
        if (!$enlace) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
         
        //PONEMOS PRIMERO CANCELADO PORQUE AÚN NO HA CONFIRMADO EL PEDIDO
        $queryOrders =  
        'INSERT INTO orders'. 
        '(id_client, statusOrder, order_date) VALUES '.
        '('.$clientID.','.'"ABORTED", NOW());';
        $result = mysqli_query($enlace, $queryOrders); 

        //CONSULTA CON ALIAS PARA EL ID ACTUAL
        $maxOrder =  
        'SELECT MAX(id_order) AS max_id FROM orders;';
        $result = mysqli_query($enlace, $maxOrder); 


        $currentOrder = $result->fetch_assoc();

        //OBTENEMOS EL PEDIDO ACTUAL 
        $orderID = $currentOrder['max_id'];
        //CREAMOS UNA COOKIE PARA EL ID DEL PEDIDO
        setcookie("currentOrder", $orderID, time() + 60 * 60 * 24);

        //CREAMOS UN PEDIDO, AHORA NECESITAMOS LISTAR LOS PRODUCTOS EN EL PEDIDO
        $productsCookie = $_COOKIE['products'];
        while(list($productID, $quantity) = each($productsCookie)){
            
            $queryOrdersProducts =  
            "INSERT INTO orders_products". 
            "(id_order, id_product, quantity) VALUES ".
            "( '".$orderID."', '".$productID."',  '".$quantity."');";
            $result = mysqli_query($enlace, $queryOrdersProducts); 
        }
        if (!$result) {
            die('Error, realizando la orden');
                mysqli_close($enlace);    
        }
        mysqli_close($enlace);    
        //CONSULTA EXITOSA 
        return true;
}


function deleteOrder($orderID){
    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");

    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
     
    //BORRAR EL PEDIDO DE LA TABLA orders Y DE LA m:n
    $queryOrders =  
    'DELETE FROM orders '. 
    'WHERE '.
    '(id_order = '.$orderID.');';
    $result = mysqli_query($enlace, $queryOrders); 
    
    $queryOrdersProducts =  
    'DELETE FROM orders_products '. 
    'WHERE '.
    '(id_order = '.$orderID.');';
    $result = mysqli_query($enlace, $queryOrdersProducts); 
    setcookie("currentOrder", 0, time() - 60 * 60 * 24);

    //CREAMOS UN PEDIDO, AHORA NECESITAMOS LISTAR LOS PRODUCTOS EN EL PEDIDO
    $productsCookie = $_COOKIE['products'];
    while(list($productID, $quantity) = each($productsCookie)){
        
        $queryOrdersProducts =  
        "INSERT INTO orders_products". 
        "(id_order, id_product, quantity) VALUES ".
        "( '".$orderID."', '".$productID."',  '".$quantity."');";
        $result = mysqli_query($enlace, $queryOrdersProducts); 
    }
    if (!$result) {
        die('Error, limpiando la orden');
            mysqli_close($enlace);    
    }
    mysqli_close($enlace);    
    //CONSULTA EXITOSA 
    return true;
}

function confirmOrder($orderID){
    $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");

    if (!$enlace) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
     
    //PONEMOS PRIMERO CANCELADO PORQUE AÚN NO HA CONFIRMADO EL PEDIDO
    $queryOrders =  
    'UPDATE orders set statusOrder="WAITING" '. 
    'WHERE'.
    '('.$orderID.' = id_order);';
    $result = mysqli_query($enlace, $queryOrders); 
    if ($result){ 
        setcookie("currentOrder", 0, time() - 60 * 60 * 24);
        return true;
    }else{
        die('Error confirmando tu orden, intenta de nuevo');
    }

    mysqli_close($enlace);    
}

function listOrders(){

$orderID = $_COOKIE['currentOrder'];
if (!isset($orderID) || $orderID < 1){
    die('No tienes pedidos actualmente');
}

$enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
    
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// SELECCIONAMOS EL NOMBRE Y EL PRECIO DE PRODUCTOS CON EL ID DEL PEDIDO
// SELECT orders_products.id_product, orders_products.quantity, 
// products.price, products.name FROM `orders_products` 
// INNER JOIN products ON orders_products.id_product = products.id_product 
// WHERE (id_order='29');

    $queryOrders = 
    "SELECT orders_products.id_product, orders_products.quantity, products.price, products.name 
    FROM `orders_products` INNER JOIN products ON orders_products.id_product = products.id_product 
    WHERE (id_order='".$orderID."' ) ORDER BY products.name DESC;";    

    $resultOrders = mysqli_query($enlace, $queryOrders);
    
    $numberOfProducts = $resultOrders->num_rows; 
    $products = $resultOrders->fetch_all();
    
    include_once 'orders/print_order.php';
    //FUNCION PARA IMPRIMIR LA TABLA
    renderTableOrders($orderID, $products, $numberOfProducts);


mysqli_close($enlace);


}



?>