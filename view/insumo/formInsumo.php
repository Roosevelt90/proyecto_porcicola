<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $fabricacion = insumoTableClass::FECHA_FABRICACION ?>
<?php $vencimiento = insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $tipoInsumo = tipoInsumoTableClass::DESCRIPCION ?>
<?php $id_tipoInsumo = tipoInsumoTableClass::ID ?>
<?php $idTipoInsumo = insumoTableClass::TIPO_INSUMO ?>
<?php $valor = insumoTableClass::VALOR ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objInsumo) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objInsumo)): ?>
      <input type="hidden" name="<?php echo insumoTableClass::getNameField(insumoTableClass::ID, TRUE) ?>" value="<?php echo $objInsumo[0]->$id ?>">
    <?php endif; //close if ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive ">    
                      <tr>
                        <th>  <?php echo i18n::__('tipoInsumo') ?>:</th>
                        <th>
                            <select name="<?php echo insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO, true) ?>">
                                <option value=<?php echo null ?>>...</option>
                                <?php foreach ($objTipoInsumo as $key): ?>
                                  <option value="<?php echo $key->$id_tipoInsumo ?>"><?php echo $key->$tipoInsumo ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('insumo', NULL, 'insumo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('insumo', NULL, 'insumo') : $objInsumo[0]->$nombre = ucwords($objInsumo[0]->$nombre)) ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaFabricacion') ?>:</th>
                        <th> <input  type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('fechaVencimiento') ?>:</th>
                        <th> <input  type="date" name="<?php echo insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true) ?>" ></th>   
                    </tr>
                  
                    <tr>
                        <th>  <?php echo i18n::__('valorInsumo') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objInsumo) == FALSE) ? i18n::__('valorInsumo') : $objInsumo[0]->$valor = ucwords($objInsumo[0]->$valor)) ?>" type="text" name="<?php echo insumoTableClass::getNameField(insumoTableClass::VALOR, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-right">
                        <input type="submit" value="<?php echo i18n::__(((isset($objInsumo) == TRUE) ? 'edit' : 'register'), NULL, 'user') ?>">
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