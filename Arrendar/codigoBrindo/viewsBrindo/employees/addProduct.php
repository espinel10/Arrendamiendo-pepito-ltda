<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../cssBrindo/formularioCliente.css">

    <link rel="icon" href="../../../datosBrindo/iconosBrindo/iconoBrindo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Para los íconos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Para la familia de la fuente -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Anton" />
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <!-- Para el css principal -->
    <link rel="stylesheet" href="../../cssBrindo/loginFormBrindo.css">
    <link rel="stylesheet" href="../../cssBrindo/plantillaBrindo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Brindo, la página para hacer los pedidos en tu restaurante" />
    <meta name="distribution" content="global" />
    <meta name="Keywords" content="Brindo,Pedidos,Restaurante,Domicilios" />
    <meta name="Robots" content="all" />
    <meta name="author" content="Andrés Felipe Cabeza, Geyner Rojas" />
    <meta name="copyright" content="Andrés Felipe Cabeza" />
    <title>Agregar productos</title>

</head>

<body>


    <!-- MENÙ-->
    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar navbar-dark brindo-navbar">
            <a href="../../../" class="navbar-left "><img class="logo" src="../../../datosBrindo/iconosBrindo/iconoAltBrindo.png"></a>
            <a class="navbar-brand" href="../../../">Brindo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
    
                    <li class="nav-item">
                        <a class="nav-link" href="homeEmployeeBrindo.php">Mostrar Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addProduct.php">Agregar y Eliminar Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showOrders.php">Mostrar pedidos</a>
                    </li>
                </ul>
                <!-- NAV BAR ALINEADO A LA DERECHA -->


                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../employees/employeeLoginBrindo.php">Salir</a>
                    </li>
                </ul>
                </ul>
            </div>
        </nav>
    </div>


    <?php
    $enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");
    if (!$enlace) {
        echo "Error en la conexion con el servidor";
    }
    ?>

    <?php
    include_once '../../scripts/employees/employee_login_functions.php';
    isEmployeeLoggedIn();
    ?>

<!--AGREGA PRODUCTOS -->


	<div class="contenedor">
    
    <h2 class="tittle" style="margin-left:30%">Agregar producto</h2>
		<form action="#" class="formulario" id="formulario" name="formulario" method="POST">
			<div class="contenedor-inputs" style="margin-left:30%">
                <input type="number" name="id" placeholder="Id-producto"><br>
                <input type="text" name="name" placeholder="Nombre"><br>
                <input type="text" name="description" placeholder="Descripción"><br>
                <input type="number" step=0.01 name="price" placeholder="Precio"><br>
                <input type="text" name="photo" placeholder="Link-foto"><br>
                <input type="number" name="id_cat" placeholder="Categoria"><br>

			</div>

			<input type="submit" class="btn btn-success "  style="margin-left:40%" name="registrarse" value="Agregar">
		</form>
    </div>




<?php 
//REGISTRA LOS DATOS EN LA BASE 
    if(isset($_POST['registrarse'])){
        $id = $_POST["id"];
        $nombre = $_POST["name"];
        $descripcion = $_POST["description"];
        $precio = $_POST["price"];
        $foto = $_POST["photo"];
        $cate = $_POST["id_cat"];

        $insertarDatos = "INSERT INTO products VALUES('$id','$nombre','$descripcion','$precio','','','$foto','$cate')";
        
        $ejecutarInsertar = mysqli_query($enlace,$insertarDatos);
        if(!$ejecutarInsertar){
            echo"Error en la línea de sql";
        }


    }

?>


<!--ELIMINA PRODUCTOS -->


<div class="contenedor" style="margin-left:30%"> 
    
    <h2 class="tittle">Eliminar producto</h2>
		<form action="#" class="formulario" id="formulario" name="formulario" method="POST">
			<div class="contenedor-inputs">
                <input type="number" name="id" placeholder="Id-producto"><br>
			</div>
			<input type="submit" class="btn btn-success "  name="eliminar" value="Eliminar">
		</form>
    </div>
<?php

if (isset($_POST['eliminar'])){
    $id_product = $_POST["id"];
    
    $queryOrders =("DELETE FROM products  WHERE id_product='$id_product'");
    $result = mysqli_query($enlace, $queryOrders);
   

    mysqli_close($enlace);

}?>


    
    <!-- Jquery para las animaciones de la página -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    Cabeza Serrano Andres Felipe
                    <a href="https:www.github.com/felipecabeza16" class="nav-link" target="_blank"><i class="fa fa-github fa-lg"></i></a>
                </div>
                <div class="col-sm">
                    Rojas Torres Geyner Felipe
                    <a href="https:www.instagram.com/geynerrt" class="nav-link" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
                <div class="col-sm">
                    Jaimes Teheran Jorge Alfredo
                    <a href="https:www.github.com/jhosgun" class="nav-link" target="_blank"><i class="fa fa-github fa-lg"></i></a>
                </div>
                <div class="col-sm">
                    Espinel Alejandro José
                    <a href="https:www.github.com/espinel10" class="nav-link" target="_blank"><i class="fa fa-github fa-lg"></i></a>
                </div>
            </div>
        </div>

    </footer>

</body>

</html>
</body>

</html>
