
<?php
session_start();
include 'db.php'; // Asegúrate de que este archivo establece una conexión mysqli

// Función para mostrar mensajes de alerta
function mostrarAlerta($mensaje, $tipo) {
    echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
            $mensaje
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}

// Lógica para Iniciar Sesión
if (isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    // Buscar usuario por correo electrónico
    $stmt = $conn->prepare("SELECT id_usuario, contrasenia FROM Usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['contrasenia'];
        
        // Verificar contraseña
        if (password_verify($contrasenia, $hashed_password)) {
            $_SESSION['id_usuario'] = $row['id_usuario'];
            mostrarAlerta('Inicio de sesión exitoso. Bienvenido a tu dashboard.', 'success');
            header("Location: dashboard.php");
            exit();
        } else {
            mostrarAlerta('Contraseña incorrecta. Inténtalo de nuevo.', 'danger');
        }
    } else {
        mostrarAlerta('No se encontró una cuenta con ese correo.', 'danger');
    }
}

// Lógica para Registro
if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    $contrasenia_confirm = $_POST['contrasenia_confirm'];

    if ($contrasenia !== $contrasenia_confirm) {
        mostrarAlerta('Las contraseñas no coinciden.', 'danger');
    } else {
        $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);

        $conn->autocommit(FALSE); // Desactivar autocommit

        try {
            // Insertar en la tabla Usuarios
            $stmt = $conn->prepare("INSERT INTO Usuarios (Nombre, Apellido, correo, contrasenia) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nombre, $apellido, $correo, $hashed_password);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al insertar en la tabla Usuarios: " . $stmt->error);
            }
            
            // Obtener el id del usuario insertado
            $id_usuario = $conn->insert_id;

            $conn->commit(); // Confirmar la transacción

            // Establecer la sesión con el id_usuario
            $_SESSION['id_usuario'] = $id_usuario;
            mostrarAlerta('Registro exitoso. Bienvenido a tu dashboard.', 'success');
            header("Location: dashboard.php");
            exit();

        } catch (Exception $e) {
            $conn->rollback(); // Revertir cambios en caso de error
            if ($conn->errno == 1062) {
                mostrarAlerta('El correo ya está registrado. Por favor, intenta con otro correo.', 'danger');
            } else {
                mostrarAlerta('Error al registrar: ' . $e->getMessage(), 'danger');
            }
        } finally {
            $conn->autocommit(TRUE); // Volver a activar autocommit
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AYUDANDO ECUADOR ONLINE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-k6RqeWeci5ZR/Lv4MR0sA0FfDOM3Qn6W0vGkOo5Gq6Zp9zTZ0RSl/+hWAcsyU2F4WQd+Ue4BBKZ8TkV9Yf1j2g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0 fixed-top">
    <h1 class="m-0 text-uppercase">
        <i class="fas fa-hands-helping text-warning me-2"></i> <!-- Ícono de manos de ayuda -->
        <span class="text-blue">Ayudando</span>
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


<!-- Page Header Start -->
<!-- <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Services</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Services</a>
            </div>
        </div>
    </div> -->
<!-- Page Header End -->


<!-- Services Start -->
<div class="container-fluid py-6 px-5">
    <div class="container mt-5">
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipo_mensaje; ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensaje); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <h2 class="text-center">Registro / Iniciar Sesión</h2>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <!-- Mensajes de error o éxito -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php elseif (isset($success)): ?>
                            <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
                        <?php endif; ?>

                        <!-- Selector de formulario -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="register-tab" data-bs-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Registro</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="login-tab" data-bs-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Iniciar Sesión</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="" method="post" class="mt-5">
                                    <h2>Registrarse</h2>
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo_reg" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="correo_reg" name="correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contrasenia_reg" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasenia_reg" name="contrasenia" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contrasenia_confirm" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" class="form-control" id="contrasenia_confirm" name="contrasenia_confirm" required>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-success">Registrarse</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <form action="" method="post">
                                    <h2>Iniciar Sesión</h2>
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contrasenia" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary">Iniciar Sesión</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</div>
<!-- Services End -->


<!-- Quote Start -->

<!-- Quote End -->


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