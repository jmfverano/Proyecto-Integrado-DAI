drop table usuarios cascade;

create table usuarios (
  id_usuario bigserial    constraint pk_usuarios primary key,
  email      varchar(200) constraint uq_usuarios_email unique,
  password   char(32)     not null,
  dni        char(9)      constraint uq_usuarios_dni unique,
  nombre_usu varchar(100) not null,
  apellidos  varchar(200) not null,
  direccion  varchar(500) not null,
  telefono   char(9)      not null,
  admin      bool         default false
);

insert into usuarios (email, password, dni, nombre_usu, apellidos, direccion, telefono, admin)
values ('josemanuel.tecnico@gmail.com',md5('werty'),'48894964T','Jose Manuel', 'Fernández Verano', 
        'Paseo Jadín del Botánico Edif. Azucena B1', 956367056, true);
insert into usuarios (email, password, dni, nombre_usu, apellidos, direccion, telefono) 
values ('Xhaman@gmail.com',md5('werty'),'49894965T','Salvador', 'Jiménez Verano', 'Carretera Jerez Numero 10', 856367056);


drop table proveedores cascade;

create table proveedores (
  id_proveedor    bigserial       constraint pk_proveedores primary key,
  nombre_prov     varchar(300)    not null,
  cif             varchar(15)     not null,
  telefono        varchar(12)     not null,
  email           varchar(100)    not null
);

insert into proveedores (nombre_prov, cif, telefono, email) values ('Fender', '12345678912','+34956112233','fender_iberia@fender.com');
insert into proveedores (nombre_prov, cif, telefono, email) values ('Gibson', '12345678911','+34956112234','Gibson_europe@gibson.com');

drop table categorias cascade;

create table categorias(
  id_categoria               bigserial    constraint pk_categorias primary key,
  tipo_instrumento           varchar(200) not null
);

insert into categorias (tipo_instrumento) values ('Guitarra');
insert into categorias (tipo_instrumento) values ('Bajo');


drop table piezas_compatibles cascade;

create table piezas_compatibles (
    
  id_piezas     bigserial     constraint pk_piezas_compatibles primary key,
  pc_nombre     varchar(30)   not null,
  id_categoria  bigint        constraint fk_categorias_piezas_compatibles references categorias (id_categoria)
  
);

insert into piezas_compatibles(pc_nombre, id_categoria) values ('Telecaster', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('SG', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Les Paul', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal Guitarra', 1);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('Universal Bajo', 2);
insert into piezas_compatibles(pc_nombre, id_categoria) values ('JazzBass', 2);


drop table tipo_productos cascade;

create table tipo_productos (

  id_tipo_producto          bigserial    constraint pk_tipo_producto primary key,
  tnomb_producto            varchar(100)  not null unique
  
);

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

drop table productos cascade;

create table productos (
  id_producto       bigserial    constraint pk_productos primary key,
  nombre_prod       varchar(200) not null,
  stock             numeric(99)  not null default 1,
  descripcion       text         not null,
  fabricante        varchar(200) not null,
  precio            numeric(9,2) not null,
  id_categoria      bigint      constraint fk_productos_categorias references categorias (id_categoria),
  id_proveedor      bigint      constraint fk_productos_proveedores references proveedores (id_proveedor),
  id_tipo_producto  bigint      constraint fk_productos_tipo_producto references tipo_productos (id_tipo_producto),
  id_piezas         bigint      constraint fk_productos_piezas references piezas_compatibles (id_piezas)
 
);

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


drop table pedidos cascade;

create table pedidos (
  id_pedido        bigserial     constraint pk_pedidos primary key,
  id_usuario       bigint        constraint fk_pedidos_usuario references usuarios (id_usuario),  
  fecha            date          default current_date,
  estado           varchar(15)   default 'Iniciado'
);

insert into pedidos(id_usuario) values(1);

drop table linea_pedidos cascade;

create table linea_pedidos (
  id_linea_pedido  bigserial    constraint pk_lineas_pedidos primary key,
  id_pedido        bigint       constraint fk_linea_pedidos_pedido references pedidos (id_pedido),
  id_producto      bigint       constraint fk_line_pedido_producto references productos (id_producto),
  cantidad         numeric(2)   default 1,
  precio           numeric(9,2) not null
);

drop table facturas cascade;

create table facturas (
  id_factura       bigserial     constraint pk_facturas primary key,
  id_usuario       bigint        constraint fk_factura_usuario references usuarios (id_usuario),
  id_pedido        bigint        constraint fk_factura_pedidos references pedidos (id_pedido),
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
  id_factura       bigint       constraint fk_linea_facturas_factura references facturas (id_factura),
  id_producto      bigint       constraint fk_linea_facturas_producto references productos (id_producto),
  cantidad         numeric(2)   default 1,
  precio           numeric(9,2) not null
);

