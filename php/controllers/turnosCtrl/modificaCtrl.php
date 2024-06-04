<?php
session_start();
include ('../../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $entrada = $_POST['entrada'];
  $salida = $_POST['salida'];

  $query = "CALL EditarTurno(?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("iss", $id, $entrada, $salida);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Turno actualizado exitosamente.";
      header("Location: ../../layout/menu-turnos.php");
    } else {
      $_SESSION['error'] = "Error al actualizar el turno.";
      header("Location: ../../layout/menu-turnos.php");
    }
    $stmt->close();
  } else {
    $_SESSION['error'] = "Error al preparar la consulta.";
    header("Location: ../../layout/menu-turnos.php");
  }

  $conn->close();
} else {
  header("Location: ../../layout/menu-turnos.php");
}
?>