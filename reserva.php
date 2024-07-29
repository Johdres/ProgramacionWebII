<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AGENCIA";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener IDs de vuelos disponibles
$vuelo_ids = [];
$result = $conn->query("SELECT id_vuelo FROM VUELO");
while ($row = $result->fetch_assoc()) {
    $vuelo_ids[] = $row['id_vuelo'];
}

// Obtener IDs de hoteles disponibles
$hotel_ids = [];
$result = $conn->query("SELECT id_hotel FROM HOTEL");
while ($row = $result->fetch_assoc()) {
    $hotel_ids[] = $row['id_hotel'];
}

if (empty($vuelo_ids) || empty($hotel_ids)) {
    die("No hay vuelos u hoteles disponibles para crear reservas.");
}

// Insertar 10 reservas
for ($i = 1; $i <= 10; $i++) {
    $id_cliente = $i;
    $fecha_reserva = date('Y-m-d', strtotime("2024-07-$i"));
    $id_vuelo = $vuelo_ids[array_rand($vuelo_ids)];
    $id_hotel = $hotel_ids[array_rand($hotel_ids)];

    $sql = "INSERT INTO RESERVA (id_cliente, fecha_reserva, id_vuelo, id_hotel)
            VALUES ('$id_cliente', '$fecha_reserva', '$id_vuelo', '$id_hotel')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Mostrar contenido de la tabla RESERVA
$sql = "SELECT * FROM RESERVA";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id_reserva: " . $row["id_reserva"]. " - id_cliente: " . $row["id_cliente"]. " - fecha_reserva: " . $row["fecha_reserva"]. " - id_vuelo: " . $row["id_vuelo"]. " - id_hotel: " . $row["id_hotel"]. "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
