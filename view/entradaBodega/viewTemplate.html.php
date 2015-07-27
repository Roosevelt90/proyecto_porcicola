<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\request\requestClass as request ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php $idEntrada = detalleEntradaBodegaTableClass::ID_ENTRADA ?>
<?php $fecha = entradaBodegaTableClass::FECHA ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $tipoInsumo = tipoInsumoTableClass::DESCRIPCION ?>
<?php $insumo = insumoTableClass::NOMBRE ?>
<?php $cantidad = detalleEntradaBodegaTableClass::CANDITDAD ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">

      <br/> <br/>
      Entrada de bodega
      <br /> <br/>

      <table class="table table-bordered table-responsive ">
        <thead>
          <tr class="active">
            <th>
              id
            </th>
            <th>
              fecha
            </th>
            <th>
              Empleado
        </thead>
        <tbody>
          <?php foreach ($objEntrada as $key): ?>
            <tr>
              <td><?php echo $key->$id ?></td>
              <td><?php echo $key->$fecha ?></td>
              <td><?php echo $key->$nombreEmpleado ?></td>
            </tr>
                                                                      
          <?php endforeach//close foreach   ?>
        </tbody>
      </table>
      <br/> 
      Registros de entrada

      <div class="container container-fluid" style="margin-bottom: 10px">
        <!--<form id="frmDelebottom: 10px; margin-top: 30px">-->
        <br />    
        <a href="#myModalReport"  id="buscarDetalle" class="btn btn-xs btn-default active"><?php echo i18n::__('filters') ?></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="buscarDetalle">
          <?php echo i18n::__('buscar', null, 'ayuda') ?>
        </div>
        <a class="btn btn-xs btn-default active" id="eliminarBusquedaDetalle" href="<?php echo routing::getInstance()->getUrlWeb('bodega', 'deleteFilterDetalleEntrada') ?>"><?php echo i18n::__('eliminar filtros') ?></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusquedaDetalle">
          <?php echo i18n::__('eliBusDetalle', null, 'ayuda') ?>
        </div>
        <a href="#" data-target="#myModalReport" data-toggle="modal" id="buscarReporteDetalle" class="btn btn-xs btn-default active"><?php echo i18n::__('filterReport', null, 'detalleVacunacion') ?></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="buscarReporteDetalle">
          <?php echo i18n::__('buscarReporteDet', null, 'ayuda') ?>
        </div>
        <a href="#" data-target="#myModalEliminarMasivo" data-toggle="modal" id="eliminarSeleccionDetalle" class="btn btn-xs btn-default active"><?php echo i18n::__('inhMasa') ?></a>
        <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccionDetalle">
          <?php echo i18n::__('inhabilitarMasaDetalle', null, 'ayuda') ?>
        </div>
        <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'reportDetalleVacunacion')        ?>" class="btn btn-info btn-xs" ><?php echo i18n::__('report') ?></a>-->       


      </div>

      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectDetalleVacunacion') ?>" method="POST">

        <table class="table table-bordered table-responsive ">
          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
              <th>
                Id
              </th>
              <th>
                Id registro
              </th>
              <th>
                Tipo de insumo  
              </th>
              <th>
                Insumo
              </th>
              <th>
                Cantidad
              </th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($objDetalleEntrada as $key): ?>
              <tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $key->id ?>"></td>
                <td><?php echo $key->$id ?></td>
                <td><?php echo $key->$idEntrada ?></td>
                <td><?php echo $key->$tipoInsumo ?></td>
                <td><?php echo $key->$insumo ?></td>
                <td><?php echo $key->$cantidad ?></td>
                <td>
                  <a id="editarDetalle<?php echo $countDetale ?>" href="#myModaUpdateDetails<?php echo $key->$id ?>" class="btn btn-sm btn-info fa "  ><?php echo i18n::__('edit', null, 'user') ?></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="editarDetalle<?php echo $countDetale ?>">
                    <?php echo i18n::__('editDetalle', null, 'ayuda') ?>
                  </div>  
                  <a id="eliminarDetalle<?php echo $countDetale ?>" href="#myModalDelete<?php echo $key->$id ?>" class="btn btn-sm btn-danger fa fa-trash-o" ><?php echo i18n::__('delete') ?></a>
                  <div class="mdl-tooltip mdl-tooltip--large" for="eliminarDetalle<?php echo $countDetale ?>">
                    <?php echo i18n::__('inhabilitarDetalle', null, 'ayuda') ?>
                  </div>  
                </td>
              </tr>
              <?php $countDetale++ ?>    


              <!-- WINDOWS MODAL DELETE -->
            <div id="myModalDelete<?php echo $key->$id ?>" class="modalmask">
              <div class="modalbox rotate">
                <a href="#close" title="Close" class="close">X</a>
                <div class="modal-body">
                  <?php echo i18n::__('eliminarIndividual') ?>
                </div>
                <div class="modal-footer">
                  <a href="#close2" title="Close" class="close2 btn btn-info"><?php echo i18n::__('cancel') ?></a>
                  <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->id ?>, '<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID, true) ?>', '<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteDetalleVacunacion')    ?>')"><?php echo i18n::__('delete') ?></button>
                </div>
              </div>
            </div>


            <!-- WINDOWS MODAL UPDATE DETAILS -->
            <div id="myModaUpdateDetails<?php echo $key->$id ?>" class="modalmask">
              <div class="modalbox rotate">
                <a href="#close" title="Close" class="close">X</a>
                <div class="modal-body">
                  <form id="detailForm" class="form-horizontal" method="POST" action="<?php // echo routing::getInstance()->getUrlWeb('vacunacion', 'updateDetalleVacunacion')      ?>">
                    <input type="hidden" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>" name="PATH_INFO">

                    <input type="hidden" value="<?php echo $key->$idEntrada ?>" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID_ENTRADA, true) ?>" >
                    <input type="hidden"  value="<?php echo $key->$id ?>" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::ID, true) ?>">

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
                      <?php endforeach; //close foreach   ?>
                    </select>


                    <h3><?php echo i18n::__('cantidad') ?></h3>
                    <input type="number" name="<?php echo detalleEntradaBodegaTableClass::getNameField(detalleEntradaBodegaTableClass::CANDITDAD, true) ?>">

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">   <?php echo i18n::__('cancel') ?></button>
                  <button type="button"  onclick="$('#detailForm').submit()">Insertar</button>
                </div>
              </div>
            </div>
          <?php endforeach//close foreach    ?>
          </tbody>
        </table>

    </div>
    <!-- WINDOWS MODAL DELETE MASIVE -->
    <div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
          </div>
          <div class="modal-body">

            <?php echo i18n::__('confirmDeleteMasive') ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo i18n::__('close', null, 'vacunacion') ?></button>
            <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
          </div>
        </div>
      </div>
    </div>


  </div>
