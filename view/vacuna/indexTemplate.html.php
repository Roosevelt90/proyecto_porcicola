<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass  as session ?>
<?php $id = vacunaTableClass::ID ?>
<?php $nomVacuna = vacunaTableClass::NOMBRE_VACUNA ?>
<?php $loteVacuna = vacunaTableClass::LOTE_VACUNA ?>
<?php $fecha_fabricacion = vacunaTableClass::FECHA_FABRICACION ?>
<?php $fecha_vencimiento = vacunaTableClass::FECHA_VENCIMIENTO ?>
<?php $valor = vacunaTableClass::VALOR ?>
<?php  $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">


        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('read', NULL, 'vacuna') ?>
                    </h2>
                </div>
            </div>

            <div class="row">
            <div class="col-xs-12 text-center">
                  <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                <a id="nueva" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'insertVacuna') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="nueva">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
<!--                <a id="eliminarSeleccion" href="#myModalEliminarMasivo" data-toggle="modal" class="btn btn-default btn-sm fa fa-trash-o"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="eliminarSeleccion">
                    <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                </div>-->
                <?php endif; ?>
                <a id="filter" href="#myModalFilter" data-toggle="modal" class="btn btn-sm btn-info active fa fa-search"></a>
               <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a  id='eliminarBusqueda' href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteFilterVacuna') ?>" class="btn btn-sm btn-primary fa fa-reply" ></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="eliminarBusqueda">
                    <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                </div>
                <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'reportVacuna') ?>" class="btn btn-primary active btn-sm fa fa-download" ></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                    <?php echo i18n::__('reporte', null, 'ayuda') ?>
                </div>
            </div>
            </div>
            <?php view::includeHandlerMessage() ?>
            <div class=" table-responsive">
            <table class="table table-bordered">
                <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteSelectVacuna') ?>" method="POST">
                    <thead>
                        <tr class="success">
                        <!--        <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                            <th><input type="checkbox" id="chkAll"></th> 
                          <?php endif; ?> -->
                            <th><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></th>
                            <th><?php echo i18n::__('lote') ?></th>
                            <th><?php echo i18n::__('fecha_fabricacion', null, 'vacuna') ?></th>
                            <th><?php echo i18n::__('fecha_vencimiento', null, 'vacuna') ?></th>
                            <th><?php echo i18n::__('valor', null, 'dpVenta') ?></th>
                            <th><?php echo i18n::__('cantidad') ?></th>
                            <th><?php echo i18n::__('stock') ?></th>
                              <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                            <th><?php echo i18n::__('action') ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objVacuna as $key): ?>
                            <tr>
                           <!--        <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
<?php endif; ?> -->
                                
                                <td><?php echo $key->$nomVacuna ?></td>
                                <td><?php echo $key->$loteVacuna ?></td>
                                <td><?php echo $key->$fecha_fabricacion ?></td>
                                <td><?php echo $key->$fecha_vencimiento ?></td>
                                <td><?php echo $key->$valor ?></td>
                                <td><?php echo $key-> cantidad ?></td>
                                <td><?php echo $key-> stock_minimo ?></td>
                                  <?php if(session::getInstance()->hasCredential('admin') == 1):?>
                                <td>
                                    <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'editVacuna', array(vacunaTableClass::ID => $key->id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                                    <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                      <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                  </div>  
                                    <a id="eliminar<?php echo $countDetale ?>"href="#myModalDelete<?php echo $key->$id ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" data-toggle="modal" <?php echo $key->id ?>"><i class="material-icons">delete</i></a>
                               <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                      <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                                  </div>  
                                </td>
                                <?php endif; ?>
                            </tr>

                    </form>

                    <!-- WINDOWS MODAL DELETE -->
                    <div class="modalmask" id="myModalDelete<?php echo $key->id ?>" >
                        <div class="modalbox rotate">
                          
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">  <?php echo i18n::__('confirmDelete') ?></h4>
                                </div>
                            <a href="#close" title="Close" class="close">X</a>
                                <div class="modal-body">
                                    <?php echo i18n::__('eliminarIndividual') ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                                    <button type="button" class="btn btn-primary fa fa-eraser" onclick="eliminar(<?php echo $key->id ?>, '<?php echo vacunaBaseTableClass::getNameField(vacunaTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'deleteVacuna') ?>')"> <?php echo i18n::__('delete') ?></button>
                                </div>
                          
                        </div>
                    </div> 
                    <?php  $countDetale++ ?>
                <?php endforeach//close foreach  ?>

                </tbody>
            </table>
            </div>
            <!----paginado-->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count ++ ?>        
                        <?php endfor; //close for ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>



            <!-- WINDOWS MODAL DELETE MASIVE -->
<!--            <div class="modalmask" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modalbox rotate">
               
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('borrar seleccion') ?></h4>
                        </div>
                    <a href="#close" title="Close" class="close">X</a>
                        <div class="modal-body">

                            <?php echo i18n::__('deleteMasive') ?>
                        </div>
                        <div class="modal-footer">
                            <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"> <?php echo i18n::__('cancel') ?></a>
                            <button type="button" class="btn btn-primary fa fa-eraser" onclick="$('#frmDeleteAll').submit()"> <?php echo i18n::__('confirm') ?></button>
                        </div>
              
                </div>
            </div>-->

            <!-- WINDOWS MODAL FILTER -->
            <div class="modalmask" id="myModalFilter" >
                <div class="modalbox rotate">
                
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filterBy') ?>:</h4>
                        </div>
                      <a href="#close" title="Close" class="close">X</a>
                        <div class="modal-body">
                            <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('nameVacuna', NULL, 'vacuna') ?>:
                                        </th>
                                        <th>
                                            <input pattern="[A-Za-z0-9]{3}"  type="text" name="filter[nombre]" >
                                        </th>   
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('lote', NULL, 'vacuna') ?>:
                                        </th>
                                        <th>
                                            <input pattern="[A-Za-z0-9]{3}"  type="text" name="filter[lote]">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('fecha_fabricacion', null, 'vacuna') ?>
                                        </th>
                                        <th>
                                            <input type="date" name="filter[fecha_f]">

                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('fecha_vencimiento', null, 'vacuna') ?>
                                        </th>

                                        <th>
                                            <input type="date" name="filter[fecha_v]">
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo i18n::__('valor', NULL, 'vacuna') ?>:
                                        </th>
                                        <th>
                                            <input type="number" min="0" name="filter[valor]">
                                        </th>
                                    </tr>
                                                        <tr>
                                        <th>
                                            <?php echo i18n::__('cantidad') ?>:
                                        </th>
                                        <th>
                                            <input type="number" min="0" name="filter[cantidad]">
                                        </th>
                                    </tr>
                                                                        <tr>
                                        <th>
                                            <?php echo i18n::__('stock') ?>:
                                        </th>
                                        <th>
                                            <input type="number" min="0" name="filter[stock]">
                                        </th>
                                    </tr>
                                </table>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#close2" title="Close"  type="button" class="btn btn-default fa fa-times-circle-o close2"><?php echo i18n::__('close', null, 'vacunacion') ?></a>
                            <button type="button" class="btn btn-info fa fa-search" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                        </div>
                    </div>
                </div>
     
        </div>
</main>