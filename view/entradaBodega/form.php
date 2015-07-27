<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $id = empleadoTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('bodega', ((isset($objEntrada) == TRUE) ? 'updateEntrada' : 'createEntrada')) ?>">
  <?php if (isset($objFacturaCompra)): ?>
    <input type="hidden" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID, TRUE) ?>" value="<?php echo $objEntrada[0]->$id ?>">
  <?php endif; //close if  ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">

        <table class="table table-responsive "> 
          <table class="table table-responsive "> 
            <tr>
              <th>
                Fecha
              </th>
              <th>
                <input type="datetime-local" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true) ?>">
              </th>   

            </tr>
            <tr>
              <th>  
                <?php echo i18n::__('empleado', NULL, 'empleado') ?>:
              </th>
              <th> 
                <select name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO, true) ?>">
                  <option value="">...</option>
                  <?php foreach ($objEmpleado as $key): ?>
                    <option value="<?php echo $key->$id ?>"> <?php echo $key->$nombreEmpleado ?></option>
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