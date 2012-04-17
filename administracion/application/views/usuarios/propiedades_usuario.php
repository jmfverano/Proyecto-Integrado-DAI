<div class="datos_usuario">
	<fieldset>
		<legend>Datos Usuario</legend>
		<?php extract($usuario); ?>
		<p align="center">DNI: <?= $dni ?> Nombre: <?= $nombre?> Apellidos: <?= $apellidos ?> Dirección: <?= $direccion ?> Teléfono: <?= $telefono ?></p>
		<p> 
			<?= form_open("usuarios/editar") ?>
			    <?= form_hidden('id_usuario', $id_usuario) ?>
  				<?= form_submit('editar', 'Editar') ?>
		    <?= form_close() ?>	
		    <?= form_open("usuarios/borrar") ?>
			    <?= form_hidden('id_usuario', $id_usuario) ?>
  				<?= form_submit('borrar', 'Borrar') ?>
		    <?= form_close() ?>	
		</p>
	</fieldset>
</div>
<br/>
<div>
	<table border="1" style="margin: auto" class="tabla_pedidos">
	  <thead>
	    <th>Número Pedido</th>
	    <th>Fecha</th>
	    <th>Estado</th>
	  </thead>
	  <tbody align="center">
		<?php foreach ($pedidos as $pedido): ?>
		<?php extract($pedido); ?>
			<td>
				<?= $id_pedido ?>
			</td>
			<td>
				<?= $fecha ?>
			</td>
			<td>
				<?= $estado ?>
			</td>
		<?php endforeach;?>
</div>