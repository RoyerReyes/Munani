<?php
session_start();
if (!isset($_SESSION['mayor_edad'])) {
    header('Location: verificacion.php');
    exit;
}
include 'header.php';
?>

<!-- Resto del contenido de tu archivo index.php -->

<!-- Estilos -->
<style>
    .primerbanner {
        position: relative;
        width: 100%;
        height: 100vh; /* Asegura que el banner ocupe la altura total de la vista */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .primerbanner .banner-content .titulo {
        position: absolute;
        top: 37%;
        left: 50%;
        transform: translate(-50%, 40%);
        text-align: center;
        color: white;
    }

    .banner-button {
        position: absolute;
        top: 75%;
        left: 44%;
        font-weight: bold; /* Negrita para el texto del menú. */
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #ff0000; /* Color inicial del botón */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    /* Cambiar color al pasar el cursor por encima */
    .banner-button:hover {
        background-color: rgb(255, 255, 255); /* Color del botón al pasar el cursor */
        color: rgb(255, 0, 0); /* Color del texto al pasar el cursor */
    }

    .segundobanner {
        position: relative;
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0; /* Elimina cualquier margen exterior */
    }

    .segundobanner .container {
        padding-top: 5rem; /* Espaciado superior */
        padding-bottom: 5rem; /* Espaciado inferior */
    }

    .features {
        margin: 0; /* Elimina márgenes exteriores */
        padding: 3rem 0; /* Ajusta el relleno según sea necesario */
        background-image: url('./imagenes/fondonegro.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
    }

    .features .feature-item {
        display: inline-block;
        width: 45%;
        margin: 0 2.5%;
        text-align: center;
        position: relative;
        top: 10px;
        left: 200px;
    }

    /* Estilos para el botón flotante de WhatsApp */
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

<!-- Banner Principal -->
<div class="primerbanner" style="background-image: url('./imagenes/fondoinicio.jpg');">
    <div class="banner-content">
        <h1 class="titulo">Bienvenidos</h1>
        <a href="productos.php" class="banner-button">Comprar Ahora</a>
    </div>
</div>

<!-- Banner Secundario -->
<div class="segundobanner" style="background-image: url('./imagenes/banner2.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 style="color: #ffffff; font-weight: bold;">LA BEBIDA ESPIRITUOSA</h1>
                <p style="color: #ffffff;" class="lead">MACERADOS ARTESANALES a base de Pisco Quebranta Premium sumado a una fusión perfecta de frutas y hierbas logrando una bebida espirituosa perfecta con sabor único y un exquisito perfume.</p>
                <h2 style="color: #ffffff;">Pisco Quebranta Premium</h2>
                <h2 style="color: #ffffff;">Selección de frutas y/o Hierbas</h2>
            </div>
        </div>
    </div>
</div>

<!-- Características o Beneficios -->
<section class="features">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="fas fa-truck fa-3x mb-3"></i>
                    <h4>Envío a todo Lima</h4>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="fas fa-lock fa-3x mb-3"></i>
                    <h4>Transacciones 100% seguras</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/51910889631?text=Hola%2C%20tengo%20una%20consulta%20sobre%20sus%20productos" class="whatsapp-button" target="_blank">
    <img src="./imagenes/wtsp.png" alt="WhatsApp">
</a>

<!-- Script -->
<script>
function agregarAlCarrito(productoId) {
    // Por ahora solo mostraremos una alerta
    alert('Producto agregado al carrito (ID: ' + productoId + ')');
    // Aquí posteriormente agregaremos la funcionalidad real con AJAX
}
</script>

<?php include 'footer.php'; ?>
