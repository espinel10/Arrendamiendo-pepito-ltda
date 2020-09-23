<?php
$enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

//SCRIPT PARA FORMATEAR LA BASE DE DATOS E INSERTAR MANUALMENTE, 


$queryDropOrders =  'DROP TABLE IF EXISTS orders;';
$resultado = mysqli_query($enlace, $queryDropOrders);

if (!$resultado) {
    die('Error borrando los pedidos');
}

$queryDropClients =  'DROP TABLE IF EXISTS clients;';
$resultado = mysqli_query($enlace, $queryDropClients);

if (!$resultado) {
    die('La tablas no existen, por favor agregalos');

}


$queryDropEmployees =  'DROP TABLE IF EXISTS employees;';
$resultado = mysqli_query($enlace, $queryDropEmployees);

if (!$resultado) {
    die('Error borrando empleados');
}

$queryDropProducts =  'DROP TABLE IF EXISTS products;';
$resultado = mysqli_query($enlace, $queryDropProducts);

if (!$resultado) {
    die('Error borrando productos');
}

$queryDropCategories =  'DROP TABLE IF EXISTS categories;';
$resultado = mysqli_query($enlace, $queryDropCategories);

if (!$resultado) {
    die('Error borrando las tablas cat');
}


$queryDropOrdersProducts =  'DROP TABLE IF EXISTS orders_products;';
$resultado = mysqli_query($enlace, $queryDropOrdersProducts);

if (!$resultado) {
    die('Error borrando las orders_products');
}


//SE CREA LA BASE DE DATOS, HAY QUE EJECUTARLO UNA VEZ

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS categories(
    id_category INT(3) NOT NULL AUTO_INCREMENT,
    category CHARACTER varying(40) NOT NULL,
    description CHARACTER varying(200),
    photo CHARACTER varying(200) NOT NULL,
    CONSTRAINT id_categories_pk PRIMARY KEY (id_category)
  );');
if (!$resultado) {
    die('Error, creando categorías');
}

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS clients(
    id_client INT(11) NOT NULL AUTO_INCREMENT,
    first_name CHARACTER varying(40) NOT NULL,
    last_name CHARACTER varying(40) NOT NULL,
    CC INT(11) UNSIGNED  NOT NULL UNIQUE,
    email CHARACTER varying(40) NOT NULL,
    password CHARACTER varying(255) NOT NULL,
    phone CHARACTER varying(20) NOT NULL UNIQUE,
    age INT(2),
    photo CHARACTER varying(200),
    address CHARACTER varying(255),
    CONSTRAINT id_clients_pk PRIMARY KEY (id_client)
  );');

if (!$resultado) {
    die('Error, creando clientes');
}

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS employees(
    id_employee INT(11) NOT NULL AUTO_INCREMENT,
    first_name CHARACTER varying(40) NOT NULL,
    last_name CHARACTER varying(40) NOT NULL,
    CC INT(11) UNSIGNED  NOT NULL UNIQUE,
    password CHARACTER varying(255) NOT NULL,
    phone CHARACTER varying(20) NOT NULL UNIQUE,
    age INT(2),
    photo CHARACTER varying(200),
    address CHARACTER varying(255),
    CONSTRAINT id_employees_pk PRIMARY KEY (id_employee)
  );');
if (!$resultado) {
    die('Error, creando empleados');
}

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS products(
    id_product INT(11) NOT NULL AUTO_INCREMENT,
    name CHARACTER varying(40) NOT NULL,
    description CHARACTER varying(200),
    price INT UNSIGNED NOT NULL,
    score DOUBLE UNSIGNED,
    votters DOUBLE UNSIGNED,
    photo CHARACTER varying(200) NOT NULL,
    id_category INT(11),
    CONSTRAINT id_products_pk PRIMARY KEY (id_product),
    CONSTRAINT id_categories_products_fk
    FOREIGN  KEY (id_category) REFERENCES categories(id_category)
  );');
