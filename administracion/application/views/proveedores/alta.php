<?php if (isset($mensaje)): ?>
  <div>
    <p><?= $mensaje ?></p>
  </div>
<?php endif; ?>

<div>
	<fieldset>
		<legend>Instroduce los datos del Proveedor.</legend>
		<?= form_open('proveedores/insertar') ?>
		  <p>
		    <?= form_label('Email:', 'email') ?>
		    <?= form_input('email', $email) ?> <br/>
		    <?= form_label('Nombre:', 'nombre_prov') ?>
		    <?= form_input('nombre_prov', $nombre_prov) ?> <br>
		    <?= form_label('CIF:', 'cif') ?>
		    <?= form_input('cif', $cif) ?> <br/>
		    <?= form_label('Teléfono:', 'telefono') ?>
		    <?= form_input('telefono', $telefono) ?> <br/>
		  </p>
		  <p><?= form_submit('alta_nueva', 'Alta', 'class="boton"') ?>
		     <?= form_submit('cancelar', 'Cancelar', 'class="boton"') ?>
		  </p>
		<?= form_close() ?>
	</fieldset>
</div>
