CREATE DATABASE Almacenamiento;

USE Almacenamiento;

-- TABLAS
CREATE TABLE
  Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    contrasenia VARCHAR(20),
    correo VARCHAR(20),
    admin TINYINT (1)
  );

CREATE TABLE
  Producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(50),
    cantidad INT,
    descripcion TEXT,
    estado VARCHAR(20),
    Precio INT
  );

CREATE TABLE
  Turno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Entrada TIME,
    Salida TIME
  );

CREATE TABLE
  Rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(20)
  );

CREATE TABLE
  Personal (
    id_personal INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    dni VARCHAR(50),
    correo VARCHAR(50),
    fecha_ingreso DATETIME,
    sueldo INT,
    rol VARCHAR(20),
    id_turno INT,
    id_usuario INT,
    id_rol INT,
    FOREIGN KEY (id_turno) REFERENCES Turno (id),
    FOREIGN KEY (id_usuario) REFERENCES Usuario (id),
    FOREIGN KEY (id_rol) REFERENCES Rol (id)
  );

CREATE TABLE
  Movimiento (
    id_recepcion INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_personal INT,
    tipo_movimiento VARCHAR(20),
    estado VARCHAR(20),
    fecha DATE,
    descuento INT,
    FOREIGN KEY (id_producto) REFERENCES Producto (id_producto),
    FOREIGN KEY (id_personal) REFERENCES Personal (id_personal)
  );

-- PROCEDIMIENTOS PARA PERSONAL
DELIMITER / / CREATE PROCEDURE CrearPersonal (
  IN nombre VARCHAR(50),
  IN apellidos VARCHAR(50),
  IN dni VARCHAR(50),
  IN correo VARCHAR(50),
  IN fecha_ingreso DATETIME,
  IN sueldo INT,
  IN rol VARCHAR(20),
  IN id_turno INT,
  IN id_usuario INT,
  IN id_rol INT
) BEGIN
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
  );

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE EditarPersonal (
  IN p_id_personal INT,
  IN p_nombre VARCHAR(50),
  IN p_apellidos VARCHAR(50),
  IN p_dni VARCHAR(50),
  IN p_correo VARCHAR(50),
  IN p_fecha_ingreso DATETIME,
  IN p_sueldo INT,
  IN p_rol VARCHAR(20),
  IN p_id_turno INT,
  IN p_id_usuario INT,
  IN p_id_rol INT
) BEGIN
UPDATE Personal
SET
  nombre = p_nombre,
  apellidos = p_apellidos,
  dni = p_dni,
  correo = p_correo,
  fecha_ingreso = p_fecha_ingreso,
  sueldo = p_sueldo,
  rol = p_rol,
  id_turno = p_id_turno,
  id_usuario = p_id_usuario,
  id_rol = p_id_rol
WHERE
  id_personal = p_id_personal;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ListarPersonal () BEGIN
SELECT
  *
FROM
  Personal;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ConsultarPersonal (IN p_id_personal INT) BEGIN
SELECT
  *
FROM
  Personal
WHERE
  id_personal = p_id_personal;

END / / DELIMITER;

-- PROCEDIMIENTOS PARA TURNO 
DELIMITER / / CREATE PROCEDURE ListarTurno () BEGIN
SELECT
  *
FROM
  Turno;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE EditarTurno (
  IN p_id_turno INT,
  IN p_entrada TIME,
  IN p_salida TIME
) BEGIN
UPDATE Turno
SET
  Entrada = p_entrada,
  Salida = p_salida
WHERE
  id = p_id_turno;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ConsultarTurno (IN p_id_turno INT) BEGIN
SELECT
  *
FROM
  Turno
WHERE
  id = p_id_turno;

END / / DELIMITER;

-- PROCEDIMIENTOS PARA USUARIO
DELIMITER / / CREATE PROCEDURE CrearUsuario (
  IN p_username VARCHAR(20),
  IN p_contrasenia VARCHAR(20),
  IN p_correo VARCHAR(20),
  IN p_admin TINYINT (1)
) BEGIN
INSERT INTO
  Usuario (username, contrasenia, correo, admin)
VALUES
  (p_username, p_contrasenia, p_correo, p_admin);

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ConsultarUsuario (IN p_id_usuario INT) BEGIN
SELECT
  *
FROM
  Usuario
WHERE
  id = p_id_usuario;

END / / DELIMITER;

-- PROCEDIMIENTOS PARA MOVIMIENTO
DELIMITER / / CREATE PROCEDURE CrearMovimiento (
  IN p_id_producto INT,
  IN p_id_personal INT,
  IN p_tipo_movimiento VARCHAR(20),
  IN p_estado VARCHAR(20),
  IN p_fecha DATE,
  IN p_descuento INT
) BEGIN
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
  (
    p_id_producto,
    p_id_personal,
    p_tipo_movimiento,
    p_estado,
    p_fecha,
    p_descuento
  );

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE EditarMovimiento (
  IN p_id_recepcion INT,
  IN p_id_producto INT,
  IN p_id_personal INT,
  IN p_tipo_movimiento VARCHAR(20),
  IN p_estado VARCHAR(20),
  IN p_fecha DATE,
  IN p_descuento INT
) BEGIN
UPDATE Movimiento
SET
  id_producto = p_id_producto,
  id_personal = p_id_personal,
  tipo_movimiento = p_tipo_movimiento,
  estado = p_estado,
  fecha = p_fecha,
  descuento = p_descuento
WHERE
  id_recepcion = p_id_recepcion;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ConsultarMovimiento (IN p_id_recepcion INT) BEGIN
SELECT
  *
FROM
  Movimiento
WHERE
  id_recepcion = p_id_recepcion;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ListarMovimiento () BEGIN
SELECT
  *
FROM
  Movimiento;

END / / DELIMITER;

-- PROCEDIMIENTOS PARA PRODUCTO
DELIMITER / / CREATE PROCEDURE CrearProducto (
  IN p_nombre_producto VARCHAR(50),
  IN p_cantidad INT,
  IN p_descripcion TEXT,
  IN p_estado VARCHAR(20),
  IN p_precio INT
) BEGIN
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
    p_nombre_producto,
    p_cantidad,
    p_descripcion,
    p_estado,
    p_precio
  );

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE EditarProducto (
  IN p_id_producto INT,
  IN p_nombre_producto VARCHAR(50),
  IN p_cantidad INT,
  IN p_descripcion TEXT,
  IN p_estado VARCHAR(20),
  IN p_precio INT
) BEGIN
UPDATE Producto
SET
  nombre_producto = p_nombre_producto,
  cantidad = p_cantidad,
  descripcion = p_descripcion,
  estado = p_estado,
  Precio = p_precio
WHERE
  id_producto = p_id_producto;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ConsultarProducto (IN p_id_producto INT) BEGIN
SELECT
  *
FROM
  Producto
WHERE
  id_producto = p_id_producto;

END / / DELIMITER;

DELIMITER / / CREATE PROCEDURE ListarProducto () BEGIN
SELECT
  *
FROM
  Producto;

END / / DELIMITER;

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