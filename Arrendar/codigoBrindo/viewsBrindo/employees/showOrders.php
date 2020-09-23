<!DOCTYPE html>

<head>



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../cssBrindo/formularioCliente.css">

    <link rel="icon" href="https://image.flaticon.com/icons/png/512/723/723164.png">
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
    <meta name="Description" content="Pepito tu pagina para conocer inmuebles alrededor del mundo" />
    <meta name="distribution" content="global" />
    <meta name="Keywords" content="pepito,arrandemiento,mundo,inmuebles,clientes,admin" />
    <meta name="Robots" content="all" />
    <meta name="author" content="Espinel Alejandro José" />
    <meta name="copyright" content="Espinel Alejandro José" />
    <title>Pepito</title>

    <style>
        table {
            border-collapse: collapse;
            width: 70%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>


    <!-- MENÙ-->
    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar navbar-dark brindo-navbar">
            <a href="../../../" class="navbar-left "><img class="logo" src="https://image.flaticon.com/icons/png/512/723/723164.png"></a>
            <a class="navbar-brand" href="../../../">Pepito</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="homeEmployeeBrindo.php">Mostrar Citas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addProduct.php">Agregar y Eliminar Inmuebles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="showOrders.php">Mostrar Inmuebles</a>
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
    include_once '../../scripts/employees/employee_login_functions.php';
    isEmployeeLoggedIn();
    ?>

    <h2 style="margin-left:50%">Citas de arrendamiento</h2>

    <?php
    //MUESTRA ORDENES
    $inc = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");
    if ($inc) {
        $queryOrders =
            "SELECT orders_products.id_order, orders_products.id_product, orders_products.quantity, products.price, products.name, orders.id_client, orders.statusOrder
            FROM `orders_products` INNER JOIN products ON orders_products.id_product = products.id_product INNER JOIN orders ON orders_products.id_order = orders.id_order;";
        $resultado = mysqli_query($inc, $queryOrders);


        if ($resultado) {
    ?>
            <div>
                <table style="width:500; border:1; bordercolor: #5F5F5F; bgcolor: #F68D2E; margin-left:20%">
                    <th><b>Numero de orden </b><br></th>
                    <th><b>Numero de pedido </b><br></th>
                    <th><b>Cantidad </b> <br></th>
                    <th><b>Precio</b> <br></th>
                    <th><b>Nombre</b> <br></th>
                    <th><b>Estado</b> <br></th>
                    <th><b>Cliente</b> <br></th>
                    <?php

                    while ($row = $resultado->fetch_array()) {
                        $ido = $row['id_order'];
                        $id = $row['id_product'];
                        $cantidad = $row['quantity'];
                        $precio = $row['price'];
                        $nombre = $row['name'];
                        $estado = $row['statusOrder'];
                        $cliente = $row['id_client'];

                    ?>
                        <tr>
                            <th><?php echo $ido ?><br></th>
                            <th><?php echo $id ?><br></th>
                            <th><?php echo $cantidad ?><br></th>
                            <th><?php echo $precio ?><br></th>
                            <th><?php echo $nombre ?><br></th>
                            <th><?php echo $estado ?><br></th>
                            <th><?php echo $cliente ?><br></th>


                        </tr>
                    <?php
                    } ?>
                </table>
            </div> <?php

                } else {
                    echo "no sirve";
                }
            }    ?>



    <div>
        <?php
       $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","20201B103");
        if (!$enlace) {
            echo "Error en la conexion con el servidor";
        }
        ?>
        <form action="#" method="post">
            <input type="number" id="user" name="id" placeholder="Ingrese el id de la orden">
            <!-- <input type="text"  id="user" name="status" placeholder="Ingrese nuevo estado"> -->
            
            <select name="status" placeholder="Ingrese nuevo estado">
                        <option disabled selected>Selecciona un estado</option>
                        <option value="COMPLETED" selected>Entregado</option>    
                        <option value="WAITING">En espera</option>
                        <option value="ABORTED">Cancelar</option>
            </select>

            <input type="submit" name="modificar" class="btn btn-success " value="Modificar">
        </form>

        <?php

        $enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","20201B103");

        if (!$enlace) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }


        //PONEMOS PRIMERO CANCELADO PORQUE AÚN NO HA CONFIRMADO EL PEDIDO

        if (isset($_POST['modificar'])) {
            $orderID = $_POST["id"];
            $status = $_POST["status"];


            $queryOrders = ("UPDATE orders SET statusOrder='$status' WHERE id_order= '$orderID'");
            $result = mysqli_query($enlace, $queryOrders);


            mysqli_close($enlace);
        }










        ?>
    </div>


    <!-- DISEÑO A 3 COLUMNAS -->

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