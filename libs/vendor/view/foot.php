  <?php use mvc\session\sessionClass as session ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\i18n\i18nClass as i18n ?>
  <?php if(\mvc\config\configClass::getScope() === 'dev'): ?>
  <div id="mvcMain" class="shfDevelopmentBar">
    <i class="fa fa-leaf mvcPointer"></i> SHF <?php echo config::getSohoFrameworkVersion() ?> |
    <i class="fa fa-dashboard"></i> <?php echo number_format((memory_get_usage() / 1048576), '3', '.', '\'') ?> MB |
    <i class="fa fa-clock-o"></i> <?php echo number_format((microtime(true) - $GLOBALS['timeIni']), '4', '.', '\'') ?> seg.
    <?php if (session::getInstance()->hasAttribute('mvcDbQuery')): ?>
    | <i class="fa fa-database"></i> <?php echo session::getInstance()->getAttribute('mvcDbQuery') ?>
    <?php session::getInstance()->deleteAttribute('mvcDbQuery') ?>
    <?php endif ?>
  </div>
  <?php endif ?>
  <?php if(\mvc\config\configClass::getScope() === 'dev'): ?>
  <div id="mvcIcon" class="shfDevelopmentBar">
    <i class="fa fa-leaf mvcPointer"></i> SHF <?php echo config::getSohoFrameworkVersion() ?>
  </div>
  <?php endif ?>

<?php use mvc\routing\routingClass as routing ?>
<?php if(session::getInstance()->hasUserId()): ?>
<div class="logout text-right right">
    <a class="btn" href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>">
<?php echo i18n::__('Exit')?>
    </a>
</div>
<?php endif; ?>
<div class="copyright">
copyright <?php echo date('Y') ?> &copysr; 
</div>
<?php echo session::getInstance()->getFlash('mvcSQL') ?>
</body>
</html>
