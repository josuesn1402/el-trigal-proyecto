<?php
// Archivo: list_productos.php

// Incluir archivo de conexión
include('../config/connection.php');

// Consulta para obtener datos de la tabla Producto
$query = "SELECT id_producto, nombre_producto, cantidad, descripcion, estado, Precio FROM Producto";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-productos.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Registro de Productos</h2>
    <div class="productos-container">
      <form action="submit_product.php" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre del Producto</label>
          <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label for="stock">Cantidad</label>
          <input type="number" id="stock" name="stock" min="0" required>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label for="price">Precio</label>
          <input type="number" id="price" name="price" min="0.01" step="0.01" required>
        </div>
        <button type="submit">Guardar Producto</button>
      </form>
    </div>
    <div class="table-container">
      <table class="styled-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Precio</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Verificar si hay resultados
          if ($result->num_rows > 0) {
            // Recorrer y mostrar los datos
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['id_producto'] . "</td>";
              echo "<td>" . $row['nombre_producto'] . "</td>";
              echo "<td>" . $row['cantidad'] . "</td>";
              echo "<td>" . $row['descripcion'] . "</td>";
              echo "<td>" . $row['estado'] . "</td>";
              echo "<td>" . $row['Precio'] . "</td>";
              echo "<td><a class='btn-editar' href='../layout/editar-producto.php?id=" . $row['id_producto'] . "'>✏️</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='7'>No hay datos disponibles</td></tr>";
          }
          // Cerrar conexión
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>