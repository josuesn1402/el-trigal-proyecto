<?php
session_start();
include ('../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Consulta para verificar las credenciales del usuario y obtener su rol
  $query = "SELECT id, admin FROM Usuario WHERE username = ? AND contrasenia = ?";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $stmt->bind_result($id_usuario, $admin);
      $stmt->fetch();

      // Iniciar la sesión y guardar los datos del usuario
      $_SESSION['id'] = $id_usuario;
      $_SESSION['username'] = $username;
      $_SESSION['admin'] = $admin;

      // Redirigir al menú principal
      header("Location: ../layout/menu-inicio.php");
      exit();
    } else {
      // Credenciales incorrectas
      header("Location: ../../index.php?error=credenciales");
      exit();
    }

    $stmt->close();
  } else {
    // Error en la consulta
    header("Location: ../../index.php?error=credenciales");
    exit();
  }

  $conn->close();
} else {
  // Redirigir si se accede al script directamente
  header("Location: ../../index.php");
  exit();
}
?>