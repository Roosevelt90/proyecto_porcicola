<?php
 $db = fopen("/var/www/html/ProyectoPorcicola/config/config.txt", "w+");
$cont = 0;
$index = "ola mundo";
fwrite($file, "config::setDefaultActionSecurity('" . $index ."'); " . PHP_EOL);
fwrite($file, "Otra más" . PHP_EOL);

fclose($db);

// $linea = '';
// fputs($db, "ola");
//while (!feof($db)) {
//    $linea = fgets($db);
//echo $linea . "<br />";
////    $cont++;
////    if($cont == 1){
////       fputs($db, "ola");
////    }
//}
////echo $linea; 
//            fclose($db);
            
//            config::setDbHost('127.0.0.1');


//use mvc\interfaces\controllerActionInterface;
//use mvc\controller\controllerClass;
//use mvc\config\configClass as config;
//use mvc\request\requestClass as request;
//use mvc\routing\routingClass as routing;
//use mvc\session\sessionClass as session;
//use mvc\i18n\i18nClass as i18n;
//use mvc\validatorFields\validatorFieldsClass as validator;
//use hook\log\logHookClass as log;
//use mvc\model\modelClass as model;
//
///**
// * Description of ejemploClass
// *
// * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
// */
//class createActionClass extends controllerClass implements controllerActionInterface {
//
//    public function execute() {
//        try {
////            $db = fopen("/var/www/html/ProyectoPorcicola/config/config.php", "r");
////            
////            $linea = fgets($db);
////            fclose($db);
////            echo $linea;
//            echo 1;
////            $file = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
////            
////            $db = fopen($file, "r");
////            $sql = "";
////            while (feof($db)) {
////                $sql .= fgets($db);
////            }
////            fclose($db);
////            
////            model::getInstance()->query($sql)->execute();
//            $this->defineView('usuario', 'index', session::getInstance()->getFormatOutput());
//        } catch (PDOException $exc) {
//            echo $exc->getMessage();
//            echo '<br>';
//            echo '<pre>';
//            print_r($exc->getTrace());
//            echo '</pre>';
//        }
//    }
//
//}
