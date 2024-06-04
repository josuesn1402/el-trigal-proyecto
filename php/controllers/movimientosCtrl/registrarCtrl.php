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
  $estado = $_POST['estado'];
  $fecha = $_POST['fecha'];
  $descuento = $_POST['descuento'];

  // Preparar la consulta SQL para insertar los datos en la tabla Movimiento
  $query = "CALL CrearMovimiento(?, ?, ?, ?, ?, ?)
    ";

  // Preparar la declaración
  if ($stmt = $conn->prepare($query)) {
    // Vincular los parámetros
    $stmt->bind_param("iisssd", $producto, $empleado, $tipo_movimiento, $estado, $fecha, $descuento);

    // Ejecutar la declaración
    if ($stmt->execute()) {
      // Redirigir a la página de lista de movimientos con un mensaje de éxito
      header("Location: ../../layout/menu-movimientos.php?success=1");
    } else {
      // Redirigir a la página de lista de movimientos con un mensaje de error
      header("Location: ../../layout/menu-movimientos.php?error=1");
    }

    // Cerrar la declaración
    $stmt->close();
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
