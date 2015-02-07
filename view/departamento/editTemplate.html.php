<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('edit', NULL, 'depto') ?> :</h2>

            <br>   
            <h3><?php echo $objDepto[0]->nombre = ucwords($objDepto[0]->nombre) ?></h3>
        </div>
    </div>
</div>
<?php view::includePartial('departamento/formDepto', array('objDepto' => $objDepto)) ?>

