<?php
session_start();
include ('../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validación de los datos y autenticación
  $query = "SELECT * FROM Usuario WHERE username = '$username' AND contrasenia = '$password'";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    header("Location: ../layout/menu-inicio.php");
    exit;
  } else {
    header("Location: ../../index.php?error=credenciales");
    exit;
  }
}
?>