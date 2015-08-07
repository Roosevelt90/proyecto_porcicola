<?phpuse mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--blue-300">
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 text-center">
           
            <h2>  <?php echo i18n::__('nueva',  NULL, 'credencial') ?>
            </h2>
        </div>
    </div>
</div>

<?php view::includePartial('usuarioCredencial/formUcrede', array('objUsuario'=>$objUsuario, 'objCredencial'=>$objCredencial)) ?>

