<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../../../datosBrindo/iconosBrindo/iconoBrindo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Para los íconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Para la familia de la fuente -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Anton" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <!-- Para el css principal -->
    <link rel="stylesheet" href="../../cssBrindo/clientMenu.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Pepito tu pagina para conocer inmuebles alrededor del mundo" />
    <meta name="distribution" content="global" />
    <meta name="Keywords" content="pepito,arrandemiento,mundo,inmuebles,clientes,admin" />
    <meta name="Robots" content="all" />
    <meta name="author" content="Espinel Alejandro José" />
    <meta name="copyright" content="Espinel Alejandro José" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir productos</title>

    <?php 
    //SI LA SESIÓN NO ES VÁLIDA LO REDIRIGE AL INICIO
    include_once '../../scripts/clients/client_login_functions.php';
    isClientLoggedIn();
    ?>

    <script type="text/javascript" >
        
        function showCarrito() {  

                console.log("mostrando carrito");      
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("carrito").innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST","add_products.php",true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('list=true');
                
        }      

        function incrementarProducto(id_producto) {
                console.log("incrementando carrito");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "increment=true&productID="+id_producto+"";
            xhttp.send(params);
            
        }

        function decrementarProducto(id_producto) {
                console.log("decrementando carrito");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "decrement=true&productID="+id_producto+"";
            xhttp.send(params);
            
        }

        function borrarProducto(id_producto) {
                console.log("borrando del carrito");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "remove=true&productID="+id_producto+"";
            xhttp.send(params);
            
        }

        function borrarCarrito() {
                console.log("borrando TODO el carrito");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "removeAll=true";
            xhttp.send(params);
            
        }

        function addCarrito(id_producto) {
                console.log("añadiendo al carrito");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "add=true&productID="+id_producto+"";
            xhttp.send(params);
            
        }

        function ordenar() {
                console.log("SE HA ORDENADO");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                //showCarrito();
                facturar();
            };
            
            xhttp.open("POST","add_products.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "order=true";
            xhttp.send(params);
            
        }
        
        function facturar() {
                console.log("SE HA facturado");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                

            };
            
            xhttp.open("POST","orders.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "order=true";
            xhttp.send(params);           
        }
        function confirmarFactura(){
            console.log("SE HA facturado");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                

            };
            
            xhttp.open("POST","orders.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "confirmOrder=true";
            xhttp.send(params);
        }
        function cancelarFacturar(){
            console.log("SE HA facturado");        
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("carrito").innerHTML = this.responseText;
                }
                showCarrito()

            };
            
            xhttp.open("POST","orders.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "cancelOrder=true";
            xhttp.send(params);
           
        }
     

    </script>

</head>
<body onload="showCarrito()">
       
        <!-- MENÙ-->
        <div class="wrapper">
            <nav class="navbar navbar-expand-md navbar navbar-dark brindo-navbar">
                <a href="#" class="navbar-left "><img class="logo" src="https://image.flaticon.com/icons/png/512/723/723164.png"></a>
                <a class="navbar-brand" href="#">Brindo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                        <form action="" method="post"></form>
                            <a class="nav-link" href="logout.php">SALIR<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >
                            <?php
                            session_name('login');
                            session_start();


                            $lastTimeClient = $_SESSION['last_time_client'];

                            // Verificación del tiempo de inactividad del usuario mediante una sesion de usuario
                            // FORMATO  March 10, 2001, 5:16 pm
                            echo 'Último acceso '.date("F j, Y, g:i a", $lastTimeClient);
                            ?>
                            </a>
                        </li>

                </div>
            </nav>
        </div> 
    
    
<?php 
include_once '../../scripts/utils/formatters.php';
$enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");
if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;   
}
$sql_stmt_categoria = "SELECT * FROM categories"; 
    //SQL select query 
    
     $result_categoria = mysqli_query($enlace,$sql_stmt_categoria);
     //execute SQL statement 

	if (!$result_categoria)     
		die("Database access failed: " . mysqli_error()); 
    	//output error message if query execution failed 
        
		$rows_categoria = mysqli_num_rows($result_categoria); 
   		// get number of rows returned 
        if ($rows_categoria) {  

        echo '<div class="container">';
        echo '<div class="panel-group" id="accordion">';  

            while ($row_categoria = mysqli_fetch_array($result_categoria)) { 
                        
                //echo 'Categoria: ' . $row_categoria['category'] . ' ID: ' . $row_categoria['id_category'] . '<br>'; 
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">';
                echo '<h4 class="panel-title">';
                echo '<a data-toggle="collapse" data-parent="#accordion" href="#collapse' . $row_categoria['category'] . '"> ' . $row_categoria['category'] . '</a>';
                echo ' </h4>';
                echo '</div>';
                echo '<div id="collapse' . $row_categoria['category'] . '" class="panel-collapse collapse in">';
                echo ' <div class="panel-body">';
                $sql_stmt_producto = "SELECT * FROM products WHERE id_category = {$row_categoria['id_category']} ";                             
                $result_productos = mysqli_query($enlace,$sql_stmt_producto);
                if (!$result_productos)     		die("Database access failed: " . mysqli_error()); 
                $rows_productos = mysqli_num_rows($result_productos);                
                if ($rows_productos) {  
                    echo '<div class="row row-cols-1 row-cols-md-3" style="margin-right: 10%;margin-left: 10%;text-align:center;">';
                    while ($row_productos = mysqli_fetch_array($result_productos)) {        

                        //echo 'productos: ' . $row_productos['name'] . ' ID: ' . $row_productos['id_product'] . '<br>';         
                        
                                    
                        echo            '<div class="card" style="width: 18rem;margin:0px auto;">';
                        echo                '<img src="'. $row_productos['photo'].'" class="card-img-top" style="width: 18rem; height: 18rem;margin:0px auto;" alt="...">';
                        echo                '<div class="card-body">';
                        echo                    '<h5 class="card-title">'. $row_productos['name'].' </h5>';
                        echo                    '<p class="card-text">'. $row_productos['description'].'</p>';
                        
                        echo                    '<form action="javascript:void(0);">';
                        echo                    '<input type="hidden" name="productID" value="'. $row_productos['id_product'].'">';
                        echo                    '<input type="submit" name="add"  class="btn btn-primary" value="'. toPesos($row_productos['price']).'" onClick="addCarrito('. $row_productos['id_product'].')">';
                        echo                    '</form>';

                       // echo                    '<a href="" class="btn btn-primary">'. $row_productos['price'].'</a>';
                        echo                '</div>';
                        echo            '</div>';
            
                        
                    } 
                    echo '</div>';
                }
                echo '</div>'; 
                echo '</div>';
                echo '</div>';
                
            } 
        } 
        echo '</div>';
        echo '</div> ';
    mysqli_close($enlace); //close the database connection 
    
?>

    
    
<!-- En el div CARRITO se irán añadiendo los productos -->
    <div id="carrito" class="table-responsive" style="align-text:center">    
    </div>
    <!-- <button type="button" onclick="showCarrito()">Mostrar productos</button>   -->
    <div  class="card" style="width:30%; margin-left:37%" > 
    <button type="button" class="btn btn-primary"  onclick="borrarCarrito()">borrar carrito</button>
    <button type="button" class="btn btn-primary"  onclick="ordenar()">ordenar</button>
    </div>
    <footer>
        <div class="container">
            <div class="row">
             
                <div class="col-sm">
                    Espinel Alejandro José
                    <a href="https://www.github.com/espinel10" class="nav-link" target="_blank"><i
                            class="fa fa-github fa-lg"></i></a>
                </div>
            </div>
        </div>

    </footer>

</body>
</html>