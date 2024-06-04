CREATE DATABASE IF NOT EXISTS Almacenamiento;

USE Almacenamiento;

DROP TABLE IF EXISTS Movimiento;
DROP TABLE IF EXISTS Personal;
DROP TABLE IF EXISTS Rol;
DROP TABLE IF EXISTS Turno;
DROP TABLE IF EXISTS Producto;
DROP TABLE IF EXISTS Usuario;

CREATE TABLE Usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    contrasenia VARCHAR(20),
    correo VARCHAR(20),
    admin TINYINT (1)
);

CREATE TABLE Producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(50),
    cantidad INT,
    descripcion TEXT,
    estado VARCHAR(20),
    Precio INT
);

CREATE TABLE Turno (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Entrada TIME,
    Salida TIME
);

CREATE TABLE Rol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(20)
);

CREATE TABLE Personal (
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

CREATE TABLE Movimiento (
    id_recepcion INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_personal INT,
    tipo_movimiento VARCHAR(20),
    cantidad INT,
    estado VARCHAR(20),
    fecha DATE,
    descuento INT,
    FOREIGN KEY (id_producto) REFERENCES Producto (id_producto),
    FOREIGN KEY (id_personal) REFERENCES Personal (id_personal)
);
