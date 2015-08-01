<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = loteTableClass::ID ?>
<?php $nombre = loteTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('animal', ((isset($objLote) == TRUE) ? 'updateLote' : 'createLote')) ?>">
    <?php if (isset($objLote)): ?>
        <input type="hidden" name="<?php echo loteTableClass::getNameField(loteTableClass::ID, TRUE) ?>" value="<?php echo $objLote[0]->$id ?>">
    <?php endif; //close if  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                    <tr>
                        <th>  <?php echo i18n::__('lote', NULL, 'lote') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objLote) == FALSE) ? i18n::__('lote', NULL, 'lote') : $objLote[0]->$nombre = ucwords($objLote[0]->$nombre)) ?>" type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objLote) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
</div>
</main>