<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php $fechaEntrada = entradaBodegaTableClass::FECHA ?>
<?php $id_empleado = empleadoTableClass::ID ?>
<?php $nombre_empleado = empleadoTableClass::NOMBRE ?>
<?php $estado = entradaBodegaTableClass::ESTADO ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">


      <div class="row">
        <div class="col-xs-12 text-center">

          <h2>
            <?php echo i18n::__('RegistrosEntrada') ?> 
          </h2>
        </div>
      </div>
      <br /> <br />
      <div style="margin-bottom: 10px; margin-top: 30px">
        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'insertEntrada') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="new">
          <?php echo i18n::__('registrar', null, 'ayuda') ?>
        </div>
        <a id="deleteMasa" href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-default btn-sm fa fa-exchange"></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
          <?php echo i18n::__('inhabilitarMasa', null, 'ayuda') ?>
        </div>
        <a id="filter" href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-sm btn-info active fa fa-search"></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="filter">
          <?php echo i18n::__('buscar', null, 'ayuda') ?>
        </div>
        <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFilterFacturaCompra') ?>" class="btn btn-sm btn-primary fa fa-reply" ></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
          <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
        </div>
        <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportCompra') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
          <?php echo i18n::__('reporte', null, 'ayuda') ?>
        </div>
      </div>
      <?php view::includeHandlerMessage() ?>

      <table class="table table-bordered table-responsive ">
        <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">

          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
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
                  <?php endif; //close if ?>
                </td>
                <td><?php echo $key->$id . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>
                <td><?php echo $key->$fechaEntrada ?></td>
                <td><?php echo $key->$nombre_empleado ?></td>
                <td>  

                  <?php if ($key->$estado == true): ?>
<!--                    <a  id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'editEntrada', array(entradaBodegaTableClass::ID => $key->$idEntrada)) ?>" class="btn btn-sm btn-default active fa fa-edit"></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                      <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                  </div> -->
                    <a id="insertDetalle<?php echo $countDetale ?>" href="#myModalInserDetails<?php echo $key->$id ?>" class="btn btn-sm btn-default fa fa-navicon" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                      <?php echo i18n::__('insertDetalle', null, 'ayuda') ?>
                    </div> 
                    <a   id="verDetalle<?php echo $countDetale ?>"  href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'viewEntrada', array(entradaBodegaTableClass::ID => $key->$id)) ?>" class=" btn btn-info active btn-sm fa fa-eye"> </a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                      <?php echo i18n::__('verDetalle', null, 'ayuda') ?>
                    </div>  
                  <?php endif; ?>

                  <a id="habilitar<?php echo $countDetale ?>"  href="#changeState<?php echo $key->$id ?>" class=" btn btn-sm btn-danger fa fa-ban" ><?php echo i18n::__((($key->$estado == true)) ? 'inhabilitar' : 'habilitar' ) ?></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="habilitar<?php echo $countDetale ?>">
                    <?php echo i18n::__('habilitar', null, 'ayuda') ?>
                  </div> 
                </td>
              </tr>
          </form>

          <!-- WINDOWS MODAL DELETE -->
          <div id="changeState<?php echo $key->$id ?>" class="modalmask">
            <div class="modalbox rotate">
              <a href="#close" title="Close" class="close">X</a>
              <div class="modal-body">
                ....
              </div>
              <div class="modal-footer">
                <a href="#close2" title="Close" class="close2 btn btn-info"> <?php echo i18n::__('cancel') ?></a>
                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('bodega', 'deleteEntrada') ?>')"> <?php echo i18n::__('inhabil') ?></button>
              </div>
            </div>
          </div>

          <!-- WINDOWS MODAL DTAILS -->
          <div id="myModalInserDetails<?php echo $key->$id ?>" class="modalmask">
            <div class="modalbox rotate">
              <a href="#close" title="Close" class="close">X</a>
              <div class="modal-body">
                <form id="detailForm" class="form-horizontal" method="POST" action="<?php  echo routing::getInstance()->getUrlWeb('bodega', 'createDetalleEntrada') ?>">

                  <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true) ?>">

                  <h3>tipo insumo</h3>
                  <select name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::TIPO_INSUMO, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objTipoInsumo as $key): ?>
                      <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
                    <?php endforeach; //close foreach  ?>
                  </select>
                  
                  <h3><?php echo i18n::__('insumo') ?></h3>
                  <select name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_INSUMO, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objInsumo as $key): ?>
                      <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                    <?php endforeach; //close foreach  ?>
                  </select>
                  

                    <h3><?php echo i18n::__('cantidad') ?></h3>
                    <input type="number" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true) ?>">

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                <button type="button" class="btn btn-primary" onclick="$('#detailForm').submit()"> <?php echo i18n::__('create') ?></button>
              </div>
            </div>
          </div>
          <?php $countDetale++ ?>
        <?php endforeach//close foreach  ?>
        </tbody>
      </table>


      <!-- PAGINATOR -->
      <div class="text-right">
        <nav>
          <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
              <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
              <?php $count ++ ?>        
            <?php endfor//close for ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
          </ul>
        </nav>
      </div> 
    </div>
  </div>
</main>




<!-- WINDOWS MODAL DELETE MASIVE -->
<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('inhMasa') ?></h4>
      </div>
      <div class="modal-body">

        <?php echo i18n::__('confirmInh') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
      </div>
    </div>
  </div>
</div>
