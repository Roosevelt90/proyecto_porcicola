<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('edit',  NULL,  'datos') ?> :</h2>

            <br>   
            <h3><?php echo $objDatos[0]->nombre = ucwords($objDatos[0]->nombre) ?></h3>
        </div>
        <?php        print_r($objUsuario) ?>
    </div>
</div>
<?php view::includePartial('dataUser/formDatos', array('objDatos' => $objDatos, 'objCiudad'=>$objCiudad, 'objUsuario'=> $objUsuario, 'objTipoDoc' => $objTipoDoc)) ?>

