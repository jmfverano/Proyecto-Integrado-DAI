<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

<div>
<?= form_open('usuarios/editar') ?>
  <p>
  	<?= form_label('DNI:', 'dni') ?>
    <?= form_input('dni', $dni) ?> <br/>
    <?= form_hidden('id_usuario', $id_usuario) ?>
    <?= form_label('Email:', 'email') ?>
    <?= form_input('email', $email) ?> <br/>
    <?= form_label('Nombre:', 'nombre_usu') ?>
    <?= form_input('nombre_usu', $nombre_usu) ?> <br>
    <?= form_label('Apellidos:', 'apellidos') ?>
    <?= form_input('apellidos', $apellidos) ?> <br/>
    <?= form_label('Direccion:', 'direccion') ?>
    <?= form_input('direccion', $direccion) ?> <br/>
    <?= form_label('Teléfono:', 'telefono') ?>
    <?= form_input('telefono', $telefono) ?> <br/>
  </p>
  <p><?= form_submit('actualizar', 'Actualizar', 'class="boton"') ?>
     <?= form_submit('cancelar', 'Cancelar', 'class="boton"') ?>
     <?= form_submit('m_password', 'Modificar Constraseña', 'class="boton"') ?></p>
<?= form_close() ?>
</div>