if (!$resultado) {
    die('Error, creando productos');
}

///////alejandro modifico esto

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS encuesta(
  id_encuesta INT(11) NOT NULL AUTO_INCREMENT,
  name CHARACTER varying(40) NOT NULL,
  gender CHARACTER varying(40) NOT NULL,
  email CHARACTER varying(40) NOT NULL,
  phone  CHARACTER varying(20) NOT NULL UNIQUE,
  learning  CHARACTER varying(40) NOT NULL,
  tipo_uso CHARACTER varying(40) NOT NULL,
  pages CHARACTER varying(40) NOT NULL,
  hours int(12),
  menssage CHARACTER varying(100) NOT NULL,
  CONSTRAINT id_encuesta_pk PRIMARY KEY (id_encuesta)
  );');
if (!$resultado) {
    die('Error, Insertando encuesta');
}
///////////////////////////////




$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS orders(
    id_order INT(11) NOT NULL AUTO_INCREMENT,  
    order_date DATETIME NOT NULL,
    statusOrder VARCHAR(10) NOT NULL,
    id_client INT(11) NOT NULL,  
    CHECK (statusOrder = "COMPLETED" OR statusOrder = "ABORTED" OR statusOrder = "WAITING" ),
    CONSTRAINT id_orders_pk PRIMARY KEY (id_order),
    CONSTRAINT id_clients_orders_fk 
    FOREIGN  KEY (id_client) REFERENCES clients(id_client)
  );');
if (!$resultado) {
    die('Error, creando pedidos con check');
}

$resultado = mysqli_query($enlace, 'CREATE TABLE IF NOT EXISTS orders_products(
    id_order INT(11) NOT NULL,  
    id_product INT(11) NOT NULL,  
    quantity INT NOT NULL,
    CONSTRAINT id_orders_pk PRIMARY KEY (id_order, id_product)
  );');
if (!$resultado) {
    die('Error, creando pedidos');
}


// INSERTAR VALORES DE PRUEBA 


//INSERTA LAS CATEGORÍAS
$queryCategories =  'INSERT INTO categories 
(id_category, category, description, photo) VALUES
(1, "Hamburguesas", "Las mejores hamburguesas de Bucaramanga", "https://recipes-secure-graphics.grocerywebsite.com/0_GraphicsRecipes/4589_4k.jpg"), 
(2, "Bebidas", "Productos postobon y jugos naturales", "https://i.ytimg.com/vi/pTdlujTWpB4/maxresdefault.jpg"), 
(3, "Acompañantes", NULL, "https://img-global.cpcdn.com/recipes/c722ba336c392024/400x400cq70/photo.jpg"),
(4, "Carnes y más", NULL, "https://i.ytimg.com/vi/O3Xv3Mnk1Nk/hqdefault.jpg");';
$resultado = mysqli_query($enlace, $queryCategories);

if (!$resultado) {
    die('Error, insertando categorias, ANTES DEBES CREAR LAS TABLAS, create_table.php o los valores ya existen');

}


//INSERTA LOS CLIENTES
$queryClients =  'INSERT INTO clients 
(id_client, first_name, last_name, CC, email, password, phone, age, photo) 
VALUES
(10, "Felipe", "Cabeza", "1234567890", "felipecabezas98@gmail.com", "hola1234", "3204408369", 22, "https://avatars1.githubusercontent.com/u/39039427?s=400&u=2f8287f42df63ddfe276ef7628dc6cf8665ed759&v=4"), 
(20, "Laura", "Mantilla", "987654321", "lauramantilla@gmail.com", "hola1234", "3167053118", 21, "https://laverdadnoticias.com/__export/1588106073332/sites/laverdad/img/2020/04/28/mia_khalifa_preocupa_a_sus_fans.jpg_1902800913.jpg");';
$resultado = mysqli_query($enlace, $queryClients);

if (!$resultado) {
    die('Error, insertando clientes');
}


