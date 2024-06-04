<?php
session_start();
include ('../../config/connection.php');

// Verifica si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $entrada = $_POST['entrada'];
  $salida = $_POST['salida'];

  $query = "CALL CrearTurno(?, ?)";

  // Prepara y ejecuta la consulta con los datos proporcionados
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("ss", $entrada, $salida);
    if ($stmt->execute()) {
      // Redirecciona al menú de turnos con un mensaje de éxito
      $_SESSION['message'] = "Turno registrado exitosamente.";
      header("Location: ../../layout/menu-turnos.php");
    } else {
      // Muestra un mensaje de error en caso de fallo
      $_SESSION['error'] = "Error al registrar el turno.";
      header("Location: ../../layout/menu-turnos.php");
    }
    $stmt->close();
  } else {
    // Muestra un mensaje de error si la preparación de la consulta falla
    $_SESSION['error'] = "Error al preparar la consulta.";
    header("Location: ../../layout/menu-turnos.php");
  }

  // Cierra la conexión
  $conn->close();
} else {
  // Redirecciona al formulario de registro si el método de solicitud no es POST
  header("Location: ../../layout/menu-turnos.php");
}
?>