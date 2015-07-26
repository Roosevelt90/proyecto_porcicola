<?php use mvc\routing\routingClass as routing ?>

<?php use mvc\i18n\i18nClass as i18n ?>

<?php use mvc\view\viewClass as view ?>

<?php $idAnimal = animalTableClass::ID ?>
<?php $peso = animalTableClass::PESO ?>
<?php $edad = animalTableClass::EDAD ?>
<?php $parto = animalTableClass::PARTO ?>
<?php $precio = animalTableClass::PRECIO ?>
<?php $fecha = animalTableClass::FECHA_INGRESO ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $lote = loteTableClass::NOMBRE ?>
<?php $raza = razaTableClass::NOMBRE_RAZA ?>
<?php $countDetale = 1 ?>
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
            <div class="col-xs-3 text-center">
                <!--<a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportAnimal') ?>" class=""></a>-->
                <a id="filter" href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="filter">
                    <?php echo i18n::__('buscar', null, 'ayuda') ?>
                </div>
                <a id="deleteFilter" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersAnimal') ?>"><?php echo i18n::__('deleteFilter') ?></a>  
                <div class="mdl-tooltip mdl-tooltip--large" for="deleteFilter">
                    <?php echo i18n::__('eliBusqueda', null, 'ayuda') ?>
                </div>
                 <!--<a id="new" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertAnimal') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new', null, 'animal') ?></a>-->
                <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
                <a id="reporte" href="#" data-target="#myModalReport" data-toggle="modal" class="btn btn-success btn-xs lead"><?php echo i18n::__('report') ?></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="reporte">
                    <?php echo i18n::__('reporte', null, 'ayuda') ?>
                </div>
            </div>
            <div class="col-xs-4-offset-2 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertAnimal') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()"><?php echo i18n::__('delete') ?></a>
            </div>
        </div>
        <?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="active">
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th> <?php echo i18n::__('identification', null, 'animal') ?></th>
                    <th><?php echo i18n::__('fecha', null, 'animal') ?></th>
                    <th><?php echo i18n::__('peso', null, 'animal') ?></th>
                    <th><?php echo i18n::__('genero', null, 'animal') ?></th>
                    <th><?php echo i18n::__('parto', null, 'animal') ?></th>
                    <th><?php echo i18n::__('lote', null, 'animal') ?></th>
                    <th><?php echo i18n::__('raza', null, 'animal') ?></th>
                    <th><?php echo i18n::__('precio', null, 'animal') ?></th>
                    <th><?php echo i18n::__('action', null, 'proveedor') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objAnimal as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$idAnimal ?>"></td>

                        <td><?php echo $key->$numero_identificacion ?></td>
                        <td><?php echo $key->$edad ?></td> <td><?php echo $key->$fecha ?></td>
                        <td><?php echo $key->$peso ?></td>
                        <td><?php echo $key->$genero ?></td>
                        <td><?php echo $key->$parto ?></td>
                        <td><?php echo $key->$lote ?></td>
                        <td><?php echo $key->$raza ?></td>
                        <td><?php echo $key->$precio ?></td>
                        <td>
                            <a  id="editDetalle<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editAnimal', array(animalTableClass::ID => $key->$idAnimal)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="editDetalle<?php echo $countDetale ?>">
                                <?php echo i18n::__('modificar', null, 'ayuda') ?>
                            </div>    
                            <a id="eliminar<?php echo $countDetale ?>" data-toggle="modal" data-target="#myModalDelete<?php echo $key->$idAnimal ?>" href="#" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                            </div> 
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
                <?php $countDetale++ ?>
            <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <!----PAGINADOR---->
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php $count = 0 ?>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count++ ?>        
                <?php endfor; ?>
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
                                    <option>...</option>
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
                                    <option>...</option>
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
                                    <option>... </option>
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


<!-- WINDOWS MODAL REPORTE -->
<div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
            </div>
            <div class="modal-body">
                <form id="reportForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportAnimal') ?>">
                    <table class="table table-responsive ">    
                        <tr>
                            <th>  <?php echo i18n::__('peso_inicial', NULL, 'animal') ?>:</th>
                            <th> 
                                <input placeholder="<?php echo i18n::__('peso_inicial', NULL, 'animal') ?>" type="text" name="report[peso_inicial]" >
                            </th>   
                        </tr>
                        <tr>
                            <th>  <?php echo i18n::__('peso_fin', NULL, 'animal') ?>:</th>
                            <th> 
                                <input placeholder="<?php echo i18n::__('peso_fin', NULL, 'animal') ?>" type="text" name="report[peso_fin]" >
                            </th>   
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('edad_inicial', null, 'animal') ?>:
                            </th>
                            <th>
                                <input placeholder="<?php echo i18n::__('edad_inicial', NULL, 'animal') ?>" type="number" name="report[edad_inicial]" >
                            </th>
                        </tr>

                        <tr>
                            <th>
                                <?php echo i18n::__('edad_fin', null, 'animal') ?>:
                            </th>
                            <th>
                                <input placeholder="<?php echo i18n::__('edad_fin', NULL, 'animal') ?>" type="number" name="report[edad_fin]" >
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('fecha_inicial', null, 'animal') ?>:
                            </th>
                            <th>
                                <input type="date" name="report[fecha_inicial]" >               
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('fecha_fin', null, 'animal') ?>:
                            </th>
                            <th>
                                <input type="date" name="report[fecha_fin]" >               
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('genero', null, 'animal') ?>:
                            </th>
                            <th>
                                <select name="report[genero]">
                                    <option value="default">...</option>
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
                                <select name="report[lote]">
                                    <option value="default">...</option>
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
                                <select name="report[raza]">
                                    <option value="default">... </option>
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
                <button type="button" class="btn btn-primary" onclick="$('#reportForm').submit()">Buscar</button>
            </div>
        </div>
    </div>
</div>