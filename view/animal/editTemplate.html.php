<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">

            <h2><?php echo i18n::__('edit', NULL, 'animal') ?> </h2>
        </div>
    </div>
</div>
<?php view::includePartial('animal/formAnimal', array('objAnimal' => $objAnimal, 'objGenero' => $objGenero, 'objRaza' => $objRaza, 'objLote' => $objLote)) ?>

