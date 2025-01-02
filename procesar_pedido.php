<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $forma_pago = $_POST['Formadepago'];
    
    // Recoger datos del carrito
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    
    if (empty($carrito)) {
        echo "<script>alert('El carrito está vacío.'); window.location.href = 'carrito.php';</script>";
        exit();
    }

    // Crear mensaje más estructurado
    $mensaje = "¡Nuevo Pedido!\n\n";
    $mensaje .= "👤 *Cliente:* {$nombre}\n";
    $mensaje .= "📞 *Teléfono:* {$telefono}\n";
    $mensaje .= "📍 *Dirección:* {$direccion}, {$ciudad}\n";
    $mensaje .= "💳 *Forma de Pago:* {$forma_pago}\n\n"; // Añadido forma de pago al mensaje
    $mensaje .= "*⚠️🚨¡¡NO INCLUYE COSTO DE ENVÍO!!🚨⚠️*\n";
    $mensaje .= "*PRODUCTOS SOLICITADOS:*\n";
    
    // Variable para calcular el total
    $total = 0;

    foreach ($carrito as $producto) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        $total += $subtotal;
        
        $mensaje .= "-------------------\n";
        $mensaje .= "▪️ *{$producto['nombre']}*\n";
        $mensaje .= "💰 Precio: S/" . number_format($producto['precio'], 2) . "\n";
        $mensaje .= "📦 Cantidad: " . $producto['cantidad'] . "\n";
        $mensaje .= "💵 Subtotal: S/" . number_format($subtotal, 2) . "\n";
    }
    
    $mensaje .= "\n-------------------\n";
    $mensaje .= "💰 *TOTAL:* S/" . number_format($total, 2);

    // Codificar el mensaje para la URL de WhatsApp
    $mensaje_url = urlencode($mensaje);
    $whatsapp_url = "https://api.whatsapp.com/send?phone=51935780128&text={$mensaje_url}";

    // Vaciar el carrito
    unset($_SESSION['carrito']);

    // Mostrar página de confirmación con redirección
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Redirigiendo a WhatsApp...</title>
        <script>
            window.onload = function() {
                window.open('" . $whatsapp_url . "', '_blank');
                setTimeout(function() {
                    window.location.href = 'confirmacion.php';
                }, 1000);
            }
        </script>
    </head>
    <body>
        <h2>Redirigiendo a WhatsApp...</h2>
    </body>
    </html>
    ";
    exit();
}
?>
