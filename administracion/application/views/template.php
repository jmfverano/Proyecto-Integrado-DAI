<?php if (isset($contador)): ?>

<?php endif; ?>

<html>
	<head>
		<title>Music Band Center S.L</title>
		<?= link_tag('estilos/tienda.css') ?>
	</head>
		<?php if (isset($contador)): ?>
	<body>
	<?php else: ?>

	<body>
	<?php endif; ?>
		<div id="header">
			<div id="logo"> Music Band Center - Instrumentos a medida!!</div>
		</div>
		
		<div id="contents">
		<?= $contents ?>
		</div>
	
		<div id="footer">
			<div id="parrafo_blanco">
				<p>Copyright José Manuel Fernandez Verano - Proyecto DAI 2012</p>
			</div>
		</div>

	</body>
</html>
