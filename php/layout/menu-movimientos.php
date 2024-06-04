<?php
// Archivo: list_movimientos.php

// Incluir archivo de conexión
include('../config/connection.php');

// Consulta para obtener datos de la tabla Movimiento con los nombres correspondientes
$query = "
SELECT
  Movimiento.id_recepcion,
  Producto.nombre_producto,
  Personal.nombre AS nombre_personal,
  Movimiento.tipo_movimiento,
  Movimiento.estado,
  Movimiento.fecha,
  Movimiento.descuento
FROM
  Movimiento
JOIN Producto ON Movimiento.id_producto = Producto.id_producto
JOIN Personal ON Movimiento.id_personal = Personal.id_personal
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-movimientos.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Registro de Movimientos</h2>
    <div class="productos-container">
      <form action="submit_product.php" method="POST">
        <div class="form-group">
          <label for="departamento">Turno</label>
          <select id="departamento" name="departamento" required>
            <option value="">Seleccione un producto</option>
            <option value="ventas">Ventas</option>
            <option value="marketing">Marketing</option>
            <option value="rrhh">Recursos Humanos</option>
            <option value="it">IT</option>
            <option value="finanzas">Finanzas</option>
          </select>
        </div>
        <div class="form-group">
          <label for="departamento">Turno</label>
          <select id="departamento" name="departamento" required>
            <option value="">Seleccione un empleado</option>
            <option value="ventas">Ventas</option>
            <option value="marketing">Marketing</option>
            <option value="rrhh">Recursos Humanos</option>
            <option value="it">IT</option>
            <option value="finanzas">Finanzas</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Tipo Movimiento</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
          <label for="price">Descuento</label>
          <input type="number" id="price" name="price" min="0.01" step="0.01" required>
        </div>
        <button type="submit">Guardar Movimiento</button>
      </form>
    </div>
    <div class="table-container">
      <table class="styled-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Personal</th>
            <th>Tipo de Movimiento</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Descuento</th>
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
              echo "<td>" . $row['id_recepcion'] . "</td>";
              echo "<td>" . $row['nombre_producto'] . "</td>";
              echo "<td>" . $row['nombre_personal'] . "</td>";
              echo "<td>" . $row['tipo_movimiento'] . "</td>";
              echo "<td>" . $row['estado'] . "</td>";
              echo "<td>" . $row['fecha'] . "</td>";
              echo "<td>" . $row['descuento'] . "</td>";
              echo "<td><a class='btn-editar' href='../layout/editar-movimientos.php?id=" . $row['id_recepcion'] . "'>✏️</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='8'>No hay datos disponibles</td></tr>";
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