<!DOCTYPE HTML>
<html>
<head>
	<title>Facturas Music Band Center.</title>
	<?= link_tag('estilos/factura.css') ?>
</head>
<body>
<div id="posicion_empresa">
<!-- Datos de la empresa -->
	<fieldset  id="datos_empresa">
	    <h1 align="center"><img src="http://localhost/web/proyecto/cliente/estilos/logo_plano.png" 
	  	     alt="Tus instrumentos a medida, guitarras y bajos.." WIDTH="200" HEIGHT="70" border="0"> </h1>
	  	<p>NIF: 99999999A.</p>
	  	<p>Dirección: Calle Ancha Nº 20.</p>
	  	<p>Teléfono: 900123456.</p>
		<p>eMail: info@musicbandcenter.es</p>
		<p>Localidad: Sanlúcar de Barrameda.</p>
		<p>Provincia: Cádiz.</p>
	</fieldset>
</div>

<div id="posicion_datos_factura">
<!--Muestra los datos de la factura y los del cliente. -->
	<fieldset id="datos_factura">
		<h3 align="center"> Datos de la Factura.</h3>
		<?php extract($factura); ?>
		<p>Numero de Factura: <?= $id_factura ?></p>
		<p>Fecha de Factura: <?= $fecha ?> </p>
		<p>Numero de Pedido: <?= $id_pedido ?></p>
		<h3 align="center"> Datos del Cliente.</h3>
		<p>DNI: <?= $dni ?></p>
		<p>Nombre: <?= $nombre_fat ?>
		<p>Apellidos: <?= $apellidos ?></p>
		<p>Dirección: <?= $direccion ?></p>
		<p>Teléfono: <?=$telefono ?> </p>
	</fieldset>
</div>
</br>
<div id="posicion_productos">
<!-- Muestra los productos comprados. -->
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
    	Tipo de Parte
    </th>
    <th>
    	Precio
    </th>
    <th>
    	Unidades
    </th>
    
    <th>
    	Tipo Pieza
    </th>
    <th>
    	Compatible
    </th>
  </thead>
  <tbody>
  	<?php $total = 0;?>
    <?php foreach ($filas as $fila): ?>
      <?php extract($fila); ?>
      <tr>
        <td>
        	<?= $id_producto ?>
        </td>
        <td><?= $nombre_prod ?> </td>
        <td><?= $fabricante ?></td>
        <td><?= $descripcion ?></td>
        <th><?= $tnomb_producto ?></th>
        <td><?= $precio ?>€</td>
        <td><?= $cantidad ?></td>
        <td><?= $tipo_instrumento ?> </td>
        <td><?= $pc_nombre ?></td>
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
</div>
</body>

</html>