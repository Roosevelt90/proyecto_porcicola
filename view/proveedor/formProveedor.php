<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = proveedorTableClass::ID ?>
<?php $numero_documento = proveedorTableClass::NUMERO_DOC ?>
<?php $nombre_completo = proveedorTableClass::NOMBRE ?>
<?php $telefono = proveedorTableClass::TEL ?>
<?php $tipo_documento_id = tipoDocumentoTableClass::ID ?>
<?php $direccion = proveedorTableClass::DIRECCION ?>
<?php $id_ciudad = ciudadTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('personal', ((isset($objProveedor) == TRUE) ? 'updateProveedor' : 'createProveedor')) ?>">
  <?php if (isset($objProveedor)): ?>
    <input type="hidden" name="<?php echo proveedorBaseTableClass::getNameField(proveedorTableClass::ID, TRUE) ?>" value="<?php echo $objProveedor[0]->$id ?>">
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-6-offset-3">

        <table class="table table-responsive "> 
               <tr>
           
             <th><?php echo i18n::__('document type', null, 'empleado') ?>:</th>
           
            <th>
              <select name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TIPO_DOC, true) ?>">
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

              <input type="number"  value=""  placeholder="<?php echo i18n::__('identificacion') ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NUMERO_DOC, true) ?>"></th>   

          </tr>
          <th>   <?php echo i18n::__('nombre') ?>: </th>

          <th> <input  placeholder="<?php echo i18n::__('nombre') ?>" name="<?php echo proveedorBaseTableClass::getNameField(proveedorTableClass::NOMBRE, true) ?>"></th>   

          </tr>
          <tr>
            <th><?php echo i18n::__('telefono') ?>:</th>
            <th> <input type="number" placeholder="<?php echo i18n::__('telefono') ?>" name="<?php echo proveedorBaseTableClass::getNameField(proveedorTableClass::TEL, true) ?>"></th>
          </tr>
           <tr>
            <th><?php echo i18n::__('direccion') ?>:</th>
            <th> <input  placeholder="<?php echo i18n::__('direccion') ?>" name="<?php echo ProveedorBaseTableClass::getNameField(proveedorTableClass::DIRECCION, true) ?>"></th>

          </tr>
          <tr>
          <th>
            <?php echo i18n::__('city') ?>:
          </th>
          <th>
            <select name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CIUDAD, true) ?>">
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
            <th colspan="2">
          <div class="text-center">
              <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objProveedor) == TRUE) ? 'edit' : 'register'), $culture = NULL) ?>">
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