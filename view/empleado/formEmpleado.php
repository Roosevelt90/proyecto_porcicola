<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = empleadoTableClass::ID ?>
<?php $numero_documento = empleadoTableClass::NUMERO_DOC ?>
<?php $telefono = empleadoTableClass::TEL ?>
<?php $tipo_doc = tipoDocumentoTableClass::ID ?>
<?php $cargo_id = cargoTableClass::ID ?>
<?php $ciudad = ciudadTableClass::ID ?>
<?php $direccion = empleadoTableClass::DIRECCION ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('personal', ((isset($objEmpleado) == TRUE) ? 'updateEmpleado' : 'createEmpleado')) ?>">
    <?php if (isset($objEmpleado)): ?>
        <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objEmpleado[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
             <div class="col-xs-6-offset-3">

                <table class="table table-responsive"> 
                       <tr>
                        <th>
                            <?php echo i18n::__('document type', null, 'empleado') ?>:
                        </th>
                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_DOC, true) ?>">
                                 <option>...</option>                               
                             <?php foreach ($objTipo_doc as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->descripcion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>                  

                    <tr>

                        <th><?php echo i18n::__('identificacion') ?>:</th>

                        <th>

                            <input type="number"  value="<?php // echo $objEmpleado[0]->$numero_documento ?>"  placeholder="<?php echo i18n::__('identificacion') ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true) ?>"></th>   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('empleado') ?>:</th>
                        <th> <input placeholder="<?php echo i18n::__('empleado', NULL, 'empleado') ?>" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>"></th>   

                    </tr>
                    <tr>
                        <th><?php echo i18n::__('telefono') ?>:</th>
                        <th> <input type="number" placeholder="<?php echo i18n::__('telefono') ?>" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::TEL, true) ?>"></th>

                    </tr>
                    <tr>
                        <th><?php echo i18n::__('direccion') ?>:</th>
                        <th> <input placeholder="<?php echo i18n::__('direccion') ?>" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>"></th>

                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('city') ?>:
                        </th>

                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CIUDAD, true) ?>">
                                  <option>...</option>
                                <?php foreach ($objCiudad as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->nombre_ciudad ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('cargo', null, 'cargo') ?>:
                        </th>

                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>">
                                <option>...</option>
                                <?php foreach ($objCargo as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->descripcion_cargo ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                 


                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objEmpleado) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
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