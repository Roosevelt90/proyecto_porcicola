<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = procesoVentaTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $cliente = clienteTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('factura', ((isset($objFacturaVenta) == TRUE) ? 'updateFacturaVenta' : 'createFacturaVenta')) ?>">
    <?php if (isset($objFacturaCompra)): ?>
      <input type="hidden" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, TRUE) ?>" value="<?php echo $objFacturaCompra[0]->$id ?>">
    <?php endif; //close if  ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">

                <table class="table table-responsive "> 
                    <table class="table table-responsive "> 
                        <tr>
                            <th>
                                <?php i18n::__('fechaFactura', null, 'facturaCompra') ?>
                            </th>
                            <th>
                                <input type="datetime-local" name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::FECHA_HORA_VENTA, true) ?>">
                            </th>   

                        </tr>
                        <tr>
                            <th>  
                                <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
                            </th>
                            <th> 
                                <select name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::EMPLEADO_ID, true) ?>">
                                    <option value="">...</option>
                                    <?php foreach ($objEmpleado as $key): ?>
                                      <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
                                    <?php endforeach; //close foreach  ?>
                                </select>
                            </th>   

                        </tr>

                        <tr>
                            <th>  
                                <?php echo i18n::__('cliente') ?>:
                            </th>
                            <th> 
                                <select name="<?php echo procesoVentaTableClass::getNameField(procesoVentaTableClass::CLIENTE_ID, true) ?>">
                                    <option value="">...</option>
                                    <?php foreach ($objCliente as $key): ?>
                                      <option value="<?php echo $key->$id ?>"> <?php echo $key->$cliente ?></option>
                                    <?php endforeach; //close foreach  ?>
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
</div>
</main>
