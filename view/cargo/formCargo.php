<?php use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
    <?php $id = cargoTableClass::ID?>
    <?php $descripcion =  cargoTableClass::DESCRIPCION ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('personal', ((isset($objCargo) == TRUE) ? 'updateCargo' : 'createCargo')) ?>">
<?php if (isset($objCargo)): ?>
    <input type="hidden" name="<?php echo cargoBaseTableClass::getNameField(cargoBaseTableClass::ID, TRUE) ?>" value="<?php echo $objCargo[0]->$id ?>">
<?php endif; ?>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 
                   
                    <tr>
                        <th>  <?php echo i18n::__('cargo', NULL, 'cargo') ?>:</th>
                        <th> <input required pattern="[a-zA-Z0-9]{3,20}$" placeholder="cargo" name="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>"></th>
     
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input   type="submit" value="<?php echo i18n::__(((isset($objCargo) == TRUE) ? 'edit' : 'register'), $culture = NULL) ?>">
                    </div>
                            </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>