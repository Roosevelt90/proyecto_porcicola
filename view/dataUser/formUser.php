<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php $idUsuario = usuarioBaseTableClass::ID ?>
<?php $password = usuarioBaseTableClass::PASSWORD ?>
<?php $usuario = usuarioBaseTableClass::USER ?>
<?php $idPregunta = recuperarTableClass::ID ?>
<?php $pregunta = recuperarTableClass::PREGUNTA_SECRETA ?>
<?php $id = datosUsuarioTableClass::ID ?>
<?php $nombre = datosUsuarioTableClass::NOMBRE ?>
<?php $apellidos = datosUsuarioTableClass::APELLIDOS ?>
<?php $cedula = datosUsuarioTableClass::CEDULA ?>
<?php $direccion = datosUsuarioTableClass::DIRECCION ?>
<?php $telefono = datosUsuarioTableClass::TELEFONO ?>
<?php $user = usuarioTableClass::USER ?>
<?php $nom_ciudad = ciudadTableClass::NOMBRE ?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuario', ((isset($objUsuario) == TRUE) ? 'update' : 'create')) ?>">
    <?php if (isset($objUsuario)): ?>
        <input type="hidden" name="<?php echo usuarioTableClass::getNameField(usuarioBaseTableClass::ID, TRUE) ?>" value="<?php echo $objUsuario[0]->$idUsuario ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <table class="table">    
                    <tr>
                        <th>  <?php echo i18n::__('user', NULL, 'user') ?>:</th>
                        <th> <input required pattern="^[A-Za-z0-9]{1,20}$" title="No se puede usar caracteres especiales"  maxlength="20"   placeholder="<?php echo ((isset($objUsuario) == FALSE) ? i18n::__('user', NULL, 'user') : $objUsuario[0]->user_name = ucwords($objUsuario[0]->user_name)) ?>" type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>" ></th>   
                    </tr>

                    <tr>
                        <th>
                            <?php echo i18n::__(((isset($objUsuario) == FALSE) ? 'pass' : 'oldPass'), NULL, 'user') ?>:</th>
                        <th><input required maxlength="20" type="password" placeholder="<?php echo i18n::__(((isset($objUsuario) == TRUE) ? 'oldPass' : 'pass'), NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true) ?>"></th>
                    </tr>
                    <?php if (isset($objRecuperar)): ?>
                        <tr>
                            <th>
                                <?php echo i18n::__('rePass', null, 'user') ?>
                            </th>
                            <th>
                                <input  maxlength="20" type="password" placeholder="<?php echo i18n::__('rePass', NULL, 'user') ?>" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true) ?>">              
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
                                    <?php endforeach; ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <?php echo i18n::__('answer', null, 'user') ?>
                            </th>
                            <th>
                                <input required pattern="^[A-Za-z0-9]{1,20}$" maxlength="20"  title="No se puede usar caracteres especiales" type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true) ?>" placeholder="<?php echo i18n::__('answer', null, 'user') ?>">   
                            </th>
                        </tr>
                    <?php endif; ?>
                            <tr>
                        <th>  <?php echo i18n::__('name', NULL, 'datos') ?>:</th>
                        <th> <input placeholder="<?php echo ((isset($objDatos) == FALSE) ? i18n::__('name', NULL, 'datos') : $objDatos[0]->$nombre = ucwords($objDatos[0]->$nombre)) ?>" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::NOMBRE, true) ?>" ></th>   
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('lastName', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objDatos) == false) ? i18n::__('lastName', null, 'datos') : $objDatos[0]->$apellidos = ucwords($objDatos[0]->$apellidos)) ?>" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::APELLIDOS, true) ?>">
                        </th>                        
                    </tr>

                    <tr>
                        <th>
                            <?php echo i18n::__('cc', null, 'datos') ?>:
                        </th>
                        <th>
                            <?php
                            if (isset($objDatos) == false) {
                                ?>
                                <input placeholder="<?php echo i18n::__('cc', null, 'datos') ?>"  type='text'  name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CEDULA, true) ?>">

                                <?php
                            } else {
                                ?>
                                <input value="<?php echo $objDatos[0]->$cedula ?>" placeholder="<?php echo i18n::__('cc', null, 'datos') ?>"  type='text' readonly name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CEDULA, true) ?>">
                                <?php
                            }
                            ?>
                        </th>                        
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('dir', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objDatos) == false) ? i18n::__('lastName', null, 'datos') : $objDatos[0]->$direccion = ucwords($objDatos[0]->$direccion)) ?>" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::DIRECCION, true) ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('city', null, 'city') ?>:
                        </th>
                        <th>
                            <select name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::CIUDAD_ID, true) ?>">
                                <?php foreach ($objCiudad as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->$nom_ciudad ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <?php echo i18n::__('tel', null, 'datos') ?>:
                        </th>
                        <th>
                            <input placeholder="<?php echo ((isset($objDatos) == false) ? i18n::__('tel', null, 'datos') : $objDatos[0]->$telefono = ucwords($objDatos[0]->$telefono)) ?>" type="text" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::TELEFONO, true) ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="titulo">
                        <input type="submit" value="<?php echo i18n::__(((isset($objUsuario) == TRUE) ? 'edit' : 'register'), $culture = NULL, $dictionary = 'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>