<?php
$host = 'localhost'; // Cambia esto si tu host es diferente
$database = 'ayudandoecuador1'; // Cambia esto por el nombre de tu base de datos
$username = 'root'; // Cambia esto por tu usuario de MySQL
$password = 'admin'; // Cambia esto por tu contraseña de MySQL

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>