<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$conn = conectarDB();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

if (!$usuario_id) {
    echo json_encode([
        'success' => false,
        'message' => 'Por favor, inicia sesión para agregar productos al carrito',
        'cartCount' => 0
    ]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$producto_id = isset($data['producto_id']) ? (int)$data['producto_id'] : 0;

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

    if ($producto['stock'] <= 0) {
        throw new Exception('Producto sin stock disponible');
    }

    // Verificar si ya existe en el carrito
    $stmt = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $carrito_actual = $resultado->fetch_assoc();

    if ($carrito_actual) {
        // Actualizar cantidad
        $nueva_cantidad = $carrito_actual['cantidad'] + 1;
        if ($nueva_cantidad > $producto['stock']) {
            throw new Exception('Stock insuficiente');
        }
        
        $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("iii", $nueva_cantidad, $usuario_id, $producto_id);
    } else {
        // Insertar nuevo item
        $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $usuario_id, $producto_id);
    }
    
    $stmt->execute();

    // Obtener count total de items en carrito
    $stmt = $conn->prepare("SELECT SUM(cantidad) as total FROM carrito WHERE id_usuario = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_assoc()['total'] ?? 0;

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Producto agregado al carrito',
        'cartCount' => (int)$count
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'cartCount' => 0
    ]);
} finally {
    $conn->close();
}
?>