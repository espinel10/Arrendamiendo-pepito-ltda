
<?php 


include_once '../../scripts/utils/formatters.php';
//COLUMNA 1 PEDIDO, COLUMNA 2 NOMBRE Y CANTIDAD, COLUMNA 3 SUBTOTAL

// $products -> YA TIENE CANTIDAD NOMBRE y PRECIO
function renderTableOrders($orderID, $products, $numberOfProducts){

    // [0] -> id_pedido
    // [1] -> cantidad
    // [2] -> precio
    // [3] -> nombre
    echo            '<div class="card" style="width: 30%;margin:0px auto; padding-bottom: 50px;">';
    echo "<table>
    <tr>
        <th>Detalles</th>
        <th>Total</th>
    </tr>";
    $total = 0;
    for ($i=0; $i<$numberOfProducts; $i++){
        
        $productName = $products[$i][3];
        $productQuantity = $products[$i][1];
        $productPrice = $products[$i][2];
        $total+= $productPrice * $productQuantity;
        echo "<tr>";
        echo "<td> " . printProductsQuantity($productName, $productQuantity) . "</td>";
        echo "<td>"  . toPesos($productPrice) . "</td>";
        echo "</tr>";
    }
    echo "<h1>Pedido $orderID : Total a pagar ".toPesos($total). "</h1>";
    echo "</table>";
    echo            '</div>';
}

?>

