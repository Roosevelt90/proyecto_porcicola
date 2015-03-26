<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('edit', NULL, 'raza') ?> :</h2>

            <br>   
            <h3><?php echo $objRaza[0]->nombre_raza = ucwords($objRaza[0]->nombre_raza) ?></h3>
        </div>
    </div>
</div>
<?php view::includePartial('raza/formRaza', array('objRaza' => $objRaza)) ?>

