<div>
	<?= $this->session->flashdata('mensaje'); ?>
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
			</br>
			<?= form_open("usuarios/index") ?>
			<?= form_submit('editar', 'Editar') ?>
			<?= form_submit('borrar', 'Borrar') ?>
			<?= form_submit('nuevo_instrumento', 'Nuevo Instrumento') ?>
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
				<th>Generar PDF</th>
			</thead>
			<tbody>
			<?php foreach ($pedidos as $pedido): ?>
			<?php extract($pedido); ?>
			<?php $atts = array('width'      => '1024',
					             'height'     => '768',
					             'scrollbars' => 'yes',
					             'status'     => 'yes',
					             'resizable'  => 'yes',
					             'screenx'    => '0',
					             'screeny'    => '0');?>
				<tr>
					<td><?php echo anchor_popup("tiendas/muestra_factura/$id_pedido",$id_pedido, $atts); ?></td>
					<td><?= $fecha ?></td>
					<td><?= $estado ?></td>
					<td> <?php echo anchor_popup("tiendas/obtener_factura_en_pdf/$id_pedido",'Obtener PDF', $atts); ?> </td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php else: ?>
		<p id="p_informativo">El usuario no realizó ningún pedido.</p>
		<?php endif;?>
	</div>
</div>
<?php echo $this->session->userdata('id_usuario'); ?>