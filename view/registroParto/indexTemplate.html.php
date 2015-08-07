<?php

use mvc\routing\routingClass as routing ?>
<?php use mvc\session\sessionClass  as session ?>
<?php $id = registroPartoTableClass::ID ?>
<?php $fecha = registroPartoTableClass::FECHA_NACIMIENTO ?>
<?php $hembras = registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS ?>
<?php $machos = registroPartoTableClass::MACHOS_NACIDOS_VIVOS ?>
<?php $muertos = registroPartoTableClass::NACIDOS_MUERTOS ?>
<?php $raza_id = razaTableClass::NOMBRE_RAZA ?>
<?php $raza = registroPartoTableClass::RAZA_ID ?>
<?php $animal_id = registroPartoTableClass::ANIMAL_ID ?>
<?php $idR = razaTableClass::ID ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
  <div class="mdl-grid demo-content">
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 text-center">
            <h2>
<?php echo i18n::__('read', NULL, 'parto') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectRegistroParto') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 text-center">
                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertRegistroParto') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="new">
                        <?php echo i18n::__('registrar', null, 'ayuda') ?>
                    </div> 
<!--                <a id="filter" href="#myModalFilter"  data-toggle="modal" class="btn btn-sm btn-info active fa fa-search"></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>-->
                <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportRegistroParto') ?>" class="btn btn-primary active btn-sm fa fa-download"></a>
                   <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>

<!--                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>-->
            </div>
        </div>
        </form>
        <div class="table-responsive"> 
<?php view::includeHandlerMessage() ?>
        <table class="table table-bordered">
            <thead>
                <tr class="success">
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>    <?php echo i18n::__('Number of document', null, 'proveedor') ?></th>
                    <th>    <?php echo i18n::__('parto1', null, 'animal') ?></th>
                    <th>    <?php echo i18n::__('hembras', null, 'parto') ?></th>
                    <th><?php echo i18n::__('machos', null, 'parto') ?></th>
                    <th><?php echo i18n::__('muertos', null, 'parto') ?></th>
                    <th><?php echo i18n::__('raza', null, 'raza') ?></th>
                    <th><?php echo i18n::__('mother', null, 'raza') ?></th>

                    <th><?php echo i18n::__('action') ?></th>
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
                            <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editRegistroParto', array(registroPartoBaseTableClass::ID => $key->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
  <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                    </div>                             
<!--<a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" href="#" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>-->
<!--                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id  ?>)" class="btn btn-danger btn-sm">Eliminar</a>-->
                        </td>
                    </tr>
                    <!-- WINDOWS MODAL DELETE -->
<!--                <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                </div>-->
             <?php $countDetale++ ?>
<?php endforeach ?>
            </tbody>
        </table>
        </div>
    
    
    
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
<!--<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>-->
<!-- FIN WINDOWS MODAL DELETE MASIVE -->

<!-- WINDOWS MODAL FILTERS -->
<!--<div class="modalmask" id="myModalFilter" >
    <div class="modalbox rotate">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
            </div>
            <div class="modal-body">
                <form id="filterForm"  class="form-horizontal"   method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexRegistroParto') ?>">
                      <table class="table table-responsive "> 
                   <tr>
                        <th>
<?php echo i18n::__('fecha', null, 'animal') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fecha_inicial]" >               
                        </th>
                    </tr></br>
   
                                    <tr>
                            <th>
                                <?php echo i18n::__('raza', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[raza]">
                                    <option>... </option>
                                    <?php foreach ($objRaza as $key): ?>
                                        <option value="<?php echo $key->$idR ?>">
                                            <?php echo $key->nombre_raza ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>

                    <tr>
                        <th>
<?php echo i18n::__('fecha', null, 'animal') ?>:
                        </th>
                        <th>
                            <input type="date" name="filter[fecha_fin]" >               
                        </th>
                    </tr>

                      </table>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" ">Cerrar</a>
                <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()">Buscar</button>
            </div>
    
    </div>
</div>-->
  </div>
</main>