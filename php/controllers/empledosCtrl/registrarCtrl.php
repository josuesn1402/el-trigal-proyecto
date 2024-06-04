<?php
// Incluir archivo de conexión
include ('../../config/connection.php');

// Verificar si el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Datos del usuario
  $usuario = $_POST['use'];
  $contrasena = $_POST['con'];
  $correo = $_POST['cor'];
  $es_administrador = isset($_POST['admin']) ? 1 : 0; // Si está marcado, es administrador, de lo contrario, no

  // Insertar usuario
  $query_insert_usuario = "INSERT INTO Usuario (username, contrasenia, correo, admin) 
                             VALUES ('$usuario', '$contrasena', '$correo', $es_administrador)";

  if ($conn->query($query_insert_usuario) === TRUE) {
    $id_usuario = $conn->insert_id;

    // Datos del empleado
    $nombre = $_POST['name'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_ingreso = $_POST['fecha'];
    $rol = $_POST['rol'];
    $sueldo = $_POST['sueldo'];
    $turno = $_POST['turno'];

    // Insertar empleado asociado al usuario
    $query_insert_empleado = "INSERT INTO Personal (nombre, apellidos, dni, correo, fecha_ingreso, sueldo, rol, id_turno, id_usuario, id_rol) 
                                  VALUES ('$nombre', '$apellido', '$dni', '$correo', '$fecha_ingreso', $sueldo, $rol, $turno, $id_usuario, $rol)";

    if ($conn->query($query_insert_empleado) === TRUE) {
      // Redireccionar al menú de empleados con un mensaje de éxito
      session_start();
      $_SESSION['message'] = "Empleado registrado correctamente.";
      header("Location: ../../layout/menu-empleados.php");
      exit(); // Asegura que el script se detenga después de la redirección
    } else {
      // Redireccionar al menú de empleados con un mensaje de error si falla la inserción de empleado
      session_start();
      $_SESSION['error'] = "Error al registrar empleado: " . $conn->error;
      header("Location: ../../layout/menu-empleados.php");
      exit();
    }
  } else {
    // Redireccionar al formulario de registro con un mensaje de error si falla la inserción de usuario
    session_start();
    $_SESSION['error'] = "Error al registrar usuario: " . $conn->error;
    header("Location: ../../layout/menu-empleados.php");
    exit();
  }
} else {
  // Redireccionar al formulario de registro si el método de solicitud no es POST
  header("Location: ../../layout/menu-empleados.php");
  exit();
}

// Cerrar conexión
$conn->close();
?>