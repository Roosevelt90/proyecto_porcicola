<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\request\requestClass as request ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php $fechaEntrada = entradaBodegaTableClass::FECHA ?>
<?php $id_empleado = empleadoTableClass::ID ?>
<?php $nombre_empleado = empleadoTableClass::NOMBRE ?>
<?php $estado = entradaBodegaTableClass::ESTADO ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">


      <div class="row">
        <div class="col-xs-12 text-center">

          <h2>
            <?php echo i18n::__('RegistrosEntrada') ?> 
          </h2>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 text-center">
          <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
            <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'insertEntrada') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
            <div class="mdl-tooltip mdl-tooltip--large" for="new">
              <?php echo i18n::__('registrar', null, 'ayuda') ?>
            </div>
            <a id="deleteMasa" href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-default btn-sm fa fa-exchange"></a>
            <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
              <?php echo i18n::__('inhabilitarMasa', null, 'ayuda') ?>
            </div>
          <?php endif; ?>
          <a id="filter" href="#myModalFilter"  class="btn btn-sm btn-info active fa fa-search"></a>
          <div class="mdl-tooltip mdl-tooltip--large" for="filter">
            <?php echo i18n::__('buscar', null, 'ayuda') ?>
          </div>
          <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'deleteFilterEntrada') ?>" class="btn btn-sm btn-primary fa fa-reply" ></a>
          <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
            <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
          </div>
          <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportCompra') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
          <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
            <?php echo i18n::__('reporte', null, 'ayuda') ?>
          </div>
        </div>
      </div>
      <?php view::includeHandlerMessage() ?>
        <div class="table-responsive">
      <table class="table table-bordered">
          <thead>
            <tr class="success">
              <th>
                                      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">
                <input type="checkbox" id="chkAll">
                                      </form></th>
              <th><?php echo i18n::__('numberDoc', null, 'datos') ?> </th>
              <th><?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?> </th>
              <th><?php echo i18n::__('empleado', null, 'empleado') ?> </th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($objEntradaBodega as $key): ?>
              <tr> 
                <td>
                  <?php if ($key->$estado == true): ?> 
                    <input type="checkbox" name="chk[]" value="<?php echo $key->id ?>">
                  <?php endif; //close if   ?>
                </td>
                <td><?php echo $key->$id . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>
                <td><?php echo $key->$fechaEntrada ?></td>
                <td><?php echo $key->$nombre_empleado ?></td>
                <td>  

                  <?php if ($key->$estado == true): ?>
                    <?php if (session::getInstance()->hasCredential('admin') == 1): ?>
                      <a  id="editar<?php echo $countDetale ?>" href="<?php // echo routing::getInstance()->getUrlWeb('bodega', 'editEntrada', array(entradaBodegaTableClass::ID => $key->$idEntrada))    ?>" class="btn btn-default active btn-sm fa fa-edit"></a>
                      <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                        <?php echo i18n::__('modificar', null, 'ayuda') ?>
                      </div> 
                      <a id="habilitar<?php echo $countDetale ?>"  href="#changeState<?php echo $key->$id ?>" class=" btn btn-sm btn-default fa fa-ban" ></a>
                      <div class="mdl-tooltip mdl-tooltip--large" for="habilitar<?php echo $countDetale ?>">
                        <?php echo i18n::__('habilitar', null, 'ayuda') ?>
                      </div> 

                      <a id="insertDetalle<?php echo $countDetale ?>" href="#myModalInserDetails<?php echo $key->$id ?>" class="btn btn-sm btn-primary fa fa-bars" ></a>
                      <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                        <?php echo i18n::__('insertDetalle', null, 'ayuda') ?>
                      </div> 
                    <?php endif; ?>
                  <?php endif; ?>
                  <a   id="verDetalle<?php echo $countDetale ?>"  href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'viewEntrada', array(entradaBodegaTableClass::ID => $key->$id)) ?>" class="btn btn-primary active btn-sm fa fa-eye"> </a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                    <?php echo i18n::__('verDetalle', null, 'ayuda') ?>
                  </div> 
                </td>
              </tr>

          <!-- WINDOWS MODAL CHANGE STATE -->
          <div id="changeState<?php echo $key->$id ?>" class="modalmask">
            <div class="modalbox rotate">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('inhRegistro') ?></h4>
              </div>
              <a href="#close" title="Close" class="close">X</a>
              <div class="modal-body">
                <?php echo i18n::__('confirmInhabil') ?>
              </div>
              <div class="modal-footer">
                <a href="#close2" title="Close" class="close2 btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                <button type="button" class="btn btn-primary fa fa-ban" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('bodega', 'deleteEntrada') ?>')"> <?php echo i18n::__('inhabil') ?></button>
              </div>
            </div>
          </div>

          <!-- WINDOWS MODAL DETAILS -->
          <div id="myModalInserDetails<?php echo $key->$id ?>" class="modalmask">
            <div class="modalbox rotate">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('insertDetail', null, 'vacunacion') ?></h4>
              </div>
              <a href="#close" title="Close" class="close">X</a>
              <div class="modal-body">
                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('bodega', 'createDetalleEntrada') ?>">

                  <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true) ?>">

                  <h3>tipo insumo</h3>
                  <select name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::TIPO_INSUMO, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objTipoInsumo as $key): ?>
                      <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
                    <?php endforeach; //close foreach   ?>
                  </select>

                  <h3><?php echo i18n::__('insumo') ?></h3>
                  <select name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_INSUMO, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objInsumo as $key): ?>
                      <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                    <?php endforeach; //close foreach    ?>
                  </select>


                  <h3><?php echo i18n::__('cantidad') ?></h3>
                  <input type="number" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true) ?>">

                </form>
              </div>
              <div class="modal-footer">
                <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></a>
                <button type="button" class="btn btn-info active fa fa-plus-square" onclick="$('#detailForm').submit()"> <?php echo i18n::__('create') ?></button>
              </div>
            </div>
          </div>
          <?php $countDetale++ ?>
        <?php endforeach//close foreach    ?>
        </tbody>
      </table>

        </div>
      <!-- PAGINATOR -->
      <div class="text-right">
        <nav>
          <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
              <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
              <?php $count ++ ?>        
            <?php endfor//close for   ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
          </ul>
        </nav>
      </div> 
    </div>
  </div>
</main>

<!-- WINDOWS MODAL SEARCH -->
<div id="myModalFilter" class="modalmask">
  <div class="modalbox rotate">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
    </div>
    <a href="#close" title="Close" class="close">X</a>
    <div class="modal-body">
      <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>">
        <table class="table table-bordered">
          <tr>
            <th>  <?php echo i18n::__('empleado') ?>:</th>
            <th>
              <select name="filter[empleado]">
                <option value="">...</option>
                <?php foreach ($objEmpleado as $key): ?>
                  <option value="<?php echo $key->id ?>"> <?php echo $key->nombre_completo ?></option>
                <?php endforeach; //close foreach    ?>
              </select>
            </th>
          </tr>
        </table>
      </form>
      <div class="modal-footer">
        <a href="#close2" title="Close" type="button" class="btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('close', null, 'vacunacion') ?></a>
        <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
      </div>
    </div>
  </div>
</div>