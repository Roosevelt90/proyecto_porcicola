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
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
                recuperarTableClass::ID,
                recuperarTableClass::PREGUNTA_SECRETA
            );
            $fieldsCiudad = array(
                ciudadTableClass::ID,
                ciudadTableClass::NOMBRE
            );
            $fieldsTipoDoc = array(
                tipoDocumentoUsuarioTableClass::ID,
                tipoDocumentoUsuarioTableClass::DESCRIPCION
            );
//
            $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fieldsTipoDoc, false);
            $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad);
            $this->objRecuperar = recuperarTableClass::getAll($fields, false);
            $this->defineView('insert', 'usuario', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
