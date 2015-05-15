<?php use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
    <?php $id = cargoTableClass::ID?>
    <?php $descripcion =  cargoTableClass::DESCRIPCION ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('empleado', ((isset($objCargo) == TRUE) ? 'updateCargo' : 'createCargo')) ?>">
<?php if (isset($objCargo)): ?>
    <input type="hidden" name="<?php echo cargoBaseTableClass::getNameField(cargoBaseTableClass::ID, TRUE) ?>" value="<?php echo $objCargo[0]->$id ?>">
<?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 
                   
                    <tr>
                        <th>  <?php echo i18n::__('cargo', NULL, 'cargo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objCargo) == FALSE) ? i18n::__('cargo',  NULL, 'cargo') : $objCargo[0]->$descripcion = ucwords($objCargo[0]->$descripcion)) ?>" type="text" name="<?php echo cargoBaseTableClass::getNameField(cargoBaseTableClass::DESCRIPCION, true) ?>" ></th>   
                </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                            <input type="submit" value="<?php echo i18n::__(((isset($objCargo) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'cargo') ?>">
                    </div>
                            </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>