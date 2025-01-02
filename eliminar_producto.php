<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$conn = conectarDB();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if (!$usuario_id) {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autenticado',
        'cartCount' => 0
    ]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$producto_id = isset($data['producto_id']) ? (int)$data['producto_id'] : 0;

try {
    $conn->begin_transaction();

    // Eliminar el producto del carrito
    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();

    // Obtener count actualizado del carrito (suma de cantidades)
    $stmt = $conn->prepare("SELECT SUM(cantidad) as total FROM carrito WHERE id_usuario = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Producto eliminado del carrito',
        'cartCount' => (int)$count
    ]);

} catch (Exception $e) {
    if ($conn->connect_errno === 0) {
        $conn->rollback();
    }
    echo json_encode([
        'success' => false,
        'message' => 'Error al eliminar el producto: ' . $e->getMessage(),
        'cartCount' => 0
    ]);
} finally {
    $conn->close();
}
?>