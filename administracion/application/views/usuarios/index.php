<p>
<fieldset>
  <legend>Buscar</legend>
  <?= form_open('usuarios/index') ?>
    <?= form_dropdown('columna', array('dni' => 'DNI',
                                       'nombre_usu' => 'Nombre',
                                       'direccion' => 'Dirección',
                                       'telefono' => 'Teléfono',
                                       'apellidos' => 'Apellidos'), $columna) ?>
    <?= form_input('criterio', $criterio) ?>
    <?= form_submit('buscar', 'Buscar') ?>
                                       
  <?= form_close() ?>
</fieldset>
</p>
<p>
<?php $orden = ''?> 
<table border="1" style="margin: auto" class="tabla_usuario">
  <thead>
    <th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'dni') ?>
    	<?= form_submit('dni','DNI') ?>
		<?= form_close() ?>
	</th>
	<th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'nombre_usu') ?>
    	<?= form_submit('nombre_usu','Nombre') ?>
		<?= form_close() ?>
	</th>
    <th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'apellidos') ?>
    	<?= form_submit('apellidos','Apellidos') ?>
		<?= form_close() ?>
	</th>
    <th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'direccion') ?>
    	<?= form_submit('direccion','Dirección') ?>
		<?= form_close() ?>
	</th>
    <th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'telefono') ?>
    	<?= form_submit('telefono','Teléfono') ?>
		<?= form_close() ?>
	</th>
    <th>
    	<?= form_open('usuarios/index') ?>
  		<?= form_hidden('orden', 'admin') ?>
    	<?= form_submit('admin','Tipo de Usuario') ?>
		<?= form_close() ?>
	</th>
  </thead>
  <tbody align="center">
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td>
        	<?= form_open('usuarios/propiedades_usuario') ?>
  				<?= form_hidden('id_usuario', $id_usuario) ?>
        		<?= form_submit('dni', $dni) ?>
			<?= form_close() ?>
        </td>
        <td><?= $nombre_usu ?></td>
        <td><?= $apellidos ?></td>
        <td><?= $direccion ?></td>
        <td><?= $telefono ?></td>
        <td>
          <?php if($admin == 't'): ?>
            Administrador
          <?php else: ?>
            Cliente
          <?php endif; ?>
        </td>
      </tr>      
    <?php endforeach; ?>
  </tbody>
</table>
</p>
<p>
<?= form_open("usuarios/insertar") ?>
  <?= form_submit('insertar', 'Nuevo cliente') ?>
<?= form_close() ?>
<?= form_open("usuarios/index") ?>
  <?= form_submit('volver', 'Volver al Inicio') ?>
<?= form_close() ?>
</p>