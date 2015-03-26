<?php

use mvc\routing\routingClass as routing ?>

<?php $id = razaTableClass::ID ?>
<?php $nombre = razaTableClass::NOMBRE_RAZA ?>

<?php

use mvc\i18n\i18nClass as i18n ?>

<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'raza') ?>
            </h2>
        </div>
    </div>
    <?php view::includeHandlerMessage() ?>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectRaza') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertRaza') ?>" class="btn btn-success btn-xs">Nuevo</a>
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
<?php foreach ($objRaza as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$nombre ?></td>
                        <td>
                            <a  href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editRaza', array(razaTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$id ?>" href="#" class="btn btn-danger btn-sm">Eliminar</a>
                            <!--<a href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>-->
                        </td>
                    </tr>
                         <!-- WINDOWS MODAL DELETE -->
                        <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete', null, 'user') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                  desea eliminar la raza??
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo razaTableClass::getNameField(razaTableClass::ID,true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteRaza') ?>')">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
 
<?php endforeach ?>
            </tbody>
        </table>
    </form>
        <!----PAGINADOR---->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor; ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>
</div>
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


