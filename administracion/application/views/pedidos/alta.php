<div>
	<fieldset>
		<legend>Usuario que Realiza el Pedio</legend>
		<?php extract($usuario); ?>
		<p id="p_informativo">DNI: <?= $dni ?> - Nombre: <?= $nombre_usu?> - Apellidos: <?= $apellidos ?> - Dirección: <?= $direccion ?> - Teléfono: <?= $telefono ?></p>
	</fieldset>
	</br>
	<div id="cuadro_login">
		
		<?= form_open('pedidos/alta') ?>
	    Cuerpo 
	    <?= form_dropdown('id_cuerpo', $cuerpo) ?> </br>
	    Pastilla Mastil 
	    <?= form_dropdown('id_p_mastil', $p_mastil) ?> </br>
	    Pastilla Puente
	    <?= form_dropdown('id_p_puente', $p_puente) ?> </br>
	    Pastilla Central
	    <?= form_dropdown('id_p_central', $p_central) ?> </br>
	    Set Pastillas
	    <?= form_dropdown('id_set_pastilla', $set_pastilla) ?> </br>
	    Mastil
	    <?= form_dropdown('id_mastil', $mastil) ?> </br>
	    Calvijero
	    <?= form_dropdown('id_clavijero', $clavijero) ?> </br>
	    Cuerdas
	    <?= form_dropdown('id_cuerdas', $cuerdas) ?> </br>
	    Cejuela
	    <?= form_dropdown('id_cejuela', $cejuela) ?> </br>
	    Puente
	    <?= form_dropdown('id_puente', $puente) ?> </br>
	    Potenciometro
	    <?= form_dropdown('id_poteciometro', $potenciometro) ?> </br>
	    Conexión Jack
	    <?= form_dropdown('id_jack', $jack) ?> </br>
	    Selector de Posición
	    <?= form_dropdown('id_s_posicion', $s_posicion) ?> </br>
	    Guarda Puas
	    <?= form_dropdown('id_guarda_puas', $guarda_puas) ?> </br>
	    Otros accesorios
	    <?= form_dropdown('id_otros', $otros) ?> </br>
	    </br>
	    <?= form_hidden($id_usuario) ?>
	    <?= form_submit('realizar_pedido', 'Realizar Pedido') ?>
	    <?= form_submit('cancelar', 'Cancelar') ?>                                    
	  	<?= form_close() ?>
	</div>
</div>