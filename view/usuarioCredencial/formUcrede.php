<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = usuarioCredencialTableClass::ID ?>
<?php $usuario_id = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $credencial_id = usuarioCredencialTableClass::CREDENCIAL_ID?>
<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuario', ((isset($objCredencial) == TRUE) ? 'updateUsuCredencial' : 'createUsuCredencial')) ?>">
    <?php if (isset($objCredencial)): ?>
    <input type="hidden" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, TRUE) ?>" value="<?php echo $objCredencial[0]->$id ?>">
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-6-offset-3">
                <table class="table table-responsive ">    
                      <tr>
                        <th>
                            <?php echo i18n::__('credencial', null, 'userCredencial') ?>:
                        </th>
                       
                        <th>
                            <select name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true) ?>">
                                <?php foreach ($objCredencial as $key): ?>
                                    <option value="<?php echo $key->$id ?>">
                                        <?php echo $key->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                        <th>
                            <?php echo i18n::__('user', null, 'userCredencial') ?>:
                        </th>
                       
                       
                        <th>
                            <select name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true) ?>">
                                <?php foreach ($objUsuario as $key): ?>
                                    <option value="<?php echo $key->id ?>">
                                        <?php echo $key->user_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2">
                    <div class="text-center">
                        <input type="submit" class="btn" value="<?php echo i18n::__(((isset($objCredencial) == TRUE) ? 'edit' : 'register'), NULL,  'user') ?>">
                    </div>
                    </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>