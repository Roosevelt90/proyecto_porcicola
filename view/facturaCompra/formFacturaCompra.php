<?php
use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $id = procesoCompraTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $nombreProveedor = proveedorTableClass::NOMBRE_COMPLETO ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('factura', ((isset($objFacturaCompra) == TRUE) ? 'updateEFacturaCompra' : 'createFacturaCompra')) ?>">
    <?php if (isset($objFacturaCompra)): ?>
    <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objFacturaCompra[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 
                    <tr>
                        <th>
                            <?php i18n::__('fechaFactura', null, 'facturaCompra') ?>
                        </th>
                        <th>
                            <input type="datetime-local" name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::FECHA_HORA_COMPRA, true) ?>">
                        </th>   
                   
                    </tr>
                    <tr>
                        <th>  
                            <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
                        </th>
                        <th> 
                            <select name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::EMPLEADO_ID, true) ?>">
                                <option value="">...</option>
                                <?php foreach ($objEmpleado as $key): ?>
                                <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>   
                    
                    </tr>
                  
                    <tr>
                        <th>  
                            <?php echo i18n::__('proveedor') ?>:
                        </th>
                        <th> 
                            <select name="<?php echo procesoCompraTableClass::getNameField(procesoCompraTableClass::PROVEEDOR_ID, true) ?>">
                                <option value="">...</option>
                                <?php foreach ($objProveedor as $key): ?>
                                <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreProveedor ?></option>
                                <?php endforeach; ?>
                            </select>
                        </th>   
                    
                    </tr>                    
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objFacturaCompra) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>