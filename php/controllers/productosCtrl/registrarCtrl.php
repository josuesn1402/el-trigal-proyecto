<?php
session_start();
include ('../../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $stock = $_POST['stock'];
  $descripcion = $_POST['descripcion'];
  $estado = $_POST['estado'];
  $precio = $_POST['price'];

  $query = "CALL CrearProducto(?, ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("sisss", $nombre, $stock, $descripcion, $estado, $precio);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Producto registrado exitosamente.";
      header("Location: ../../layout/menu-productos.php");
    } else {
      $_SESSION['error'] = "Error al registrar el producto.";
      header("Location: ../../layout/menu-productos.php");
    }
    $stmt->close();
  } else {
    $_SESSION['error'] = "Error al preparar la consulta.";
    header("Location: ../../layout/menu-productos.php");
  }

  $conn->close();
} else {
  header("Location: ../../layout/menu-productos.php");
}
?>