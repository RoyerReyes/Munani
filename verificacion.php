<?php
session_start();
if (isset($_POST['mayor_edad']) && $_POST['mayor_edad'] == 'si') {
    $_SESSION['mayor_edad'] = true;
    header('Location: index.php');
    exit;
} elseif (isset($_POST['mayor_edad']) && $_POST['mayor_edad'] == 'no') {
    header('Location: https://www.google.com'); // Redirige a otro sitio si el usuario no es mayor de edad
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Edad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('./imagenes/fondonegro.png'); /* Fondo de la página */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .verification-box {
            background-color: rgba(0, 0, 0, 0.8); /* Fondo oscuro semitransparente */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
        }
        .verification-box h1 {
            margin-bottom: 20px;
        }
        .verification-box button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #ff0000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .verification-box button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="verification-box">
        <h1>¿ERES MAYOR DE EDAD PARA COMPRAR EN MUNANI MACERADOS?</h1>
        <form method="post">
            <button type="submit" name="mayor_edad" value="si">Sí</button>
            <button type="submit" name="mayor_edad" value="no">No</button>
        </form>
    </div>
</body>
</html>