//INSERTA LOS EMPLEADOS
$queryEmployees =  'INSERT INTO employees 
(id_employee, first_name, last_name, CC, password, phone, age, photo) 
VALUES
(100, "Geyner", "Rojas", "1234512345", "hola4321", "3114413437", 21, "https://www.prensalibre.com/wp-content/uploads/2018/12/afa2268e-f4dc-411b-b150-1d850801b2a4.jpg?quality=82&w=760&h=430&crop=1");';
$resultado = mysqli_query($enlace, $queryEmployees);

if (!$resultado) {
    die('Error, insertando empleados');
}


//INSERTA LOS PRODUCTOS
$queryProducts =  'INSERT INTO products 
(id_product, name, description, price, score, votters, photo, id_category) 
VALUES
(1000, "Hamburguesa doble carne", "300g de carne, deliciosa hamburguesa con tomate, jamón, queso y cebolla", 20000, 4.2, 2, "https://www.west24horas.com/wp-content/uploads/2019/12/doble-carne.png", 1),
(2000, "Rock Burguer", "350g de carne, deliciosa hamburguesa con tomate, huevo frito jamón, queso y cebolla para repetir", 22000, 4.5, 6, "https://media-cdn.tripadvisor.com/media/photo-s/07/1d/ee/ce/rock-burger-milano.jpg", 1),
(3000, "Limonada hierbabuena", "Deliciosa limonada natural para mantenerte saludable", 7000, 4.1, 1, "https://img-global.cpcdn.com/recipes/9533711ac3f3d8c3/751x532cq70/limonada-de-hierbabuena-con-notas-de-jengibre-foto-principal.jpg", 2),
(4000, "Gaseosa Hipinto 350ml", "Gaseosa hipinto de 250ml o 350ml sabores kola y piña", 4000, 3.8, 4, "https://tomatelavida.com.co/wp-content/uploads/2018/06/pin%CC%83a-f_Mesa-de-trabajo-1-copia.jpg", 2),
(5000, "Papas locas", "Deliciosas papas locas para acompañar tus platos", 12000, 4.3, 5, "https://img-global.cpcdn.com/recipes/c722ba336c392024/400x400cq70/photo.jpg", 3),
(6000, "Papas a la francesa", "Deliciosas papas a la francesa para acompañar tus platos", 7000, 4.1, 10, "https://i.ytimg.com/vi/qpA5tTDtuG4/maxresdefault.jpg", 3),
(7000, "Carne a la plancha", "400 g de carne a la plancha a tu medida", 24000, 4.4, 6, "https://www.carniceriapedrorivas.com/img/cms/2960016764_9a13d8b1b3_b.jpg", 4),
(8000, "Pechuga gratinada", "200 g de pechuga gratinada acompañada de arepa, ensalada y papa criolla", 20000, 4.8, 13, "https://dondemanuel.co/wp-content/uploads/2018/01/pechuga-gratinada.jpg", 4);';
$resultado = mysqli_query($enlace, $queryProducts);

if (!$resultado) {
    die('Error, insertando productos');
}


//INSERTA LAS ÓRDENES
$queryOrders =  'INSERT INTO orders 
(id_order, id_client, statusOrder, order_date) VALUES
(1, 10, "COMPLETED", NOW()), 
(2, 20, "ABORTED", NOW());';
$resultado = mysqli_query($enlace, $queryOrders);

if (!$resultado) {
    die('Error, insertando pedidos');
}


$queryOrders =  'INSERT INTO orders_products 
(id_order, id_product, quantity) VALUES
(1, 1000, 2), 
(1, 3000, 3), 
(2, 5000, 1), 
(2, 6000, 2), 
(2, 7000, 3);';
$resultado = mysqli_query($enlace, $queryOrders);

if (!$resultado) {
    die('Error, insertando pedidos con productos');
}
echo('Base de datos formateada!!');
mysqli_close($enlace);

?>