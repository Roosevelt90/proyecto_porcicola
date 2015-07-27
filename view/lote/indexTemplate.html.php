<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = loteTableClass::ID ?>
<?php $nombre = loteTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">
      <div class="row">
        <div class="col-xs-4-offset-4 titulo">
          <h2>
            <?php echo i18n::__('read', NULL, 'lote') ?>
          </h2>
        </div>
      </div>
      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectLote') ?>" method="POST">
        <div class="row">
          <div class="col-xs-4-offset-4 nuevo">
            <a id="deleteMasa" href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()"><?php echo i18n::__('borrar seleccion') ?></a>
            <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
              <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
            </div>
            <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertLote') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('nuev') ?></a>
            <div class="mdl-tooltip mdl-tooltip--large" for="new">
              <?php echo i18n::__('registrar', null, 'ayuda') ?>
            </div>
          </div>
        </div>
        <?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive">
          <thead>
            <tr class="active">
              <td><input type="checkbox" id="chkAll"></td> 
              <th><?php echo i18n::__('id') ?></th>
              <th><?php echo i18n::__('name') ?></th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($objLote as $key): ?>
              <tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                <td><?php echo $key->$id ?></td>
                <td><?php echo $key->$nombre ?></td>
                <td>
                  <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editLote', array(loteTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                    <?php echo i18n::__('modificar', null, 'ayuda') ?>
                  </div> 
                  <a id="eliminar<?php echo $countDetale ?>"  href="#myModalDelete<?php echo $key->$id ?>" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                    <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                  </div> 
                </td>
              </tr>

              <!-- WINDOWS MODAL DELETE -->
            <div id="myModalDelete<?php echo $key->$id ?>" class="modalmask">
              <div class="modalbox rotate">
                <a href="#close" title="Close" class="close">X</a>
                <div class="modal-body">
                  ¿<?php echo i18n::__('confirmDelete') ?>?
                </div>
                <div class="modal-footer">
                  <a href="#close2" title="Close" class="close2 btn btn-info"><?php echo i18n::__('cancel') ?></a>
                  <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteLote') ?>')"><?php echo i18n::__('delete') ?></button>
                </div>
              </div>
            </div>

            <?php $countDetale++ ?>
          <?php endforeach//close foreach  ?>
          </tbody>
        </table>
      </form>
      <!----PAGINADOR---->
      <div class="text-right">
        <nav>
          <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
              <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
              <?php $count ++ ?>        
            <?php endfor; //close for  ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexLote') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
          </ul>
        </nav>
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
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>