<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--blue-grey-200">
  <div class="mdl-grid demo-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-4-offset-4 text-center">
          <h2><?php echo i18n::__('editUser', $culture = NULL, $dictionary = 'user') ?>: </h2>
          <h2> <?php echo $objUsuario[0]->user_name = ucwords($objUsuario[0]->user_name) ?></h2>

        </div>
      </div>
    </div>
    <?php // view::includeHandlerMessage() ?>
    <?php view::includePartial('usuario/formUser', array('objUsuario' => $objUsuario, 'objCiudad' => $objCiudad, 'objTipoDoc' => $objTipoDoc, 'objRecuperar' => $objRecuperar)) ?>

