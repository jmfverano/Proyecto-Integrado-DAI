<div>
  <p><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<div>
<?= form_open('usuarios/borrar') ?>
  <p>
    <strong>¿Está seguro que desea borrar su cuenta de usuario?</strong>
  </p>
  	<?= form_hidden('id_usuario', $id_usuario)?>
  <p><?= form_submit('si', 'Si') ?>
     <?= form_submit('no', 'No') ?></p>
<?= form_close() ?>
</div>
