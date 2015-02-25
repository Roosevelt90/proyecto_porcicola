<?php

use mvc\routing\routingClass as routing ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 titulo">
            <br>
            <h2>
                Seleccione una tabla 
            </h2>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="coo-xs-10-offset-1">
            <div class="table-responsive">
                <div class="btn-group btn-group-lg btn-group-justified">
                    <a  onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>'" class="btn btn-info">Usuario</a>                      
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index') ?>'" class="btn btn-info">Datos usuario</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>'" class="btn btn-info">Credencial</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>'" class="btn btn-info ">Usuario credencial</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('departamento', index) ?>'" class=" btn btn-info">Departamento</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('ciudad', 'index') ?>'" class="btn btn-info">Ciudad</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('raza', 'index') ?>'" class="btn btn-info">Raza</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('lote', 'index') ?>'" class="btn btn-info">Lote</a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>'" class="btn btn-info">Insumo</a>

                </div>
            </div>
        </div>
    </div>
</div>
<footer>

</footer>