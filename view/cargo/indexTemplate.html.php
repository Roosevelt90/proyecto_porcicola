<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\routing\routingClass as routing ?>

<?php $id = cargoTableClass::ID ?>
<?php $descripcion_cargo = cargoTableClass::DESCRIPCION ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'cargo') ?>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4-offset-4 nuevo">
            <a href="<?php echo routing::getInstance()->getUrlWeb('personal', 'insertCargo') ?>" class="btn btn-success btn-xs">Nuevo</a>

        </div>
    </div>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="active">
                <th><input type="checkbox" id="chkAll"></th> 
                <th><?php echo i18n::__('identification') ?></th>
                <th><?php echo i18n::__('name') ?></th>
                <th><?php echo i18n::__('action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($objCargo as $key): ?>
                <tr>
                    <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>

                    <td><?php echo $key->$id ?></td>
                    <td><?php echo $key->$descripcion_cargo ?></td>
                    <td>

                        <a  href="<?php echo routing::getInstance()->getUrlWeb('personal', 'editCargo', array(cargoTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php i18n::__('edit')?></a>
                    </td>
                </tr>




            <?php endforeach ?>

        </tbody>
    </table>
    <!----paginado-->
     <div class="text-right">
    <nav>
        <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCargo') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php $count = 0 ?>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCargo') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCargo') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
    </nav>

