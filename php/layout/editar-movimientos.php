<?php
// Archivo: editar-movimientos.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Verificar si se ha enviado un ID válido por GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Obtener el ID de movimiento
  $id_movimiento = $_GET['id'];

  // Consulta para obtener los datos del movimiento específico
  $query_movimiento = "SELECT M.*, P.cantidad AS cantidad_disponible 
                        FROM Movimiento M 
                        INNER JOIN Producto P ON M.id_producto = P.id_producto 
                        WHERE id_recepcion = $id_movimiento";
  $result_movimiento = $conn->query($query_movimiento);

  // Verificar si se encontró el movimiento
  if ($result_movimiento->num_rows > 0) {
    // Obtener los datos del movimiento
    $row_movimiento = $result_movimiento->fetch_assoc();

    // Obtener productos desde la base de datos
    $query_productos = "SELECT id_producto, nombre_producto FROM Producto";
    $result_productos = $conn->query($query_productos);

    // Obtener empleados desde la base de datos
    $query_empleados = "SELECT id_personal, CONCAT(nombre, ' ', apellidos) AS nombre_completo FROM Personal";
    $result_empleados = $conn->query($query_empleados);
  } else {
    // Redirigir si el movimiento no se encontró
    header("Location: list_movimientos.php");
    exit();
  }
} else {
  // Redirigir si no se ha proporcionado un ID válido
  header("Location: list_movimientos.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Movimientos</title>
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
    <h2>Editar Movimientos</h2>
    <div class="productos-container">
      <form id="editMovimientoForm" action="../controllers/movimientosCtrl/modificaCtrl.php" method="POST">
        <input type="hidden" id="id" name="id" value="<?php echo $row_movimiento['id_recepcion']; ?>" required>
        <div class="form-group">
          <label for="producto">Producto</label>
          <select id="producto" name="producto" required>
            <option value="">Seleccione un producto</option>
            <?php
            if ($result_productos->num_rows > 0) {
              while ($row_producto = $result_productos->fetch_assoc()) {
                $selected = ($row_producto['id_producto'] == $row_movimiento['id_producto']) ? 'selected' : '';
                echo "<option value='" . $row_producto['id_producto'] . "' $selected>" . $row_producto['nombre_producto'] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="cantidad_producto">Cantidad disponible del producto</label>
          <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" step="1"
            value="<?php echo $row_movimiento['cantidad_disponible']; ?>" disabled>
        </div>
        <div class="form-group">
          <label for="empleado">Empleado</label>
          <select id="empleado" name="empleado" required>
            <option value="">Seleccione un empleado</option>
            <?php
            if ($result_empleados->num_rows > 0) {
              while ($row_empleado = $result_empleados->fetch_assoc()) {
                $selected = ($row_empleado['id_personal'] == $row_movimiento['id_personal']) ? 'selected' : '';
                echo "<option value='" . $row_empleado['id_personal'] . "' $selected>" . $row_empleado['nombre_completo'] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <input type="hidden" id="tipo_movimiento_original" name="tipo_movimiento_original"
          value="<?php echo $row_movimiento['tipo_movimiento']; ?>" required>
        <div class="form-group">
          <label for="tipo_movimiento">Tipo de Movimiento</label>
          <select id="tipo_movimiento" name="tipo_movimiento" required>
            <option value="">Seleccione el tipo de movimiento</option>
            <option value="ENTRADA" <?php if ($row_movimiento['tipo_movimiento'] == 'ENTRADA')
              echo 'selected'; ?>>ENTRADA
            </option>
            <option value="SALIDA" <?php if ($row_movimiento['tipo_movimiento'] == 'SALIDA')
              echo 'selected'; ?>>SALIDA
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="cantidad">Cantidad</label>
          <input type="number" id="cantidad" name="cantidad" value="<?php echo $row_movimiento['cantidad']; ?>" min="1"
            step="1" required>
        </div>
        <input type="hidden" id="cantidad_mod_original" name="cantidad_mod_original"
          value="<?php echo $row_movimiento['cantidad']; ?>" min="1" step="1" required>
        <div class="form-group">
          <label for="estado">Estado</label>
          <select id="estado" name="estado" required>
            <option value="BUENO" <?php if ($row_movimiento['estado'] == 'BUENO')
              echo 'selected'; ?>>BUENO</option>
            <option value="DEFECTUOSO" <?php if ($row_movimiento['estado'] == 'DEFECTUOSO')
              echo 'selected'; ?>>DEFECTUOSO
            </option>
          </select>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input type="date" id="fecha" name="fecha" value="<?php echo $row_movimiento['fecha']; ?>" required>
        </div>
        <div class="form-group">
          <label for="price">Descuento</label>
          <input type="number" id="price" name="price" value="<?php echo $row_movimiento['descuento']; ?>" min="0"
            step="0.01" required>
        </div>
        <button type="submit" onclick="validarEdicion()">Actualizar Movimiento</button>
      </form>
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