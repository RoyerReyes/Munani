<?php
session_start();
include 'header.php';
?>

<!-- Estilos -->
<style>
    /* Estilo principal de la sección 1 */
    .full-width-section-1 {
        position: relative;
        width: 100%;
        min-height: 100vh; /* Cambiado a min-height para evitar problemas si el contenido crece */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url('./imagenes/historiano.jpg'); /* Fondo predeterminado */
        padding: 50px ; /* Espaciado interior */
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-end;
    }

    /* Contenedor del contenido */
    .content-1 {
        position: relative;
        z-index: 2;
        color: rgb(255, 255, 255);
        text-align: center;
        max-width: 60%; /* Ajusta el ancho del contenido */
    }

    /* Estilo para el título */
    .content-1 h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .content-1 h1 span {
        color: #f39c12; /* Color destacado */
    }

    /* Estilo del párrafo */
    .content-1 p {
        font-size: 1.2rem;
        line-height: 1.8;
        text-align: justify;
        margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.6); /* Fondo translúcido para destacar el texto */
        padding: 20px;
        border-radius: 10px;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .content-1 h1 {
            font-size: 2rem;
        }

        .content-1 p {
            font-size: 1rem;
        }
    }

    /* Estilo principal de la sección 2 */
    .full-width-section-2 {
        position: relative;
        width: 100%;
        min-height: 100vh; /* Cambiado a min-height para evitar problemas si el contenido crece */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-image: url('./imagenes/fondonegro.png'); /* Fondo predeterminado */
        padding: 50px; /* Espaciado interior */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Centra verticalmente */
        align-items: center; /* Centra horizontalmente */
    }

    /* Contenedor del contenido */
    .content-2 {
        position: relative;
        z-index: 2;
        color: rgb(255, 255, 255);
        text-align: center;
        max-width: 60%; /* Ajusta el ancho del contenido */
    }

    /* Estilo para el título */
    .content-2 h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .content-2 h1 span {
        color: #f39c12; /* Color destacado */
    }

    /* Estilo del párrafo */
    .content-2 p {
        font-size: 1.2rem;
        line-height: 1.8;
        text-align: justify;
        margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.6); /* Fondo translúcido para destacar el texto */
        padding: 20px;
        border-radius: 10px;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .content-2 h1 {
            font-size: 2rem;
        }

        .content-2 p {
            font-size: 1rem;
        }
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
    .boton{
        font-weight: bold; /* Negrita para el texto del menú. */
        margin-top: 0px;
        padding: 10px 100px;
        background-color:rgb(0, 38, 255); /* Color inicial del botón */
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }
</style>

<!-- Sección de "Nosotros" -->
<div class="full-width-section-1">
    <div class="content-1">
        <!-- Título 1-->
        <h1>
            Nuestra <span>Historia</span>
        </h1>

        <!-- Descripción 1-->
        <p>
            <strong>MUNANI MACERADOS</strong> es nuestra marca 100% peruana que nació un 23 de septiembre del año 2020, con el propósito de continuar difundiendo nuestra bebida bandera, el <strong>PISCO</strong>, en una versión macerada con exquisitas hierbas y frutas. Este concepto fue creado para deleitar los paladares más exigentes con diversos cócteles llenos de sabor, aroma y frescura.
        </p>
        <p>
            Nuestra identidad peruana merecía un empaque de lujo, por lo que diseñamos diferentes <strong>"PaKs"</strong> que transmiten la riqueza de nuestro país. Desde nuestro logo, inspirado en las hermosas flores ayacuchanas, hasta los detalles andinos hechos a mano por talentosos artesanos, y el nombre de nuestra marca que enmarca nuestra <strong>"Pasión por los Macerados"</strong>. <strong>Munani Macerados</strong> son una combinación perfecta de tradición y creatividad, resultando en sabores únicos que deleitan el paladar.
        </p>
    </div>
</div>
<div class="full-width-section-2">
    <div class="content-2">
        <!-- Título 2-->
        <h1>
            Nuestras <span>Recetas</span>
        </h1>

        <!-- Descripción 2-->
        <p>
        <p>Las recetas de <strong> Munani Macerados </strong>no solo mezclan tradición y creatividad, sino que también te invitan a un viaje sensorial que deleita el paladar y celebra la riqueza cultural de Perú. Cada receta es una obra maestra que fusiona ingredientes seleccionados con precisión y un meticuloso proceso de maceración, resultando en sabores únicos y auténticos. No pierdas la oportunidad de explorar estas recetas que transforman cada sorbo en una experiencia memorable. ¡Descúbrelas y déjate sorprender por la calidad excepcional y la innovación de Munani Macerados!
        </p>
        <a href="https://www.instagram.com/s/aGlnaGxpZ2h0OjE3OTEzNjkyODI3NTY3MTE4?story_media_id=3377438692550854867_43011525297&igshid=ODVweWwzd2N6YjB1" target="_blank">
            <button type="submit" class="boton">RECETAS</button>
        </a>
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
