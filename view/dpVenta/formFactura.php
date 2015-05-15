
<?php use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = dpVentaTableClass::ID ?>
<?php $fecha = dpVentaTableClass::FECHA ?>
<?php $numero_documento = dpVentaTableClass::NUMERO_DOCUMENTO ?>
<?php  $usuario_id = dpVentaTableClass::USUARIO_ID ?>
<?php  $peso_animal = dpVentaTableClass::PESO_ANIMAL ?>
<?php $precio_animal = dpVentaTableClass::PRECIO_ANIMAL ?>
<?php $animal_id = dpVentaTableClass::ANIMAL_ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('dpVenta', ((isset($objDventa) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objDventa)): ?>
        <input type="hidden" name="<?php echo dpVentaBaseTableClass::getNameField(dpVentaBaseTableClass::ID, TRUE) ?>" value="<?php echo $objDventa[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                 <table class="table table-responsive ">
                     <tr>
                    <th>  <?php echo i18n::__('date', NULL, 'dpVenta') ?>:</th>
                   <th> <input placeholder="<?php echo ((isset($objDventa) == FALSE) ? i18n::__('date', NULL, 'dpVenta') : $objDventa[0]->$fecha = ucwords($objDventa[0]->$fecha)) ?>" type="datetime-local" name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::FECHA, true) ?>" ></th> 
                  </tr>  
                     <tr>
                        <th>
                            <?php echo i18n::__('user', null, 'dpVenta') ?>:
                        </th>
                        <th>
                            <select name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::USUARIO_ID, true) ?>">
                                <?php foreach ($objUsuario as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->user_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th></br>
                     </tr>
                  <tr>
                   <tr>
                        <th colspan="9">
                    <div class="titulo">
                       <?php echo i18n::__('details', NULL, 'dpVenta') ?>
                    </div>
                    </th>
                    </tr>
                      <tr>
                        <th>
                            <?php echo i18n::__('numer', null, 'dpVenta') ?>:
                        </th>
                        <th>
                            <select name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::NUMERO_DOCUMENTO, true) ?>">
                                <?php foreach ($objPventa as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->id ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th></br>
                     </tr>
                    <tr>
                   <th>  <?php echo i18n::__('weight', NULL, 'dpVenta') ?>:</th>
                   <th>  <?php echo i18n::__('price', NULL, 'dpVenta') ?>:</th>
                    
                    </tr>
                   <tr>
                         
                         <th> <input placeholder="<?php echo ((isset($objDventa) == FALSE) ? i18n::__('weight', NULL, 'dpVenta') : $objDventa[0]->$peso_animal = ucwords($objDventa[0]->$peso_animal)) ?>" type="text" name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::PESO_ANIMAL, true) ?>" ></th> 
                          <th> <input placeholder="<?php echo ((isset($objDventa) == FALSE) ? i18n::__('price', NULL, 'dpVenta') : $objDventa[0]->$precio_animal = ucwords($objDventa[0]->$precio_animal)) ?>" type="text" name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::PRECIO_ANIMAL, true) ?>" ></th> 
                                        
                 </tr>
                <tr>
                    <th>
                        <?php echo i18n::__('animal_id', null, 'dpVenta') ?>:
                    </th>
                    <th>
                        <select name="<?php echo dpVentaTableClass::getNameField(dpVentaTableClass::ANIMAL_ID, true) ?>">
                            <?php foreach ($objAnimal as $key): ?>
                                <option value="<?php echo $key->id ?>">
                                    <?php echo $key->id ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </th></br>
                 </tr>
                    <tr>
                        <th colspan="9">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objDventa) == TRUE) ? 'edit' : 'register'), NULL,  'dpVenta') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
