-- INSERTS
INSERT INTO
  Usuario (username, contrasenia, correo, admin)
VALUES
  (
    'usuario1',
    'contraseña1',
    'usuario1@example.com',
    0
  );

INSERT INTO
  Usuario (username, contrasenia, correo, admin)
VALUES
  (
    'usuario2',
    'contraseña2',
    'usuario2@example.com',
    1
  );

INSERT INTO
  Producto (
    nombre_producto,
    cantidad,
    descripcion,
    estado,
    Precio
  )
VALUES
  (
    'Producto1',
    10,
    'Descripción del producto 1',
    'BUENO',
    200
  );

INSERT INTO
  Producto (
    nombre_producto,
    cantidad,
    descripcion,
    estado,
    Precio
  )
VALUES
  (
    'Producto2',
    20,
    'Descripción del producto 2',
    'DEFECTUOSO',
    100
  );

INSERT INTO
  Turno (Entrada, Salida)
VALUES
  ('06:00:00', '4:00:00');

INSERT INTO
  Turno (Entrada, Salida)
VALUES
  ('4:00:00', '00:00:00');

INSERT INTO
  Turno (Entrada, Salida)
VALUES
  ('00:00:00', '06:00:00');

INSERT INTO
  Rol (descripcion)
VALUES
  ('Administrador');

INSERT INTO
  Rol (descripcion)
VALUES
  ('Empleado');

INSERT INTO
  Personal (
    nombre,
    apellidos,
    dni,
    correo,
    fecha_ingreso,
    sueldo,
    rol,
    id_turno,
    id_usuario,
    id_rol
  )
VALUES
  (
    'Juan',
    'Pérez',
    '12345678A',
    'juan@example.com',
    '2024-05-01 08:00:00',
    1500,
    'Empleado',
    1,
    1,
    2
  );

INSERT INTO
  Personal (
    nombre,
    apellidos,
    dni,
    correo,
    fecha_ingreso,
    sueldo,
    rol,
    id_turno,
    id_usuario,
    id_rol
  )
VALUES
  (
    'María',
    'González',
    '87654321B',
    'maria@example.com',
    '2024-05-15 08:00:00',
    1800,
    'Administrador',
    2,
    2,
    1
  );

INSERT INTO
  Movimiento (
    id_producto,
    id_personal,
    tipo_movimiento,
    estado,
    fecha,
    descuento
  )
VALUES
  (1, 1, 'Entrada', 'Pendiente', '2024-05-01', 0);

INSERT INTO
  Movimiento (
    id_producto,
    id_personal,
    tipo_movimiento,
    estado,
    fecha,
    descuento
  )
VALUES
  (2, 2, 'Salida', 'Completo', '2024-05-15', 0);