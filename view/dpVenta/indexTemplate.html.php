<?php

use mvc\routing\routingClass as routing ?>

<?php $id = dpVentaTableClass::ID ?>
<?php $fecha = dpVentaTableClass::FECHA ?>
<?php $usuario_id = dpVentaTableClass::USUARIO_ID ?>
<?php $peso_animal = dpVentaTableClass::PESO_ANIMAL ?>
<?php $precio_animal = dpVentaTableClass::PRECIO_ANIMAL ?>
<?php $animal_id = dpVentaTableClass::ANIMAL_ID ?>
<?php $numero_documento = dpVentaTableClass::NUMERO_DOCUMENTO ?>


<?php

use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'dpVenta') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                 <a href="<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'report') ?>" class="btn btn-success btn-xs">Reporte</a>
                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active">Buscar</a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>Item</th>
                    <th>documento</th>
                    <th>Peso animal</th>
                    <th> precio animal</th>  
                    <th> animal id </th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($objDventa as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                        <td><?php echo $key->$id ?></td>
                        <td> <?php echo $key->$numero_documento?></td>
                        <td><?php echo $key->$peso_animal ?></td>
                        <td><?php echo $key->$precio_animal ?></td>                        
                        <th><?php echo $key->$animal_id ?></th>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm ">Ver</a>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'edit', array(dpVentaBaseTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'dpVenta') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
<?php endforeach ?>
            </tbody>
        </table>
    </form>

    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('dpVenta', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo dpVentaBaseTableClass::getNameField(dpVentaBaseTableClass::ID, true) ?>">
    </form>
</div>

