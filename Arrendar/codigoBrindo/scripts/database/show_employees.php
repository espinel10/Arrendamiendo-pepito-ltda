
<?php 


$enlace = mysqli_connect("sql304.tonohost.com", "ottos_26809991", "pele1234","ottos_26809991_20201B103");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$result = mysqli_query($enlace, "SELECT * FROM employees");

echo "<table>";
echo "<tr> <th>ID</th>		<th>CC</th> <th>Password</th>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<td>";
    echo($row['id_employee']);
    echo "</td>";
    echo "<td>";
    echo($row['CC']);
    echo "</td>";
    echo "<td>";
    echo($row['password']);
    echo "</td>";
    echo "<td>";
}

echo "</table>";

mysqli_close($enlace);

?>
