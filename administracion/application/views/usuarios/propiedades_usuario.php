<div>
	<div>
		<fieldset>
			<legend>Datos Usuario</legend>
			<?php extract($usuario); ?>
			<p>
				DNI:
				<?= $dni ?>
				- Nombre:
				<?= $nombre_usu?>
				- Apellidos:
				<?= $apellidos ?>
				- Dirección:
				<?= $direccion ?>
				- Teléfono:
				<?= $telefono ?>
			</p>
			<?= form_open("usuarios/editar") ?>
			<?= form_hidden('id_usuario', $id_usuario) ?>
			<?= form_submit('editar', 'Editar') ?>
			<?= form_close() ?>
			<?= form_open("usuarios/borrar") ?>
			<?= form_hidden('id_usuario', $id_usuario) ?>
			<?= form_submit('borrar', 'Borrar') ?>
			<?= form_close() ?>
			<?= form_open("pedidos/alta") ?>
			<?= form_hidden('id_usuario', $id_usuario) ?>
			<?= form_submit('ir_alta', 'Nuevo Pedido') ?>
			<?= form_close() ?>
		</fieldset>
	</div>
	<br />
	<div>
	<?php if(!empty($pedidos)):?>
		<table>
			<thead>
				<th>Número Pedido</th>
				<th>Fecha</th>
				<th>Estado</th>
			</thead>
			<tbody>
			<?php foreach ($pedidos as $pedido): ?>
			<?php extract($pedido); ?>
				<td><?= $id_pedido ?></td>
				<td><?= $fecha ?></td>
				<td><?= $estado ?></td>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php else: ?>
		<p id="p_informativo">El usuario no realizó ningún pedido.</p>
		<?php endif;?>
	</div>
</div>