</main>


<!-- WINDOWS MODAL FILTER -->
<div id="myModalReport" class="modalmask">
  <div class="modalbox rotate">
    <a href="#close" title="Close" class="close">X</a>
    <div class="modal-body">
      <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('bodega', 'viewEntrada') ?>">
        <input type="hidden" name="<?php echo entradaBodegaTableClass::ID ?>" value="<?php echo request::getInstance()->getRequest(entradaBodegaTableClass::ID) ?>">
        <table class="table table-bordered">
          <tr>
            <th>
              Tipo insumo
            </th>
            <th>
              <select name="filter[tipoInsumo]">
                <option value="">...</option>
                <?php foreach ($objTipoInsumo as $key): ?>
                  <option value="<?php echo $key->id ?>"><?php echo $key->descripcion ?></option>
                <?php endforeach; //close foreach   ?>
              </select>
            </th>
          </tr>
          <tr>

            <th>
              Insumo
            </th>
            <th>
              <select name="filter[Insumo]">
                <option value="">...</option>
                <?php foreach ($objInsumo as $key): ?>
                  <option value="<?php echo $key->id ?>"><?php echo $key->nombre_insumo ?></option>
                <?php endforeach; //close foreach   ?>
              </select>
            </th>
          </tr>
          <tr>
            <th>
              Cantidad
            </th>
            <th>
              <input name="filter[cantidad]" type="text">
            </th>
          </tr>
        </table>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo i18n::__('close', null, 'vacunacion') ?></button>
      <button type="button" class="btn btn-primary" onclick="$('#reportForm').submit()"><?php echo i18n::__('buscar') ?></button>
    </div>
  </div>
</div>


