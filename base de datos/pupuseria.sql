/*CREATE DATABASE pupuseria;*/
/*USE pupuseria;*/
/*DROP DATABASE pupuseria;*/

/*PRIMER NIVEL*/
CREATE TABLE cargo ( /*REVISADA*/
id_cargo INT NOT NULL AUTO_INCREMENT, 
cargo VARCHAR(50) NOT NULL,
PRIMARY KEY (id_cargo)
);
CREATE TABLE mesa ( /*REVISADA*/
id_mesa INT NOT NULL AUTO_INCREMENT, 
detalle_mesa VARCHAR(50) NOT NULL,
PRIMARY KEY (id_mesa)
);
CREATE TABLE articulos_productos ( /*REVISADA*/
id_articulos_productos INT NOT NULL AUTO_INCREMENT, 
nombre_articulo VARCHAR(200) NOT NULL,
detalle_articulo VARCHAR(200) NOT NULL,
precio_articulo FLOAT NOT NULL,
grupos VARCHAR(100) NOT NULL,
PRIMARY KEY (id_articulos_productos)
);
/*SEGUNDO NIVEL*/
CREATE TABLE empleado ( /*REVISADA*/
id_empleado INT NOT NULL AUTO_INCREMENT, 
id_cargo INT NOT NULL,
dui VARCHAR(10) NOT NULL,
nombre_completo VARCHAR(250) NOT NULL,
direccion_empleado VARCHAR(250) NOT NULL,
usuario VARCHAR(50) NOT NULL,
clave VARCHAR(100) NOT NULL,
nivel_acceso INT NOT NULL,
PRIMARY KEY (id_empleado),
FOREIGN KEY (id_cargo) REFERENCES pupuseria.cargo (id_cargo) 
);
CREATE TABLE detalle_pedido ( /*REVISADA*/
id_detalle_pedido INT NOT NULL AUTO_INCREMENT, 
id_articulos_productos INT NOT NULL,
cantidad INT NOT NULL,
total_linea FLOAT NOT NULL,
PRIMARY KEY (id_detalle_pedido),
FOREIGN KEY (id_articulos_productos) REFERENCES pupuseria.articulos_productos (id_articulos_productos) 
);
/*TERCER NIVEL*/
CREATE TABLE cliente (/*REVISADA*/ 
id_cliente INT NOT NULL AUTO_INCREMENT,
id_empleado INT NOT NULL, 
nombre_cliente VARCHAR(250) NOT NULL,
apellido_cliente VARCHAR(250) NOT NULL,
direccion_cliente VARCHAR(250) NOT NULL,
PRIMARY KEY (id_cliente),
FOREIGN KEY (id_empleado) REFERENCES pupuseria.empleado (id_empleado) 
);
CREATE TABLE encabezado_pedido ( /*REVISADA*/ 
id_encabezado INT NOT NULL AUTO_INCREMENT,
id_empleado INT NOT NULL, 
id_detalle_pedido INT NOT NULL,
id_mesa INT NOT NULL,
fecha_encabezado DATE NOT NULL,
numero_pedido INT NOT NULL,
estado_pedido VARCHAR(50) NOT NULL,
PRIMARY KEY (id_encabezado),
FOREIGN KEY (id_empleado) REFERENCES pupuseria.empleado (id_empleado),
FOREIGN KEY (id_detalle_pedido) REFERENCES pupuseria.detalle_pedido (id_detalle_pedido),
FOREIGN KEY (id_mesa) REFERENCES pupuseria.mesa (id_mesa)
);
/*CUARTO NIVEL*/
CREATE TABLE pagos_cobros (/*REVISADA*/ 
id_pagos INT NOT NULL AUTO_INCREMENT,
id_encabezado INT NOT NULL, 
id_cliente INT NOT NULL, 
total_pagar FLOAT NOT NULL,
estado_cobro VARCHAR(50) NOT NULL,
PRIMARY KEY (id_pagos),
FOREIGN KEY (id_encabezado) REFERENCES pupuseria.encabezado_pedido (id_encabezado),
FOREIGN KEY (id_cliente) REFERENCES pupuseria.cliente (id_cliente)  
);
/*DATOS DE PRINCIPALES*/
INSERT INTO cargo(cargo) VALUES ('admin');
INSERT INTO cargo(cargo) VALUES ('empleado');
INSERT INTO empleado(id_cargo,dui,nombre_completo,direccion_empleado,usuario,clave,nivel_acceso)
	VALUES('1','00000000-0','admin','-','admin','M0hxOHpsQWFFQnNmV0pLWktaZXFTdz09','1');