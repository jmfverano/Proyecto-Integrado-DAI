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
<table border="1" style="margin: auto" class="tabla_usuario">
  <thead>
    <th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Dirección</th><th>Teléfono</th><th>Tipo Usuario</th> <th colspan="3">Operaciones</th>
  </thead>
  <tbody align="center">
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td><?= $dni ?></td>
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
        <td>
          <?= form_open("usuarios/editar") ?>
            <?= form_hidden('id_usuario', $id_usuario)?>
            <?= form_submit('editar', 'Editar') ?>
          <?= form_close() ?>
        </td>
        <td>
          <?= form_open("usuarios/borrar") ?>
            <?= form_hidden('id_usuario', $id_usuario)?>
            <?= form_submit('borrar', 'Borrar') ?>
          <?= form_close() ?>
        </td>
        <td>
          <?= form_open("usuarios/pedidos") ?>
            <?= form_hidden('id_usuario', $id_usuario)?>
            <?= form_submit('pedidos', 'Pedidos') ?>
          <?= form_close() ?>
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