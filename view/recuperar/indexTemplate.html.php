<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<main class="mdl-layout__content mdl-color--blue-100">
    <div class="mdl-grid demo-content">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-xs-4-offset-4 text-center">
                    <h2>
                        <?php echo i18n::__('quest1', NULL, 'user') ?>
                    </h2>
                </div>
            </div>
            <form method="post" action="<?php echo routing::getInstance()->getUrlWeb('recuperar', 'consultar') ?>">
                <div class=" table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <?php echo i18n::__('escriba', NULL, 'user') ?>:</th>
                                <th><input type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>">
                                </th></tr><tr>
                                <th> <?php echo i18n::__('seleccione', NULL, 'user') ?>:</th>
                                <th>
                                    <select name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true) ?>">
                                        <option>...</option>
                                        <?php foreach ($objRecuperar as $key): ?>
                                            <option value="<?php echo $key->id ?>">
                                                <?php echo $key->pregunta_secreta ?>
                                            </option>
                                        <?php endforeach; //close foreach   ?>
                                    </select></th></tr><tr>
                                <th>
                                    <?php echo i18n::__('resp', NULL, 'user') ?>:</th><th>
                                    <input type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true) ?>">
                                </th>   
                            </tr>
                            <tr>
                                <th colspan="2">
                        <div class="text-center">
                            <input type="submit" class="btn">
                        </div>
                        </th>
                        </tr>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
</main>

