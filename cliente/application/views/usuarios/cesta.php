<?php if($filas): ?>
	<p id="p_informativo">Estos son los productos que contiene la cesta. </p>
	<table>
  <thead>
  	<th>
  		Código Producto
  	</th>
    <th>
    	Nombre
    </th>
    <th>
    	Fabricante
    </th>
    <th>
    	Descripción
    </th>
    <th>
    	Tipo Instrumento
    </th>
    <th>
    	Precio
    </th>
    <th>
    	Tipo Pieza
    </th>
    <th>
    	Compatible
    </th>
     <th>
    	Eliminar
    </th>
  </thead>
  <tbody>
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td>
        	<?php $atts = array('width'      => '800',
					             'height'     => '500',
					             'scrollbars' => 'no',
					             'status'     => 'yes',
					             'resizable'  => 'yes',
					             'screenx'    => '0',
					             'screeny'    => '0');?>

		<?php echo anchor_popup("productos/informacion_producto/$id_producto",$id_producto, $atts); ?>
		
        </td>
        <td><?= $nombre_prod ?> </td>
        <td><?= $fabricante ?></td>
        <td><?= $descripcion ?></td>
        <th><?= $tipo_instrumento ?></th>
        <td><?= $precio ?>€</td>
        <td><?= $tnomb_producto ?></td>
        <td><?= $pc_nombre ?></td>
        <td><?= anchor("usuarios/elimina_cesta/$id_producto", 'Eliminar') ?> </td>
      </tr>      
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
	
	<p id="p_informativo"> La cesta está vacía.</p>

<?php endif;?>