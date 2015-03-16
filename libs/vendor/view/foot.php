<!-- div con información de memoria consumida por el sript y tiempo que ha tomado la ejecución -->
<!--<div id="narumInfo">
  Memoria usada: <?php //echo number_format((memory_get_usage() / 1048576), '3', '.', '\'') ?> megaBytes -
  Tiempo usado: <?php //echo number_format((microtime(true) - $GLOBALS['timeIni']), '4', '.', '\'') ?> segundos
</div>-->

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
