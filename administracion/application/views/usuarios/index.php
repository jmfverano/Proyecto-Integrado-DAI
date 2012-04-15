<p>
<fieldset>
  <legend>Buscar</legend>
  <?= form_open('usuarios/index') ?>
    <?= form_dropdown('columna', array('dni' => 'DNI',
                                       'nombre' => 'Nombre',
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
    <th><?= anchor('usuarios/index', 'DNI', $orden = "dni") ?></th>
    <th><?= anchor('usuarios/index', 'Nombre', $orden = "nombre") ?></th>
    <th><?= anchor('usuarios/index', 'Apellidos', $orden = "apellidos") ?></th>
    <th><?= anchor('usuarios/index', 'Dirección', $orden = "direccion") ?></th>
    <th><?= anchor('usuarios/index', 'Teléfono', $orden = "telefono") ?></th>
    <th><?= anchor('usuarios/index', 'Tipo de Usuario', $orden = "admin") ?></th>
  </thead>
  <tbody align="center">
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td><?= anchor('usuarios/propiedades_usuario', $dni, $id_usuario) ?></td>
        <td><?= $nombre ?></td>
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