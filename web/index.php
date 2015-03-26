<?php

//$installer = include_once __DIR__ . '/../config/install.php';
//
//if (file_exists($installer)) {
//    $GLOBALS['timeIni'] = microtime(true);
//    session_name('proyectoPorcicola');
//    session_start();
//    ob_start();
//    include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
//    mvc\autoload\autoLoadClass::getInstance()->autoLoad();
//    mvc\dispatch\dispatchClass::getInstance()->main('config', 'index');
//} else {
    $GLOBALS['timeIni'] = microtime(true);
    session_name('proyectoPorcicola');
    session_start();
    ob_start();
    include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
    mvc\autoload\autoLoadClass::getInstance()->autoLoad();
    mvc\dispatch\dispatchClass::getInstance()->main();
//}
