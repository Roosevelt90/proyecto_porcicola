<?php
use mvc\routing\routingClass as routing ?>

        
<?php
use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <form method="post" action="<?php echo routing::getInstance()->getUrlWeb('recuperar', 'consultar') ?>">
    <h3>Escriba su nombre de usuario</h3>
    <input type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::USER, true) ?>">
    <h3>Selecciones pregunta</h3>
    <select name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true) ?>">
        <?php foreach ($objRecuperar as $key):?>
        <option value="<?php echo $key->id ?>">
            <?php echo $key->pregunta_secreta ?>
        </option>
        <?php endforeach; ?>
    </select>
    <h3>Respuesta secreta</h3>
    <input type="text" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true) ?>">
    <input type="submit">
    </div>

