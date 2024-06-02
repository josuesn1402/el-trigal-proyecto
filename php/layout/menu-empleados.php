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
        <form action="submit_form.php" method="POST">
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
                  <label for="pais">Rol</label>
                  <select id="pais" name="pais" required>
                    <option value="">Seleccione un rol</option>
                    <option value="argentina">Argentina</option>
                    <option value="brasil">Brasil</option>
                    <option value="chile">Chile</option>
                    <option value="mexico">México</option>
                    <option value="peru">Perú</option>
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
                  <label for="departamento">Turno</label>
                  <select id="departamento" name="departamento" required>
                    <option value="">Seleccione un departamento</option>
                    <option value="ventas">Ventas</option>
                    <option value="marketing">Marketing</option>
                    <option value="rrhh">Recursos Humanos</option>
                    <option value="it">IT</option>
                    <option value="finanzas">Finanzas</option>
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
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Fecha de Registro</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Juan Pérez</td>
            <td>juan.perez@example.com</td>
            <td>2024-01-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
          <tr>
            <td>2</td>
            <td>María García</td>
            <td>maria.garcia@example.com</td>
            <td>2024-02-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
          <tr>
            <td>2</td>
            <td>María García</td>
            <td>maria.garcia@example.com</td>
            <td>2024-02-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
          <tr>
            <td>2</td>
            <td>María García</td>
            <td>maria.garcia@example.com</td>
            <td>2024-02-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
          <tr>
            <td>2</td>
            <td>María García</td>
            <td>maria.garcia@example.com</td>
            <td>2024-02-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
          <tr>
            <td>2</td>
            <td>María García</td>
            <td>maria.garcia@example.com</td>
            <td>2024-02-01</td>
            <td><a class="btn-editar" href="../layout/editar-empleados.php">✏️</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>