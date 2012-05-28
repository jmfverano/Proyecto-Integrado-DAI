<div id="eliminar_cesta">
    <p>Se encontraron productos en la cesta. ¿Quiere eliminar los articulos?</p>
	<?= form_open('tiendas/creacion_guitarra') ?>
    	<?= form_submit('elimina_cesta','Eliminar pedido anterior') ?>
    	<?= form_submit('cancelar','Cancelar') ?>
	<?= form_close() ?>
</div>