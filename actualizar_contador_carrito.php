<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if (!$usuario_id) {
    echo json_encode(['count' => 0]);
    exit;
}

$conn = conectarDB();
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM carrito WHERE id_usuario = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_assoc()['total'];
$conn->close();

echo json_encode(['count' => $count]);
?>