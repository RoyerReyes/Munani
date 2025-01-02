<?php
function verificarAutenticacion() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}

function estaAutenticado() {
    return isset($_SESSION['usuario_id']);
}
?>