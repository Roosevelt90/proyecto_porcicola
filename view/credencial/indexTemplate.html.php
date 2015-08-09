<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<?php $countDetale = 1 ?>

<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('read', NULL, 'credencial') ?>
                    </h2>
                </div>
            </div>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteSelectCredencial') ?>" method="POST">
                <div class="row">
                    <div class="col-xs-4-offset-4 text-center">
                        <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'insertCredencial') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                        <div class="mdl-tooltip mdl-tooltip--large" for="new">
                            <?php echo i18n::__('registrar', null, 'ayuda') ?>
                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="success">
                              
                                <th><?php echo i18n::__('number', null, 'lote') ?></th>
                                <th><?php echo i18n::__('name') ?></th>
                                <th><?php echo i18n::__('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($objCredencial as $key): ?>
                                <tr>
                                  
                                    <td><?php echo $key->$id ?></td>
                                    <td><?php echo $key->$nombre ?></td>
                                    <td>
                                        <!--<a href="#" class="btn btn-warning btn-sm disabled">Ver</a>-->
                                        <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'editCredencial', array(credencialBaseTableClass::ID => $key->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                                        <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                            <?php echo i18n::__('modificar', null, 'ayuda') ?>
                                        </div> 

                                    </td>
                                </tr>
                                <?php $countDetale++ ?>
                            <?php endforeach//close foreach   ?>
                        </tbody>
                    </table>
                </div>
            </form>
            <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteCredencial') ?>" method="POST">
                <input type="hidden" id="idDelete" name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>">
            </form>
            <!--    paginado-->
            <div class="text-right">
                <nav>
                    <ul class="pagination" id="slqPaginador">
                        <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexCredencial') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                        <?php $count = 0 ?>
                        <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                            <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexCredencial') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                            <?php $count ++ ?>        
                        <?php endfor ?>
                        <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexCredencial') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>

