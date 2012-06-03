<div>
  <p  id="p_informativo"><?= isset($mensaje) ? $mensaje : '' ?></p> 
</div>
<div id="cuadro_login">
<p id="p_informativo">Introduce los datos para continuar.</p>
<?php $attributes = array('id' => 'login');?>
<?= form_open('usuarios/login', $attributes) ?>
    <?= form_label('Usuario:', 'email') ?> <br/>
    <?= form_input('email') ?><br/>
    <br/>
    <?= form_label('Constraseña:', 'password') ?> <br/> 
    <?= form_password('password') ?><br/>
 <p><?= form_submit('login', 'Login') ?>
    <?= form_submit('recuperar', 'Olvido su contraseña')?>
    <?= form_submit('nuevo', 'Nuevo usuario')?></p>
<?= form_close() ?>
</div>
