<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/style.css">
  <title>Login</title>
</head>

<body>
  <div class="login-container">
    <div class="login-left">
      <div class="illustration">
        <img src="../../assets/svg/undraw_secure_login.svg" alt="Illustration">
      </div>
      <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div class="login-right">
      <h2>Bienvenido</h2>
      <form action="../controllers/loginController.php" method="POST">
        <h3>Ingrese a su cuenta</h3>
        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar sesión</button>
        <div class="links">
          <a href="#">Crear cuenta</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>