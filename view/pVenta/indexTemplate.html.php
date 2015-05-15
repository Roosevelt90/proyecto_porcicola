         <?php 
use mvc\routing\routingClass as routing ?>

<?php $id = pVentaTableClass::ID ?>
<?php $fecha = pVentaTableClass::FECHA ?>
<?php $usuario_id = pVentaTableClass::USUARIO_ID ?>

<?php use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'pVenta') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('pVenta', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('pVenta', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>fecha</th>
                    <th>usuario_id</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($objPventa as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$fecha ?></td>
                        <td><?php echo $key->$usuario_id?></td>
                        <td>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('pVenta', 'edit', array(pVentaBaseTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'pVenta') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('dpVenta','index', array(pVentaBaseTableClass::ID=>$key->$id))?>" class="btn btn-warning btn-sm "><?php echo i18n::__('details',NULL,'dpVenta')?></a>
                        
                        </td>
                    </tr>
<?php endforeach ?>
            </tbody>
        </table>
         <div class="text-right">
             pagina <select id="slgPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb(pVenta,index) ?>')">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>

                </select> de 100
            </div>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('pVenta', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo pVentaTableClass::getNameField(pVentaTableClass::ID, true) ?>">
    </form>
</div>

