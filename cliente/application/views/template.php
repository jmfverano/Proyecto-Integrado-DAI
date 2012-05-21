<?php if (isset($contador)): ?>

<?php endif; ?>

<html>
	<head>
		<title>Music Band Center S.L</title>
		<?= link_tag('estilos/tienda_c.css') ?>
	</head>
		<?php if (isset($contador)): ?>
	<body>
	<?php else: ?>

	<body>
	<?php endif; ?>
		<div id="header">
			<div id="logo"> Music Band Center - Instrumentos a medida!!</div>
		</div>
		<div  id="menu_izquierdo">
			<fieldset>
				<legend id="menu_tipos">Productos</legend>
				<p><?= anchor('productos/cuerpo','Cuerpo.'); ?></p>
				<p><?= anchor('productos/mastil','Mástil.'); ?></p>
				<p><?= anchor('productos/pastillas','Pastillas.'); ?></p>
				<p><?= anchor('productos/clavijero','Clavijeros.'); ?></p>
				<p><?= anchor('productos/cuerda','Cuerdas.'); ?></p>
				<p><?= anchor('productos/cejuela','Cejuela.'); ?></p>
				<p><?= anchor('productos/puente','Puente.'); ?></p>
				<p><?= anchor('productos/potenciometro','Potenciometros.'); ?></p>
				<p><?= anchor('productos/jack','Conexión Jack.'); ?></p>
				<p><?= anchor('productos/selector_posicion','Selector Posición.'); ?></p>
				<p><?= anchor('productos/pickguard','Pickguard.'); ?></p>
				<p><?= anchor('productos/otras','Otros.'); ?></p>
			</fieldset>
		</div>
		
		</div>
		<div  id="menu_login2">
			<fieldset>
				<legend id="menu_tipos">Login</legend>
				<?php $attributes = array('id' => 'login');?>
				<p><?= form_open('usuarios/login', $attributes) ?></p>
    			<p><?= form_label('Usuario:', 'email','id="login_label"') ?> </p>
    			<p><?= form_input('email','','id="login_input"') ?></p>
    			<p><?= form_label('Constraseña:', 'password', 'id="login_label"') ?> </p>
    			<p><?= form_password('password','','id="login_input"') ?><p>
 				<p><?= form_submit('login', 'Login') ?><p>
				<?= form_close() ?>
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
