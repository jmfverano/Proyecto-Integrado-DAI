<html>
<head>
<title>Añade una imagen al producto</title>
</head>
<body>
<?php echo $error;?>
<fieldset>
	<legend> Busque una imagen </legend>
	<?php echo form_open_multipart('upload/do_upload');?> 
	<input type="file" name="userfile" size="20" />
	<br /><br />
	<input type="submit" value="upload" />
	</form>
	<?= form_open('productos/index') ?>
      <?= form_submit('cancelar', 'Cancelar') ?>
    <?= form_close() ?>
</fieldset>
</body>
</html>