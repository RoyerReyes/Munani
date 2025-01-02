<?php
session_start();
include 'header.php';
require_once 'config.php';

$conn = conectarDB();
$usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;

$total = 0;
if ($usuario_id) {
    $query = "SELECT c.*, p.nombre, p.precio, p.stock 
              FROM carrito c 
              INNER JOIN productos p ON c.id_producto = p.id_producto 
              WHERE c.id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $items_carrito = $resultado->fetch_all(MYSQLI_ASSOC);
    
    foreach ($items_carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
}
?>

<div class="container py-5">
    <h2 class="mb-4">Carrito de Compras</h2>
    
    <?php if (!$usuario_id): ?>
        <div class="alert alert-warning">
            Por favor, inicia sesión para ver tu carrito. <a href="login.php">Iniciar sesión</a>
        </div>
    <?php elseif (empty($items_carrito)): ?>
        <div class="alert alert-info">
            Tu carrito está vacío. <a href="productos.php">Ir a comprar</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Stock Disponible</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items_carrito as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                            <td>S/<?php echo number_format($item['precio'], 2); ?></td>
                            <td>
                                <div class="input-group" style="max-width: 120px;">
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="actualizarCantidad(<?php echo $item['id_producto']; ?>, 'decrease')"
                                            <?php echo ($item['cantidad'] <= 1) ? 'disabled' : ''; ?>>-</button>
                                    <input type="text" class="form-control text-center" 
                                           value="<?php echo htmlspecialchars($item['cantidad']); ?>" 
                                           readonly>
                                    <button class="btn btn-outline-secondary btn-sm" 
                                            onclick="actualizarCantidad(<?php echo $item['id_producto']; ?>, 'increase')"
                                            <?php echo ($item['cantidad'] >= $item['stock']) ? 'disabled' : ''; ?>>+</button>
                                </div>
                            </td>
                            <td><?php echo $item['stock']; ?></td>
                            <td>S/<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm" 
                                        onclick="eliminarProducto(<?php echo $item['id_producto']; ?>)">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td><strong>S/<?php echo number_format($total, 2); ?></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="productos.php" class="btn btn-secondary">Seguir Comprando</a>
            <button onclick="procesarCompra()" class="btn btn-primary">Procesar Compra</button>
        </div>
    <?php endif; ?>
</div>

<script>
function procesarCompra() {
    $.ajax({
        url: 'verificar_carrito.php',
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                window.location.href = 'checkout.php';
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Error al procesar la solicitud');
        }
    });
}
</script>

<?php 
$conn->close();
include 'footer.php'; 
?>
