<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CONSULT - Consultancy Website Template</title>
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
                    <a class="text-body py-2 pe-3 border-end"><small></small></a>
                    
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
        <span class="text-blue">Ayudando</span> 
        <span class="text-primary">Ecuador</span>
    </h1>
</a>

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


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase">Ayudando Ecuador</h5>
                            <h1 class="display-1 text-white mb-md-4">Unidos por el Bienestar de Todos</h1>
                            <p class="text-white">Conectamos a las entidades que necesitan ayuda con quienes desean contribuir.</p>
                            <p class="text-white">Tu apoyo puede marcar la diferencia en la vida de muchos.</p>
                            <a href="entidades.php" class="btn btn-primary py-md-3 px-md-5 me-3 rounded-pill">Ver Entidades</a>
                            <a href="service.php" class="btn btn-secondary py-md-3 px-md-5 rounded-pill">Registrate</a>
                        </div>

                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="text-white text-uppercase">Cada acción cuenta: juntos podemos ofrecer esperanza y ayuda a quienes más lo necesitan.</h5>
                                <h4 class="display-1 text-white mb-md-4">Cada Mano Cuenta</h4>
                                <a href="entidades.php" class="btn btn-primary py-md-3 px-md-5 me-3 rounded-pill">Ver Entidades</a>
                                <a href="service.php" class="btn btn-secondary py-md-3 px-md-5 rounded-pill">Registrate</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid bg-secondary p-0">
        <div class="row g-0">
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Bienvenido a Ayudando <span class="text-primary">Ecuador</span></h1>
                <h4 class="text-primary mb-4">En Ayudando Ecuador, nuestra misión es conectar a quienes necesitan ayuda con aquellos dispuestos a ofrecerla. Creemos en un Ecuador solidario, donde cada acción cuenta y cada mano puede hacer la diferencia.</h4>
                <p class="mb-4">Nos enfocamos en brindar apoyo a refugios de animales, personas mayores, y comunidades afectadas por desastres naturales. A través de nuestra plataforma, puedes encontrar diversas entidades que requieren ayuda y formas en las que tú puedes contribuir.</p>
                <a href="" class="btn btn-primary py-md-3 px-md-5 rounded-pill">Ver Entidades</a>
            </div>
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column justify-content-center bg-primary p-5">
                    <div class="d-flex text-white mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-paw fs-4"></i> <!-- Icono de mascotas -->
                        </div>
                        <div class="ps-4">
                            <h3>Apoyo a Refugios de Animales</h3>
                            <p class="mb-0">Brindamos asistencia a refugios de animales que luchan por ofrecer un hogar seguro y amoroso a mascotas necesitadas.</p>
                        </div>
                    </div>
                    <div class="d-flex text-white mb-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-user fs-4"></i> <!-- Icono de personas -->
                        </div>
                        <div class="ps-4">
                            <h3>Asistencia a Personas Mayores</h3>
                            <p class="mb-0">Apoyamos a las personas mayores en nuestra comunidad, proporcionando recursos y asistencia para mejorar su calidad de vida.</p>
                        </div>
                    </div>
                    <div class="d-flex text-white">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-umbrella fs-4"></i> <!-- Icono de desastres -->
                        </div>
                        <div class="ps-4">
                            <h3>Ayuda en Desastres Naturales</h3>
                            <p class="mb-0">Estamos comprometidos en ayudar a las comunidades afectadas por desastres naturales, proporcionando asistencia y recursos necesarios para la recuperación.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    <div class="container-fluid pt-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">"Juntos podemos construir un Ecuador más fuerte y solidario."</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-map-marker-alt fa-2x"></i> <!-- Icono para ubicación -->
                    </div>
                    <h3 class="mb-3">Ubicaciones de Entidades</h3>
                    <p class="mb-0">Encuentra la ubicación de diversas entidades que ofrecen ayuda en Ecuador. Te proporcionamos mapas y direcciones para que puedas visitarlas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-phone-alt fa-2x"></i> <!-- Icono para contacto -->
                    </div>
                    <h3 class="mb-3">Contactos de Entidades</h3>
                    <p class="mb-0">Proporcionamos información de contacto, incluyendo números de teléfono y correos electrónicos, para que puedas comunicarte fácilmente con las organizaciones que ayudan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-info-circle fa-2x"></i> <!-- Icono para información -->
                    </div>
                    <h3 class="mb-3">Información sobre Servicios</h3>
                    <p class="mb-0">Descubre los diferentes servicios que ofrecen las entidades, desde asistencia médica hasta apoyo educativo, y cómo acceder a ellos.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-users fa-2x"></i> <!-- Icono para comunidad -->
                    </div>
                    <h3 class="mb-3">Conoce a la Comunidad</h3>
                    <p class="mb-0">Infórmate sobre las personas detrás de las entidades que ayudan y cómo puedes involucrarte o apoyarlas en su labor.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-calendar-alt fa-2x"></i> <!-- Icono para eventos -->
                    </div>
                    <h3 class="mb-3">Eventos y Actividades</h3>
                    <p class="mb-0">Mantente al tanto de eventos y actividades organizadas por entidades de ayuda, donde puedes participar y contribuir.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <i class="fa fa-heart fa-2x"></i> <!-- Icono para donaciones -->
                    </div>
                    <h3 class="mb-3">Cómo Ayudar</h3>
                    <p class="mb-0">Información sobre cómo puedes colaborar con las entidades, ya sea a través de donaciones, voluntariado o apoyo en sus actividades.</p>
                </div>
            </div>

        </div>
    </div>
    <!-- Services End -->


    <!-- Features Start -->

    <!-- Features Start -->


    <!-- Quote Start -->

    <!-- Quote End -->


    <!-- Team Start -->

    <!-- Team End -->


    <!-- Testimonial Start -->

    <!-- Testimonial End -->


    <!-- Blog Start -->

    <!-- Blog End -->


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
    <p class="m-0">&copy; <a class="text-secondary border-bottom" href="#">AyudandoEcuador</a>. Todos los Derechos Reservados. Diseñado por <a class="text-secondary border-bottom" href="">KELA IT CONSULTING</a></p>
</div>

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