<?php
session_start();
include ('../config/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = $conn->prepare("SELECT * FROM Usuario WHERE username = ? AND contrasenia = ?");
  $query->bind_param("ss", $username, $password);
  $query->execute();
  $result = $query->get_result();

  if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    header("Location: ../layout/menu-inicio.php");
    exit;
  } else {
    header("Location: ../../index.php?error=credenciales");
    exit;
  }
}
?>