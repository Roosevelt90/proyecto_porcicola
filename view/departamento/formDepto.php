<?php use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
    <?php $id = departamentoTableClass::ID ?>
    <?php $nombre = departamentoTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('departamento', ((isset($objDepto) == TRUE) ? 'update' : 'create')) ?>">
<?php if (isset($objDepto)): ?>
    <input type="hidden" name="<?php echo departamentoBaseTableClass::getNameField(departamentoBaseTableClass::ID, TRUE) ?>" value="<?php echo $objDepto[0]->$id ?>">
<?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th>  <?php echo i18n::__('depto', NULL, 'depto') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objDepto) == FALSE) ? i18n::__('depto',  NULL, 'depto') : $objDepto[0]->$nombre = ucwords($objDepto[0]->$nombre)) ?>" type="text" name="<?php echo departamentoBaseTableClass::getNameField(departamentoBaseTableClass::NOMBRE, true) ?>" ></th>   
                </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                            <input type="submit" value="<?php echo i18n::__(((isset($objDepto) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                            </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>