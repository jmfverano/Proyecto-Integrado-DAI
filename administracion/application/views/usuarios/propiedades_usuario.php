<div>
	<?= $this->session->flashdata('mensaje');  ?>
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
	<br />
	<div>
	<?php if(!empty($pedidos)):?>
		<table>
			<thead>
				<th>Número Pedido</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th>Cambiar</th>
			</thead>
			<tbody>
			<?php foreach ($pedidos as $pedido): ?>
			<?php extract($pedido); ?>
			<tr>
				<td><?= $id_pedido ?></td>
				<td><?= $fecha ?></td>
				<td>
				<?= form_open('pedidos/modifica_estado') ?>
    			<?= form_dropdown('estado', array('Iniciado' => 'Iniciado',
                                   				   'Cancelado' => 'Cancelado',
                                                   'Procesado' => 'Procesado',
                                                   'Terminado' => 'Terminado',
                                                   'Enviado' => 'Enviado'), $estado) ?></td>
               <td> 
               <?= form_hidden('id_pedido', $id_pedido) ?>                                  
               <?= form_submit('cambiar', 'Cambiar') ?>                  
               <?= form_close() ?>
               </td>
				<?php endforeach;?>
			</tr>
			</tbody>
		</table>
		<?php else: ?>
		<p id="p_informativo">El usuario no realizó ningún pedido.</p>
		<?php endif;?>
	</div>
</div>
