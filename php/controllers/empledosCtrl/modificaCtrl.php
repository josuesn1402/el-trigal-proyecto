<?php
// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del empleado
  $id_personal = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $dni = $_POST['dni'];
  $correo = $_POST['correo'];
  $fecha_ingreso = $_POST['fecha_ingreso'];
  $sueldo = $_POST['sueldo'];
  $id_rol = $_POST['id_rol'];
  $id_turno = $_POST['id_turno'];

  // Datos del usuario
  $id_usuario = $_POST['id_usuario'];
  $u_correo = $_POST['u_correo'];
  $nombre_usuario = $_POST['nombre_usuario'];
  $contrasena = $_POST['contrasena'];
  $es_administrador = isset($_POST['admin']) ? 1 : 0; // Si está marcado, es administrador, de lo contrario, no

  // Actualizar usuario
  $query_update_usuario = "UPDATE Usuario 
                           SET username = '$nombre_usuario', contrasenia = '$contrasena', correo = '$u_correo', admin = $es_administrador 
                           WHERE id = $id_usuario";

  if ($conn->query($query_update_usuario) === TRUE) {
    // Actualizar empleado
    $query_update_empleado = "UPDATE Personal 
                              SET nombre = '$nombre', apellidos = '$apellido', dni = '$dni', correo = '$correo', 
                                  fecha_ingreso = '$fecha_ingreso', sueldo = $sueldo, id_rol = $id_rol, id_turno = $id_turno 
                              WHERE id_personal = $id_personal";

    if ($conn->query($query_update_empleado) === TRUE) {
      // Redireccionar al menú de empleados con un mensaje de éxito
      session_start();
      $_SESSION['message'] = "Empleado actualizado correctamente.";
      header("Location: ../../layout/menu-empleados.php");
      exit(); // Asegura que el script se detenga después de la redirección
    } else {
      // Redireccionar al menú de empleados con un mensaje de error si falla la actualización del empleado
      session_start();
      $_SESSION['error'] = "Error al actualizar empleado: " . $conn->error;
      header("Location: ../../layout/menu-empleados.php");
      exit();
    }
  } else {
    // Redireccionar al formulario de edición con un mensaje de error si falla la actualización del usuario
    session_start();
    $_SESSION['error'] = "Error al actualizar usuario: " . $conn->error;
    header("Location: ../../layout/menu-empleados.php");
    exit();
  }
} else {
  // Redireccionar al formulario de edición si el método de solicitud no es POST
  header("Location: ../../layout/menu-empleados.php");
  exit();
}

// Cerrar conexión
$conn->close();
?>