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
		<div id="menu_izquierdo">
			<span>Tipos de Productos</span>
			<p>Cuerpo</p>
			<p>Mástil</p>
			<p>Pastillas</p>
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
