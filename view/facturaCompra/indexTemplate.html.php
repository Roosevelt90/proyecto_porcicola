<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>

<?php $id = procesoCompraTableClass::ID ?>
<?php $fecha = procesoCompraTableClass::FECHA_HORA_COMPRA ?>
<?php $empleado = empleadoTableClass::NOMBRE ?>
<?php $proveedor = proveedorTableClass::NOMBRE ?>
<?php $estado = procesoCompraTableClass::ACTIVA ?>
<?php $id = procesoCompraTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $nombreProveedor = proveedorTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">
      <div class="row">
        <div class="col-xs-12 text-center">

          <h2>
            <?php echo i18n::__('factura', null, 'facturaCompra') ?> 
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4-offset-4 text-left">
          <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('factura', 'insertFacturaCompra') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
          <div class="mdl-tooltip mdl-tooltip--large" for="new">
            <?php echo i18n::__('registrar', null, 'ayuda') ?>
          </div>
          <a id="deleteMasa" href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-default btn-sm fa fa-ellipsis-v"></a>
          <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
            <?php echo i18n::__('inhabilitarMasaFact', null, 'ayuda') ?>
          </div>
          <a id="filter" href="#myModalFilter" class="btn btn-sm btn-info active fa fa-search"></a>
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
      </div>
      <?php view::includeHandlerMessage() ?>

      <table class="table table-bordered table-responsive ">
        <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacunacion') ?>" method="POST">

          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
              <th><?php echo i18n::__('numberDoc', null, 'datos') ?> </th>
              <th><?php echo i18n::__('fechaFactura', null, 'facturaCompra') ?> </th>
              <th><?php echo i18n::__('empleado') ?> </th>
              <th><?php echo i18n::__('proveedor', null, 'proveedor') ?> </th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($objFacturaCompra as $key): ?>
              <tr> 
                <td>
                  <?php if ($key->$estado == true): ?> 
                    <input type="checkbox" name="chk[]" value="<?php echo $key->id ?>">
                  <?php endif; //close if  ?>
                </td>
                <td><?php echo $key->$id . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>
                <td><?php echo $key->$fecha ?></td>
                <td><?php echo $key->$empleado ?></td>
                <td><?php echo $key->$proveedor ?></td>
                <td>  
                  <?php if ($key->$estado == true): ?>
                            <!--<a id="edit<?php echo $countDetale ?>" href="<?php //echo routing::getInstance()->getUrlWeb('factura', 'editFacturaCompra', array(procesoCompraTableClass::ID => $key->$id))            ?>" class="btn btn-default active btn-sm fa fa-edit"></a>-->
                    <div class="mdl-tooltip mdl-tooltip--large" for="edit<?php echo $countDetale ?>">
                      <?php echo i18n::__('modificar', null, 'ayuda') ?>
                    </div>  

                    <a id="insertDetalle<?php echo $countDetale ?>" href="#myModalDetail<?php echo $key->$id ?>" class="btn btn-sm btn-primary fa fa-bars" data-toggle="modal" data-target="#myModalDetail<?php echo $key->$id ?>" ></a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="insertDetalle<?php echo $countDetale ?>">
                      <?php echo i18n::__('insertFactura', null, 'ayuda') ?>
                    </div> 
                    <a   id="verDetalle<?php echo $countDetale ?>"  href="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaCompra', array(procesoCompraTableClass::ID => $key->$id)) ?>" class="btn btn-primary active btn-sm fa fa-eye"> </a>
                    <div class="mdl-tooltip mdl-tooltip--large" for="verDetalle<?php echo $countDetale ?>">
                      <?php echo i18n::__('verDetalleFact', null, 'ayuda') ?>
                    </div>  
                  <?php endif ?>
                  <a id="habilitar<?php echo $countDetale ?>"  href="#changeState<?php echo $key->$id ?>" class="btn btn-sm btn-info active fa fa-exchange" ></a>
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
                <button type="button" class="btn btn-danger fa fa-eraser"  onclick="eliminar(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')" > <?php echo i18n::__('inhabil') ?></button>
              </div>
            </div>
          </div>


          </form>
          <!-- WINDOWS MODAL DETAIL VACCINATION -->
          <div id="myModalDetail<?php echo $key->$id ?>" class="modalmask">
            <div class="modalbox rotate">
              <a href="#close" title="Close" class="close">X</a>
              <div class="modal-body">
                <form id="detailForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'createDetalleFacturaCompra')            ?>">

                  <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleProcesoCompraBaseTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>">

                  <h3><?php echo i18n::__('insumo') ?></h3>
                  <select name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true) ?>">
                    <option value="">...</option>
                    <?php foreach ($objInsumo as $key): ?>
                      <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                    <?php endforeach; //close foreach   ?>
                  </select>
                  <h3><?php echo i18n::__('cantidad') ?></h3>
                  <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true) ?>">
                  <h3><?php echo i18n::__('valorUni') ?></h3>
                  <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true) ?>">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                <button type="button" class="btn btn-primary" onclick="$('#detailForm').submit()">Insertar</button>
                <!--<input type="submit"  class="btn btn-primary" value=<?php echo i18n::__('confirm') ?> >-->
              </div>
            </div>

          </div>
      </div>




      <?php $countDetale++ ?>
    <?php endforeach//close foreach   ?>
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
          <?php endfor//close for  ?>
          <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
      </nav>
    </div> 
    <form id="frmDelete" action="<?php //echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion')            ?>" method="POST">
      <input type="hidden" id="idDelete" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>">
    </form>
  </div>
</div>
</main>
<!-- WINDOWS MODAL DELETE MASIVE -->
<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
      </div>
      <div class="modal-body">

        <?php echo i18n::__('deleteMasive') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
      </div>
    </div>
  </div>
</div>



<!-- WINDOWS MODAL DELETE -->
<div id="myModalFilter" class="modalmask">
  <div class="modalbox rotate">
    <a href="#close" title="Close" class="close">X</a>
    <div class="modal-body">
      <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>">
        <table>
          <tr>
            <th>
              <?php echo i18n::__('fechaInicio') ?>
            </th>
            <th>
              <input type="datetime-local" name="filter[fecha_inicio]">
            </th>   

          </tr>
          <tr>
            <th>
              <?php echo i18n::__('fechaFin') ?>
            </th>
            <th>
              <input type="datetime-local" name="filter[fecha_fin]">
            </th>   

          </tr>
          <tr>
            <th>  
              <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
            </th>
            <th> 
              <select name="filter[empleado]">
                <option value="">...</option>
                <?php foreach ($objEmpleado as $key): ?>
                  <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                <?php endforeach; //close foreach  ?>
              </select>
            </th>   

          </tr>

          <tr>
            <th>  
              <?php echo i18n::__('proveedor') ?>:
            </th>
            <th> 
              <select name="filter[proveedor]">
                <option value="">...</option>
                <?php foreach ($objProveedor as $key): ?>
                  <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreProveedor ?></option>
                <?php endforeach; //close foreach  ?>
              </select>
            </th>   

          </tr>
        </table>

      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close', null, 'vacunacion') ?></button>
      <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
    </div>
  </div>

</div>
</div>
