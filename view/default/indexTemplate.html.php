<?php
use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">  
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
                    <a  onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('user') ?></a>                      
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('dataUser') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('credencial') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>'" class="btn btn-ttc "><?php echo i18n::__('userCredencial') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('departamento', index) ?>'" class=" btn btn-ttc"><?php echo i18n::__('depto') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('ciudad', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('city') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('raza', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('raza') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('lote', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('lote') ?></a>
                    <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>'" class="btn btn-ttc"><?php echo i18n::__('insumo') ?></a>

                </div>
            </div>
        </div>
    </div>
</div>
<footer>

</footer>