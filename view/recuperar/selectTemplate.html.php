<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>

<?php $idUsuario = usuarioBaseTableClass::ID ?>
<?php $password = usuarioBaseTableClass::PASSWORD ?>
<?php $usuario = usuarioBaseTableClass::USER ?>
<?php $idPregunta = recuperarTableClass::ID ?>
<?php $pregunta = recuperarTableClass::PREGUNTA_SECRETA ?>

<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>Restaurar Contraseña</h2>

            <br>   
            <h3><?php echo $objUsuario[0]->user_name = ucwords($objUsuario[0]->user_name) ?></h3>
        </div>
    </div>
</div>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('recuperar', 'recuperar') ?>">
    <input type="hidden" name="<?php echo usuarioTableClass::getNameField(usuarioBaseTableClass::ID, TRUE) ?>" value="<?php echo $objUsuario[0]->$idUsuario ?>">
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <table class="table">    

                    <tr>
                        <th>
                            <?php echo i18n::__(((isset($objUsuario) == FALSE) ? 'pass' : 'oldPass'), NULL, 'user') ?>:</th>
                        <th><input type="password" placeholder="<?php echo i18n::__(((isset($objUsuario) == TRUE) ? 'oldPass' : 'pass'), NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>"></th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('rePass', null, 'user') ?>
                        </th>
                        <th>
                            <input type="password" placeholder="<?php echo i18n::__('rePass', NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true) ?>">              
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('quest', null, 'user') ?>
                        </th>
                        <th>
                            <select name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true) ?>">
                                <?php foreach ($objRecuperar as $key): ?>
                                    <option value="<?php echo $key->$idPregunta ?>">
                                        <?php echo $key->$pregunta ?>
                                    </option>
                                <?php endforeach;//close foreach ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('answer', null, 'user') ?>
                        </th>
                        <th>
                            <input type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true) ?>">   
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__('edit', NULL, 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>