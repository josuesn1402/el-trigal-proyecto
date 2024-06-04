<?php
// Incluir archivo de conexión
include ('../config/connection.php');

// Consulta para obtener datos de la tabla Personal, incluyendo las uniones necesarias para rol y turno
$query = "
SELECT 
    p.id_personal, 
    p.nombre, 
    p.apellidos, 
    p.dni, 
    p.correo, 
    p.fecha_ingreso, 
    p.sueldo, 
    r.descripcion AS rol, 
    t.Entrada, 
    t.Salida
FROM 
    Personal p
INNER JOIN 
    Rol r ON p.id_rol = r.id
INNER JOIN 
    Turno t ON p.id_turno = t.id";

$result = $conn->query($query);

// Consulta para obtener roles desde la base de datos
$query_roles = "SELECT * FROM Rol";
$result_roles = $conn->query($query_roles);

// Consulta para obtener turnos desde la base de datos
$query_turnos = "SELECT * FROM Turno";
$result_turnos = $conn->query($query_turnos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
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
      <h2>Registro de Empleado</h2>
      <div class="empleados-form">
        <form action="../controllers/empledosCtrl/registrarCtrl.php" method="POST">
          <div class="form-container">
            <div class="empleados">
              <div class="empleados-left">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" id="dni" name="dni" required>
                </div>
                <div class="form-group">
                  <label for="fecha">Fecha Ingreso</label>
                  <input type="date" id="fecha" name="fecha" required>
                </div>
                <div class="form-group">
                  <label for="rol">Rol</label>
                  <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    <?php
                    if ($result_roles->num_rows > 0) {
                      while ($row_rol = $result_roles->fetch_assoc()) {
                        echo "<option value='" . $row_rol['id'] . "'>" . $row_rol['descripcion'] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="empleados-right">
                <div class="form-group">
                  <label for="apellido">Apellido</label>
                  <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                  <label for="correo">Correo</label>
                  <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                  <label for="sueldo">Sueldo</label>
                  <input type="number" min="1" id="sueldo" name="sueldo" required>
                </div>
                <div class="form-group">
                  <label for="turno">Turno</label>
                  <select id="turno" name="turno" required>
                    <option value="">Seleccione un turno</option>
                    <?php
                    if ($result_turnos->num_rows > 0) {
                      while ($row_turno = $result_turnos->fetch_assoc()) {
                        echo "<option value='" . $row_turno['id'] . "'>" . $row_turno['Entrada'] . " - " . $row_turno['Salida'] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="usuarios-form">
              <div class="form-group">
                <label for="cor">Correo</label>
                <input type="email" id="cor" name="cor" required>
              </div>
              <div class="form-group">
                <label for="use">Usuario</label>
                <input type="text" id="use" name="use" required>
              </div>
              <div class="form-group">
                <label for="con">Contraseña</label>
                <input type="password" id="con" name="con" required>
              </div>
              <div class="form-group">
                <label for="admin"><input type="checkbox" id="admin" name="admin"> ¿Es administrador?</label>
              </div>
            </div>
          </div>
          <button type="submit">Registrar Empleado</button>
        </form>
      </div>

    </div>
    <div class="table-container">
      <table class="styled-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>DNI</th>
            <th>Correo Electrónico</th>
            <th>Fecha de Ingreso</th>
            <th>Rol</th>
            <th>Turno</th>
            <th>Sueldo</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Verificar si hay resultados
          if ($result->num_rows > 0) {
            // Recorrer y mostrar los datos
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['id_personal'] . "</td>";
              echo "<td>" . $row['nombre'] . " " . $row['apellidos'] . "</td>";
              echo "<td>" . $row['dni'] . "</td>";
              echo "<td>" . $row['correo'] . "</td>";
              echo "<td>" . $row['fecha_ingreso'] . "</td>";
              echo "<td>" . $row['rol'] . "</td>";
              echo "<td>" . $row['Entrada'] . " - " . $row['Salida'] . "</td>";
              echo "<td>" . $row['sueldo'] . "</td>";
              echo "<td><a class='btn-editar' href='../layout/editar-empleados.php?id=" . $row['id_personal'] . "'>✏️</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='9'>No hay datos disponibles</td></tr>";
          }
          // Cerrar conexión
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
