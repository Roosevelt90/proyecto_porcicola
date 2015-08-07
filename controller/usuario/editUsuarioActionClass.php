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
class editUsuarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $fields = array(
            usuarioTableClass::ID,
            usuarioTableClass::USER,
            usuarioTableClass::PASSWORD,
            usuarioTableClass::RESPUESTA_SECRETA
            );
            
            $where = array(
                    usuarioTableClass::ID => request::getInstance()->getRequest(usuarioTableClass::ID)
                );
            
            $fieldsRecuperar = array(
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
            $this->objUsuario = usuarioTableClass::getAll($fields, false, null, null, null, null, $where);
            $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fieldsTipoDoc, false);
            $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad);
            $this->objRecuperar = recuperarTableClass::getAll($fieldsRecuperar, false);
            $this->defineView('edit', 'usuario', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}