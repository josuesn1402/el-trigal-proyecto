<?php
// Archivo: registrarCtrl.php

// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtener los datos del formulario
  $producto = $_POST['producto'];
  $empleado = $_POST['empleado'];
  $tipo_movimiento = $_POST['tipo_movimiento'];
  $cantidad = $_POST['cantidad'];
  $estado = $_POST['estado'];
  $fecha = $_POST['fecha'];
  $descuento = $_POST['descuento'];

  // Obtener la cantidad actual del producto
  $query_cantidad_producto = "SELECT cantidad FROM Producto WHERE id_producto = ?";
  if ($stmt_cantidad_producto = $conn->prepare($query_cantidad_producto)) {
    $stmt_cantidad_producto->bind_param("i", $producto);
    $stmt_cantidad_producto->execute();
    $result_cantidad_producto = $stmt_cantidad_producto->get_result();

    // Verificar si se obtuvo un resultado válido
    if ($result_cantidad_producto->num_rows > 0) {
      $row_cantidad_producto = $result_cantidad_producto->fetch_assoc();
      $cantidad_disponible = $row_cantidad_producto['cantidad'];

      // Verificar si la cantidad de salida es menor o igual a la cantidad disponible
      if ($tipo_movimiento == 'SALIDA' && $cantidad > $cantidad_disponible) {
        // Mostrar alerta de cantidad insuficiente
        echo "<script>alert('La cantidad de salida es mayor que la cantidad disponible');</script>";
        // Redirigir a la página de lista de movimientos
        header("Location: ../../layout/menu-movimientos.php");
        exit();
      }

      // Calcular el nuevo stock del producto dependiendo del tipo de movimiento
      if ($tipo_movimiento == 'ENTRADA') {
        $nuevo_stock = $cantidad_disponible + $cantidad; // Sumar la cantidad ingresada al stock actual
      } else if ($tipo_movimiento == 'SALIDA') {
        $nuevo_stock = $cantidad_disponible - $cantidad; // Restar la cantidad ingresada al stock actual
      }

      // Actualizar el stock del producto en la base de datos
      $query_update_stock = "UPDATE Producto SET cantidad = ? WHERE id_producto = ?";
      if ($stmt_update_stock = $conn->prepare($query_update_stock)) {
        $stmt_update_stock->bind_param("ii", $nuevo_stock, $producto);
        $stmt_update_stock->execute();
        $stmt_update_stock->close();

        // Preparar la consulta SQL para insertar los datos en la tabla Movimiento
        $query_insert_movimiento = "CALL CrearMovimiento(?, ?, ?, ?, ?, ?, ?)";
        if ($stmt_insert_movimiento = $conn->prepare($query_insert_movimiento)) {
          // Vincular los parámetros
          $stmt_insert_movimiento->bind_param("iissssd", $producto, $empleado, $tipo_movimiento, $cantidad, $estado, $fecha, $descuento);
          ;

          // Ejecutar la declaración
          if ($stmt_insert_movimiento->execute()) {
            // Redirigir a la página de lista de movimientos con un mensaje de éxito
            header("Location: ../../layout/menu-movimientos.php?success=1");
          } else {
            // Redirigir a la página de lista de movimientos con un mensaje de error
            header("Location: ../../layout/menu-movimientos.php?error=1");
          }

          // Cerrar la declaración
          $stmt_insert_movimiento->close();
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