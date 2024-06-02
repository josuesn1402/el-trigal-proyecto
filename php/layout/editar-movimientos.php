<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu</title>
  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/menu-movimientos.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <?php include '../components/menu.php' ?>
  <section>
    <h2>Editar Movimientos</h2>
    <div class="productos-container">
      <form action="submit_product.php" method="POST">
        <div class="form-group">
          <label for="departamento">Turno</label>
          <select id="departamento" name="departamento" required>
            <option value="">Seleccione un producto</option>
            <option value="ventas">Ventas</option>
            <option value="marketing">Marketing</option>
            <option value="rrhh">Recursos Humanos</option>
            <option value="it">IT</option>
            <option value="finanzas">Finanzas</option>
          </select>
        </div>
        <div class="form-group">
          <label for="departamento">Turno</label>
          <select id="departamento" name="departamento" required>
            <option value="">Seleccione un empleado</option>
            <option value="ventas">Ventas</option>
            <option value="marketing">Marketing</option>
            <option value="rrhh">Recursos Humanos</option>
            <option value="it">IT</option>
            <option value="finanzas">Finanzas</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Tipo Movimiento</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha</label>
          <input type="date" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
          <label for="price">Descuento</label>
          <input type="number" id="price" name="price" min="0.01" step="0.01" required>
        </div>
        <button type="submit">Actualizar Movimiento</button>
      </form>
    </div>
  </section>
</body>

</html>