<fieldset>
  <legend>Buscar</legend>
  <?= form_open('tiendas/creacion_guitarra') ?>
    <?= form_dropdown('columna', array('id_producto' => 'Código',
                                       'nombre_prod' => 'Nombre',
                                       'fabricante' => 'Fabricante',
                                       'tnomb_producto' => 'Tipo Parte',
                                       'nombre_prov' => 'Marca'), $columna) ?>
    <?= form_input('criterio', $criterio, 'id=buscar') ?>
    <?= form_submit('buscar', 'Buscar', 'id=boton_buscar') ?>
    <?= form_hidden('tipo_producto', $this->session->userdata('producto')) ?>                  
    <?= form_close() ?>
    
    
</fieldset>
<?php if(!empty($filas)): ?>
<p>
<table>
  <thead>
  	<th>
  		<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'id_producto') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('id_producto','Código Producto', "id='boton_cabecera'") ?>
		<?= form_close() ?>
  	</th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'nombre_prod') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('nombre_prod','Nombre', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'fabricante') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('fabricante','Fabricante', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'descripcion') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('descripcion','Descripción', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'tnomb_producto') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('tnomb_producto','Tipo de Parte', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'precio') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('precio','Precio', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'stock') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('stock','Stock Disponible', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'nombre_prov') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('nombre_prov','Proveedor', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'tipo_instrumento') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('tipo_instrumento','Tipo Pieza', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	<?= form_open('tiendas/creacion_guitarra') ?>
  		<?= form_hidden('campo', 'pc_nombre') ?>
  		<?= form_hidden('orden', 'asc') ?>
    	<?= form_submit('pc_nombre','Compatible', "id='boton_cabecera'") ?>
		<?= form_close() ?>
    </th>
    <th>
    	Añadir
    </th>
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
        <td><?= $pc_nombre ?></td>
        <td>
			<?= form_open('tiendas/creacion_guitarra') ?>
		  		<?= form_hidden('id_producto', $id_producto) ?>
		  		<?= form_hidden('id_piezas', $id_piezas) ?>
		    	<?= form_submit('anadir_producto','Añadir') ?>
			<?= form_close() ?>
        </td>
      </tr>      
    <?php endforeach; ?>
  </tbody>
</table>
</p>
<?php else: ?>
	<p id="p_informativo"> No se encontro ningún producto </p>
<?php endif;?>

<!-- Aquí estan los datos del paginador.  -->
<?php if (!empty($numero_paginas)) :?>
<form method="post">
	<input type="hidden" value="paginador">
	<?php for ($i=1; $i <= $numero_paginas; $i++): ?>
		<input type="submit"  name="numero_pagina" value="<?= $i ?>" , id="boton_dni" >
	<?php endfor;?>
</form>
<?php endif;?>

<!-- Se muestra el formulario que controlara los pasos  anteriores-->
<?php if($this->session->userdata('numero_paso')) :?>
	<div>
		<?= form_open('tiendas/creacion_guitarra') ?>
	  		<?= form_hidden('numero_paso', $this->session->userdata('numero_paso')) ?>
	    	<?= form_submit('anterior','Volver al paso anterior') ?>
		<?= form_close() ?>
	</div>
<?php endif; ?>

<?php var_dump($this->session->userdata('cesta')); ?>