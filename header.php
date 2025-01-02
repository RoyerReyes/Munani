<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

// Función para obtener el contador del carrito desde la BD
function getCartCount($usuario_id) {
    if (!$usuario_id) return 0;
    
    $conn = conectarDB();
    $stmt = $conn->prepare("SELECT COUNT(*) as total FROM carrito WHERE id_usuario = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['total'];
    $conn->close();
    
    return $count;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { padding-top: 60px; }
        .header { padding: 0; background-color: rgb(0, 0, 0); }
        .navbar { min-height: 50px; padding: 0; }
        .navbar-brand img { max-height: 50px; width: auto; }
        .navbar-nav { align-items: center; }
        .nav-link {
            padding: 0.5rem 1rem !important;
            font-size: 18px !important;
            font-weight: bold !important;
            color: #ffffff !important;
        }
        .cart-container {
            position: relative;
            display: inline-block;
            margin-left: 15px;
            margin-right: 30px; /* Añadir margen a la derecha del carrito */
        }
        .cart-icon {
            font-size: 1.5rem;
            color: rgb(4, 0, 255) !important;
            text-decoration: none;
            padding: 0.5rem;
        }
        .cart-count {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.4rem;
            font-size: 0.8rem;
            min-width: 20px;
            text-align: center;
        }
        .navbar-toggler {
            background-color: #ffffff;
            border: none;
        }
        .dropdown-menu {
            margin-top: 0;
            background-color: #343a40;
            border: 1px solid rgba(255, 255, 255, .1);
            min-width: 180px;
        }
        .dropdown-menu .dropdown-item {
            color: #ffffff;
            padding: 8px 16px;
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #495057;
            color: #ffffff;
        }
        .nav-link.dropdown-toggle {
            cursor: pointer;
            padding: 8px 16px;
        }
        .user-icon {
            font-size: 1.5rem;
            margin-right: 5px;
        }
        .dropdown { position: relative; z-index: 1000; }
        .navbar-nav.ms-auto { margin-left: auto !important; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery incluido -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="carrito.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="./imagenes/munani.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="productos.php">Contenido</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nosotros.php">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffffff;">
                                <i class="fas fa-user user-icon"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
                                <li><a class="dropdown-item" href="registro.php">Registrarse</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                        <div class="cart-container">
    <a class="cart-icon" href="carrito.php">
        <i class="fas fa-shopping-cart"></i>
        <?php
        $usuario_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : null;
        $cartCount = getCartCount($usuario_id);
        if ($cartCount > 0) {
            echo "<span class='cart-count'>$cartCount</span>";
        }
        ?>
    </a>
</div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- jQuery primero -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Luego Popper.js (necesario para Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- Finalmente Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script de inicialización -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Asegurarse de que todos los dropdowns funcionen
    var dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(function(dropdown) {
        new bootstrap.Dropdown(dropdown);
    });
});
</script>
<script>
function actualizarContadorCarrito() {
    $.ajax({
        url: 'actualizar_contador_carrito.php',
        method: 'GET',
        success: function(response) {
            const count = response.count;
            const cartCountElement = document.querySelector('.cart-count');
            
            if (count > 0) {
                if (cartCountElement) {
                    cartCountElement.textContent = count;
                } else {
                    const newCount = document.createElement('span');
                    newCount.className = 'cart-count';
                    newCount.textContent = count;
                    document.querySelector('.cart-icon').appendChild(newCount);
                }
            } else {
                if (cartCountElement) {
                    cartCountElement.remove();
                }
            }
        }
    });
}

// Actualizar contador cuando se carga la página
document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);

// Actualizar contador después de agregar/eliminar productos
$(document).on('cartUpdated', actualizarContadorCarrito);
</script>
</body>
</html>
