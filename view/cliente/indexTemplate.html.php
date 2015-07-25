
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?PHP
USE mvc\request\requestClass as request ?>

<?php $id = clienteTableClass::ID ?>
<?php $numero_documento = clienteTableClass::NUMERO_DOC ?>
<?php $nombre_completo = clienteTableClass::NOMBRE ?>
<?php $tipo_documento_id = tipoDocumentoTableClass::DESCRIPCION ?>
<?php $telefono = clienteTableClass::TEL ?>
<?php $direccion = clienteTableClass::DIRECCION ?>
<?php $ciudad = ciudadTableClass::NOMBRE ?>

<?php

use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', null, 'cliente') ?>
            </h2>
        </div>
    </div>


    <!-- WINDOWS MODAL FILTERS -->
    <div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('buscar') ?></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="filterForm" method ="POST" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>">

                        <table class="table table-responsive ">    
                            <tr>
                                <th>  <?php echo i18n::__('name', NULL, 'cliente') ?>:</th>
                                <th> 
                                    <input placeholder="<?php echo i18n::__('name', NULL, 'cliente') ?>" type="text" name="filter[nombre_completo]" >
                                </th>   
                            </tr>
                            <tr>
                                <th>
                                    <?php echo i18n::__('telefono', null, 'cliente') ?>:
                                </th>
                                <th>
                                    <input placeholder="<?php echo i18n::__('telefono', NULL, 'cliente') ?>" type="text" name="filter[telefono]" >
                                </th>
                            </tr>

                            <tr>
                                <th>
                                    <?php echo i18n::__('document type', null, 'cliente') ?>:
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
                <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'insertCliente') ?>" class="btn btn-success btn-xs"> <?php echo i18n::__('insertar', null, 'cliente') ?></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportCliente') ?>" class="btn btn-xs btn-default"><?php echo i18n::__('reporte') ?></a>

                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteFiltersCliente') ?>" class="btn btn-xs btn-primary">ELiminar filtros</a>  
              
            </div>
        </div>
    </form>


    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <td><input type="checkbox" id="chkAll"></td> 
                <th><?php echo i18n::__('identification', null, 'cliente') ?></th>
                <th><?php echo i18n::__('Number of document', null, 'cliente') ?></th>
                <th><?php echo i18n::__('name', null, 'cliente') ?> </th>
                <th><?php echo i18n::__('document type', null, 'cliente') ?></th>
                <th><?php echo i18n::__('telefono', null, 'cliente') ?></th>
                <th><?php echo i18n::__('direccion', null, 'cliente') ?></th>
                <th><?php echo i18n::__('city', null, 'cliente') ?></th>

                <th><?php echo i18n::__('action', null, 'cliente') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objCliente as $key): ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                    <td><?php echo $key->$id ?></td>
                    <td><?php echo $key->$numero_documento ?></td>
                    <td><?php echo $key->$nombre_completo ?></td>
                    <th><?php echo $key->$tipo_documento_id ?></th>
                    <th><?php echo $key->$telefono ?></th>
                    <th><?php echo $key->$direccion ?></th>
                    <th><?php echo $key->$ciudad ?></th>


                    <td>
                        <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'editCliente', array(clienteTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('edit', null, 'cliente') ?></a>
                        <a href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $key->id ?>"><?php echo i18n::__('delete') ?></a>


                        <!-- WINDOWS MODAL DELETE -->
                        <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteCliente') ?>" method="POST">

                            <div class="modal fade" id="myModalDelete<?php echo $key->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete') ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            desea eliminar ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$id ?>, '<?php echo clienteTableClass::getNameField(clienteTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('personal', 'deleteCliente') ?>')">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    <?php endforeach ?>
        </tbody>
    </table>
</div>


<!--    paginado-->
<div class="text-right">
    <nav>
        <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
    </nav>
</div> <!--reporte-->
<div class="modal fade" id="myModalReporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('reporte') ?></h4>
            </div>
            <div class="modal-body">
                <form id='reportForm' class="form-horizontal" methodo='POST'action="<?php echo routing::getInstance()->getUrlWeb('personal', 'reportCliente') ?>">
                    <table class="table table-responsive">
                        <tr>
                            <th><input>

                            </th>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirmar') ?></button>
            </div>
        </div>
    </div>
</div>
