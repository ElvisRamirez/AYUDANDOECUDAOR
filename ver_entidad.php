<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AYUDA ECUADOR ONLINE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<div>
    <!-- Topbar Start -->
    <div class="container-fluid bg-secondary ps-5 pe-0 d-none d-lg-block">
        <!-- <div class="row gx-0">
            <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body py-2 pe-3 border-end" href=""><small>FAQs</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Support</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Privacy</small></a>
                    <a class="text-body py-2 px-3 border-end" href=""><small>Policy</small></a>
                    <a class="text-body py-2 ps-3" href=""><small>Career</small></a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-end">
                <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                    <div class="me-3 pe-3 border-end py-2">
                        <p class="m-0"><i class="fa fa-envelope-open me-2"></i>info@example.com</p>
                    </div>
                    <div class="py-2">
                        <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
    <a href="index.php" class="navbar-brand p-0">
    <h1 class="m-0 text-uppercase">
        <i class="fas fa-hands-helping text-warning me-2"></i> <!-- Ícono de manos de ayuda -->
        <span class="text-blue">Ayuda</span> 
        <span class="text-primary">Ecuador</span>
    </h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 me-n3">
           
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 me-n3">
                        <a href="index.php" class="nav-item nav-link">Inicio</a>
                        <a href="entidades.php" class="nav-item nav-link">Entidades</a>

                        <?php

                        if (isset($_SESSION['id_usuario'])) {
                            // Si el usuario ha iniciado sesión, muestra solo Dashboard y Cerrar Sesión
                            echo '<a href="dashboard.php" class="nav-item nav-link">Dashboard</a>';
                            echo '<a href="logout.php" class="nav-item nav-link text-danger">Cerrar Sesión</a>';
                        } else {
                            // Si el usuario no ha iniciado sesión, muestra el botón de Registro/Login
                            echo '<a href="service.php" class="nav-item nav-link">Registro/Login</a>';
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <?php
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', 'admin', 'ayudandoecuador1');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el ID de la entidad desde la URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "
    SELECT 
        u.Nombre AS usuario_nombre,
        u.Apellido AS usuario_apellido,
        u.correo AS usuario_correo,
        e.Entidad_Nombre,
        e.rama_accion,
        e.descripcion AS entidad_descripcion,
        e.necesidad AS necesidad_entidad,
        e.representante,
        f.foto_ruta,
        c.tipo AS clasificacion_tipo,
        uo.provincia,
        uo.canton,
        uo.parroquia,
        t.telefono,
        r.tipo_red,
        r.links AS red_links,
        da.tipo_cuenta,
        da.cuentas_bancarias,
        uo.latitud,
        uo.altitud as longitud  -- Cambiamos el nombre para claridad
    FROM Entidad e
    LEFT JOIN Datos d ON e.id_dato = d.id_datos
    LEFT JOIN Usuarios u ON d.id_usuario = u.id_usuario
    LEFT JOIN fotos f ON e.id_dato = f.id_dato
    LEFT JOIN Clasificacion c ON e.id_dato = c.id_datos
    LEFT JOIN Ubicacion uo ON e.id_dato = uo.id_dato
    LEFT JOIN Telefonos t ON e.id_dato = t.id_datos
    LEFT JOIN redes_sociales r ON e.id_dato = r.id_datos
    LEFT JOIN datos_adicionales da ON e.id_dato = da.id_dato
    WHERE e.id_dato = ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Convertir a float y verificar que sean números válidos
                $latitud = floatval($row['latitud']);
                $longitud = floatval($row['longitud']);

                // Debug info
                echo "<!-- Debug info: -->";
                echo "<!-- Latitud: " . $latitud . " -->";
                echo "<!-- Longitud: " . $longitud . " -->";

                // El resto de tu HTML se mantiene igual hasta la sección del mapa
                echo "
    
            <div class='container-fluid py-6 px-5'>
    <div class='text-center mx-auto mb-5' style='max-width: 600px;'>
        <h1 class='display-5 mb-0'>" . htmlspecialchars($row['Entidad_Nombre']) . "</h1>
          <h3 class='text-center text-muted'>" . htmlspecialchars($row['rama_accion']) . "</h3>
      
       
    </div>

    <div class='row g-5'>
        <div class='col-lg-4'>
            <div class='row g-5'>
                <div class='col-12'>
                    <div class='d-flex align-items-center mb-3'>
            <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
                <i class='fa fa-cubes fs-4 text-white'></i>
            </div>
                <h3 class='ms-3'>Clasificación:</h3>
            </div>
                    <p>" . htmlspecialchars($row['clasificacion_tipo']) . "</p>

                 <div class='d-flex align-items-center mb-3'>
    <!-- Ícono circular -->
    <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
        <i class='fa fa-lightbulb fs-4 text-white'></i>
    </div>
    <!-- Título ajustable -->
    <h3 class='ms-3'>Necesidad:</h3>
</div>
<!-- Contenido dinámico -->
<p>" . htmlspecialchars($row['necesidad_entidad']) . "</p>
   
                </div>
                <div class='col-12'>
                   <div class='d-flex align-items-center mb-3'>
                        <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
                            <i class='fa fa-map-marker fs-4 text-white'></i>
                        </div>
                        <h3 class='ms-3'>Ubicación:</h3>
                    </div>
                 
                    <p><strong>Provincia:</strong> " . htmlspecialchars($row['provincia']) . "</p>
                    <p><strong>Canton:</strong> " . htmlspecialchars($row['canton']) . "</p>
                    <p><strong>Parroquia:</strong> " . htmlspecialchars($row['parroquia']) . "</p>
                </div>
            </div>
        </div>

       <div class='col-lg-4'>
    <div class='d-block bg-primary h-100 text-center'>
       
        <img 
            class='img-fluid rounded-image' 
            src='" . htmlspecialchars($row['foto_ruta']) . "' 
            alt='Foto de la entidad'>
       <div class='d-flex align-items-center mb-3'>
    <!-- Ícono dentro de un círculo, que puede representar algún aspecto de la descripción -->
    <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
        <i class='fa fa-info-circle fs-4 text-white'></i> <!-- Ícono informativo -->
    </div>
    <!-- Título de la sección de descripción -->
    <h3 class='ms-3 text-white'>Descripción:</h3>
</div>

<div class='p-4'>
    <!-- Descripción con texto blanco y margen adecuado -->
    <p class='text-white mb-4'>" . htmlspecialchars($row['entidad_descripcion']) . "</p>
</div>

    </div>
</div>
<style>
/* Clase para imágenes con tamaño fijo y bordes redondeados */
.rounded-image {
    width: 90%; /* Asegura que ocupe todo el ancho disponible */
    height: 200px; /* Altura fija para todas las imágenes */
    object-fit: contain; /* Mantiene las proporciones de la imagen sin recortar */
    background-color: #f8f9fa; /* Fondo claro para mejorar la apariencia */
  
    justify-content: center;
    align-items: center;
    object-fit: cover; /* Ajusta la imagen sin deformarla */
    border-radius: 15px; /* Bordes redondeados */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animación suave */
}

/* Efecto de zoom y sombra al pasar el mouse */
.rounded-image:hover {
    transform: scale(1.05); /* Zoom suave */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Sombra atractiva */
}

/* Clase para el contenedor para centrado y consistencia */
.bg-primary {
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra envolvente */
}
</style>


        <div class='col-lg-4'>
            <div class='row g-5'>
                <div class='col-12'>
                   <div class='d-flex align-items-center mb-3'>
              <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
                    <i class='fa fa-phone fs-4 text-white'></i>
                </div>
                <h3 class='ms-3'>Contactos:</h3>
            </div>
                   <p><strong>Representante:</strong> " . (empty($row['representante']) ? "No disponible" : htmlspecialchars($row['representante'])) . "</p>
                                <p><strong>telefono:</strong>" . (empty($row['telefono']) ? "No se encontraron teléfonos para esta entidad." : htmlspecialchars($row['telefono'])) . "</p>
                  
                <p><strong>Correo Electrónico:</strong> <a href='mailto:" . htmlspecialchars($row['usuario_correo']) . "'>" . htmlspecialchars($row['usuario_correo']) . "</a></p>
            
                </div>
                        <!-- Redes Sociales -->
                        <div class='col-12'>
                        <div class='d-flex align-items-center mb-3'>
                            <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
                                <i class='fa fa-share-alt fs-4 text-white'></i>
                            </div>
                            <h3 class='ms-3'>Redes Sociales:</h3>
                        </div>

                        <p><strong>Tipo de Red:</strong> " . (empty($row['tipo_red']) ? "No disponible" : htmlspecialchars($row['tipo_red'])) . "</p>
                        <p><strong>Enlace:</strong> " . (empty($row['red_links']) ? "No disponible" : "<a href='" . htmlspecialchars($row['red_links']) . "' target='_blank'>" . htmlspecialchars($row['red_links']) . "</a>") . "</p>
                        </div>

                
         <div class='col-12'>
                            <div class='d-flex align-items-center mb-3'>
                <div class='bg-primary rounded-circle d-flex align-items-center justify-content-center' style='width: 60px; height: 60px;'>
                    <i class='fa fa-credit-card fs-4 text-white'></i>
                </div>
                <h3 class='ms-3'>Datos Bancarios:</h3>
              </div>
                                <p><strong>Tipo de Cuenta:</strong> " . (empty($row['tipo_cuenta']) ? "No disponible" : htmlspecialchars($row['tipo_cuenta'])) . "</p>
                    <p><strong>Cuentas Bancarias:</strong> " . (empty($row['cuentas_bancarias']) ? "No disponibles" : htmlspecialchars($row['cuentas_bancarias'])) . "</p>
            </div>
            </div>
        </div>
    </div>
</div>



                    <!-- Sección del mapa actualizada -->
                  <div class='row'>
    <div class='col-md-12'>
        <h4 class='text-center'>Ubicación en el mapa:</h4>
        <div class='d-flex justify-content-center'>
            <div id='map' style='height: 400px; width: 80%;'></div>
        </div>
        <div id='map-error' class='alert alert-danger mt-3' style='display:none;'></div>
    </div>
</div>


                    <script>
                    // Variable global para el mapa
                    let map;
                    let marker;

                    // Función que inicializa el mapa
                    function iniciarMap() {
                        // Verificar que las coordenadas sean válidas
                        var lat = " . json_encode($latitud) . ";
                        var lng = " . json_encode($longitud) . ";
                        
                        console.log('Coordenadas:', lat, lng);
                        
                        // Verificar que las coordenadas son números válidos y están en rangos correctos
                        if (!isNaN(lat) && !isNaN(lng) && 
                            lat >= -90 && lat <= 90 && 
                            lng >= -180 && lng <= 180) {
                            
                            try {
                                var entidadLocation = { lat: lat, lng: lng };
                                
                                map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 14,
                                    center: entidadLocation,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    mapTypeControl: true,
                                    streetViewControl: true,
                                    fullscreenControl: true
                                });

                                marker = new google.maps.Marker({
                                    position: entidadLocation,
                                    map: map,
                                    title: '" . addslashes($row['Entidad_Nombre']) . "'
                                });
                            } catch (e) {
                                console.error('Error al inicializar el mapa:', e);
                                document.getElementById('map-error').style.display = 'block';
                                document.getElementById('map-error').innerHTML = 'Error al cargar el mapa: ' + e.message;
                            }
                        } else {
                            console.error('Coordenadas no válidas:', lat, lng);
                            document.getElementById('map-error').style.display = 'block';
                            document.getElementById('map-error').innerHTML = 'Coordenadas no válidas. Latitud: ' + lat + ', Longitud: ' + lng;
                        }
                    }

                    // Función para cargar el script de Google Maps
                    function loadGoogleMaps() {
                        const script = document.createElement('script');
                        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap';
                        script.async = true;
                        script.defer = true;
                        script.onerror = function() {
                            console.error('Error al cargar Google Maps');
                            document.getElementById('map-error').style.display = 'block';
                            document.getElementById('map-error').innerHTML = 'Error al cargar Google Maps. Por favor, verifica tu conexión a internet y la API key.';
                        };
                        document.head.appendChild(script);
                    }

                    // Cargar el mapa cuando la página esté lista
                    document.addEventListener('DOMContentLoaded', loadGoogleMaps);
                    </script>
                </div>
            ";
            }
        } else {
            echo "<p>No se encontraron detalles para esta entidad.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?><br>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary p-5">
    <div class="row g-5 justify-content-center">
    <div class="col-lg-4 col-md-6">
            <h3 class="text-white mb-4">CEOSSOLUCIONES S.A.S.</h3>
            <div class="d-flex justify-content-center">
                <img src="img/KELA.png" alt="Logo de la Empresa" class="img-fluid" style="max-width: 60%; height: auto;">
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <h3 class="text-white mb-4">Enlaces Rápidos</h3>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Inicio</a>
                <a class="text-secondary mb-2" href="entidades.php"><i class="bi bi-arrow-right text-primary me-2"></i>Entidades</a>
                <a class="text-secondary mb-2" href="service.php"><i class="bi bi-arrow-right text-primary me-2"></i>Registrate/login</a>
            </div>
        </div>
       
        <div class="col-lg-3 col-md-6">
            <h3 class="text-white mb-4">Síguenos</h3>
            <div class="d-flex justify-content-center">
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram fw-normal"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
    <p class="m-0">&copy; <a class="text-secondary border-bottom" href="#">AyudaEcuador</a>. Todos los Derechos Reservados. Diseñado por <a class="text-secondary border-bottom" href="">KELA IT CONSULTING</a></p>
</div>

    <!-- Footer End -->
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>