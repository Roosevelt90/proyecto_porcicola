<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = vacunaTableClass::ID ?>
<?php $nombre = vacunaTableClass::NOMBRE_VACUNA ?>
<?php $lote = vacunaTableClass::LOTE_VACUNA ?>
<?php $fecha_fabricacion = vacunaTableClass::FECHA_FABRICACION ?>
<?php $fecha_vencimiento = vacunaTableClass::FECHA_VENCIMIENTO ?>
<?php $valor = vacunaTableClass::VALOR ?>


<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('vacunacion', ((isset($objVacuna) == TRUE) ? 'updateVacuna' : 'createVacuna')) ?>">
    <?php if (isset($objVacuna)): ?>
    <input type="hidden" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::ID, TRUE) ?>" value="<?php echo $objVacuna[0]->$id ?>">
    <?php endif;//close if ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 

                    <tr>
                        <th>  
                            <?php echo i18n::__('nameVacuna', NULL, 'vacuna') ?>:
                        </th>
                        <th>
                            <input value="<?php echo ((session::getInstance()->getFlash(vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true))) ? 'uno' : ''  ) ?>" required="" placeholder="<?php echo ((isset($objVacuna) == FALSE) ? i18n::__('vacuna', NULL, 'vacuna') : $objVacuna[0]->$nombre = ucwords($objVacuna[0]->$nombre)) ?>" type="text" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::NOMBRE_VACUNA, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('lote', NULL, 'vacuna') ?>:
                        </th>
                        <th>
                            <input required="" placeholder="<?php echo ((isset($objVacuna) == FALSE) ? i18n::__('lote', NULL, 'vacuna') : $objVacuna[0]->$lote = ucwords($objVacuna[0]->$lote)) ?>" type="text" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::LOTE_VACUNA, true) ?>" >
                        </th>   

                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fecha_fabricacion', null, 'vacuna') ?>
                        </th>
                        <th>
                            <input required="" type="date" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::FECHA_FABRICACION, true) ?>" >
                        </th> 
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('fecha_vencimiento', null, 'vacuna') ?>
                        </th>
                        <th>
                            <input required="" type="date" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::FECHA_VENCIMIENTO, true) ?>" >
                        </th> 
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('valor', NULL, 'vacuna') ?>:
                        </th>
                        <th>
                            $ <input pattern="[0-9]{3} required="" min="0" placeholder="<?php echo ((isset($objVacuna) == FALSE) ? i18n::__('valor', NULL, 'vacuna') : $objVacuna[0]->$valor = ucwords($objVacuna[0]->$valor)) ?>" type="number" name="<?php echo vacunaTableClass::getNameField(vacunaTableClass::VALOR, true) ?>" >Pesos
                        </th>   

                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" value="<?php echo i18n::__(((isset($objVacuna) == TRUE) ? 'edit' : 'register')) ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>
       
</main>