<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar y sanitizar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Validar los datos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        $_SESSION['contacto_error'] = "Error: Todos los campos son obligatorios.";
        header("Location: contacto.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contacto_error'] = "Error: Dirección de correo no válida.";
        header("Location: contacto.php");
        exit;
    }

    // Configurar correo
    $destinatario = "royreyes2000@hotmail.com"; // Cambiar al correo receptor
    $asunto = "Nuevo mensaje de contacto";
    $contenido = "Has recibido un nuevo mensaje de contacto:\n\n";
    $contenido .= "Nombre: $nombre\n";
    $contenido .= "Email: $email\n";
    $contenido .= "Mensaje:\n$mensaje\n";
    $cabeceras = "From: $email\r\n";
    $cabeceras .= "Reply-To: $email\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Intentar enviar el correo
    if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
        $_SESSION['contacto_exito'] = "Mensaje enviado correctamente.";
    } else {
        error_log("Error al enviar el correo a $destinatario");
        $_SESSION['contacto_error'] = "Error: No se pudo enviar el mensaje. Intenta nuevamente más tarde.";
    }    
    header("Location: contacto.php");
    exit;
} else {
    echo "Acceso no autorizado.";
}
?>
