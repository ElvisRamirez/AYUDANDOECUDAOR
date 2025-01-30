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
    <style>
        /* Contenedor para las tarjetas */
/* Contenedor para las tarjetas */
.container {
    display: flex;
    
    flex-wrap: wrap;
    gap: 15px; /* Espacio entre columnas (y filas) */
}

/* Asegurarse de que las tarjetas tengan el mismo tamaño */
.card {
    
    width: 100%; /* Para ocupar todo el ancho dentro de una columna */
    height: 100%; /* Para que las tarjetas sean uniformes en altura */
    max-width: 300px; /* Limitar el ancho máximo de las tarjetas */
    margin-bottom: 20px;
    border: 1px solid #ddd; /* Bordes suaves */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Sombra ligera */
}

/* Hacer que las tarjetas se ajusten con el grid */

/* Agregar barra de desplazamiento a la descripción */
.descripcion {
    max-height: 100px; /* Altura máxima para la descripción */
    overflow-y: auto; /* Habilitar desplazamiento vertical si es necesario */
    padding-right: 5px; /* Espacio extra para la barra de desplazamiento */
    text-overflow: ellipsis; /* Agregar puntos suspensivos si es necesario */
}

/* Estilos adicionales opcionales */
.card-img-top {
    margin: 5px;
    width: 250px;
    justify-self: center;
    height: auto; /* Limitar la altura de la imagen */
    object-fit: cover; /* Asegura que la imagen se recorte de manera uniforme */
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    object-fit: cover; /* Mantiene la proporción de la imagen */
}
/* Ajustando espacio con márgenes en las columnas */

/* Para quitar el margen en la última columna de cada fila */
.col-md-4:last-child {
    margin-right: 0;
}
  .custom-img {
    width: 90%; /* Asegura que ocupe todo el ancho disponible */
    height: 200px; /* Altura fija para todas las imágenes */
    object-fit: contain; /* Mantiene las proporciones de la imagen sin recortar */
    background-color: #f8f9fa; /* Fondo claro para mejorar la apariencia */
    display: flex; /* Para centrar contenido si no hay imagen */
    justify-content: center;
    align-items: center;
  }



    </style>
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
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0 fixed-top">
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
</nav>

<!-- Navbar End -->





<!-- About Start -->
<div class="container-fluid bg-secondary p-0">
    <div class="row g-0">
        
    <?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', 'admin', 'ayudandoecuador1');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todas las provincias disponibles
$provincia_sql = "SELECT DISTINCT provincia FROM Ubicacion";
$provincia_result = $conn->query($provincia_sql);

// Verificar si se ha seleccionado alguna provincia
$provincia_filter = "";
if (isset($_GET['provincia']) && !empty($_GET['provincia'])) {
    $provincia_filter = " AND uo.provincia = '" . htmlspecialchars($_GET['provincia']) . "'";
}

// Consulta SQL para obtener las entidades, aplicando el filtro si es necesario
$sql = "
    SELECT 
        e.id_dato,
        e.Entidad_Nombre,
        e.rama_accion,
        e.descripcion AS entidad_descripcion,
        f.foto_ruta,  -- VARCHAR con la ruta de la imagen
        c.tipo AS clasificacion_tipo,
        uo.provincia
    FROM Entidad e
    LEFT JOIN fotos f ON e.id_dato = f.id_dato
    LEFT JOIN Clasificacion c ON e.id_dato = c.id_datos
    LEFT JOIN Ubicacion uo ON e.id_dato = uo.id_dato
    WHERE 1=1" . $provincia_filter; // Aplica el filtro de provincia si existe

// Ejecutar la consulta
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por Provincia</title>
    
</head>

<body>


<style>


.row {
    margin-left: 0; 
    margin-right: 0; /* Evita márgenes laterales en la fila */
}

    /* Estilo de la imagen y contenedor */



.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0; /* Oculto por defecto */
    transition: opacity 0.3s ease-in-out;
    z-index: 2; /* Asegura que esté por encima */
}

.card:hover .card-overlay {
    opacity: 1; /* Visible al pasar el mouse */
}

