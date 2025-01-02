<?php
session_start();
include 'header.php';
require_once 'config.php';

// Obtener conexión a la base de datos
$conn = conectarDB();

// Consultar productos
$query = "SELECT * FROM productos WHERE estado = 'activo'";
$resultado = $conn->query($query);

// Verificar si hay errores en la consulta
if (!$resultado) {
    die("Error al obtener los productos: " . $conn->error);
}
?>

<style>
/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

/* Estilo para el contenedor principal */
.containerpro {
    padding: 100px;
    position: relative;
    width: 100%;
    min-height: 100vh;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* Títulos */
h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #ffffff;
    text-align: center;
}

/* Tarjetas de productos */
.card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.card-text {
    font-size: 0.9rem;
    color: #555;
}

/* Botón */
.btn-primary {
    background-color: #007bff;
    border: none;
    color: #fff;
    padding: 0.5rem 1rem;
    text-transform: uppercase;
    font-size: 0.875rem;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Ajuste de filas */
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.col-md-3 {
    padding: 0 15px;
    margin-bottom: 30px;
}

/* Botón flotante de WhatsApp */
.whatsapp-button {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: rgb(255, 255, 255);
    color: #fff;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px #999;
    z-index: 1000;
}

.whatsapp-button img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.whatsapp-button:hover {
    background-color: rgb(0, 90, 23);
}
</style>

<div class="containerpro" style="background-image: url('./imagenes/fondonegro.png');">
    <h1 class="mb-4" style="font-weight: bold;">CONOCE NUESTROS SABORES</h1>
    
    <div class="row">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="imagenes/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                        <p class="card-text">
    <?php 
    $palabras = explode(" ", $producto['descripcion']); 
    foreach ($palabras as $palabra) {
        echo "● " . $palabra . "<br>";
    }
    ?>
</p>

                        <p class="card-text"><strong><?php echo $producto['mililitros']; ?> ml</strong></p>
                        <p class="card-text"><strong>S/<?php echo number_format($producto['precio'], 2); ?></strong></p>
                        <?php if ($producto['stock'] > 0): ?>
                            <button onclick="agregarAlCarrito(<?php echo $producto['id_producto']; ?>)" 
                                    class="btn btn-primary">
                                Agregar al carrito
                            </button>
                        <?php else: ?>
                            <button class="btn btn-secondary" disabled>
                                Agotado
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/51910889631?text=Hola%2C%20tengo%20una%20consulta%20sobre%20sus%20productos" class="whatsapp-button" target="_blank">
    <img src="./imagenes/wtsp.png" alt="WhatsApp">
</a>
<?php 
// Cerrar la conexión
$conn->close();
include 'footer.php'; 
?>
