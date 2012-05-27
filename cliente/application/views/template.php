<?php if (isset($contador)): ?>

<?php endif; ?>
<!DOCTYPE HTML>
<html>
	<script languaje="javascript">
		
	</script>
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
