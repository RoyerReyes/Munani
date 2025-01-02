<?php
session_start();
header('Content-Type: application/json');

require_once 'config.php';
$conn = conectarDB();

$data = json_decode(file_get_contents('php://input'), true);
$producto_id = isset($data['producto_id']) ? (int)$data['producto_id'] : 0;
$accion = isset($data['accion']) ? $data['accion'] : '';
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if (!$usuario_id) {
    echo json_encode([
        'success' => false, 
        'message' => 'Usuario no autenticado',
        'cartCount' => 0
    ]);
    exit;
}

try {
    $conn->begin_transaction();

    // Verificar stock del producto
    $stmt = $conn->prepare("SELECT stock FROM productos WHERE id_producto = ? FOR UPDATE");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();

    if (!$producto) {
        throw new Exception('Producto no encontrado');
    }

    // Obtener la cantidad actual en el carrito
    $stmt = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $carrito_actual = $resultado->fetch_assoc();

    if ($carrito_actual) {
        $cantidad_actual = $carrito_actual['cantidad'];

        if ($accion === 'increase') {
            if ($cantidad_actual + 1 <= $producto['stock']) {
                $nueva_cantidad = $cantidad_actual + 1;
                $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
                $stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $producto_id);
                $stmt->execute();
            } else {
                throw new Exception('Stock insuficiente');
            }
        } elseif ($accion === 'decrease') {
            if ($cantidad_actual > 1) {
                $nueva_cantidad = $cantidad_actual - 1;
                $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
                $stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $producto_id);
                $stmt->execute();
            } else {
                $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
                $stmt->bind_param("ii", $usuario_id, $producto_id);
                $stmt->execute();
            }
        } else {
            throw new Exception('Acción no válida');
        }

        // Obtener count actualizado
        $stmt = $conn->prepare("SELECT SUM(cantidad) as total FROM carrito WHERE id_usuario = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $count = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

        $conn->commit();

        echo json_encode([
            'success' => true,
            'cartCount' => (int)$count
        ]);
    } else {
        throw new Exception('Producto no encontrado en el carrito');
    }

} catch (Exception $e) {
    if ($conn->connect_errno === 0) {
        $conn->rollback();
    }
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'cartCount' => 0
    ]);
} finally {
    $conn->close();
}
?>