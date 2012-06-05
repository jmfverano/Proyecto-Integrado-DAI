<div id="eliminar_cesta">
    <p>Se encontraron productos en la cesta. ¿Quiere eliminar los articulos?</p>
	<?= form_open('tiendas/creacion_instrumento') ?>
    	<?= form_submit('elimina_cesta','Eliminar pedido anterior') ?>
    	<?= form_submit('cancelar','Cancelar') ?>
	<?= form_close() ?>
	
	<p>También puede continuar con el proceso pulsando continuar.</p>
	<?= form_open('tiendas/creacion_instrumento') ?>
    	<?= form_submit('continuar','Continuar') ?>
    	<?= form_submit('cancelar','Cancelar') ?>
	<?= form_close() ?>
</div>