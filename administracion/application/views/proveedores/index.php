<p>
<fieldset>
	<legend>Buscar</legend>
	<?= form_open('proveedores/index') ?>
	<?= form_dropdown('columna', array('id_proveedor' => 'Código',
			'nombre_prov' => 'Nombre',
			'cif' => 'CIF',
			'telefono' => 'Teléfono',
                                        'email' => 'Email'), $columna) ?>
	<?= form_input('criterio', $criterio) ?>
	<?= form_submit('buscar', 'Buscar') ?>
	<?= form_close() ?>
</fieldset>
</p>
<p id="p_informativo">
	<?php  if (!empty($mensaje)) $mensaje; ?>
</p>

<?php if(!empty($filas)): ?>
	<p>
		<table>
			<thead>
				<th><?= form_open('proveedor/index') ?> <?= form_hidden('orden', 'id_proveedor') ?>
					<?= form_submit('id_proveedor','Código', "id='boton_cabecera'") ?> <?= form_close() ?>
				</th>
				<th><?= form_open('proveedor/index') ?> <?= form_hidden('orden', 'nombre_prov') ?>
					<?= form_submit('nombre_prov','Nombre' , "id='boton_cabecera'") ?> <?= form_close() ?>
				</th>
				<th><?= form_open('proveedor/index') ?> <?= form_hidden('orden', 'cif') ?>
					<?= form_submit('cif','CIF', "id='boton_cabecera'") ?> <?= form_close() ?>
				</th>
				<th><?= form_open('proveedor/index') ?> <?= form_hidden('orden', 'telefono') ?>
					<?= form_submit('telefono','Teléfono', "id='boton_cabecera'") ?> <?= form_close() ?>
				</th>
				<th><?= form_open('proveedor/index') ?> <?= form_hidden('orden', 'email') ?>
					<?= form_submit('email','Email', "id='boton_cabecera'") ?> <?= form_close() ?>
				</th>
			</thead>
			<tbody>
				<?php foreach ($filas as $fila): ?>
				<?php extract($fila); ?>
				<tr>
					<td><?= $id_proveedor ?>
					</td>
					<td><?= $nombre_prov ?>
					</td>
					<td><?= $cif ?>
					</td>
					<td><?= $telefono ?>
					</td>
					<td><?= $email ?>
				
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</p>
<?php else: ?>
	<p id="p_informativo">No se encontro ningun proveedor.</p>
<?php endif;?>
<p>
	<?= form_open("proveedores/insertar") ?>
	<?= form_submit('insertar', 'Nuevo Proveedor') ?>
	<?= form_close() ?>
	<?= form_open("index/index") ?>
	<?= form_submit('volver', 'Volver al Inicio') ?>
	<?= form_close() ?>
</p>