.card-overlay a {
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: rgba(189, 19, 19, 0.8);
    transition: background-color 0.3s ease;
}

.card-overlay a:hover {
    background-color: rgb(221, 224, 228);
}
    /* Estilo para las tarjetas */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    /* Efecto al pasar el cursor sobre la tarjeta */
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Transición de fondo para el botón */
    .hover-btn:hover {
        background-color: #0056b3 !important;
        transform: translateY(-2px);
    }
    
    /* Asegurando que los botones se expandan al 100% del ancho */
    .w-100 {
        width: 80%;
    }
    
    /* Efecto de hover para tarjetas */
    .transition-transform:hover {
        transform: translateY(-5px);
    }

    /* Animación suave en la tarjeta */
    .transition-transform {
        transition: transform 0.3s ease;
    }
    #entidades {
        margin-left: 30px; /* Ajusta el valor según lo que necesites */
    }
</style>

<form method="GET" action="" style="max-width: 600px; margin:150px auto; padding: 10px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <h3 style="text-align: center; margin-bottom: 15px;">Filtrar por provincia</h3>
    
    <div class="form-group">
        <label for="provincia">Selecciona una provincia:</label>
        <select name="provincia" id="provincia" class="form-control">
            <option value="">Seleccionar provincia</option> <!-- Opción por defecto -->
            <?php
            // Mostrar todas las provincias
            while ($provincia_row = $provincia_result->fetch_assoc()) {
                // Si la provincia está seleccionada, marcarla como seleccionada
                $selected = (isset($_GET['provincia']) && $_GET['provincia'] == $provincia_row['provincia']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($provincia_row['provincia']) . "' $selected>" . htmlspecialchars($provincia_row['provincia']) . "</option>";
            }
            ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 10px;">Filtrar</button>
</form>
<div id="entidades" class="container-fluid py-4">
    <div class="row g-0"> <!-- Sin espacios entre columnas -->
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fotoRuta = !empty($row['foto_ruta']) ? htmlspecialchars($row['foto_ruta']) : null;
                $imgHtml = $fotoRuta
                    ? "<img src='" . $fotoRuta . "' class='card-img-top img-fluid custom-img' alt='Imagen de la entidad'>"
                    : "<div class='card-img-top bg-secondary custom-img' style='display: flex; align-items: center; justify-content: center;'>
                        <span class='text-white'>Sin imagen disponible</span>
                      </div>";
                echo "
                     <div class='col-lg-3 col-md-6 col-12 mb-4'>  <!-- Ajustado para pantallas grandes, medianas y pequeñas -->
                        <div class='card shadow-lg border-light rounded-3'>
                            <div class='card-overlay d-flex justify-content-center align-items-center'>
                                <a href='ver_entidad.php?id=" . htmlspecialchars($row['id_dato']) . "' class='btn btn-primary'>Ver</a>
                            </div>
                            $imgHtml
                            <div class='card-body'>
                                <h5 class='card-title text-center'>" . htmlspecialchars($row['Entidad_Nombre']) . "</h5>
                                <p class='card-text'><strong>Clasificación:</strong> " . htmlspecialchars($row['clasificacion_tipo']) . "</p>
                                <p class='card-text'><strong>Rama de Acción:</strong> " . htmlspecialchars($row['rama_accion']) . "</p>
                                <p class='card-text'><strong>Provincia:</strong> " . htmlspecialchars($row['provincia']) . "</p>
                            </div>
                        </div>
                    </div>
                ";
            }
        } else {
            echo "<p class='text-center text-muted'>No se encontraron detalles para las entidades.</p>";
        }
        ?>
    </div>
</div>





</body>
</html>





    </div>
</div>

<!-- About End -->





<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary p-5">
    <div class="row g-5 justify-content-center">
    <!-- <div class="col-lg-4 col-md-6">
            <h3 class="text-white mb-4">CEOSSOLUCIONES S.A.S.</h3>
            <div class="d-flex justify-content-center">
                <img src="img/KELA.png" alt="Logo de la Empresa" class="img-fluid" style="max-width: 60%; height: auto;">
            </div>
        </div> -->
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