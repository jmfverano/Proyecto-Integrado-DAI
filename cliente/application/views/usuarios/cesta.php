<?= $this->session->flashdata('mensaje'); ?>
<?php if(!empty($filas)): ?>
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
    <?php $total = 0;?>
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
 		 <?php $total += $precio; ?>
    <?php endforeach; ?>
    <?php $iva = ($total * 18) /100; ?>
    <?php $total += $iva;?>
    	<tr>
        <td colspan="8"><b>IVA(18%)</td>
        <td><?= $iva ?>€</td>
       </tr>
       <tr>
        <td colspan="8"><b>Total</td>
        <td><?= $total ?>€</td>
       </tr>
  </tbody>
</table>
</br>
	<?php if($this->session->userdata('completado')):?>
		<div>
			<p id="p_informativo">El proceso guiado ha terminado, ahora confirma y cancela el pedido.</p>
			<?= form_open("tiendas/instrumento_completado") ?>
			<?= form_submit('elimina_cesta', 'Cancelar Pedido') ?>
			<?= form_submit('realizar_pedido', 'Realizar Pedido') ?>
			<?= form_close() ?>
		</div>
	<?php else:?>
		<p id="p_informativo">Para completar el proceso vuelva a la creación de guitarra o bajo.</p>
	<?php endif;?>
<?php else: ?>
	
	<p id="p_informativo"> La cesta está vacía.</p>

<?php endif;?>
<?php var_dump($this->session->userdata('cesta'));?>