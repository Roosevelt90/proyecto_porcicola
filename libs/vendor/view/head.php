<!DOCTYPE html>
<html lang="<?php echo \mvc\config\configClass::getDefaultCulture() ?>">
    <head>
        <?php echo \mvc\view\viewClass::genTitle() ?>
        <?php echo \mvc\view\viewClass::genMetas() ?>
        <?php echo \mvc\view\viewClass::genFavicon() ?>
        <?php echo \mvc\view\viewClass::genStylesheet() ?>
        <?php echo \mvc\view\viewClass::genJavascript() ?>
    </head>
    <body>
        <?php if (\mvc\config\configClass::getScope() === 'dev'): ?>
            <div id="shfDevelopmentBar">
                SHF 1.0.0
            </div>
        <?php endif; ?>
