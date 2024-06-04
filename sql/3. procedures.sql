CREATE DATABASE IF NOT EXISTS Almacenamiento;

USE Almacenamiento;

-- Eliminar procedimientos existentes
DROP PROCEDURE IF EXISTS CrearPersonal;
DROP PROCEDURE IF EXISTS EditarPersonal;
DROP PROCEDURE IF EXISTS ListarPersonal;
DROP PROCEDURE IF EXISTS ConsultarPersonal;
DROP PROCEDURE IF EXISTS ListarTurno;
DROP PROCEDURE IF EXISTS EditarTurno;
DROP PROCEDURE IF EXISTS ConsultarTurno;
DROP PROCEDURE IF EXISTS CrearUsuario;
DROP PROCEDURE IF EXISTS ConsultarUsuario;
DROP PROCEDURE IF EXISTS CrearMovimiento;
DROP PROCEDURE IF EXISTS EditarMovimiento;
DROP PROCEDURE IF EXISTS ConsultarMovimiento;
DROP PROCEDURE IF EXISTS ListarMovimiento;
DROP PROCEDURE IF EXISTS CrearProducto;
DROP PROCEDURE IF EXISTS EditarProducto;
DROP PROCEDURE IF EXISTS ConsultarProducto;
DROP PROCEDURE IF EXISTS ListarProducto;

-- Procedimientos para Personal
DELIMITER //
CREATE PROCEDURE CrearPersonal (
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
)
BEGIN
  INSERT INTO Personal (
    nombre, apellidos, dni, correo, fecha_ingreso, sueldo, rol, id_turno, id_usuario, id_rol
  )
  VALUES (
    nombre, apellidos, dni, correo, fecha_ingreso, sueldo, rol, id_turno, id_usuario, id_rol
  );
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EditarPersonal (
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
)
BEGIN
  UPDATE Personal
  SET nombre = p_nombre, apellidos = p_apellidos, dni = p_dni, correo = p_correo, 
      fecha_ingreso = p_fecha_ingreso, sueldo = p_sueldo, rol = p_rol, id_turno = p_id_turno, 
      id_usuario = p_id_usuario, id_rol = p_id_rol
  WHERE id_personal = p_id_personal;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ListarPersonal ()
BEGIN
  SELECT * FROM Personal;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarPersonal (IN p_id_personal INT)
BEGIN
  SELECT * FROM Personal WHERE id_personal = p_id_personal;
END //
DELIMITER ;

-- Procedimientos para Turno
DELIMITER //
CREATE PROCEDURE ListarTurno ()
BEGIN
  SELECT * FROM Turno;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EditarTurno (
  IN p_id_turno INT,
  IN p_entrada TIME,
  IN p_salida TIME
)
BEGIN
  UPDATE Turno
  SET Entrada = p_entrada, Salida = p_salida
  WHERE id = p_id_turno;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarTurno (IN p_id_turno INT)
BEGIN
  SELECT * FROM Turno WHERE id = p_id_turno;
END //
DELIMITER ;

-- Procedimientos para Usuario
DELIMITER //
CREATE PROCEDURE CrearUsuario (
  IN p_username VARCHAR(20),
  IN p_contrasenia VARCHAR(20),
  IN p_correo VARCHAR(20),
  IN p_admin TINYINT (1)
)
BEGIN
  INSERT INTO Usuario (username, contrasenia, correo, admin)
  VALUES (p_username, p_contrasenia, p_correo, p_admin);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarUsuario (IN p_id_usuario INT)
BEGIN
  SELECT * FROM Usuario WHERE id = p_id_usuario;
END //
DELIMITER ;

-- Procedimientos para Movimiento
DELIMITER //
CREATE PROCEDURE CrearMovimiento (
  IN p_id_producto INT,
  IN p_id_personal INT,
  IN p_tipo_movimiento VARCHAR(20),
  IN p_estado VARCHAR(20),
  IN p_fecha DATE,
  IN p_descuento INT
)
BEGIN
  INSERT INTO Movimiento (
    id_producto, id_personal, tipo_movimiento, estado, fecha, descuento
  )
  VALUES (
    p_id_producto, p_id_personal, p_tipo_movimiento, p_estado, p_fecha, p_descuento
  );
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EditarMovimiento (
  IN p_id_recepcion INT,
  IN p_id_producto INT,
  IN p_id_personal INT,
  IN p_tipo_movimiento VARCHAR(20),
  IN p_estado VARCHAR(20),
  IN p_fecha DATE,
  IN p_descuento INT
)
BEGIN
  UPDATE Movimiento
  SET id_producto = p_id_producto, id_personal = p_id_personal, tipo_movimiento = p_tipo_movimiento,
      estado = p_estado, fecha = p_fecha, descuento = p_descuento
  WHERE id_recepcion = p_id_recepcion;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarMovimiento (IN p_id_recepcion INT)
BEGIN
  SELECT * FROM Movimiento WHERE id_recepcion = p_id_recepcion;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ListarMovimiento ()
BEGIN
  SELECT * FROM Movimiento;
END //
DELIMITER ;

-- Procedimientos para Producto
DELIMITER //
CREATE PROCEDURE CrearProducto (
  IN p_nombre_producto VARCHAR(50),
  IN p_cantidad INT,
  IN p_descripcion TEXT,
  IN p_estado VARCHAR(20),
  IN p_precio INT
)
BEGIN
  INSERT INTO Producto (
    nombre_producto, cantidad, descripcion, estado, Precio
  )
  VALUES (
    p_nombre_producto, p_cantidad, p_descripcion, p_estado, p_precio
  );
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EditarProducto (
  IN p_id_producto INT,
  IN p_nombre_producto VARCHAR(50),
  IN p_cantidad INT,
  IN p_descripcion TEXT,
  IN p_estado VARCHAR(20),
  IN p_precio INT
)
BEGIN
  UPDATE Producto
  SET nombre_producto = p_nombre_producto, cantidad = p_cantidad, descripcion = p_descripcion,
      estado = p_estado, Precio = p_precio
  WHERE id_producto = p_id_producto;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarProducto (IN p_id_producto INT)
BEGIN
  SELECT * FROM Producto WHERE id_producto = p_id_producto;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ListarProducto ()
BEGIN
  SELECT * FROM Producto;
END //
DELIMITER ;
