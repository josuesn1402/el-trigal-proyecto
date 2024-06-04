<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../../css/menu.css">
    <link rel="stylesheet" href="../../css/menu-turnos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include '../components/menu.php' ?>
    <section>
        <h2>Editar Turnos</h2>
        <div class="productos-container">
            <form action="submit_product.php" method="POST">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="hidden" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="entrada">Entrada</label>
                    <input type="time" id="entrada" name="entrada" required>
                </div>
                <div class="form-group">
                    <label for="salida">Salida</label>
                    <input type="time" id="salida" name="salida" required>
                </div>
                <button type="submit">Actualizar Turno</button>
            </form>
        </div>
    </section>
</body>

</html>