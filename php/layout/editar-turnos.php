<?php
// Archivo: editar-turnos.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Verificar si se recibe un ID válido por parámetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Obtener el ID del turno desde el parámetro GET
  $id_turno = $_GET['id'];

  // Consulta para obtener los datos del turno con el ID proporcionado
  $query = "CALL ConsultarTurno(?)";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $id_turno);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontraron resultados
    if ($stmt->num_rows == 1) {
      // Vincular variables a los resultados de la consulta
      $stmt->bind_result($id, $entrada, $salida);
      $stmt->fetch();
    } else {
      // No se encontró el turno con el ID proporcionado
      echo "No se encontró el turno.";
      exit(); // Finalizar la ejecución del script
    }

    // Cerrar la consulta preparada
    $stmt->close();
  } else {
    // Error al preparar la consulta
    echo "Error al preparar la consulta.";
    exit(); // Finalizar la ejecución del script
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
} else {
  // No se recibió un ID válido por parámetro GET
  echo "ID de turno no válido.";
  exit(); // Finalizar la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Turnos</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-turnos.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Editar Turnos</h2>
    <div class="productos-container">
      <!-- Formulario para editar el turno -->
      <form action="../controllers/turnosCtrl/modificaCtrl.php" method="POST">
        <div class="form-group">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" required>
          <!-- <input type="text" id="id_display" name="id_display" value="<?php echo $id; ?>" disabled> -->
        </div>
        <div class="form-group">
          <label for="entrada">Entrada</label>
          <input type="time" id="entrada" name="entrada" value="<?php echo $entrada; ?>" required>
        </div>
        <div class="form-group">
          <label for="salida">Salida</label>
          <input type="time" id="salida" name="salida" value="<?php echo $salida; ?>" required>
        </div>
        <button type="submit">Actualizar Turno</button>
      </form>
    </div>
  </section>
</body>

</html>