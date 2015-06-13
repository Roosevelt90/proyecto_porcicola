<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = ciudadTableClass::ID ?>
<?php $nombreCiudad = ciudadTableClass::NOMBRE ?>
<?php $departamento_id = ciudadTableClass::ID_DEPTO?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('ciudad', ((isset($objCiudad) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objCiudad)): ?>
        <input type="hidden" name="<?php echo ciudadBaseTableClass::getNameField(ciudadBaseTableClass::ID, TRUE) ?>" value="<?php echo $objCiudad[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th>  <?php echo i18n::__('city', NULL, 'city') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objCiudad) == FALSE) ? i18n::__('city', NULL, 'city') : $objCity[0]->$nombreCiudad = ucwords($objCiudad[0]->$nombreCiudad)) ?>" type="text" name="<?php echo ciudadBaseTableClass::getNameField(ciudadBaseTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('depto', null, 'depto') ?>:
                        </th>
                        <th>
                            <select name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::ID_DEPTO, true) ?>">
                                <?php foreach ($objDepto as $key): ?>
                                    <option value="<?php echo $key->departamento_id ?>">
                                        <?php echo $key->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objCiudad) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
