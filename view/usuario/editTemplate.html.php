<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('editUser', $culture = NULL, $dictionary = 'user') ?>: <?php echo $objUsuario[0]->user_name = ucwords($objUsuario[0]->user_name) ?></h2>

        </div>
    </div>
</div>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('usuario/formUser', array('objUsuario' => $objUsuario, 'objCiudad' => $objCiudad, 'objTipoDoc' => $objTipoDoc)) ?>

