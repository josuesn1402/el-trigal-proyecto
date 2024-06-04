<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link href="css/styles.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <div class="login-container">
    <div class="login-left">
      <div class="login-title">
        <span>El Trigal</span>
        <p>Accede a tu gestión de almacén con facilidad y eficiencia</p>
      </div>
      <img src="assets/trigal-login.png" alt="">
    </div>
    <div class="login-right">
      <form action="php/acceso.php" method="POST">
        <div class="form-title">
          <h1>¡Hola de nuevo!</h1>
          <p>Bienvenido</p>
        </div>
        <input type="text" placeholder="Usuario" id="user" name="username">
        <input type="password" placeholder="Contraseña" id="pass" name="contrasena">
        <div class="form-buttons">
          <button class="form-login" type="submit">INGRESAR</button>
        </div>
      </form>

      <?php
      // Verificar si hay un mensaje de error
      if (isset($_GET['error']) && $_GET['error'] === 'credenciales') {
        echo "<p style='margin: 0;color: red; text-align: center; font-size: 14px; width: 75%;'>Las credenciales son incorrectas. Por favor, intenta nuevamente.</p>";
      }
      ?>
    </div>
  </div>
</body>

</html>