<?php
// use mvc\routing\routingClass as routing;
//$install = include_once __DIR__ . '/../config/install.php';
////$install = include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
//////$exists = 
//if(!file_exists($install)){
//session_name('proyectoPorcicola');
//include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
//mvc\autoload\autoLoadClass::getInstance()->autoLoad();
//   routing::getInstance()->getUrlWeb('config', 'index');
//    exit();
//}
//echo 2;
$GLOBALS['timeIni'] = microtime(true);
session_name('proyectoPorcicola');
session_start();
ob_start();
include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
mvc\autoload\autoLoadClass::getInstance()->autoLoad();
mvc\dispatch\dispatchClass::getInstance()->main();