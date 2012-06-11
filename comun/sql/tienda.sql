drop table usuarios cascade;

create table usuarios (
  id_usuario bigserial    constraint pk_usuarios primary key,
  email      varchar(200) constraint uq_usuarios_email unique,
  password   char(32)     not null,
  dni        char(9)      not null,
  nombre_usu varchar(100) not null,
  apellidos  varchar(200) not null,
  direccion  varchar(500) not null,
  telefono   char(9)      not null,
  admin      bool         default false
);


drop table proveedores cascade;

create table proveedores (
  id_proveedor    bigserial       constraint pk_proveedores primary key,
  nombre_prov     varchar(300)    not null,
  cif             varchar(15)     not null,
  telefono        varchar(12)     not null,
  email           varchar(100)    not null
);


drop table categorias cascade;

create table categorias(
  id_categoria               bigserial    constraint pk_categorias primary key,
  tipo_instrumento           varchar(200) not null
);



drop table piezas_compatibles cascade;

create table piezas_compatibles (
    
  id_piezas     bigserial     constraint pk_piezas_compatibles primary key,
  pc_nombre     varchar(30)   not null,
  id_categoria  bigint        constraint fk_categorias_piezas_compatibles references categorias (id_categoria) 
                                         on delete cascade on update cascade
  
);


drop table tipo_productos cascade;

create table tipo_productos (

  id_tipo_producto          bigserial    constraint pk_tipo_producto primary key,
  tnomb_producto            varchar(100)  not null unique
  
);

drop table productos cascade;

create table productos (
  id_producto       bigserial    constraint pk_productos primary key,
  nombre_prod       varchar(200) not null,
  stock             numeric(99)  not null default 1,
  descripcion       text         not null,
  fabricante        varchar(200) not null,
  precio            numeric(9,2) not null,
  id_categoria      bigint      constraint fk_productos_categorias references categorias (id_categoria)
                                           on delete cascade on update cascade,
  id_proveedor      bigint      constraint fk_productos_proveedores references proveedores (id_proveedor)
                                           on delete cascade on update cascade,
  id_tipo_producto  bigint      constraint fk_productos_tipo_producto references tipo_productos (id_tipo_producto)
                                           on delete cascade on update cascade,
  id_piezas         bigint      constraint fk_productos_piezas references piezas_compatibles (id_piezas)
                                           on delete cascade on update cascade
 
);

drop table pedidos cascade;

create table pedidos (
  id_pedido        bigserial     constraint pk_pedidos primary key,
  id_usuario       bigint        constraint fk_pedidos_usuario references usuarios (id_usuario)
                                            on delete cascade on update cascade,  
  fecha            date          default current_date,
  estado           varchar(15)   default 'Iniciado'
);



drop table facturas cascade;

create table facturas (
  id_factura       bigserial     constraint pk_facturas primary key,
  id_usuario       bigint        constraint fk_factura_usuario references usuarios (id_usuario)
                                            on delete cascade on update cascade,
  id_pedido        bigint        constraint fk_factura_pedidos references pedidos (id_pedido)
                                            on delete cascade on update cascade,
  dni              char(9),
  nombre_fat       varchar(100),  
  apellidos        varchar(200),  
  direccion        varchar(500),  
  telefono         char(9),       
  fecha            date    default current_date
);

drop table linea_facturas cascade;

create table linea_facturas (
  id_linea_factura bigserial    constraint pk_linea_facturas primary key,
  id_factura       bigint       constraint fk_linea_facturas_factura references facturas (id_factura)
                                           on delete cascade on update cascade,
  id_producto      bigint       constraint fk_linea_facturas_producto references productos (id_producto)
                                           on delete cascade on update cascade,
  cantidad         numeric(2)   default 1,
  precio           numeric(9,2) not null
);

-- Se introducen los datos para las pruebas del sistema.


