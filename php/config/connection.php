<?php
$servername = "localhost";
$username = "root";
$password = "root2024";
$database = "Almacenamiento";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>