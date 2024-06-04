<?php
// Archivo: editar-productos.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Verificar si se recibe un ID válido por parámetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Obtener el ID del producto desde el parámetro GET
  $id_producto = $_GET['id'];

  // Consulta para obtener los datos del producto con el ID proporcionado
  $query = "CALL ConsultarProducto(?)";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontraron resultados
    if ($stmt->num_rows == 1) {
      // Vincular variables a los resultados de la consulta
      $stmt->bind_result($id, $nombre, $stock, $descripcion, $estado, $precio);
      $stmt->fetch();
    } else {
      // No se encontró el producto con el ID proporcionado
      echo "No se encontró el producto.";
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
  echo "ID de producto no válido.";
  exit(); // Finalizar la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Productos</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-productos.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Editar Productos</h2>
    <div class="productos-container">
      <!-- Formulario para editar el producto -->
      <form action="../controllers/productosCtrl/modificaCtrl.php" method="POST">
        <div class="form-group">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" required>
        </div>
        <div class="form-group">
          <label for="nombre">Nombre del Producto</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="form-group">
          <label for="stock">Cantidad</label>
          <input type="number" id="stock" name="stock" value="<?php echo $stock; ?>" min="0" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $descripcion; ?></textarea>
        </div>
        <div class="form-group">
          <label for="estado">Estado</label>
          <select id="estado" name="estado" required>
            <option value="BUENO" selected>BUENO</option>
            <option value="DEFECTUOSO">DEFECTUOSO</option>
          </select>
        </div>
        <div class="form-group">
          <label for="price">Precio</label>
          <input type="number" id="price" name="price" value="<?php echo $precio; ?>" min="0.01" step="0.01" required>
        </div>
        <button type="submit">Actualizar Producto</button>
      </form>
    </div>
  </section>
</body>

</html>