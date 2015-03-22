<?php

use mvc\routing\routingClass as routing ?>

<?php

use mvc\i18n\i18nClass as i18n ?>

<?php

use mvc\view\viewClass as view ?>

<?php $idAnimal = animalTableClass::ID ?>
<?php $peso = animalTableClass::PESO ?>
<?php $edad = animalTableClass::EDAD ?>
<?php $fecha = animalTableClass::FECHA_INGRESO ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $lote = loteTableClass::NOMBRE ?>
<?php $raza = razaTableClass::NOMBRE_RAZA ?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'animal') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelectAnimal') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportAnimal') ?>" class="btn btn-success btn-xs">Reporte</a>
                <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active">Buscar</a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertAnimal') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="active">
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>Peso</th>
                    <th>Edad</th>
                    <th>Fecha de nacimiento</th>
                    <th>Genero</th>
                    <th>Lote</th>
                    <th>Raza</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objAnimal as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$idAnimal ?>"></td>

                        <td><?php echo $key->$idAnimal ?></td>
                        <td><?php echo $key->$peso ?></td>
                        <td><?php echo $key->$edad ?></td>
                        <td><?php echo $key->$fecha ?></td>
                        <td><?php echo $key->$genero ?></td>
                        <td><?php echo $key->$lote ?></td>
                        <td><?php echo $key->$raza ?></td>
                        <td>
                            <a  href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editAnimal', array(animalTableClass::ID => $key->$idAnimal)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a data-toggle="modal" data-target="#myModalDelete<?php echo $key->$idAnimal ?>" href="#" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>
                        </td>
                    </tr>
                    <!-- WINDOWS MODAL DELETE -->
                <div class="modal fade" id="myModalDelete<?php echo $key->$idAnimal ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm') ?></h4>
                            </div>
                            <div class="modal-body">
                                ¿<?php echo i18n::__('confirmDelete') ?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cancel') ?></button>
                                <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$idAnimal ?>, '<?php echo animalTableClass::getNameField(animalTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteAnimal') ?>')"><?php echo i18n::__('delete') ?></button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <!----PAGINADOR---->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
            </div>
        </div>
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
                <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>">
                    <table class="table table-responsive ">    
                        <tr>
                            <th>  <?php echo i18n::__('peso', NULL, 'animal') ?>:</th>
                            <th> 
                                <input placeholder="<?php echo i18n::__('peso', NULL, 'animal') ?>" type="text" name="filter[peso]" >
                            </th>   
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('edad', null, 'animal') ?>:
                            </th>
                            <th>
                                <input placeholder="<?php echo i18n::__('edad', NULL, 'animal') ?>" type="text" name="filter[edad]" >
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('fecha', null, 'animal') ?>:
                            </th>
                            <th>
                                <input type="date" name="filter[fecha_inicial]" >               
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('fecha', null, 'animal') ?>:
                            </th>
                            <th>
                                <input type="date" name="filter[fecha_fin]" >               
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('genero', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[genero]">
                                    <?php foreach ($objGenero as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_genero ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('lote', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[lote]">
                                    <?php foreach ($objLote as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_lote ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('raza', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="filter[raza]">
                                    <?php foreach ($objRaza as $key): ?>
                                        <option value="<?php echo $key->id ?>">
                                            <?php echo $key->nombre_raza ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                    </table>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()">Buscar</button>
            </div>
        </div>
    </div>
</div>
