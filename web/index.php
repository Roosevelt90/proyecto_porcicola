<?php
session_name('proyectoPorcicola');
session_start();
//ob_start();
include_once __DIR__ . '/../libs/vendor/autoLoadClass.php';
mvc\autoload\autoLoadClass::getInstance()->autoLoad();
mvc\dispatch\dispatchClass::getInstance()->main();