<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(ciudadTableClass::ID)) {
$fields = array(
                datosUsuarioTableClass::APELLIDOS,
                datosUsuarioTableClass::CEDULA,
                datosUsuarioTableClass::CREATED_AT,
                datosUsuarioTableClass::DIRECCION,
                datosUsuarioTableClass::ID,
                datosUsuarioTableClass::NOMBRE,
                datosUsuarioTableClass::TELEFONO
            );
$where = array (
datosUsuarioTableClass::ID =>  request::getInstance()->getRequest(datosUsuarioTableClass::ID)
);
$fields2 = array(
       ciudadTableClass::ID,
       ciudadTableClass::NOMBRE
       ); 
       $field = array(
       usuarioTableClass::ID,
       usuarioTableClass::USER
       );
       $this->objUsuario = usuarioTableClass::getAll(   $field);
       $this->objCiudad = ciudadTableClass::getAll3($fields2);
            $this->objDatos = datosUsuarioTableClass::getAll3($fields, false, null,null,null,null, $where);
                $this->defineView('edit', 'dataUser', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('ciudad', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
