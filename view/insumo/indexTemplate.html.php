<?php
use mvc\routing\routingClass as routing ?>

<?php $id = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>

<?php
use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'insumo') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="active">
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($objInsumo as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$nombre ?></td>
                        <td>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'edit', array(insumoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
<?php endforeach//close foreach ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('insumo', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, true) ?>">
    </form>
</div>

