<fieldset>
  <legend>Buscar</legend>
  <?= form_open('productos/index') ?>
    <?= form_dropdown('columna', array('id_producto' => 'Código',
                                       'nombre_prod' => 'Nombre',
                                       'fabricante' => 'Fabricante',
                                       'tnomb_producto' => 'Tipo Parte',
                                       'nombre_prov' => 'Marca'), $columna) ?>
    <?= form_input('criterio', $criterio) ?>
    <?= form_submit('buscar', 'Buscar') ?>                  
    <?= form_close() ?>
</fieldset>
<?php if(!empty($filas)): ?>
<?= $this->session->flashdata('mensaje') ?>
 <p  id="p_informativo"><?= isset($mensaje) ? $mensaje : '' ?></p> 
<p>
<table>
  <thead>
  	<th>Código Producto</th>
    <th>Nombre</th>
    <th>Fabricante</th>
    <th>Descripción</th>
    <th>Tipo de Parte</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Proveedor</th>
    <th>Compatible</th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td>
        	<?= form_open('productos/informacion_producto') ?>
  				<?= form_hidden('id_producto', $id_producto) ?>
        		<?= form_submit('id_producto', $id_producto, "id='boton_dni'") ?>
			<?= form_close() ?>
        </td>
        <td><?= $nombre_prod ?> </td>
        <td><?= $fabricante ?></td>
        <td><?= $descripcion ?></td>
        <th><?= $tnomb_producto ?></th>
        <td><?= $precio ?>€</td>
        <td><?= $stock ?></td>
        <td><?= $nombre_prov ?></td>
        <td><?= $tipo_instrumento ?> </td>
      </tr>      
    <?php endforeach; ?>
  </tbody>
</table>
</p>
<?php else: ?>
	<p id="p_informativo"> No se encontro ningún producto </p>
<?php endif;?>
<p>
<?= form_open("productos/alta") ?>
  <?= form_submit('insertar', 'Nuevo Producto') ?>
<?= form_close() ?>
</p>