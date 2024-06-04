<?php
// Archivo: list_movimientos.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Consulta para obtener datos de la tabla Movimiento con los nombres correspondientes
$query = "
SELECT
  Movimiento.id_recepcion,
  Producto.nombre_producto,
  CONCAT(Personal.nombre, ' ', Personal.apellidos) AS nombre_personal,
  Movimiento.tipo_movimiento,
  Movimiento.cantidad,
  Movimiento.estado,
  Movimiento.fecha,
  Movimiento.descuento
FROM
  Movimiento
JOIN Producto ON Movimiento.id_producto = Producto.id_producto
JOIN Personal ON Movimiento.id_personal = Personal.id_personal
ORDER BY Movimiento.fecha DESC
";
$result = $conn->query($query);

// Consulta para obtener productos desde la base de datos
$query_productos = "SELECT id_producto, nombre_producto FROM Producto";
$result_productos = $conn->query($query_productos);

// Consulta para obtener empleados desde la base de datos
$query_empleados = "SELECT id_personal, CONCAT(nombre, ' ', apellidos) AS nombre_completo FROM Personal";
$result_empleados = $conn->query($query_empleados);
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
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Registro de Movimientos</h2>
    <div class="productos-container">
      <form id="movimientoForm" action="../controllers/movimientosCtrl/registrarCtrl.php" method="POST">
        <div class="form-group">
          <label for="producto">Producto</label>
          <select id="producto" name="producto" required onchange="mostrarCantidadDisponible()">
            <option value="">Seleccione un producto</option>
            <?php
            if ($result_productos->num_rows > 0) {
              while ($row_producto = $result_productos->fetch_assoc()) {
                echo "<option value='" . $row_producto['id_producto'] . "'>" . $row_producto['nombre_producto'] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="cantidad_producto">Cantidad disponible del producto</label>
          <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" step="1" disabled>
        </div>
        <div class="form-group">
          <label for="empleado">Empleado</label>
          <select id="empleado" name="empleado" required>
            <option value="">Seleccione un empleado</option>
            <?php
            if ($result_empleados->num_rows > 0) {
              while ($row_empleado = $result_empleados->fetch_assoc()) {
                echo "<option value='" . $row_empleado['id_personal'] . "'>" . $row_empleado['nombre_completo'] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="tipo_movimiento">Tipo Movimiento</label>
          <select id="tipo_movimiento" name="tipo_movimiento" required>
            <option value="">Seleccione el tipo de movimiento</option>
            <option value="ENTRADA">ENTRADA</option>
            <option value="SALIDA">SALIDA</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cantidad">Cantidad</label>
          <input type="number" id="cantidad" name="cantidad" min="1" step="1" required>
        </div>
        <div class="form-group">
          <label for="estado">Estado</label>
          <select id="estado" name="estado" required>
            <option value="BUENO">BUENO</option>
            <option value="DEFECTUOSO">DEFECTUOSO</option>
          </select>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
          <label for="descuento">Descuento</label>
          <input type="number" id="descuento" name="descuento" min="0" step="0.50" value="0" required>
        </div>
        <button type="submit" onclick="validarCantidad()">Guardar Movimiento</button>
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
            <th>Cantidad</th>
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
              echo "<td>" . $row['cantidad'] . "</td>";
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

  <script>
    function validarCantidad() {
      var tipoMovimiento = document.getElementById('tipo_movimiento').value;

      // Si el tipo de movimiento es "SALIDA", entonces valida la cantidad disponible
      if (tipoMovimiento === 'SALIDA') {
        var cantidad = document.getElementById('cantidad').value;
        var cantidadDisponible = document.getElementById('cantidad_producto').value;

        if (cantidad === '') {
          alert('Por favor, ingresa una cantidad.');
          return false;
        }

        if (parseInt(cantidad) > parseInt(cantidadDisponible)) {
          alert('La cantidad seleccionada es mayor que la cantidad disponible del producto.');
          return false;
        }
      }

      return true; // Si todo está bien o si el tipo de movimiento es "ENTRADA", retorna true para enviar el formulario
    }

    function mostrarCantidadDisponible() {
      var productoSeleccionado = document.getElementById('producto').value;

      // Realizar una solicitud AJAX para obtener la cantidad disponible del producto
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var cantidadDisponible = xhr.responseText;
            document.getElementById('cantidad_producto').value = cantidadDisponible;
          } else {
            alert('No se pudo enviar la solicitud. Inténtalo de nuevo más tarde.');
          }
        }
      };
      xhr.open('GET', '../controllers/movimientosCtrl/obtenerCantidadDisponible.php?producto=' + productoSeleccionado, true);
      xhr.send();
    }
  </script>

</body>

</html>