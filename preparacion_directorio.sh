#!/bin/bash 
#
echo Copiamos los datos del proyecto.
cp -rv proyecto/ /var/www
echo Creamos los usuarios de la base de datos.
echo Ahora pedira la contraseña, varios apartados.
sleep 3s 
su -c "createuser -P usuario" postgres
su -c "createdb -O usuario tienda" postgres
echo Ahora introduce los datos en la base de datos, te pedira la contraseña.
psql -U usuario tienda < /var/www/proyecto/comun/sql/tienda.sql
echo Fin de proceso.
