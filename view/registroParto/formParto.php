<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = registroPartoTableClass::ID ?>
<?php $fecha = registroPartoTableClass::FECHA_NACIMIENTO ?>
<?php $hembras = registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS ?>
<?php $machos =  registroPartoTableClass::MACHOS_NACIDOS_VIVOS ?>
<?php $muertos = registroPartoTableClass::NACIDOS_MUERTOS ?>
<?php $raza = registroPartoTableClass::RAZA_ID ?>
<?php $animal_id = registroPartoTableClass::ANIMAL_ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objParto) == TRUE) ? 'updateRegistroParto' : 'createRegistroParto')) ?>">
    <?php if (isset($objParto)): ?>
    <input type="hidden" name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::ID, TRUE) ?>" value="<?php echo $objParto[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <div class="table-responsive">
                <table class="table table-bordered ">    
                    <tr>
                        <th>  <?php echo i18n::__('parto1', NULL, 'animal') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objParto) == FALSE) ? i18n::__('fecha', NULL, 'animal') : $objParto[0]->$fecha = ucwords($objParto[0]->$fecha)) ?>" type="date" min="0"  name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::FECHA_NACIMIENTO, true) ?>" >
                        </th>   
                    </tr>
                    
                    
                    <tr>
                        <th>  <?php echo i18n::__('machos', NULL, 'parto') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objParto) == FALSE) ? i18n::__('machos', NULL, 'parto') : $objParto[0]->$hembras= ucwords($objParto[0]->$hembras)) ?>" type="number" min="0"  name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::MACHOS_NACIDOS_VIVOS, true) ?>" >
                        </th>   
                    </tr>
                     <tr>
                        <th>  <?php echo i18n::__('hembras', NULL, 'parto') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objParto) == FALSE) ? i18n::__('hembras', NULL, 'parto') : $objParto[0]->$machos= ucwords($objParto[0]->$machos)) ?>" type="number" min="0"  name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS, true) ?>" >
                        </th>   
                    </tr>
                  <tr>
                        <th>  <?php echo i18n::__('muertos', NULL, 'parto') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objParto) == FALSE) ? i18n::__('muertos', NULL, 'parto') : $objParto[0]->$muertos= ucwords($objParto[0]->$muertos)) ?>" type="number" min="0"  name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::NACIDOS_MUERTOS, true) ?>" >
                        </th>   
                    </tr>
                   <tr>
                        <th>
                            <?php echo i18n::__('raza', null, 'animal') ?>:
                        </th>
                        <th>
                            <select name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::RAZA_ID, true) ?>">
                                <option>...</option>                              
                              <?php foreach ($objRaza as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_raza ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                     <tr>
                        <th>  <?php echo i18n::__('animal', NULL, 'animal') ?>:</th>
                          <th>
                            <select name="<?php echo registroPartoTableClass::getNameField(registroPartoTableClass::ANIMAL_ID, true) ?>">
                                <option>...</option>                              
                                    <?php foreach ($objAnimal as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->numero_identificacion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>  
                    </tr>
                    <tr>
                        <th colspan="2" > <div class="text-center">

                            <input type="submit"  class="btn" value="<?php echo i18n::__(((isset($objParto) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">
                    </div>
                        </th>
                    </tr>
                </table>
                    </div>
            </div>
        </div>
    </div>
</form>