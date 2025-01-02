<?php
include('config.php');

$conn = conectarDB();

if ($conn) {
    echo "Conexión exitosa a la base de datos: " . DB_NAME . "<br>";
    
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id_producto"]. " - Nombre: " . $row["nombre"]. " - Precio: " . $row["precio"]. "<br>";
        }
    } else {
        echo "0 resultados";
    }

    $conn->close();
} else {
    echo "Error de conexión: " . $conn->connect_error;
}
?>

