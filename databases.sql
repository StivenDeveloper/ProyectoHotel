DROP DATABASE IF EXISTS hoteles;
CREATE DATABASE hoteles;
USE hoteles;

DROP TABLE IF EXISTS habitaciones; 
CREATE TABLE habitaciones(
	numero_habitacion int not null,
    descripcion varchar(100),
    primary key(numero_habitacion)
);

DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes(
	cedula_cliente int not null,
    nombre varchar(45),
    apellido varchar(45),
    telefono varchar(45),
    direccion varchar(100),
    nombre_pais varchar(45),
    nombre_departamento varchar(45),
    nombre_municipio varchar(45),
    correo varchar(45),
    contrasena varchar(45),
    primary key(cedula_cliente)
);

DROP TABLE IF EXISTS validacion_clientes;

CREATE TABLE validacion_clientes(
	id_validacion INT not null,
    cedula_cliente int,
    fecha timestamp,
	verificado_cedula varchar(45),
    primary key(id_validacion),
    foreign key(cedula_cliente) references clientes(cedula_cliente)
);

DROP TABLE IF EXISTS reserva;

CREATE TABLE reserva(
	id_reserva int auto_increment,
    fecha_inicio date,
    fecha_final date,
    cedula_cliente int,
    numero_habitacion int,
    primary key(id_reserva),
    foreign key(cedula_cliente) references clientes(cedula_cliente),
    foreign key(numero_habitacion) references habitaciones(numero_habitacion)
);

DROP TABLE IF EXISTS pedidos;
CREATE TABLE pedidos(
	id_pedido int not null,
    tipo_pedido varchar(45),
    fecha_pedido date,
    cedula_cliente int,
    primary key(id_pedido),
    foreign key(cedula_cliente) references clientes(cedula_cliente)
);

DROP TABLE IF EXISTS facturacion;
CREATE TABLE facturacion(
	id_factura int,
    cedula_cliente int,
    fecha_factura date,
    costo decimal(6,2),
    primary key(id_factura),
    foreign key(cedula_cliente) references clientes(cedula_cliente)
);

DROP TABLE IF EXISTS login_registre; 

CREATE TABLE login_registre(
	cedula int not null,
    nombre_completo varchar(45),
    correo varchar(45),
    contrasena varchar(45),
    primary key(cedula)
);

-- TABLAS DE PAISES

DROP TABLE IF EXISTS paises;

CREATE TABLE paises(
	id_pais int,
    nombre varchar(45),
    primary key(id_pais)
); 

DROP TABLE IF EXISTS departamentos;

CREATE TABLE departamentos(
	id_departamento int,
    nombre varchar(45),
    id_pais int,
    primary key(id_departamento),
    foreign key(id_pais) references paises(id_pais)
); 

DROP TABLE IF EXISTS municipios;

CREATE TABLE municipios(
	id_municipio int,
    nombre varchar(45),
    id_departamento int,
    primary key(id_municipio),
    foreign key(id_departamento) references departamentos(id_departamento)
);


-- datos cliente
insert into clientes values ('98765','dirleny','ortiz','12345','agsdfg','fggsfgds','sdfgf','sfgsf','dir@dir','98765');

insert into habitaciones values
('101','Acogedora habitación individual con vista al jardín.'),
('102','Espaciosa habitación doble con balcón privado.'),
('201','Suite junior elegante con sala de estar.'),
('202','Habitación familiar con dos camas dobles.');
-- datos login
insert into login_registre values ('12345', 'weimar','wei@wei','12345');

-- datos reserva

insert into reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion) values('2023-08-24','2023-08-25','98765','101');
insert into reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion) values('2023-08-27','2023-08-30','98765','101');
insert into reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion) values('2023-08-30','2023-09-02','98765','102');


-- Consulta mágica no perder de vista
SELECT h.numero_habitacion, h.descripcion
        FROM habitaciones h
        WHERE h.numero_habitacion NOT IN (
            SELECT r.numero_habitacion
            FROM reserva r
            WHERE (r.fecha_inicio < '2023-08-30' AND r.fecha_final > '2023-08-27') -- Rango de fechas deseado
               OR (r.fecha_inicio <= '2023-08-27' AND r.fecha_final > '2023-08-27')
               OR (r.fecha_inicio >= '2023-08-27' AND r.fecha_inicio < '2023-09-04')
);