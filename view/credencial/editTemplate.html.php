<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<main class="mdl-layout__content mdl-color--blue-grey-200">
<div class="container">
    <div class="row">
        <div class="col-xs-4-offset-4 text-center">
            <h2><?php echo i18n::__('edit',  NULL,  'credencial') ?> :</h2>
             
            <?php // print_r($objCredencial) ?>
            <h3><?php echo $objCredencial[0]->nombre = ucwords($objCredencial[0]->nombre) ?></h3>
        </div>
    </div>
</div>
<?php view::includePartial('credencial/formCredencial', array('objCredencial' => $objCredencial))?>

