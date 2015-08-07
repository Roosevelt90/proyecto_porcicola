<?php

use mvc\routing\routingClass as routing ?>

<?php $id = registroPartoTableClass::ID ?>
<?php $fecha = registroPartoTableClass::FECHA_NACIMIENTO ?>
<?php $hembras = registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS ?>
<?php $machos = registroPartoTableClass::MACHOS_NACIDOS_VIVOS ?>
<?php $muertos = registroPartoTableClass::NACIDOS_MUERTOS ?>
<?php $raza_id = razaTableClass::NOMBRE_RAZA ?>
<?php $raza = registroPartoTableClass::RAZA_ID ?>
<?php $animal_id = registroPartoTableClass::ANIMAL_ID ?>
<?php

use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'parto') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectRegistroParto') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportRegistroParto') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('report') ?></a>
                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active">Buscar</a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertRegistroParto') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
<?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>Fecha Nacimiento</th>
                    <th>Hembras Vivas</th>
                    <th>Machos Vivos</th>
                    <th>Muertos</th>
                    <th>Raza</th>
                    <th>Madre</th>

                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($objParto as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                        <th><?php echo $key->$id ?></th>
                        <th><?php echo $key->$fecha ?></th>
                        <td><?php echo $key->$hembras ?></td>
                        <td><?php echo $key->$machos ?></td>
                        <td><?php echo $key->$muertos ?></td>
                        <th><?php echo $key->$raza ?></th>
                        <th><?php echo $key->$animal_id ?></th>

                        <td>
                            <!--<a href="#" class="btn btn-warning btn-sm disabled">Ver</a>-->
                            <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editRegistroParto', array(registroPartoBaseTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <!--<a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" href="#" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>-->
                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id  ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <!-- WINDOWS MODAL DELETE -->
                <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm') ?></h4>
                            </div>
                            <div class="modal-body">
                                ¿<?php echo i18n::__('confirmDelete') ?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteRegistroParto') ?>')"><?php echo i18n::__('delete') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            
<?php endforeach ?>
            </tbody>
        </table>
    </form>
    
    
      <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <?php $count = 0 ?>
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>
    
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteRegistroParto') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::ID, true) ?>">
    </form>
</div>

<!-- WINDOWS MODAL DELETE MASIVE -->
<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('deleteMasive') ?></h4>
            </div>
            <div class="modal-body">
<?php echo i18n::__('confirmDeleteMasive') ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN WINDOWS MODAL DELETE MASIVE -->

<!-- WINDOWS MODAL FILTERS -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
            </div>
            <div class="modal-body">
                <form id="filterForm"  class="form-horizontal"   method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>">
                      <table class="table table-responsive "> 
<!--                   <tr>
                        <th>
<?php //echo i18n::__('fecha', null, 'animal') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fecha_inicial]" >               
                        </th>
                    </tr></br>-->
   <tr>
                                    <tr>
                            <th>
                                <?php echo i18n::__('raza', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[raza]">
                                    <option>... </option>
                                    <?php foreach ($objRaza as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_raza ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>

<!--                    <tr>
                        <th>
<?php// echo i18n::__('fecha', null, 'animal') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fecha_fin]" >               
                        </th>
                    </tr>-->

                      </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()">Buscar</button>
            </div>
        </div>
    </div>
</div>