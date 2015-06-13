<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2><?php echo i18n::__('edit',  NULL,  'empleado') ?> :</h2>

            <br>   
 
        </div>
    </div>
</div>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('empleado/formEmpleado', array('objEmpleado'=>$objEmpleado,'objId'=>$id, 'objNumero_documento'=> $objNumero_documento, 'objCiudad'=>$objCiudad, 'objCargo'=>$objCargo, 'objTipo_doc'=>$objTipo_doc))?>
