<aside class="menu">
  <div class="menu-head">
    <a href="../layout/menu-inicio.php">
      <h1>El Trigal</h1>
    </a>
  </div>
  <p class="menu-title">Menu</p>
  <ul>
    <?php
    session_start();
    if (isset($_SESSION['admin'])) {
      echo '<li><a href="../layout/menu-productos.php"><img src="../../assets/svg/products-menu.svg" alt="">Productos</a></li>';
      echo '<li><a href="../layout/menu-movimientos.php"><img src="../../assets/svg/move-menu.svg" alt="">Movimientos</a></li>';

      if ($_SESSION['admin'] == 1) {
        echo '<li><a href="../layout/menu-empleados.php"><img src="../../assets/svg/users-menu.svg" alt="">Empleados</a></li>';
        echo '<li><a href="../layout/menu-turnos.php"><img src="../../assets/svg/shift-menu.svg" alt="">Turnos</a></li>';
        echo '<li><a href="../layout/menu-roles.php"><img src="../../assets/svg/rol-menu.svg" alt="">Rol</a></li>';
      }

      echo '<li><a href="../../index.php"><img src="../../assets/svg/back-door.svg" alt="">Salir</a></li>';
    } else {
      header("Location: ../../index.php");
      exit();
    }
    ?>
  </ul>
</aside>