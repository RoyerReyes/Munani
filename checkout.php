<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';
$conn = conectarDB();
$usuario_id = $_SESSION['usuario_id'];

// Verificar si el carrito tiene productos
$query = "SELECT c.*, p.nombre, p.precio, p.stock 
          FROM carrito c 
          INNER JOIN productos p ON c.id_producto = p.id_producto 
          WHERE c.id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$items_carrito = $resultado->fetch_all(MYSQLI_ASSOC);

if (empty($items_carrito)) {
    header('Location: carrito.php');
    exit();
}

// Almacenar los datos del carrito en la sesión
$_SESSION['carrito'] = $items_carrito;

$conn->close();
include 'header.php';
?>

<div class="container py-5">
    <h2 class="mb-4">Datos de Envío</h2>
    <form action="procesar_pedido.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección de Envío</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="mb-3">
    <label for="Formadepago" class="form-label">Forma de Pago</label>
    <select class="form-control" id="Formadepago" name="Formadepago" required>
        <option value="" disabled selected>Seleccione una opción</option>
        <option value="Yape">Yape</option>
        <option value="Plim">Plin</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="Efectivo">Efectivo</option>
    </select>
</div>
        <button type="submit" class="btn btn-primary">Confirmar Pedido</button>
    </form>
</div>

<?php include 'footer.php'; ?>
