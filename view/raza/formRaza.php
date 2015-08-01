<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
    <?php $id = razaTableClass::ID ?>
    <?php $nombre = razaTableClass::NOMBRE_RAZA ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objRaza) == TRUE) ? 'updateRaza' : 'createRaza')) ?>">
    <?php if (isset($objRaza)): ?>
        <input type="hidden" name="<?php echo razaTableClass::getNameField(razaTableClass::ID, TRUE) ?>" value="<?php echo $objRaza[0]->$id ?>">
<?php endif; //close if  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th>  <?php echo i18n::__('raza', NULL, 'raza') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objRaza) == FALSE) ? i18n::__('raza', NULL, 'raza') : $objRaza[0]->$nombre = ucwords($objRaza[0]->$nombre)) ?>" type="text" name="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE_RAZA, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objRaza) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>