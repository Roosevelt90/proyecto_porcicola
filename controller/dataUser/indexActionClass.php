<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
         
            $fields = array(
                datosUsuarioTableClass::APELLIDOS,
                datosUsuarioTableClass::CEDULA,
                datosUsuarioTableClass::CREATED_AT,
                datosUsuarioTableClass::DIRECCION,
                datosUsuarioTableClass::ID,
                datosUsuarioTableClass::NOMBRE,
                datosUsuarioTableClass::TELEFONO
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                usuarioBaseTableClass::USER
            );
            $fJoin1 = datosUsuarioTableClass::CIUDAD_ID;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = datosUsuarioTableClass::USUARIO_ID;
            $fJoin4 = usuarioBaseTableClass::ID;
            
            $where = array(
            datosUsuarioTableClass::USUARIO_ID => request::getInstance()->getRequest(usuarioTableClass::ID)
            );
            
            $this->objDatos = datosUsuarioTableClass::getAll($fields, $fields2, $fields3, $fJoin1, $fJoin2, $fJoin3, $fJoin4, true, null, null, null, null, $where);            
            $this->defineView('index', 'dataUser', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
