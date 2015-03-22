  <?php use mvc\session\sessionClass as session ?>
  <?php if(\mvc\config\configClass::getScope() === 'dev'): ?>
  <div id="mvcMain" class="shfDevelopmentBar">
    <i class="fa fa-leaf mvcPointer"></i> SHF 1.0.4 |
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
    <i class="fa fa-leaf mvcPointer"></i>
  </div>
  <?php endif ?>

<?php use mvc\routing\routingClass as routing ?>
<div class="logout text-right right">
    <a class="btn" href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>">
Salir
    </a>
</div>
<div class="copyright">
copyright <?php echo date('Y') ?> &copysr; 
</div>
</body>
</html>
