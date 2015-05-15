<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            if (request::getInstance()->isMethod('POST')) {
              $fecha = request::getInstance()->getPost(pVentaTableClass::getNameField(pVentaTableClass::FECHA, false));
                $usuario_id = request::getInstance()->getPost(pVentaTableClass::getNameField(pVentaTableClass::USUARIO_ID, true));
              
                
                
//                $fields = array(
//                    pVentaTableClass::FECHA,
//                    pVentaTableClass::USUARIO_ID
//                );
             

                $data = array(
                   
                    pVentaTableClass::FECHA=>$$fecha,
                    pVentaTableClass::USUARIO_ID=>$usuario_id
                );
 
                pVentaTableClass::insert($data);
            }
            routing::getInstance()->redirect('pVenta', 'index');
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
