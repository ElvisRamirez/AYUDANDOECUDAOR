<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['id_usuario'])) {
        die("Usuario no autenticado");
    }

    $id_usuario = $_SESSION['id_usuario'];
    
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', 'admin', 'ayudandoecuador1');
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recuperar y validar datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $tipo_cuenta = $_POST['tipo_cuenta'] ?? '';
    $cuentas_bancarias = $_POST['cuentas_bancarias'] ?? '';
    $tipo_red = $_POST['tipo_red'] ?? '';
    $links = $_POST['links'] ?? '';
    $representante = $_POST['representante'] ?? '';
    $entidad_descripcion = $_POST['entidad_descripcion'] ?? '';

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // 1. Actualizar tabla Usuarios
        $sql = "UPDATE Usuarios SET Nombre = ?, Apellido = ?, correo = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $apellido, $correo, $id_usuario);
        $stmt->execute();
        $stmt->close();

        // 2. Obtener id_datos del usuario
        $sql = "SELECT id_datos FROM Datos WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $id_datos = $row['id_datos'];
        $stmt->close();

        // 3. Actualizar tabla Telefonos
        $sql = "UPDATE Telefonos SET telefono = ? WHERE id_datos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $telefono, $id_datos);
        $stmt->execute();
        $stmt->close();

        // 4. Actualizar datos_adicionales (cuentas bancarias)
        $sql = "UPDATE datos_adicionales SET tipo_cuenta = ?, cuentas_bancarias = ? WHERE id_dato = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $tipo_cuenta, $cuentas_bancarias, $id_datos);
        $stmt->execute();
        $stmt->close();

        // 5. Actualizar redes_sociales (CORREGIDO: tipo_red en lugar de tipo)
        $sql = "UPDATE redes_sociales SET tipo_red = ?, links = ? WHERE id_datos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $tipo_red, $links, $id_datos);
        $stmt->execute();
        $stmt->close();

        // 6. Actualizar Entidad
        $sql = "UPDATE Entidad SET representante = ?, descripcion = ? WHERE id_dato = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $representante, $entidad_descripcion, $id_datos);
        $stmt->execute();
        $stmt->close();

        // 7. Manejar la subida de la imagen
        if (isset($_FILES['foto_ruta']) && $_FILES['foto_ruta']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['foto_ruta']['name'];
            $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($filetype, $allowed)) {
                // Crear directorio si no existe
                $upload_dir = 'uploads/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generar nombre único
                $newname = uniqid() . '_' . $id_usuario . '.' . $filetype;
                $upload_path = $upload_dir . $newname;
                
                // Mover archivo
                if (move_uploaded_file($_FILES['foto_ruta']['tmp_name'], $upload_path)) {
                    // Borrar foto anterior si existe
                    $sql = "SELECT foto_ruta FROM fotos WHERE id_dato = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_datos);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($row = $result->fetch_assoc()) {
                        if (file_exists($row['foto_ruta'])) {
                            unlink($row['foto_ruta']);
                        }
                    }
                    $stmt->close();

                    // Actualizar ruta en base de datos
                    $sql = "UPDATE fotos SET foto_ruta = ? WHERE id_dato = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $upload_path, $id_datos);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }

        // Confirmar transacción
        $conn->commit();
        
        // Redirigir con mensaje de éxito
        header("Location: dashboard.php?mensaje=Datos actualizados correctamente");
        exit();

    } catch (Exception $e) {
        // Revertir cambios si hay error
        $conn->rollback();
        die("Error: " . $e->getMessage());
    } finally {
        $conn->close();
    }
}
?>