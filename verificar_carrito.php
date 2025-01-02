<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión']);
    exit();
}

require_once 'config.php';
$conn = conectarDB();
$usuario_id = $_SESSION['usuario_id'];

$query = "SELECT COUNT(*) as count FROM carrito WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_assoc()['count'];

if ($count == 0) {
    echo json_encode(['success' => false, 'message' => 'El carrito está vacío']);
} else {
    echo json_encode(['success' => true]);
}

$conn->close();
?>
