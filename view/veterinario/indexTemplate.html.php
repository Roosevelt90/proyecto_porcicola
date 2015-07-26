
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = veterinarioTableClass::ID ?>
<?php $numero_doc = veterinarioTableClass::NUMERO_DOC ?>
<?php $nombre_completo = veterinarioTableClass::NOMBRE ?>
<?php $tipo_doc = tipoDocumentoTableClass::DESCRIPCION ?>
<?php $telefono = veterinarioTableClass::TEL ?>
<?php $direccion = veterinarioTableClass::DIRECCION ?>
<?php $ciudad = ciudadTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>


<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'veterinario') ?>
        </div>
    </div>
    <!-- WINDOWS MODAL FILTERS -->
    <div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="filterForm" method ="POST" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>">


                        <table class="table table-responsive ">    
                            <tr>
                                <th>  <?php echo i18n::__('name', NULL, 'veterinario') ?>:</th>
                                <th> 
                                    <input placeholder="<?php echo i18n::__('name', NULL, 'veterinario') ?>" type="text" name="filter[nombre_completo]" >
                                </th>   
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('telefono', null, 'veterinario') ?>:
                                </th>
                                <th>
                                    <input placeholder="<?php echo i18n::__('telefono', NULL, 'veterinario') ?>" type="text" name="filter[telefono]" >
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <?php echo i18n::__('document type', null, 'veterinario') ?>:
                                </th>
                                <th>
                                    <select name="filter[tipo_doc]"> 
                                        <option>...</option>
                                        <?php foreach ($objTipoDoc as $key): ?>
                                            <option value="<?php echo $key->id ?>">
                                                <?php echo $key->descripcion ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                            </tr>

                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                    <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
                </div>
            </div>
        </div>
    </div>
    <form>
        <div class="row">
            <div class=" col-xs-12 text-center">
               <a id="filter" href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
               <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteFiltersVeterinario') ?>" class="btn btn-xs btn-primary"><?php echo i18n::__('deleteFilter') ?></a>  
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                     <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
               </div>
               <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'insertVeterinario') ?>" class="btn btn-success btn-xs"> <?php echo i18n::__('insertar', null, 'veterinario') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
               <a id="reporte" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportVeterinario') ?>" class="btn btn-xs btn-default"><?php echo i18n::__('reporte') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                  <?php echo i18n::__('reporte', null, 'ayuda') ?>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <td><input type="checkbox" id="chkAll"></td>
                <th><?php echo i18n::__('document type', null, 'veterinario') ?></th>
                <th><?php echo i18n::__('Number of document', null, 'veterinario') ?></th>
                <th><?php echo i18n::__('name', null, 'veterinario') ?> </th>
                <th><?php echo i18n::__('telefono') ?></th>
                <th><?php echo i18n::__('city', null, 'veterinario') ?></th>
                <th><?php echo i18n::__('direccion') ?></th>
                <th><?php echo i18n::__('action', null, 'veterinario') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objVeterinario as $key): ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                    <th><?php echo $key->$tipo_doc ?></th>
                    <td><?php echo $key->$numero_doc ?></td>
                    <td><?php echo $key->$nombre_completo ?></td>
                    <th><?php echo $key->$telefono ?></th>
                    <th><?php echo $key->$ciudad ?></th>
                    <th><?php echo $key->$direccion ?></th>


                    <td>
                        <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('personal', 'editVeterinario', array(veterinarioTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('edit', null, 'veterinario') ?></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                            <?php echo i18n::__('modificar', null, 'ayuda') ?>
                        </div> 
                        <a id="eliminar<?php echo $countDetale ?>" href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $key->id ?>"><?php echo i18n::__('delete') ?></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                            <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                        </div> 

                        <!-- WINDOWS MODAL DELETE -->
                        <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteVeterinario') ?>" method="POST">

                            <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                                        </div>
                                        <div class="modal-body">
                                               <?php echo i18n::__('confirmDelete') ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                            <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo veterinarioTableClass::getNameField(veterinarioTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteVeterinario') ?>')"><?php echo i18n::__('delete') ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
  <?php $countDetale++ ?>
                    <?php endforeach ?>
        </tbody>
    </table>
</div>

<!--    paginado-->
<div class="text-right">
    <nav>
        <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
    </nav>
</div>
<!--reporte-->
<div class="modal fade" id="myModalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('reporte') ?></h4>
            </div>
            <div class="modal-body">
                <form id='reportForm' class="form-horizontal" methodo='POST'action="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportVeterinario') ?>">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('Exit') ?></button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
            </div>
        </div>
    </div>
</div>
