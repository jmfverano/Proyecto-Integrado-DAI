
<div>
	<!-- Aquí se comprueba si tiene una imagen añadida. -->
	
	<?php if(file_exists("/var/www/web/proyecto/comun/imagen_producto/$id_producto.jpg")): ?>
		<img src="http://localhost/web/proyecto/comun/imagen_producto/<?= $id_producto ?>.jpg" 
	  		 WIDTH="400" HEIGHT="170" border="0">
	<?php else: ?>
		<img src="http://localhost/web/proyecto/comun/imagen_producto/no_imagen_es.jpg" 
	  		 WIDTH="400" HEIGHT="170" border="0">
	<?php endif; ?>
</div>
</br>
<div>
	<p id="p_informativo"> Pulsa añadir y siga los pasos para añadir una imagen.</p>
	<?= form_open('productos/sube_imagen') ?>
      <?= form_submit('anadir', 'Añadir') ?>
      <?= form_hidden('id_producto', $id_producto) ?>
    <?= form_close() ?>
</div>

<?php if(!empty($fila)): ?>
	<?php extract($fila); ?>
	<div>
		</br>
		<table>
			<tr><td colspan="2"> Descripción del Producto </td></tr>
			<tr>
				<td>
					Numero
				</td>
				<td>
					<?= $id_producto ?>
				</td>			
			</tr>
			<tr>	
				<td>
					Nombre
				</td>
				<td>
					<?= $nombre_prod ?>
				</td>
			</tr>
			<tr>	
				<td>
					Descripción
				</td>
				<td>
					<?= $descripcion ?>
				</td>
			</tr>
			<tr>	
				<td>
					Fabricante
				</td>
				<td>
					<?= $fabricante ?>
				</td>
			</tr>
			<tr>	
				<td>
					Stock
				</td>
				<td>
					<?= $stock ?>
				</td>
			</tr>
			<tr>	
				<td>
					Precio
				</td>
				<td>
					<?= $precio ?>
				</td>
			</tr>
			<tr>	
				<td>
					Tipo Instrumento
				</td>
				<td>
					<?= $tipo_instrumento ?>
				</td>
			</tr>
			<tr>	
				<td>
					Compatible
				</td>
				<td>
					<?= $pc_nombre ?>
				</td>
			</tr>
		</table>
	</div>
<?php else: ?>
	<p id="p_informativo"> No se encontro el producto en la base de datos.</p>
<?php endif;?>
<br>
<div>
	<?= form_open('productos/index') ?>
      <?= form_submit('volver', 'Volver') ?>
    <?= form_close() ?>
</div>
