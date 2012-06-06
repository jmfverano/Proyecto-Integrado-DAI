<?php if (isset($contador)): ?>

<?php endif; ?>
<!DOCTYPE HTML>
<html>
	
<script language="javascript">
function muestraReloj()
{
// Compruebo si se puede ejecutar el script en el navegador del usuario
if (!document.layers && !document.all && !document.getElementById) return;
// Obtengo la hora actual y la divido en sus partes
var fechacompleta = new Date();
var horas = fechacompleta.getHours();
var minutos = fechacompleta.getMinutes();
var segundos = fechacompleta.getSeconds();
var mt = "AM";
// Pongo el formato 12 horas
if (horas > 12) {
mt = "PM";
horas = horas - 12;
}
if (horas == 0) horas = 12;
// Pongo minutos y segundos con dos dígitos
if (minutos <= 9) minutos = "0" + minutos;
if (segundos <= 9) segundos = "0" + segundos;
// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
cadenareloj = "<font size='1' face='arial'>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</font>";
// Escribo el reloj de una manera u otra, según el navegador del usuario
if (document.layers) {
document.layers.spanreloj.document.write(cadenareloj);
document.layers.spanreloj.document.close();
}
else if (document.all) spanreloj.innerHTML = cadenareloj;
else if (document.getElementById) document.getElementById("spanreloj").innerHTML = cadenareloj;
// Ejecuto la función con un intervalo de un segundo
setTimeout("muestraReloj()", 1000);
}

// Fin del script
</script>


<script language="javascript">

// Array de los meses
var monthNames = new makeArray(12);
monthNames[0] = "Enero";
monthNames[1] = "Febrero";
monthNames[2] = "Marzo";
monthNames[3] = "Abril";
monthNames[4] = "Mayo";
monthNames[5] = "Junio";
monthNames[6] = "Julio";
monthNames[7] = "Agosto";
monthNames[8] = "Septiembre";
monthNames[9] = "Octubre";
monthNames[10] = "Noviembre";
monthNames[11] = "Diciembre";

// Array de los días

var dayNames = new makeArray(7);
dayNames[0] = "Domingo";
dayNames[1] = "Lunes";
dayNames[2] = "Martes";
dayNames[3] = "Mi&eacute;rcoles";
dayNames[4] = "Jueves";
dayNames[5] = "Viernes";
dayNames[6] = "S&aacute;bado";

var now = new Date();
var year = now.getYear();

if (year < 2000) year = year + 1900;

function makeArray(len)
{
for (var i = 0; i < len; i++) this[i] = null;
this.length = len;
}

</SCRIPT>
	<head>
		<title>Music Band Center S.L</title>
		<?= link_tag('estilos/tienda_c.css') ?>
	</head>
		<?php if (isset($contador)): ?>
	<body>
	<?php else: ?>

	<body onLoad="muestraReloj()">
		
	<div id="fecha">
	<script language="JavaScript">
	<!--
		document.write( dayNames[now.getDay()] + " " + now.getDate() + " de " + monthNames[now.getMonth()] + " " +" de " + year);
	// -->
	</script>
	</div>
	<?php endif; ?>
		<div id="header">
			<div> 
				<a href="http://localhost/web/proyecto/cliente/index.php/tiendas/index/">
	   				<img src="http://localhost/web/proyecto/cliente/estilos/logo_plano.png" 
	  				 alt="Tus instrumentos a medida, guitarras y bajos.." WIDTH="400" HEIGHT="170" border="0">
				</a>
			</div>
		</div>
		<div  id="menu_izquierdo">
			<fieldset>
				<legend id="menu_tipos">Productos</legend>
				<p><?= anchor('productos/index/1','Cuerpo.'); ?></p>
				<p><?= anchor('productos/index/6','Mástil.'); ?></p>
				<p><?= anchor('productos/index/2','Pastillas.'); ?></p>
				<p><?= anchor('productos/index/7','Clavijeros.'); ?></p>
				<p><?= anchor('productos/index/8','Cuerdas.'); ?></p>
				<p><?= anchor('productos/index/9','Cejuela.'); ?></p>
				<p><?= anchor('productos/index/10','Puente.'); ?></p>
				<p><?= anchor('productos/index/11','Potenciometros.'); ?></p>
				<p><?= anchor('productos/index/12','Conexión Jack.'); ?></p>
				<p><?= anchor('productos/index/13','Selector Posición.'); ?></p>
				<p><?= anchor('productos/index/14','Pickguard.'); ?></p>
				<p><?= anchor('productos/index/15','Otros.'); ?></p>
				<p><?= anchor('productos/index/99','Todos.'); ?></p>
				
			</fieldset>
		</div>
		
		<div  id="menu_derecha">
			<fieldset>
				<legend id="menu_tipos">Cesta</legend>
				<?php if (!$this->session->userdata('cesta')): ?>
					<p>La cesta está vacia.</p>
				<?php else: ?>
					<p>La cesta tiene articulos.</p>
					   <?= form_open('usuarios/cesta') ?></p>
	 				<p><?= form_submit('ir_cesta', 'Cesta') ?><p>
					   <?= form_close() ?>
				<?php endif;?>
			</fieldset>
		</div>
		
		</div>
		<div  id="menu_login2">
			<fieldset>
				<legend id="menu_tipos">Login</legend>
				<?php if (!$this->session->userdata('id_usuario')): ?>
					<?php $attributes = array('id' => 'login');?>
					<p><?= form_open('usuarios/login', $attributes) ?></p>
	    			<p><?= form_label('Usuario:', 'email','id="login_label"') ?> </p>
	    			<p><?= form_input('email','','id="login_input"') ?></p>
	    			<p><?= form_label('Constraseña:', 'password', 'id="login_label"') ?> </p>
	    			<p><?= form_password('password','','id="login_input"') ?><p>
	 				<p><?= form_submit('login', 'Login') ?></p>
					<p><?= form_close() ?></p>
				<?php else: ?>
					<p>Bienvenido <?= $this->session->userdata('nombre') ?>.</p>
					<?= form_open('usuarios/logout') ?>
					<p><?= form_submit('logout', 'Logout') ?><p>
					<?=form_close() ?>
				<?php endif; ?>
				<p>
					<?= form_open('usuarios/index') ?>
					<?= form_submit('ir_panel', 'Panel Usuario') ?>
					<?= form_close() ?>
				</p>
			</fieldset>
		</div>
		<div id="contents">
		<?= $contents ?>
		</div>
		
		<div id="footer">
			<div>
				<p id="parrafo_blanco"><A class="mail" HREF="mailto:josemanuel.tecnico@gmail.com">Copyright José Manuel Fernández Verano - Proyecto DAI 2012</A></p>
			</div>
		</div>

	</body>
</html>
