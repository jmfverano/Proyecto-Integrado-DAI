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
			<div> 
				<a href="http://localhost/web/proyecto/cliente/index.php/tiendas/index/">
	   				<img src="http://localhost/web/proyecto/cliente/estilos/logo_plano.png" 
	  				 alt="Tus instrumentos a medida, guitarras y bajos.." WIDTH="400" HEIGHT="170" border="0">
				</a>
			</div>
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
