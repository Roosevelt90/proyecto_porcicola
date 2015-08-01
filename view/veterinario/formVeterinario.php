<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = veterinarioTableClass::ID ?>
<?php $numero_documento = veterinarioTableClass::NUMERO_DOC ?>
<?php $nombre_completo = veterinarioTableClass::NOMBRE ?>
<?php $telefono = veterinarioTableClass::TEL ?>
<?php $tipo_documento_id = tipoDocumentoTableClass::ID ?>
<?php $direccion = veterinarioTableClass::DIRECCION ?>
<?php $id_ciudad = ciudadTableClass::ID ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('personal', ((isset($objVeterinario) == TRUE) ? 'updateVeterinario' : 'createVeterinario')) ?>">
  <?php if (isset($objVeterinario)): ?>
    <input type="hidden" name="<?php echo veterinarioTableClass::getNameField(veterinarioTableClass::ID, TRUE) ?>" value="<?php echo $objVeterinario[0]->$id ?>">
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-2-offset-3">

        <table class="table table-responsive "> 
            <tr>
            <th>
              <?php echo i18n::__('document type', null, 'veterinario') ?>:

            </th>
            <th>
              <select name="<?php echo veterinarioTableClass::getNameField(veterinarioTableClass::TIPO_DOC, true) ?>">
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

              <input type="number" placeholder="<?php echo i18n::__('identificacion') ?>" value="<?php // echo $objVeterinario[0]->$numero_documento ?>"  name="<?php echo veterinarioBaseTableClass::getNameField(veterinarioTableClass::NUMERO_DOC, true) ?>"></th>   

          </tr>

          <tr>
            <th>   <?php echo i18n::__('nombre') ?>: </th>

            <th> <input required pattern="^[a-zA-Z]{3,20}$" placeholder="<?php echo i18n::__('nombre') ?>" name="<?php echo veterinarioBaseTableClass::getNameField(veterinarioTableClass::NOMBRE, true) ?>"></th>   

          </tr>
          <tr>
            <th><?php echo i18n::__('telefono') ?>:</th>
            <th> <input type="number" placeholder="<?php echo i18n::__('telefono') ?>" name="<?php echo veterinarioBaseTableClass::getNameField(veterinarioTableClass::TEL, true) ?>"></th>
          </tr>
           <tr>
            <th><?php echo i18n::__('direccion') ?>:</th>
            <th> <input  placeholder="<?php echo i18n::__('direccion') ?>" name="<?php echo veterinarioBaseTableClass::getNameField(veterinarioTableClass::DIRECCION, true) ?>"></th>

          </tr>
          <tr>
            <th>
              <?php echo i18n::__('city') ?>:
            </th>
            <th>
              <select name="<?php echo veterinarioTableClass::getNameField(veterinarioTableClass::CIUDAD, true) ?>">
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

          </tr>
          
          <tr>
            <th colspan="2">
          <div class="text-center">
              <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objVeterinario) == TRUE) ? 'edit' : 'register'), $culture = NULL) ?>">
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