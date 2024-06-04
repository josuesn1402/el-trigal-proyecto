USE Almacenamiento;

SELECT * FROM Usuario;
SELECT * FROM Producto;
SELECT * FROM Turno;
SELECT * FROM Rol;
SELECT * FROM Personal;
SELECT * FROM Movimiento;


SELECT
    p.id_personal,
    p.nombre,
    p.apellidos,
    p.dni,
    p.correo,
    p.fecha_ingreso,
    p.sueldo,
    p.id_rol,
    p.id_turno,
    u.id AS id_usuario,
    u.username AS nombre_usuario,
    u.contrasenia,
    u.correo AS u_correo,
    u.admin
  FROM
    Personal p
    INNER JOIN Usuario u ON p.id_usuario = u.id
  WHERE
    p.id_personal = 4;

