<?php
session_start();
include 'header.php';
?>

<!-- Estilos -->
<style>
    .containercont {
        position: relative;
        width: 100%;
        min-height: 100vh; /* Cambiado a min-height para evitar que se corte si el contenido crece */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url('./imagenes/fondonegro.png'); /* Fondo por defecto */
        padding: 50px 15px; /* Espaciado interior */
    }

    .containercont h1 {
        color: #ffffff;
        text-align: center;
        padding: 10px;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .form-label, .btn, .col-md-6 p, .col-md-6 h3 {
        color: #ffffff; /* Color blanco para los textos */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1); /* Fondo translúcido */
        color: #ffffff;
        border: 1px solid #cccccc;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.2); /* Fondo más claro al enfocar */
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .col-md-6 {
        padding: 20px;
    }

    .contact-info {
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5); /* Fondo translúcido para información de contacto */
        border-radius: 10px;
    }
    /* Estilos para el botón flotante de WhatsApp */
    .whatsapp-button {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color:rgb(255, 255, 255);
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
        background-color:rgb(0, 90, 23);
    }

</style>

<!-- Contenido -->
<div class="containercont">
    <h1>Contacto</h1>
    
    <div class="row">
        <!-- Formulario de contacto -->
        <div class="col-md-6">
            <?php if (isset($_SESSION['contacto_error'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    echo $_SESSION['contacto_error']; 
                    unset($_SESSION['contacto_error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['contacto_exito'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo $_SESSION['contacto_exito']; 
                    unset($_SESSION['contacto_exito']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="procesar_contacto.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
            </form>
        </div>
        
        <!-- Información de contacto -->
        <div class="col-md-6">
            <div class="contact-info">
                <h3>Información de Contacto</h3>
                <p>
                    <strong>Email:</strong><br>
                    info@tutienda.com
                </p>
                
                <p>
                    <strong>Teléfono:</strong><br>
                    +51 910 889 631
                </p>
                
                <h3 class="mt-4">Horario de Atención</h3>
                <p>
                    24 horas al dia, de lunes a domingo.
                </p>
            </div>
        </div>
    </div>
</div>

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
