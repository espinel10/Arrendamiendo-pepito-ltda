<?php 
include_once 'queries_clients.php';

//ESTE ARCHIVO TIENE LAS FUNCIONES DEL CARRITO (NECESARIO PARA EL FRONT)


//PARA AÑADIR UN PRODUCTO CON EL ID, NO LO AGREGA SI EL ID NO EXISTE, SI EXISTE Y 
//YA FUE CREADO SE ACTUALIZA CON LA CANTIDAD Y SI NO SE LE PASA CANTIDAD POR DEFECTO
//SU CANTIDAD ES 1
function addProduct($productID, $quantity){
    
    // SI NO TIENE CANTIDAD SE AÑADE 1 POR DEFECTO
    if ($quantity < 1){
        $quantity = 1;
    }
    if (!isset($productID)){
        die('No has proporcionado ID del producto');
    }
    //SI EL PRODUCTO NO EXISTE GENERAMOS UN ERROR
    didProductExist($productID); 
    //CREAR LA COOKIE CON CLAVE VALOR [idProducto] -> Cantidad
    setcookie("products[$productID]", $quantity, time() + 60 * 60 * 24);
    
    $productsCookie = $_COOKIE['products'];
}


//INCREMENTA LA CANTIDAD DEL PRODUCTO SI EXISTE

function incrementProductQuantity($productID){
    if (!isset($productID)){
        die('No has proporcionado ID del producto (increment)');
    }
    //SI EL PRODUCTO NO EXISTE GENERAMOS UN ERROR
    didProductExist($productID);

    //ARRAY ASOCIATIVO PARA LA COOKIE
    $productsCookie = $_COOKIE['products'];

    $quantity = $productsCookie[$productID] + 1;
    //Obtenemos el producto y la cantidad y aumentamos
     

    setcookie("products[$productID]", $quantity, time() + 60 * 60 * 24);
}

//DECREMENTA LA CANTIDAD DEL PRODUCTO SI EXISTE, VALOR MINIMO ES 1, NO VA A DECREMENTAR A CERO

function decrementProductQuantity($productID){
    if (!isset($productID)){
        die('No has proporcionado ID del producto (decrement)');
    }
    //SI EL PRODUCTO NO EXISTE GENERAMOS UN ERROR
    didProductExist($productID); 

    $productsCookie = $_COOKIE['products'];
    $quantity = $productsCookie[$productID];


    //Obtenemos el producto y la cantidad y aumentamos
    if ($quantity > 1){
        $quantity--;
        setcookie("products[$productID]", $quantity, time() + 60 * 60 * 24);
    }
}

//IMPRIME LOS PRODUCTOS [cantidad]x [nombre] > 1 ó [nombre]
//CONDICIONAL TERNARIO PARA IMPRIMIR VARIOS PRODUCTOS O UNO SÓLO            

function getProducts(){

    //ASSOC ARRAY FOR PRODUCT AND QUANTITY
    $productsCookie = $_COOKIE['products'];
    $cont_prod=0;
    while(list($productID, $quantity) = each($productsCookie)){
        $cont_prod++;
        $productName = getProductName($productID);         
        // Función para imprimir productos según cantidad
        include_once '../../scripts/utils/formatters.php';
        echo '<tr>';
        echo '<th scope="row">'.$cont_prod.' </th> ';
        echo '<td>';
        echo printProductsQuantity($productName, $quantity) ;
        echo '</td>';
        echo '<td style="display: inline;">';

        echo '<div class="btn-group">';

        echo '<form action="javascript:void(0);">';  
        echo '<input type="hidden" name="productID" value="'.$productID.'" >'; 
        echo '<button type="submit" class="btn btn-default" onclick="incrementarProducto('.$productID.')" >   +  </button>';
        echo '</form>';     
        
        echo '<form action="javascript:void(0);">';  
        echo '<input type="hidden" name="productID" value="'.$productID.'" >'; 
        echo '<button type="submit" class="btn btn-default" onclick="decrementarProducto('.$productID.')" >   -  </button>';
        echo '</form>'; 

        echo '<form action="javascript:void(0);">';  
        echo '<input type="hidden" name="productID" value="'.$productID.'" >'; 
        echo '<button type="submit" class="btn btn-default" onclick="borrarProducto('.$productID.')" >Delete</button>';
        echo '</form>'; 

        echo '</div>';

        echo '</td>';
        echo '</tr>';
    }

}

// Se llama del formulario para mirar si hay productos
function checkNotNullProducts(){
    //ASSOC ARRAY FOR PRODUCT AND QUANTITY
    $productsCookie = $_COOKIE['products'];
    $counter = 0;
    while(list($productID, $quantity) = each($productsCookie)){
        $counter++;
    }
    if ($counter == 0 ){
        die('No tienes productos para ordernar');
    }
}

// ELIMINA UN PRODUCTO POR ID
function removeProduct($productID){
    if (!isset($productID)){
        die('No has proporcionado ID del producto');
    }
    //SI EL PRODUCTO NO EXISTE GENERAMOS UN ERROR
    didProductExist($productID);

    // PONEMOS TIEMPO NEGATIVO, ELIMAMOS LA COOKIE
    setcookie("products[$productID]", 0, time() - 60 * 60 * 24);
    }

// ELIMINA TODO
    function removeAll(){
        $productsCookie = $_COOKIE['products'];
        
        while(list($productID, $quantity) = each($productsCookie)){
            // PONEMOS TIEMPO NEGATIVO, ELIMAMOS LA COOKIE
            $productName = getProductName($productID);    
            setcookie("products[$productID]", 0, time() - 60 * 60 * 24);
        }
        }

?>