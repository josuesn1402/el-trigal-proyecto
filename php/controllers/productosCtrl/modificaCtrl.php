<?php
session_start();
include ('../../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $stock = $_POST['stock'];
  $descripcion = $_POST['descripcion'];
  $estado = $_POST['estado'];
  $precio = $_POST['price'];

  $query = "CALL EditarProducto(?, ?, ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("issssi", $id, $nombre, $stock, $descripcion, $estado, $precio);
    if ($stmt->execute()) {
      $_SESSION['message'] = "Producto actualizado exitosamente.";
      header("Location: ../../layout/menu-productos.php");
    } else {
      $_SESSION['error'] = "Error al actualizar el producto.";
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