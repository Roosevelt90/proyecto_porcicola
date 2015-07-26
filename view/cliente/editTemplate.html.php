<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-4-offset-4 titulo">
          <h2><?php echo i18n::__('edit', NULL, 'cliente') ?> :</h2>

          <br>  
        </div>
      </div>
    </div>
    <?php view::includeHandlerMessage() ?>
    <?php view::includePartial('cliente/formCliente', array('objCliente' => $objCliente, 'objCiudad' => $objCiudad, 'objTipo_doc' => $objTipo_documento)) ?>
