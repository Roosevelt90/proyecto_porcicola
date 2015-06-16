
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?PHP
USE mvc\request\requestClass as request ?>

<?php $id = veterinarioTableClass::ID ?>
<?php $numero_doc = veterinarioTableClass::NUMERO_DOC ?>
<?php $nombre_completo = veterinarioTableClass::NOMBRE ?>
<?php $tipo_doc = tipoDocumentoTableClass::DESCRIPCION ?>
<?php $telefono = veterinarioTableClass::TEL ?>
<?php $direccion = veterinarioTableClass::DIRECCION ?>
<?php $ciudad = ciudadTableClass::NOMBRE ?>

<?php

use mvc\i18n\i18nClass as i18n ?>
 
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read',NULL,'veterinario')?>
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


                        <div class="form-group">
                            <label for="filterTelefono" class="col-sm-2 control-label" >telefono</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filterTelefono" name="filter[telefono]" placeholder="telefono">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="filterNombre_completo" class="col-sm-2 control-label">nombre_completo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="filterNombre_completo" name="filter[nombre_completo]" placeholder="nombre">
                            </div>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar')?></button>
                    <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar')?></button>
                </div>
            </div>
        </div>
    </div>


    <form>
        <div class="row">
            <div class=" col-xs-12 text-center">
                <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'insertVeterinario') ?>" class="btn btn-success btn-xs"> <?php echo i18n::__('insertar', null, 'veterinario') ?></a>
                <a href="#" class="btn btn-xs btn-default" onclick="reporte()"><?php echo i18n::__('reporte') ?></a>

                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
            </div>
        </div>
    </form>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <td><input type="checkbox" id="chkAll"></td> 
                <th><?php echo i18n::__('identification', null, 'veterinario') ?></th>
                <th><?php echo i18n::__('Number of document', null, 'veterinario') ?></th>
                <th><?php echo i18n::__('name', null, 'veterinario') ?> </th>
                <th><?php echo i18n::__('document type', null, 'veterinario') ?></th>
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
                    <td><?php echo $key->$id ?></td>
                    <td><?php echo $key->$numero_doc ?></td>
                    <td><?php echo $key->$nombre_completo ?></td>
                    <th><?php echo $key->$tipo_doc ?></th>
                    <th><?php echo $key->$telefono ?></th>
                    <th><?php echo $key->$ciudad ?></th>
                    <th><?php echo $key->$direccion ?></th>


                    <td>
                        <a href="#" class="btn btn-warning btn-sm "><?php echo i18n::__('view',null, 'veterinario')?> </a>
                        <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'editVeterinario', array(veterinarioTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('edit', null, 'veterinario')?></a>
                        <!--<a href="#" data-toggle="modal" data-target="#myModalDelete <?php echo $key->$id ?>" class="btn btn-danger btn-xs">Eliminar</a>-->

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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
            </div>
        </div>
    </div>
</div>