insert into usuarios (email, password, dni, nombre_usu, apellidos, direccion, telefono, admin)
values ('josemanuel.tecnico@gmail.com',md5('werty'),'48894964T','Jose Manuel', 'Fernández Verano', 
        'Paseo Jadín del Botánico Edif. Azucena B1', 956367056, true);
insert into usuarios (email, password, dni, nombre_usu, apellidos, direccion, telefono) 
values ('Xhaman@gmail.com',md5('werty'),'49894965T','Salvador', 'Jiménez Verano', 'Carretera Jerez Numero 10', 856367056);

insert into proveedores (nombre_prov, cif, telefono, email) values ('Fender', '12345678912','+34956112233','fender_iberia@fender.com');
insert into proveedores (nombre_prov, cif, telefono, email) values ('Gibson', '12345678911','+34956112234','Gibson_europe@gibson.com');

insert into categorias (tipo_instrumento) values ('Guitarra');
insert into categorias (tipo_instrumento) values ('Bajo');


insert into piezas_compatibles(pc_nombre, id_categoria) values ('Telecaster', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('SG', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Les Paul', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal Guitarra', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal Bajo', 2);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('JazzBass', 2);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal Humbucker', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal  Silgle Coil', 1);


insert into tipo_productos (tnomb_producto) values ('Cuerpo');
insert into tipo_productos (tnomb_producto) values ('Pastilla Puente');
insert into tipo_productos (tnomb_producto) values ('Pastilla Mastil');
insert into tipo_productos (tnomb_producto) values ('Pastilla central');
insert into tipo_productos (tnomb_producto) values ('Set de pastillas');
insert into tipo_productos (tnomb_producto) values ('Mastil');
insert into tipo_productos (tnomb_producto) values ('Clavijero');
insert into tipo_productos (tnomb_producto) values ('Cuerdas');
insert into tipo_productos (tnomb_producto) values ('Cejuela');
insert into tipo_productos (tnomb_producto) values ('Puente');
insert into tipo_productos (tnomb_producto) values ('Potenciometro');
insert into tipo_productos (tnomb_producto) values ('Conexión Jack');
insert into tipo_productos (tnomb_producto) values ('Selector de Posición');
insert into tipo_productos (tnomb_producto) values ('Guarda Puas');
insert into tipo_productos (tnomb_producto) values ('Otros');

-- Se introducen todas estas pastillas para probar el paginador.

insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Squier Tele Pick', 'Pastilla del mastil tipo Telecaster con sonido vitage', 'Squier',50.99, 1, 1,1,3);
insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Fender Tele Pick', 'Pastilla del mastil tipo Telecaster con sonido vitage', 'Fender',50.99, 1, 1,1,3);
insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Squier Tele Pick', 'Pastilla del puente tipo Telecaster con sonido vitage', 'Squier',50.99, 1, 1,1,2);
insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Fender Tele Pick', 'Pastilla del puente tipo Telecaster con sonido vitage', 'Fender',50.99, 1, 1,1,2);
insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Fender Strato Pick', 'Pastilla del mastil tipo Strato con sonido vitage', 'Fender',90.99, 1, 1,1,3);
insert into productos  (nombre_prod, descripcion, fabricante, precio, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Fender Strato Pick', 'Pastilla central tipo Strato con sonido vitage', 'Fender',90.99, 1, 1,1,4);

-- Datos para probar el proceso de creación de guitarra, se ha elegido el modelo Les paul para la prueba.

insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerpo Caoba Tipo Les Paul Custom', 'Cuerpo caoba tipo les paul custom sin camara', 'Gibson USA',250, 5, 1, 2,3,1);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Set Pastillas Humbucker Les Paul Custom', 'Pastillas Humbucker Sonido Vitage del 57', 'Gibson USA',300, 5, 1, 2,3,5);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Mástil Caoba Tipo Les Paul Custom', 'Mástil caoba tipo les paul custom con diapasón de Ebano', 'Gibson USA',270, 5, 1, 2,3,6);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Clavijero Tipo Les Paul Vitage', 'Clavijero Vitage auto lubricado Gibson (Plastico)', 'Gibson',90, 5, 1, 2,3,7);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Clavijero Tipo Les Paul Custom', 'Clavijero Vitage auto lubricado Gibson Custom Silver', 'Gibson',120, 5, 1, 2,3,7);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cejuela para Les Paul', 'Cejuela para Les paul de hueso, con perfil bajo color blanca', 'Gibson USA',40, 5, 1, 2,3,9);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Puente Tune-O-Matic', 'Puente Tune-O-Matic Completo Les Paul', 'Gibson',120, 5, 1, 2,3,10);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 46-10', 'Cuerdas 46-10 Nickel', 'Gibson',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 46-10', 'Cuerdas 46-10 Nickel', 'Fender',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 42-9', 'Cuerdas 42-9 Nickel', 'Erniball',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Pack Potenciometros', 'Pack Potenciometros para Les Paul 500k x 4', 'Gibson',60, 5, 1, 2,3,11);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Conexión Jack para Les Paul', 'Conexión Jack para Les Paul (Lateral) con particulas de oro', 'Gibson',59.00, 5, 1, 2,3,12);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Pickguard para Les Paul', 'Pickguard para les paul 3 capas NBN', 'Gibson USA',70, 5, 1, 2,3,14);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Indicador de posición potenciometros', 'Indicador de posición de pontenciometros', 'Grover',12, 5, 1, 2,4,15);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Comutador de tres posiciones.', 'Indicador de tres posiciones para les paul', 'Gibson',20, 5, 1, 2,3,13);


insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerpo Caoba Tipo Les Paul Custom', 'Cuerpo caoba tipo les paul custom sin camara', 'Gibson USA',250, 5, 1, 2,2,1);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Set Pastillas Humbucker Les Paul Custom', 'Pastillas Humbucker Sonido Vitage del 57', 'Gibson USA',300, 5, 1, 2,2,5);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Mástil Caoba Tipo Les Paul Custom', 'Mástil caoba tipo les paul custom con diapasón de Ebano', 'Gibson USA',270, 5, 1, 2,2,6);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Clavijero Tipo Les Paul Vitage', 'Clavijero Vitage auto lubricado Gibson (Plastico)', 'Gibson',90, 5, 1, 2,2,7);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Clavijero Tipo Les Paul Custom', 'Clavijero Vitage auto lubricado Gibson Custom Silver', 'Gibson',120, 5, 1, 2,2,7);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cejuela para Les Paul', 'Cejuela para Les paul de hueso, con perfil bajo color blanca', 'Gibson USA',40, 5, 1, 2,2,9);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Puente Tune-O-Matic', 'Puente Tune-O-Matic Completo Les Paul', 'Gibson',120, 5, 1, 2,2,10);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 46-10', 'Cuerdas 46-10 Nickel', 'D,Addarios',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 46-10', 'Cuerdas 46-10 Nickel', 'Dunlop',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Cuerdas 42-9', 'Cuerdas 42-9 Nickel', 'Neon',8, 100, 1, 2,4,8);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Pack Potenciometros', 'Pack Potenciometros para Les Paul 500k x 4', 'Gibson',60, 5, 1, 2,2,11);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Conexión Jack para Les Paul', 'Conexión Jack para Les Paul (Lateral) con particulas de oro', 'Gibson',59.00, 5, 1, 2,2,12);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Pickguard para Les Paul', 'Pickguard para SG 3 capas NBN', 'Gibson USA',70, 5, 1, 2,2,14);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Indicador de posición potenciometros', 'Indicador de posición de pontenciometros', 'Grover',12, 5, 1, 2,4,15);
insert into productos  (nombre_prod, descripcion, fabricante, precio, stock, id_categoria, id_proveedor, id_piezas, id_tipo_producto) 
values ('Comutador de tres posiciones.', 'Indicador de tres posiciones para les paul', 'Gibson',20, 5, 1, 2,2,13);


