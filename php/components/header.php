<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <header>
    <div class="header-left">
      <button id="toggleSidebar">
        <img src="../../assets/svg/bars-3.svg" alt="☰">
      </button>
    </div>
    <div class="profile">
      <?php
      session_start();
      if (isset($_SESSION['username'])) {
        echo '<span>' . $_SESSION['username'] . '</span>';
      } else {
        echo '<span>nombre</span>';
      }
      ?>
      <div>
        <img src="../../assets/svg/user-person-profile.svg" alt="perfil">
        <!-- <img src="../../assets/svg/arrow-down.svg" alt="abrir"> -->
      </div>
    </div>
  </header>
  <main>