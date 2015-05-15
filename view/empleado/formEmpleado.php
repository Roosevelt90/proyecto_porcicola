<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id=  empleadoTableClass::ID?>
<?php $numero_documento = empleadoTableClass::NUMERO_DOC?>
<?php $telefono = empleadoTableClass::TEL?>
<?php $tipo_doc=  tipoDocumentoUsuarioTableClass::ID?>
<?php $cargo_id = cargoTableClass::ID?>
<?php $Ciudad = ciudadTableClass::ID?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('empleado', ((isset($objEmpleado) == TRUE) ? 'updateEmpleado' : 'createEmpleado')) ?>">
    <?php if (isset($objEmpleado)): ?>
    <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objEmpleado[0]->$id?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 
                    <tr>
                       
                        <th>Numero Documento</th>
                   
                        <th>
                 
                            <input value="<?php echo $objEmpleado[0]->$numero_documento?>" <?php ((isset($objEmpleado)) ? readonly : readonly ) ?> placeholder="numero documento" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::NUMERO_DOC, true) ?>"></th>   
                   
                    </tr>
                    <tr>
                        <th>  <?php echo i18n::__('empleado', NULL, 'empleado') ?>:</th>
                        <th> <input placeholder="empleado" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>"></th>   
                    
                    </tr>
                    <tr>
                        <th>telefono</th>
                        <th> <input placeholder="telefono" name="<?php echo empleadoBaseTableClass::getNameField(empleadoTableClass::TEL, true) ?>"></th>
     
                    </tr>
                        <th>
                            ciudad
                        </th>
                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CIUDAD, true) ?>">
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
                            <?php echo i18n::__('cargo', null, 'cargo')?>
                        </th>
                        
                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>">
                                <?php foreach ($objCargo as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->descripcion_cargo?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                  <tr>
                        <th>
                            tipo_documento
                        </th>
                        <th>
                            <select name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_DOC, true) ?>">
                                <?php foreach ($objTipo_doc as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->descripcion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>                  
                    
                    
                    
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objEmpleado) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>