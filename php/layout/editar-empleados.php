<?php
// Archivo: editar-empleados.php

// Incluir archivo de conexión
include ('../config/connection.php');

// Consulta para obtener roles desde la base de datos
$query_roles = "SELECT * FROM Rol";
$result_roles = $conn->query($query_roles);

// Consulta para obtener turnos desde la base de datos
$query_turnos = "SELECT * FROM Turno";
$result_turnos = $conn->query($query_turnos);

// Verificar si se recibe un ID válido por parámetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
  // Obtener el ID del empleado desde el parámetro GET
  $id_empleado = $_GET['id'];

  // Consulta para obtener los datos del empleado con el ID proporcionado
  $query_empleado = "SELECT
    p.id_personal,
    p.nombre,
    p.apellidos,
    p.dni,
    p.correo,
    p.fecha_ingreso,
    p.sueldo,
    p.id_rol,
    p.id_turno,
    u.id AS id_usuario,
    u.username AS nombre_usuario,
    u.contrasenia,
    u.admin
  FROM
    Personal p
    INNER JOIN Usuario u ON p.id_usuario = u.id
  WHERE
    p.id_personal = ?";

  if ($stmt = $conn->prepare($query_empleado)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontraron resultados
    if ($stmt->num_rows == 1) {
      // Vincular variables a los resultados de la consulta
      $stmt->bind_result($id_personal, $nombre, $apellido, $dni, $correo, $fecha_ingreso, $sueldo, $id_rol, $id_turno, $id_usuario, $nombre_usuario, $contrasenia, $admin);
      $stmt->fetch();
    } else {
      // No se encontró el empleado con el ID proporcionado
      echo "No se encontró el empleado.";
      exit(); // Finalizar la ejecución del script
    }

    // Cerrar la consulta preparada
    $stmt->close();
  } else {
    // Error al preparar la consulta
    echo "Error al preparar la consulta.";
    exit(); // Finalizar la ejecución del script
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
} else {
  // No se recibió un ID válido por parámetro GET
  echo "ID de empleado no válido.";
  exit(); // Finalizar la ejecución del script
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Empleado</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-empleados.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <div class="empleados-container">
      <h2>Editar Empleado</h2>
      <div class="empleados-form">
        <form action="../controllers/empleadosCtrl/modificaCtrl.php" method="POST">
          <div class="form-container">
            <div class="empleados">
              <div class="empleados-left">
                <input type="hidden" id="id" name="id" value="<?php echo $id_personal; ?>" required>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required>
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>" required>
                </div>
                <div class="form-group">
                  <label for="correo">Correo</label>
                  <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
                </div>
                <div class="form-group">
                  <label for="fecha_ingreso">Fecha Ingreso</label>
                  <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>"
                    required>
                </div>
                <div class="form-group">
                  <label for="sueldo">Sueldo</label>
                  <input type="number" id="sueldo" name="sueldo" value="<?php echo $sueldo; ?>" required>
                </div>
                <div class="form-group">
                  <label for="id_rol">Rol</label>
                  <select id="id_rol" name="id_rol" required>
                    <option value="">Seleccione un rol</option>
                    <?php
                    if ($result_roles->num_rows > 0) {
                      while ($row_rol = $result_roles->fetch_assoc()) {
                        if ($id_rol == $row_rol['id']) {
                          echo "<option value='" . $row_rol['id'] . "' selected>" . $row_rol['descripcion'] . "</option>";
                        } else {
                          echo "<option value='" . $row_rol['id'] . "'>" . $row_rol['descripcion'] . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="empleados-right">
                <div class="form-group">
                  <label for="id_turno">Turno</label>
                  <select id="id_turno" name="id_turno" required>
                    <option value="">Seleccione un turno</option>
                    <?php
                    if ($result_turnos->num_rows > 0) {
                      while ($row_turno = $result_turnos->fetch_assoc()) {
                        if ($id_turno == $row_turno['id']) {
                          echo "<option value='" . $row_turno['id'] . "' selected>" . $row_turno['Entrada'] . " - " . $row_turno['Salida'] . "</option>";
                        } else {
                          echo "<option value='" . $row_turno['id'] . "'>" . $row_turno['Entrada'] . " - " . $row_turno['Salida'] . "</option>";
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="usuarios-form">
              <div class="form-group">
                <label for="id_usuario">Usuario</label>
                <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>" required>
              </div>
              <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>"
                  required>
              </div>
              <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasenia; ?>" required>
              </div>
              <div class="form-group">
                <label for="admin">¿Es administrador?</label>
                <input type="checkbox" id="admin" name="admin" <?php if ($admin)
                  echo 'checked'; ?>>
              </div>
            </div>
            <button type="submit">Actualizar Empleado</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>