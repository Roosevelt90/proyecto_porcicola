<?php use mvc\i18n\i18nClass as i18n ?>
<main class="mdl-layout__content mdl-color--blue-100">
  <div class="mdl-grid demo-content">
    <div class="container container-fluid">  
<div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
            <tr class="success">
                <br />
                <br/>
                <br />
                <br />
                <th class="mdl-color--teal-500 mdl-color-text--blue-grey-900"><i class="fa fa-exclamation-triangle"></i>
                   <?php echo i18n::__('acceso') ?>
                </th>
        </tr>
        <tr>
            <th class="mdl-color-text--cyan-A700">
 <?php echo i18n::__('permiso') ?>
                </th>
            </tr>
          </thead>
        </table>
  </div>
    </div>
  </div>
</main>