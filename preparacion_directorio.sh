#!/bin/bash 
#
echo Se crea el direcctorrio que guardara los archivos.
cd /home/$USER/
mkdir web
echo Se realiza un enlace simbolico.
ln -s /var/www /home/$USER/web
echo Copiamos los datos del proyecto.
cp -rv proyecto/ /home/$USER/web
echo Creamos los usuarios de la base de datos.
echo Ahora pedira la contraseña, varios apartados.
sleep 3s 
sudo -i
su postgres
createuser -P usuario
createdb -O usuario tienda
logout
logout
echo Ahora introduce los datos en la base de datos, te pedira la contraseña.
cd /home/$USER/web/proyecto/comun/sql
psql -U usuario tienda < tienda.sql
echo Fin de proceso.
