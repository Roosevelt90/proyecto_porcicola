<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\request\requestClass as request;
use mvc\config\configClass as config;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class TraductorShfSecurityActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') === true) {

                $language = request::getInstance()->getPost('language');
                $PATH_INFO = request::getInstance()->getPost('PATH_INFO');               
                session::getInstance()->setDefaultCulture($language);
                $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
                header('Location: '.$dir); 
            } else {
                routing::getInstance()->redirect('shfSecurity', 'login');
            }//close if
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
