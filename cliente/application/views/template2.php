<?php if (isset($contador)): ?>

<?php endif; ?>
<!DOCTYPE HTML>
<html>
	<script languaje="javascript">
		
	</script>
	<head>
		<title>Music Band Center S.L</title>
		<?= link_tag('estilos/tienda.css') ?>
	</head>
		<?php if (isset($contador)): ?>
	<body>
	<?php else: ?>

	<body>
		<div id="contents">
		<?= $contents ?>
		</div>
	</body>
</html>
<?php endif;?>