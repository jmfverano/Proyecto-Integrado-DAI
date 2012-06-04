<html>
<head>
<title>Gestor de subidas</title>
</head>
<body>

<h3>La imagen fue cargada correctamente.</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('productos/index', 'Volver al listado de Productos'); ?></p>

</body>
</html>