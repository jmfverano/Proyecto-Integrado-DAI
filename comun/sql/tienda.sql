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
  id_productos      bigserial    constraint pk_productos primary key,
  nombre            varchar(200) not null,
  stock             numeric(99)  not null default 0,
  descripcion       varchar(800) not null,
  fabricante        varchar(200) not null,
  id_categorias     bigint      constraint fk_productos_categorias references categorias (id_categorias)
);

drop table facturas cascade;

create table facturas (

);
