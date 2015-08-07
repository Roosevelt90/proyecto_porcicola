<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuario', ((isset($objCredencial) == TRUE) ? 'updateCredencial' : 'createCredencial')) ?>">
    <?php if (isset($objCredencial)): ?>
    <input type="hidden" name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, TRUE) ?>" value="<?php echo $objCredencial[0]->id ?>">
    <?php endif;//close if ?>
    <div class="container">
        <div class="row">
           <div class="col-xs-6-offset-3">
                <table class="table table-responsive">    
                    <tr>
                        <th>  <?php echo i18n::__('credencial', NULL, 'credencial') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objCredencial) == FALSE) ? i18n::__('credencial', NULL, 'credencial') : $objCredencial[0]->$nombre = ucwords($objCredencial[0]->$nombre)) ?>" type="text" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objCredencial) == TRUE) ? 'edit' : 'register'), NULL,  'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
