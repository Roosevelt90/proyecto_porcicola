<?php use mvc\routing\routingClass as routing ?>

<?php use mvc\i18n\i18nClass as i18n ?>

<?php use mvc\view\viewClass as view ?>

<?php $idAnimal = animalTableClass::ID ?>
<?php $peso = animalTableClass::PESO ?>
<?php $fecha = animalTableClass::FECHA_NACIMIENTO ?>
<?php $edad= animalTableClass::EDAD ?>
<?php $parto = animalTableClass::PARTO ?>
<?php $precio_animal = animalTableClass::PRECIO_ANIMAL ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $lote = loteTableClass::NOMBRE ?>
<?php $raza = razaTableClass::NOMBRE_RAZA ?>
<?php $numero = animalTableClass::NUMERO ?>
<?php  $countDetale = 1 ?>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
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
            
            <a href="#myModalFilter" class="btn btn-xs btn-default active"><?php echo i18n::__('buscar') ?></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFiltersAnimal') ?>"><?php echo i18n::__('deleteFilter') ?></a>  
            <!--<a href="#" data-target="#myModalReport" data-toggle="modal" class="btn btn-success btn-xs lead"><?php echo i18n::__('report') ?></a>-->
            
          </div>
          <div class="col-xs-4-offset-2 nuevo">
            <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()"><?php echo i18n::__('borrar seleccion') ?></a>
            <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insertAnimal') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('nuev', null, 'animal') ?></a>
            
            <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'reportAnimal') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('report') ?></a>
          </div>
        </div>
        <?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive">
          <thead>
            <tr class="active">
              <td><input type="checkbox" id="chkAll"></td> 
              <th><?php echo i18n::__('identification', null, 'animal') ?></th>
              <th><?php echo i18n::__('date_birth', null, 'animal') ?></th>
              <th><?php echo i18n::__('peso', null, 'animal') ?></th>
              <th><?php echo i18n::__('edad', null, 'animal') ?></th>
              <th><?php echo i18n::__('genero', null, 'animal') ?></th>
              <th><?php echo i18n::__('parto', null, 'animal') ?></th>
              <th><?php echo i18n::__('lote', null, 'animal') ?></th>
              <th><?php echo i18n::__('raza', null, 'animal') ?></th>
              <th><?php echo i18n::__('precio', null, 'animal') ?></th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($objAnimal as $key): ?>
              <tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $key->$idAnimal ?>"></td>
                <td><?php $key->$numero ?></td>
                <td><?php echo $key->$fecha ?></td>  
                <td><?php echo $key->$peso ?></td>
                <td><?php echo $key->$edad ?></td>
                <td><?php echo $key->$genero ?></td>
                <td><?php echo $key->$parto?></td>
                <td><?php echo $key->$lote ?></td>
                <td><?php echo $key->$raza ?></td>
                <td><?php echo $key->$precio_animal ?></td>
                <td>
                  <a  href="<?php echo routing::getInstance()->getUrlWeb('animal', 'editAnimal', array(animalTableClass::ID => $key->$idAnimal)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                  <a  href="#myModalDelete<?php echo $key->$idAnimal ?>" class="btn btn-danger btn-sm"><?php echo i18n::__('delete') ?></a>
                </td>
              </tr>
              <!-- WINDOWS MODAL DELETE -->
            <div id="myModalDelete<?php echo $key->$idAnimal ?>" class="modalmask">
              <div class="modalbox rotate">
                <a href="#close" title="Close" class="close">X</a>
                <div class="modal-body">
                  ¿<?php echo i18n::__('confirmDelete') ?>?
                </div>
                <div class="modal-footer">
                  <a href="#close2" title="Close" class="close2 btn btn-info"><?php echo i18n::__('cancel') ?></a>
                  <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $key->$idAnimal ?>, '<?php echo animalTableClass::getNameField(animalTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteAnimal') ?>')"><?php echo i18n::__('delete') ?></button>
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
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('cerrar') ?></button>
            <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
          </div>
        </div>
      </div>
    </div>

    <!-- WINDOWS MODAL FILTERS -->
    <div id="myModalFilter" class="modalmask">
      <div class="modalbox rotate">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('buscar') ?></h4>
        </div>
        <form id="filterForm" class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal') ?>">
          <table class="table table-responsive ">    
<!--                        <tr>
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
              </tr>-->

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
        <div class="modal-footer">
          <a href="#close2" title="Close" class="close2 btn btn-info"><?php echo i18n::__('cerrar') ?></a>
          <button type="button" class="btn btn-primary" onclick="$('#filterForm').submit()"><?php echo i18n::__('buscar') ?></button>
        </div>
      </div>
    </div>



  </div>
</main>
<!-- WINDOWS MODAL REPORTE -->
<!--<div class="modal fade" id="myModalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<?php // foreach ($objLote as $key):  ?>
                                        <option value="<?php // echo $key->id   ?>">
<?php //echo $key->nombre_lote  ?>
                                        </option>
<?php //endforeach; ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
<?php // echo i18n::__('raza', null, 'animal')  ?>:
                            </th>
                            <th>
                                <select name="report[raza]">
                                    <option value="default">... </option>
<?php //foreach ($objRaza as $key):  ?>
                                        <option value="<?php echo $key->id ?>">
<?php // echo $key->nombre_raza  ?>
                                        </option>
<?php //endforeach;  ?>
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
</div>-->