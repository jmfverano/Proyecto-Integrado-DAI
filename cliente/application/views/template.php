<?php if (isset($contador)): ?>

<?php endif; ?>
<!DOCTYPE HTML>
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
			<div> <?php echo img('http://localhost/web/proyecto/cliente/estilos/logo_web.png'); ?> </div>
		</div>
		<div  id="menu_izquierdo">
			<fieldset>
				<legend id="menu_tipos">Productos</legend>
				<p><?= anchor('productos/index/1','Cuerpo.'); ?></p>
				<p><?= anchor('productos/index/6','Mástil.'); ?></p>
				<p><?= anchor('productos/index/2','Pastillas.'); ?></p>
				<p><?= anchor('productos/clavijero','Clavijeros.'); ?></p>
				<p><?= anchor('productos/cuerda','Cuerdas.'); ?></p>
				<p><?= anchor('productos/cejuela','Cejuela.'); ?></p>
				<p><?= anchor('productos/puente','Puente.'); ?></p>
				<p><?= anchor('productos/potenciometro','Potenciometros.'); ?></p>
				<p><?= anchor('productos/jack','Conexión Jack.'); ?></p>
				<p><?= anchor('productos/selector_posicion','Selector Posición.'); ?></p>
				<p><?= anchor('productos/pickguard','Pickguard.'); ?></p>
				<p><?= anchor('productos/otras','Otros.'); ?></p>
				<p><?= anchor('productos/index/0','Todos.'); ?></p>
				
			</fieldset>
		</div>
		
		<div  id="menu_derecha">
			<fieldset>
				<legend id="menu_tipos">Cesta</legend>
				<?php if (!$this->session->userdata('cesta')): ?>
					<p>La cesta está vacia.</p>
				<?php else: ?>
					<p>La cesta tiene articulos.</p>
					<p><?= anchor('usuarios/cesta') ?></p>	
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
	 				<p><?= form_submit('login', 'Login') ?><p>
					<?= form_close() ?>
				<?php else: ?>
					<p>Bienvenido <?= $this->session->userdata('nombre') ?>.</p>
					<?= form_open('usuarios/logout') ?>
					<p><?= form_submit('logout', 'Logout') ?><p>
					<?=form_close() ?>
				<?php endif; ?>
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
