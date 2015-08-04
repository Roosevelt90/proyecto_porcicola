<?php

use mvc\routing\routingClass as routing ?>
<?php $usu = usuarioTableClass::USER ?>
<?php $id = usuarioTableClass::ID ?>
<?php $creacion = usuarioBaseTableClass::CREATED_AT ?>
<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass  as session ?>
<?php $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--blue-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">
      <div class="row">
        <div class="col-xs-4-offset-4 text-center">
          <h2>
            <?php echo i18n::__('read', NULL, 'user') ?>
          </h2>
        </div>
      </div>
      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteSelectUsuario') ?>" method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-4-offset-4 text-center">

               <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'insertUsuario') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
               <div class="mdl-tooltip mdl-tooltip--large" for="new">
               <?php echo i18n::__('registrar', null, 'ayuda') ?>
               </div>
               <a id="deleteMasa" href="#myModalEliminarMasivo" class="btn btn-default btn-sm fa fa-trash-o"  onclick="borrarSeleccion()"></a>
               <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
               <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
               </div>
               <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
               <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                        <?php echo i18n::__('buscar', null, 'ayuda') ?>
                    </div>
               <a class="btn btn-sm btn-primary fa fa-reply" id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteFiltersUsuario') ?>"></a> 
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                        <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                    </div> 
               <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'reportUsuario') ?>" class="btn btn-primary active btn-sm fa fa-download"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                        <?php echo i18n::__('reporte', null, 'ayuda') ?>
                    </div>
            </div>
          </div>

          <div class="table-responsive">
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered">
              <thead>
                <tr class="success">
                  <th><input type="checkbox" id="chkAll"></th>
                  <th><?php echo i18n::__('usuario', null, 'user') ?></th>
                  <th><?php echo i18n::__('date', null, 'user') ?></th>
                  <th><?php echo i18n::__('action') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($objUsuarios as $usuario): ?>   
                  <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $usuario->$id ?>"></td>
                    <td><?php echo $usuario->$usu ?></td>
                    <td><?php echo $usuario->$creacion ?></td>
                    <td>
                        <a id="verDetalle<?php echo $countDetale ?>"href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'view', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">watch</i></a>
                       <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                                      <?php echo i18n::__('verDetalle', null, 'ayuda') ?>
                                  </div>  
                      <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'editUsuario', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                       <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                    </div> 
                      <a id="eliminar<?php echo $countDetale ?>" href="#myModalDelete<?php echo $usuario->$id ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">delete</i></a>
                       <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                        <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                                    </div> 
                    </td>
                  </tr>
                  <!-- WINDOWS MODAL DELETE -->
                <div id="myModalDelete<?php echo $usuario->$id ?>" class="modalmask">
                  <div class="modalbox rotate">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete', null, 'user') ?></h4>
                    </div>
                    <div class="modal-body">
                      ¿<?php echo i18n::__('bodyDelete', null, 'user') ?> <?php echo $usuario->$usu ?>?
                      <h5><?php echo i18n::__('motivo', null, 'user') ?>:</h5>
                      <textarea name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::OBSERVACION, true) ?>">
                                                              
                      </textarea>
                    </div>
                    <div class="modal-footer">
                      <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                      <button type="button" class="btn btn-primary fa fa-eraser" onclick="eliminar(<?php echo $usuario->$id ?>, '<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteUsuario') ?>')">Eliminar</button>
                    </div>
                  </div>
                </div>
               <?php $countDetale++ ?>
              <?php endforeach ?> 
              </tbody>
            </table>
          </div>
      </form>
      <div class="text-right">
        <nav>
          <ul class="pagination" id="slqPaginador">
            <?php $count = 0 ?>
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
              <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
              <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
          </ul>
        </nav>
      </div>
      <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteUsuario') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
      </form>
    </div>

    <!-- WINDOWS MODAL FILTERS -->
    <div id="myModalFilter" class="modalmask">
      <div class="modalbox rotate">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"> <?php echo i18n::__('busq', null, 'user') ?></h4>
        </div>
        <div class="modal-body">
          <form id="filterForm"  class="form-horizontal"   method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>">

            <div class="form-group">
              <label for="filterNombre_usuario" class="col-sm-2 control-label" ><?php echo i18n::__('usuario', null, 'user') ?></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="filterNombre_usuario" name="filter[nombre_usuaio]" placeholder="nombre_usuario">
              </div>
            </div>
            <table>

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
          <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
          <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
        </div>
      </div>
    </div>



    <div id="myModalEliminarMasivo" class="modalmask">
      <div class="modalbox rotate">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"> <?php echo i18n::__('deleteMasive') ?></h4>
        </div>
        <div class="modal-body">
          <?php echo i18n::__('confirmDeleteMasive') ?>
        </div>
        <div class="modal-footer">
          <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
          <button type="button" class="btn btn-primary fa fa-eraser" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
        </div>
      </div>
    </div>
  </div>
</main>
