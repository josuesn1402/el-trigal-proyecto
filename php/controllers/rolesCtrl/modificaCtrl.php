<?php
session_start();
include ('../../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $rol = $_POST['rol'];

  $query = "UPDATE Rol SET descripcion = ? WHERE id = ?";

  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("si", $rol, $id);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Rol actualizado exitosamente.";
      header("Location: ../../layout/menu-roles.php");
    } else {
      $_SESSION['error'] = "Error al actualizar el rol.";
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