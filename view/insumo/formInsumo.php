<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
    <?php $id = insumoTableClass::ID ?>
    <?php $nombre = insumoTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objInsumo)): ?>
        <input type="hidden" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, TRUE) ?>" value="<?php echo $objInsumo[0]->$id ?>">
<?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th>  <?php echo i18n::__('insumo', NULL, 'insumo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('insumo', NULL, 'insumo') : $objInsumo[0]->$nombre = ucwords($objInsumo[0]->$nombre)) ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objInsumo) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>