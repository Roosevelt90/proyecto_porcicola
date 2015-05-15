<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\routing\routingClass as routing ?>

<?php $id = cargoTableClass::ID ?>
<?php $descripcion_cargo = cargoTableClass::DESCRIPCION ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'cargo') ?>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4-offset-4 nuevo">
            <a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'insertCargo') ?>" class="btn btn-success btn-xs">Nuevo</a>
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>

        </div>
    </div>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <th><input type="checkbox" id="chkAll"></th> 
                <th><?php echo i18n::__('identification') ?></th>
                <th><?php echo i18n::__('name') ?></th>
                <th><?php echo i18n::__('action') ?></th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($objCargo as $key): ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                    <td><?php echo $key->$id ?></td>
                    <td><?php echo $key->$descripcion_cargo ?></td>
                    <td>

                        <a  href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'editCargo', array(cargoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm">modificar</a>
                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" href="#" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>


                <!-- WINDOWS MODAL DELETE -->
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteCargo') ?>" method="POST">

                <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete', null, 'cargo') ?></h4>
                            </div>
                            <div class="modal-body">
                                desea eliminar cargos?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteCargo') ?>')">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


<?php endforeach ?>
        <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('empleado', 'deleteCargo') ?>" method="POST">
            <input type="hidden" id="idDelete" name="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>">
        </form>


        </tbody>
    </table>
    <!----paginado-->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexCargo') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexCargo') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
<?php endfor; ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('empleado', 'indexCargo') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>


