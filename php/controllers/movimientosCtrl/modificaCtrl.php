<?php
// Archivo: modificarCtrl.php

// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener los datos del formulario
  $id_movimiento = $_POST['id'];
  $producto = $_POST['producto'];
  $empleado = $_POST['empleado'];
  $tipo_movimiento = $_POST['tipo_movimiento'];
  $cantidad = $_POST['cantidad'];
  $estado = $_POST['estado'];
  $fecha = $_POST['fecha'];
  $descuento = $_POST['price'];
  $tipo_movimiento_original = $_POST['tipo_movimiento_original'];

  // Obtener la cantidad actual del producto
  $query_cantidad_producto = "SELECT cantidad FROM Producto WHERE id_producto = ?";
  if ($stmt_cantidad_producto = $conn->prepare($query_cantidad_producto)) {
    $stmt_cantidad_producto->bind_param("i", $producto);
    $stmt_cantidad_producto->execute();
    $result_cantidad_producto = $stmt_cantidad_producto->get_result();

    if ($result_cantidad_producto->num_rows > 0) {
      $row_cantidad_producto = $result_cantidad_producto->fetch_assoc();
      $cantidad_disponible = $row_cantidad_producto['cantidad'];

      // Obtener la cantidad original del movimiento
      $query_cantidad_movimiento = "SELECT cantidad FROM Movimiento WHERE id_recepcion = ?";
      if ($stmt_cantidad_movimiento = $conn->prepare($query_cantidad_movimiento)) {
        $stmt_cantidad_movimiento->bind_param("i", $id_movimiento);
        $stmt_cantidad_movimiento->execute();
        $result_cantidad_movimiento = $stmt_cantidad_movimiento->get_result();

        if ($result_cantidad_movimiento->num_rows > 0) {
          $row_cantidad_movimiento = $result_cantidad_movimiento->fetch_assoc();
          $cantidad_mod_original = $row_cantidad_movimiento['cantidad'];

          // Calcular el stock del producto antes de la actualización
          if ($tipo_movimiento_original == 'ENTRADA') {
            $nuevo_stock = $cantidad_disponible - $cantidad_mod_original;
          } else if ($tipo_movimiento_original == 'SALIDA') {
            $nuevo_stock = $cantidad_disponible + $cantidad_mod_original;
          }

          // Calcular el nuevo stock del producto dependiendo del nuevo tipo de movimiento
          if ($tipo_movimiento == 'ENTRADA') {
            $nuevo_stock += $cantidad;
          } else if ($tipo_movimiento == 'SALIDA') {
            if ($cantidad > $nuevo_stock) {
              echo "<script>alert('La cantidad de salida es mayor que la cantidad disponible');</script>";
              header("Location: ../../layout/menu-movimientos.php");
              exit();
            }
            $nuevo_stock -= $cantidad;
          }

          // Actualizar el stock del producto en la base de datos
          $query_update_stock = "UPDATE Producto SET cantidad = ? WHERE id_producto = ?";
          if ($stmt_update_stock = $conn->prepare($query_update_stock)) {
            $stmt_update_stock->bind_param("ii", $nuevo_stock, $producto);
            $stmt_update_stock->execute();
            $stmt_update_stock->close();

            // Preparar la consulta SQL para actualizar los datos en la tabla Movimiento
            $query_update_movimiento = "UPDATE Movimiento SET id_producto = ?, id_personal = ?, tipo_movimiento = ?, cantidad = ?, estado = ?, fecha = ?, descuento = ? WHERE id_recepcion = ?";
            if ($stmt_update_movimiento = $conn->prepare($query_update_movimiento)) {
              // Vincular los parámetros
              $stmt_update_movimiento->bind_param("iissssdi", $producto, $empleado, $tipo_movimiento, $cantidad, $estado, $fecha, $descuento, $id_movimiento);

              // Ejecutar la declaración
              if ($stmt_update_movimiento->execute()) {
                // Redirigir a la página de lista de movimientos con un mensaje de éxito
                header("Location: ../../layout/menu-movimientos.php?success=1");
              } else {
                // Redirigir a la página de lista de movimientos con un mensaje de error
                header("Location: ../../layout/menu-movimientos.php?error=1");
              }

              // Cerrar la declaración
              $stmt_update_movimiento->close();
            } else {
              // Redirigir a la página de lista de movimientos con un mensaje de error
              header("Location: ../../layout/menu-movimientos.php?error=1");
            }
          } else {
            // Redirigir a la página de lista de movimientos con un mensaje de error
            header("Location: ../../layout/menu-movimientos.php?error=1");
          }
        } else {
          // Redirigir a la página de lista de movimientos con un mensaje de error
          header("Location: ../../layout/menu-movimientos.php?error=1");
        }

        // Cerrar la declaración
        $stmt_cantidad_movimiento->close();
      } else {
        // Redirigir a la página de lista de movimientos con un mensaje de error
        header("Location: ../../layout/menu-movimientos.php?error=1");
      }
    } else {
      // Redirigir a la página de lista de movimientos con un mensaje de error
      header("Location: ../../layout/menu-movimientos.php?error=1");
    }

    // Cerrar la declaración
    $stmt_cantidad_producto->close();
  } else {
    // Redirigir a la página de lista de movimientos con un mensaje de error
    header("Location: ../../layout/menu-movimientos.php?error=1");
  }

  // Cerrar la conexión
  $conn->close();
} else {
  // Redirigir a la página de lista de movimientos si se accede al script directamente
  header("Location: ../../layout/menu-movimientos.php");
  exit();
}
?>