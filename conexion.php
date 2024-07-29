<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AGENCIA";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Fallo de conexion: " . mysqli_connect_error());
}
echo "Conexion exitosa";
mysqli_close($conn);
?>
