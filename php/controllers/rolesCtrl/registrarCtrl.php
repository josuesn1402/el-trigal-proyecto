<?php
session_start();
include ('../../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rol = $_POST['rol'];

  $query = "INSERT INTO Rol (descripcion) VALUES (?)";

  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("s", $rol);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Rol registrado exitosamente.";
      header("Location: ../../layout/menu-roles.php");
    } else {
      $_SESSION['error'] = "Error al registrar el rol.";
      header("Location: ../../layout/menu-roles.php");
    }
    $stmt->close();
  } else {
    $_SESSION['error'] = "Error al preparar la consulta.";
    header("Location: ../../layout/menu-roles.php");
  }

  $conn->close();
} else {
  header("Location: ../../layout/menu-roles.php");
}
?>