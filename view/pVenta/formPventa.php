<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = pVentaTableClass::ID ?>
<?php $usuario_id = pVentaTableClass::USUARIO_ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('pVenta', ((isset($objPventa) == TRUE) ? 'update' : 'create')) ?>">
    <?php   if (isset($objPventa)): ?>
    <input type="hidden" name="<?php echo pVentaTableClass::getNameField(pVentaTableClass::ID, TRUE) ?>" value="<?php echo $objPventa[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <table class="table table-responsive ">
                    <tr>
                        <th>  <?php echo i18n::__('fecha', NULL, 'pVenta') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objPventa) == FALSE) ? i18n::__('fecha', NULL, 'pVenta') : $objPventa[0]->$fecha = ucwords($objPventa[0]->$fecha)) ?>" type="datetime-local" name="<?php echo pVentaTableClass::getNameField(pVentaTableClass::FECHA, true) ?>" ></th>   
                    </tr>
                     <tr>
                        <th>
                            <?php echo i18n::__('user', null, 'user') ?>:
                        </th>
                        <th>
                            <select name="<?php echo pVentaTableClass::getNameField(pVentaTableClass::USUARIO_ID, true) ?>">
                                <?php foreach ($objUsuario as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->user_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                   <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objPventa) == TRUE) ? 'edit' : 'register'), NULL,  'pVenta') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>