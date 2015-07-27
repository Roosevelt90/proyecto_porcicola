<?phpuse mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<br>
<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="container">
      <div class="row">
        <div class="col-xs-4-offset-4 titulo">
          <br>
          <h2>  <?php echo i18n::__('new', null, 'veterinario') ?>
          </h2>

        </div>
      </div>
    </div>
    <br>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('veterinario/formVeterinario', array('objCiudad' => $objCiudad, 'objTipo_doc' => $objTipo_doc)) ?>

