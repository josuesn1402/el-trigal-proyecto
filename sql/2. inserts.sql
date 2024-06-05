USE Almacenamiento;

-- Insertar datos en la tabla Usuario
INSERT INTO Usuario (username, contrasenia, correo, admin)
VALUES ('user1', '1234', 'usuario1@example.com', 0),
       ('user2', '1234', 'usuario2@example.com', 1);

-- Insertar datos en la tabla Producto
INSERT INTO Producto (nombre_producto, cantidad, descripcion, estado, Precio)
VALUES ('Producto A', 10, 'Descripción del producto A', 'Disponible', 100),
       ('Producto B', 15, 'Descripción del producto B', 'Disponible', 150);

-- Insertar datos en la tabla Turno
INSERT INTO Turno (Entrada, Salida)
VALUES ('08:00:00', '17:00:00'),
       ('09:00:00', '18:00:00');

-- Insertar datos en la tabla Rol
INSERT INTO Rol (descripcion)
VALUES ('Administrador'),
       ('Empleado');

-- Insertar datos en la tabla Personal
INSERT INTO Personal (nombre, apellidos, dni, correo, fecha_ingreso, sueldo, rol, id_turno, id_usuario, id_rol)
VALUES ('Juan', 'Perez', '12345678A', 'juan.perez@example.com', '2024-01-01 08:00:00', 2000, 'Administrador', 1, 1, 1),
       ('Maria', 'Lopez', '87654321B', 'maria.lopez@example.com', '2024-02-01 09:00:00', 1500, 'Empleado', 2, 2, 2);

-- Insertar datos en la tabla Movimiento
INSERT INTO Movimiento (id_producto, id_personal, tipo_movimiento, cantidad, estado, fecha, descuento)
VALUES (1, 1, 'ENTRADA', 5, 'Aceptado', '2024-06-01', 0),
       (2, 2, 'SALIDA', 3, 'Aceptado', '2024-06-02', 10);
