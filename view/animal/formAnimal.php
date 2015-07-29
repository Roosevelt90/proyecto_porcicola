<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id_animal = animalTableClass::ID ?>
<?php $peso = animalTableClass::PESO ?>
<?php $precio_animal =  animalTableClass::PRECIO_ANIMAL ?>
<?php $fecha = animalTableClass::FECHA_NACIMIENTO ?>
<?php $genero = generoTableClass::NOMBRE ?>
<?php $lote = loteTableClass::NOMBRE ?>
<?php $raza = razaTableClass::NOMBRE_RAZA ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objAnimal) == TRUE) ? 'updateAnimal' : 'createAnimal')) ?>">
    <?php if (isset($objAnimal)): ?>
        <input type="hidden" name="<?php echo animalTableClass::getNameField(animalTableClass::ID, TRUE) ?>" value="<?php echo $objAnimal[0]->$id_animal ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th> Numero de identifacion</th>
                        <th> 
                          <input required  type="text"   name="<?php echo animalTableClass::getNameField(animalTableClass::NUMERO, true) ?>" >
                        </th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('kg', NULL, 'animal') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objAnimal) == FALSE) ? i18n::__('peso', NULL, 'animal') : $objAnimal[0]->$peso = ucwords($objAnimal[0]->$peso)) ?>" type="number" min="0"  name="<?php echo animalTableClass::getNameField(animalTableClass::PESO, true) ?>" >
                        </th>   
                    </tr>
                    
                    <tr>
                        <th>
                            <?php echo i18n::__('fecha', null, 'animal') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objAnimal) == FALSE) ? i18n::__('fecha', NULL, 'animal') : $objAnimal[0]->$fecha ) ?>" type="datetime-local" name="<?php echo animalTableClass::getNameField(animalTableClass::FECHA_NACIMIENTO, true) ?>" >
                        </th>
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('pesos', NULL, 'animal') ?>:</th>
                        <th> 
                            <input required  placeholder="<?php echo ((isset($objAnimal) == FALSE) ? i18n::__('precio', NULL, 'animal') : $objAnimal[0]->$precio_animal= ucwords($objAnimal[0]->$precio_animal)) ?>" type="number" min="0"  name="<?php echo animalTableClass::getNameField(animalTableClass::PRECIO_ANIMAL, true) ?>" >
                        </th>   
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('genero', null, 'animal') ?>:
                        </th>
                        <th>
                            <select name="<?php echo animalTableClass::getNameField(animalTableClass::GENERO_ID, true) ?>">
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
                            <select name="<?php echo animalTableClass::getNameField(animalTableClass::LOTE_ID, true) ?>">
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
                            <select name="<?php echo animalTableClass::getNameField(animalTableClass::RAZA, true) ?>">
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
                        <th colspan="2" class="active text-center">

                            <input type="submit" value="<?php echo i18n::__(((isset($objAnimal) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">

                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
</div>
</main>