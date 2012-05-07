<p id="p_informativo"> Selecciona la operación deseada.. </p>

<div class="menu_cliente">
    <?= form_open('index/index') ?>
      <?= form_submit('usuarios','Gestión Usuario') ?>
    <?= form_close() ?>
</div>

<div class="menu_productos">
    <?= form_open('index/index') ?>
      <?= form_submit('productos', 'Gestión Productos') ?>
    <?= form_close() ?>
</div>

<div class="menu_proveedor">
    <?= form_open('index/index') ?>
      <?= form_submit('proveedor', 'Gestión Proveedores') ?>
    <?= form_close() ?>
</div>


