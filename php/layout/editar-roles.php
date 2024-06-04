<?php
// Archivo: editar-roles.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Verificar si se recibe un ID válido por parámetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Obtener el ID del rol desde el parámetro GET
  $id_rol = $_GET['id'];

  // Consulta para obtener los datos del rol con el ID proporcionado
  $query = "SELECT id, descripcion FROM Rol WHERE id = ?";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $id_rol);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontraron resultados
    if ($stmt->num_rows == 1) {
      // Vincular variables a los resultados de la consulta
      $stmt->bind_result($id, $descripcion);
      $stmt->fetch();
    } else {
      // No se encontró el rol con el ID proporcionado
      echo "No se encontró el rol.";
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
  echo "ID de rol no válido.";
  exit(); // Finalizar la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Roles</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-roles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Editar Roles</h2>
    <div class="productos-container">
      <!-- Formulario para editar el rol -->
      <form action="../controllers/rolesCtrl/modificaCtrl.php" method="POST">
        <div class="form-group">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" required>
        </div>
        <div class="form-group">
          <label for="rol">Descripción</label>
          <input type="text" id="rol" name="rol" value="<?php echo $descripcion; ?>" required>
        </div>
        <button type="submit">Actualizar Rol</button>
      </form>
    </div>
  </section>
</body>

</html>