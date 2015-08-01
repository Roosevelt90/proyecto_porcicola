<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--blue-grey-200">
    <div class="mdl-grid demo-content">
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 text-center">
            <h2><?php echo i18n::__('edit', NULL, 'vacuna') ?> :</h2>

            
            <h3><?php echo $objVacuna[0]->descripcionnombre_vacuna = ucwords($objVacuna[0]->nombre_vacuna) ?></h3>
        </div>
    </div>
</div>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('vacuna/formVacuna', array('objVacuna' => $objVacuna)) ?>

