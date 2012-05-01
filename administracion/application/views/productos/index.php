
<p>
<?php $orden = ''?> 
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
        		<?= form_submit('id_producto', $id_producto) ?>
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
<p>
<?= form_open("productos/alta") ?>
  <?= form_submit('insertar', 'Nuevo Producto') ?>
<?= form_close() ?>
</p>