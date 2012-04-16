<div class="datos_usuario">
	<fieldset>
		<p align="center">DNI: <?php $dni ?> Nombre: <?php $nombre?> Apellidos: <?php $apellidos ?> Dirección: <?php $direccion ?> Teléfono: <?php $telefono ?></p>
		<p align="center"> 
			<?= form_open("usuarios/index") ?>
			    <?= form_hidden('id_usuario', $id_usuario) ?>
  				<?= form_submit('editar', 'Editar') ?>
  				<?= form_submit('borrar', 'Borrar') ?>
  				<?= form_submit('volver', 'Volver') ?>
		    <?= form_close() ?>	
		</p>
	</fieldset>
</div>

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