<?php
// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si se recibió el parámetro producto en la URL
if (isset($_GET['producto'])) {
  $productoId = $_GET['producto'];

  // Consulta para obtener la cantidad disponible del producto
  $query = "SELECT cantidad FROM Producto WHERE id_producto = ?";
  if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $productoId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se obtuvo un resultado válido
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $cantidadDisponible = $row['cantidad'];
      echo $cantidadDisponible; // Devolver la cantidad disponible como respuesta
    } else {
      echo "0"; // Si no se encontró el producto, devolver 0 como respuesta
    }

    // Cerrar la consulta
    $stmt->close();
  } else {
    echo "0"; // Si hubo un error en la preparación de la consulta, devolver 0 como respuesta
  }
} else {
  echo "0"; // Si no se recibió el parámetro producto, devolver 0 como respuesta
}

// Cerrar la conexión
$conn->close();
?>