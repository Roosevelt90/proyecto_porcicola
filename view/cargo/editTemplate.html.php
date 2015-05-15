<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('edit', NULL, 'cargo') ?> :</h2>

            <br>   
            <h3><?php echo $objCargo[0]->descripcion = ucwords($objCargo[0]->descripcion) ?></h3>
        </div>
    </div>
</div>
<?php view::includePartial('cargo/formCargo', array('objCargo' => $objCargo)) ?>

