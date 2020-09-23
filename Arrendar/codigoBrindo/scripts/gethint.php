
<?php
// Array with names


// get the q parameter from URL
$q = $_REQUEST["q"];


if (isset($q) && !empty($q)){
$enlace = mysqli_connect("localhost", "20201B103", "8FcDd67_Dg", "20201B103");
if (!$enlace) {
    echo "Error: No se pudo conectar al server." . PHP_EOL;
    exit;
}
$query = "SELECT * FROM `encuesta` WHERE (name='".$q."');";
$result = mysqli_query($enlace, $query);
if( $result->num_rows == 1){

  //while($row = mysqli_fetch_array($result)) {


  $row = $result->fetch_array(MYSQLI_BOTH);

  echo  $row['name'] ;
  echo "," ;
  echo $row['gender'];
  echo ",";
  echo $row['email'];
  echo  "," ;
  echo $row['phone'];
  echo ",";
  echo $row['learning'];
  echo ",";
  echo $row['tipo_uso'];
  echo ",";
  echo $row['pages'];
  echo ",";
  echo $row['hours'];
  echo ",";
  echo $row['menssage'];

 $result->free();
  //}
}

mysqli_close($enlace);
}






?>
