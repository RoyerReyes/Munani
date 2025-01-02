<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Otro contenido del head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .footer {
            background: rgb(0, 0, 0) !important;
        }

        .footer .container {
            display: flex;
            flex-direction: column; /* Asegura que los elementos hijos se dispongan en columna */
            align-items: center; /* Centra horizontalmente los elementos */
            text-align: center;
        }

        .footer .row {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .footer .col-md-4 {
            flex: 1;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <footer class="footer bg-light mt-0">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <h5 style="color: #ffffff;">Sobre Nosotros</h5>
                    <p style="color: #ffffff;">¡Bienvenid@ a Munani! 🍇✨
                    Macerados de Piscos artesanales que combinan la frescura y dulzura de la fruta con la tradición ancestral peruana. ✨</p>
                </div>
                <div class="col-md-4">
                    <h5 style="color: #ffffff;">Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://www.instagram.com/munani_macerados/" target="_blank" style="color: #ffffff;">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/MunaniMacerados" target="_blank" style="color: #ffffff;">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://www.tiktok.com/@munanimacerados?_t=ZM-8sg7BGoJMzW&_r=1" target="_blank" style="color: #ffffff;">
                                <i class="fab fa-tiktok"></i> TikTok
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 style="color: #ffffff;">Trabaja con Nosotros</h5>
                    <ul class="list-unstyled">
                        <p style="color: #ffffff; font-size: 12px;"> "¿Te apasiona la innovación y la tradición? Únete a Munani 
                            Macerados para desarrollar tus habilidades y colaborar con un equipo dinámico. ¡Envía tu CV hoy mismo!"
                        </p>
                        <li><a href="https://www.linkedin.com/company/munani-macerados/">Linkedin</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 style="color: #ffffff;">Contacto</h5>
                    <ul class="list-unstyled" style="color: #ffffff;">
                        <li>📞 +51 910 889 631</li>
                        <li>✉️ Tu email</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center" style="color: #ffffff;">
                <p>&copy; <?php echo date('Y'); ?> Munani Macerados Todos los derechos reservados</p>
                <p>Hecho por TECDIDATA</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
