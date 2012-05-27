<p>
<?php if(!empty($mensaje)): ?>
	<?= $mensaje ?>
<?php endif; ?>	
</p>
<p>
<fieldset>
  <legend>Alta Producto.</legend>
  <?= form_open('productos/alta') ?>
    Compatible con
    <?= form_dropdown('id_categoria', $categoria) ?> </br>
    Proveedor 
    <?= form_dropdown('id_proveedor', $proveedor) ?> </br>
    Tipo producto
    <?= form_dropdown('id_tipo_producto', $tipo) ?> </br>
    Pieza compatible 
    <?= form_dropdown('id_piezas', $pieza_compatible) ?> </br>
    <?= var_dump($pieza_compatible); ?>
    <?= form_label('Nombre:', 'nombre_prod') ?>
    <?= form_input('nombre_prod', $nombre_prod) ?><br/>
    <?= form_label('Descripción:', 'descripcion') ?>
    <?= form_input('descripcion', $descripcion) ?><br/>
    <?= form_label('Fabricante:', 'fabricante') ?>
    <?= form_input('fabricante', $fabricante) ?><br/>
    <?= form_label('Precio:', 'precio') ?>
    <?= form_input('precio', $precio) ?><br/>
    <?= form_label('Stock:', 'stock') ?>
    <?= form_input('stock', $stock) ?><br/>
    <?= form_submit('alta', 'Alta') ?>
    <?= form_submit('cancelar', 'Cancelar') ?>                                    
  <?= form_close() ?>
</fieldset>
</p>

