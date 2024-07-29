<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AGENCIA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT H.nombre, H.ubicación, COUNT(R.id_reserva) AS num_reservas
        FROM HOTEL H
        JOIN RESERVA R ON H.id_hotel = R.id_hotel
        GROUP BY H.nombre, H.ubicación
        HAVING COUNT(R.id_reserva) > 2";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["nombre"]. " - Ubicación: " . $row["ubicación"]. " - Reservas: " . $row["num_reservas"]. "<br>";
    }
} else {
    echo "No hay hoteles con más de dos reservas.";
}

$conn->close();
?>
