<?php
// Archivo: modificaCtrl.php

// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
  // Obtener el ID del movimiento a modificar
  $id_movimiento = $_POST['id'];

  // Obtener los nuevos datos del formulario
  $producto = $_POST['producto'];
  $empleado = $_POST['empleado'];
  $tipo_movimiento = $_POST['tipo_movimiento'];
  $estado = $_POST['estado'];
  $fecha = $_POST['fecha'];
  $descuento = $_POST['price'];

  // Preparar la consulta SQL para actualizar los datos en la tabla Movimiento
  $query = "CALL EditarMovimiento(?, ?, ?, ?, ?, ?, ?)
    ";

  // Preparar la declaración
  if ($stmt = $conn->prepare($query)) {
    // Vincular los parámetros
    $stmt->bind_param("iiisssd", $id_movimiento, $producto, $empleado, $tipo_movimiento, $estado, $fecha, $descuento);

    // Ejecutar la declaración
    if ($stmt->execute()) {
      // Redirigir a la página de lista de movimientos con un mensaje de éxito
      header("Location: ../../layout/menu-movimientos.php?success=2");
    } else {
      // Redirigir a la página de lista de movimientos con un mensaje de error
      header("Location: ../../layout/menu-movimientos.php?error=2");
    }

    // Cerrar la declaración
    $stmt->close();
  } else {
    // Redirigir a la página de lista de movimientos con un mensaje de error
    header("Location: ../../layout/menu-movimientos.php?error=2");
  }

  // Cerrar la conexión
  $conn->close();
} else {
  // Redirigir a la página de lista de movimientos si se accede al script directamente
  header("Location: ../../layout/menu-movimientos.php");
  exit();
}
?>