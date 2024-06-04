<?php
// Aquí va el código PHP para manejar la lógica del inicio de sesión
session_start();
include ('../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validación de los datos y autenticación
  $query = "SELECT * FROM Usuario WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header("Location: php/layoutmenu-inicio.php");
    exit;
  } else {
    echo "Nombre de usuario o contraseña incorrectos.";
  }
}
?>