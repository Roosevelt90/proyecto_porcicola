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
            <br /> <br />
            <!--    <div style="margin-bottom: 10px; margin-top: 30px" >
                    <form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'traductorVacunacion') ?>" name="" method="POST">
                        <select onchange="$('#frmTraductor').submit()" name="lenguaje">
                            <option <?php echo (config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">
            <?php echo i18n::__('spanish') ?> 
                            </option>         
                            <option <?php echo (config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">
            <?php echo i18n::__('english') ?> 
                            </option>
                        </select>
                        <input type="hidden" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>">
                    </form>
                </div>-->
            <div style="margin-bottom: 10px; margin-top: 30px">

                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFilterFacturaCompra') ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('deleteFilter') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('factura', 'insertFacturaCompra') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('borrar seleccion') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('factura', 'reportCompra') ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('reporte') ?></a>
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
                            <th><?php echo i18n::__('proveedor') ?> </th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objFacturaCompra as $key): ?>
                          <tr> 
                              <td>
                                  <?php if ($key->$estado == true): ?> 
                                    <input type="checkbox" name="chk[]" value="<?php echo $key->id ?>">
                                  <?php endif; //close if ?>
                              </td>
                              <td><?php echo $key->$id . ' ' . (($key->$estado == true) ? '' : 'Factura inhabilitada') ?></td>
                              <td><?php echo $key->$fecha ?></td>
                              <td><?php echo $key->$empleado ?></td>
                              <td><?php echo $key->$proveedor ?></td>
                              <td>  
                                  <?php if ($key->$estado == true): ?>
                                    <a  href="<?php echo routing::getInstance()->getUrlWeb('factura', 'viewFacturaCompra', array(procesoCompraTableClass::ID => $key->$id)) ?>" class=" btn btn-info btn-xs"> <?php echo i18n::__('viewDetail', null, 'vacunacion') ?></a>
                                    <a href="#" class="btn btn-sm btn-info fa " data-toggle="modal" data-target="#myModalDetail<?php echo $key->$id ?>" class="btn btn-info btn-xs"><?php echo i18n::__('insertDetail', null, 'vacunacion') ?></a>
                                    <!--<a href="<?php //echo routing::getInstance()->getUrlWeb('factura', 'editFacturaCompra', array(procesoCompraTableClass::ID => $key->$id))        ?>" class="btn btn-primary btn-xs"><?php // echo i18n::__('edit', null, 'user')    ?></a>-->
                                    <a href="#" class=" btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" onclick="myModalDisable(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')" ><?php echo i18n::__((($key->$estado == true)) ? 'inhabilitar' : 'habilitar' ) ?></a>
                                  <?php endif; ?>
                                  <?php if ($key->$estado == false): ?>
                                    <a href="#" class=" btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" onclick="myModalEnable(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')" ><?php echo i18n::__((($key->$estado == true)) ? 'inhabilitar' : 'habilitar' ) ?></a>
                                  <?php endif; ?>
                              </td>
                          </tr>
                  </form>


                  </form>
                  <!-- WINDOWS MODAL DETAIL VACCINATION -->
                  <div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('newDetailVaccination', null, 'detalleVacunacion') ?>:</h4>
                              </div>
                              <div class="modal-body">

                                  <form id="detailForm" class="form-horizontal" method="POST" action="<?php // echo routing::getInstance()->getUrlWeb('factura', 'createFacturaCompra')        ?>">

                                      <input type="hidden" value="<?php echo $key->$id ?>" name="<?php echo detalleProcesoCompraBaseTableClass::getNameField(detalleProcesoCompraTableClass::PROCESO_COMPRA_ID, true) ?>">

                                      <h3><?php echo i18n::__('insumo') ?></h3>
                                      <select name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::INSUMO_ID, true) ?>">
                                          <option value="">...</option>
                                          <?php foreach ($objInsumo as $key): ?>
                                            <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                                          <?php endforeach; //close foreach  ?>
                                      </select>


                                      <h3><?php echo i18n::__('cantidad') ?></h3>
                                      <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::CANTIDAD, true) ?>">

                                      <h3><?php echo i18n::__('valorUni') ?></h3>
                                      <input type="number" name="<?php echo detalleProcesoCompraTableClass::getNameField(detalleProcesoCompraTableClass::VALOR_UNITARIO, true) ?>">



                                      <!--</form>-->
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                                          <!--<button type="button" class="btn btn-primary" onclick="$('#detailForm').submit()">Insertar</button>-->
                                          <input type="submit"  class="btn btn-primary" value=<?php echo i18n::__('confirm') ?> >

                                      </div>
                              </div>
                          </div>
                      </div>
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
            <form id="frmDelete" action="<?php //echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacunacion')        ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>">
            </form>
        </div>
    </div>
</main>

<!-- WINDOWS MODAL CHANGE STATE-->
<div class="modal fade" id="myModalEnable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('habilitar') ?></h4>
            </div>
            <div class="modal-body">
                ¿<?php echo i18n::__('confirmHabilitar') ?>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                <button id="delete" name="delete" type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')"> <?php echo i18n::__('delete') ?></button>
            </div>
        </div>
    </div>
</div> 
<!-- WINDOWS MODAL CHANGE STATE-->
<div class="modal fade" id="myModalDisable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('inhabilitar') ?></h4>
            </div>
            <div class="modal-body">
                ¿<?php echo i18n::__('confirmInhabilitar') ?>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('cancel') ?></button>
                <button id="delete" name="delete" type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('factura', 'deleteFacturaCompra') ?>')"> <?php echo i18n::__('delete') ?></button>
            </div>
        </div>
    </div>
</div> 


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

<!-- WINDOWS MODAL FILTER -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
            </div>
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
                                    <?php endforeach; //close foreach ?>
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
                                    <?php endforeach; //close foreach ?>
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