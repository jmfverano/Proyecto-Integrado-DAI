#!/bin/bash 
#
echo Inicio el Proceso de Instalación la Web Music Band Center.
echo Durante el proceso debera instroducir la constraseña del super usuario.
echo Estas versiones corresponde a la distribución 12.04 de Ubuntu.
sudo apt-get install postgresql-9.1
sudo apt-get install apache2 php5 php5-pgsql

echo Ahora tienes instalado el software necesario, ahora se preparara el direcctorio.
echo Se crea el direcctorrio que guardara los archivos.
cd /home/$USER/
mkdir web
echo Se realiza un enlace simbolico.
ln -s /var/www /home/$user/web
echo Copiamos los datos del proyecto.
cp -rv ./proyecto/ /home/$user/web
echo Creamos los usuarios de la base de datos.
echo Ahora pedira la contraseña, varios apartados.
sleep 3s 
sudo -i
su postgres
createuser -P usuario
createdb -O usuario tienda
exit
exit
echo Ahora introduce los datos en la base de datos, te pedira la contraseña.
cd /home/$user/web/proyecto/comun/sql
psql -U usuario tienda < tienda.sql
echo Fin de proceso.




