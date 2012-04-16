drop table usuarios cascade;

create table usuarios (
  id_usuario bigserial    constraint pk_usuarios primary key,
  email      varchar(200) constraint uq_usuarios_email unique,
  password   char(32)     not null,
  dni        char(9)      constraint uq_usuarios_dni unique,
  nombre     varchar(100) not null,
  apellidos  varchar(200) not null,
  direccion  varchar(500) not null,
  telefono   char(9)      not null,
  admin      bool         default false
);

insert into usuarios (email, password, dni, nombre, apellidos, direccion, telefono, admin)
values ('josemanuel.tecnico@gmail.com',md5('werty'),'48894964T','Jose Manuel', 'Fernández Verano', 
        'Paseo Jadín del Botánico Edif. Azucena B1', 956367056, true);
insert into usuarios (email, password, dni, nombre, apellidos, direccion, telefono)
values ('Xhaman@gmail.com',md5('werty'),'48894965T','Salvador', 'Fernández Verano', 
        'Paseo Jadín del Botánico Edif. Azucena B1', 956367056);

drop table categorias cascade;

create table categorias(
  id_categorias bigserial    constraint pk_categorias primary key,
  nombre                     varchar(200) not null
);

insert into categorias (nombre) values ('Guitarra');
insert into categorias (nombre) values ('Bajo');

drop table productos cascade;

create table productos (
  id_producto       bigserial    constraint pk_productos primary key,
  nombre            varchar(200) not null,
  stock             numeric(99)  not null default 0,
  descripcion       varchar(800) not null,
  fabricante        varchar(200) not null,
  precio            numeric(9,2) not null,
  id_categorias     bigint      constraint fk_productos_categorias references categorias (id_categorias)
);

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
  nombre           varchar(100),  
  apellidos        varchar(200),  
  direccion        varchar(500),  
  telefono         char(9),       
  fecha            date    default current_date
);

drop table linea_facturas cascade;

create table linea_facturas (
  id_linea_factura bigserial    constraint pk_lineas_factura primary key,
  id_factura       bigint       constraint fk_linea_factura_factura references facturas (id_factura),
  id_producto      bigint       constraint fk_line_factura_producto references productos (id_producto),
  cantidad         numeric(2)   default 1,
  precio           numeric(9,2) not null
);




