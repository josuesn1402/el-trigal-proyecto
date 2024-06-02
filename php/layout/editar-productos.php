<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../../css/menu.css">
    <link rel="stylesheet" href="../../css/menu-productos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include '../components/menu.php' ?>
    <section>
        <h2>Editar Productos</h2>
        <div class="productos-container">
            <form action="submit_product.php" method="POST">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="hidden" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="stock">Cantidad</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" id="price" name="price" min="0.01" step="0.01" required>
                </div>
                <button type="submit">Actualizar Producto</button>
            </form>
        </div>
    </section>
</body>

</html>