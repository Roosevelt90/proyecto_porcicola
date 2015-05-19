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
                datosUsuarioTableClass::TIPO_DOC,
                datosUsuarioTableClass::NUMERO_DOCUMENTO,
                datosUsuarioTableClass::CREATED_AT,
                datosUsuarioTableClass::DIRECCION,
                datosUsuarioTableClass::ID,
                datosUsuarioTableClass::NOMBRE,
                datosUsuarioTableClass::TELEFONO,
                datosUsuarioTableClass::USUARIO_ID
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                usuarioBaseTableClass::USER
            );
            $fields4 = array(
            tipoDocumentoUsuarioTableClass::DESCRIPCION
            );
            $fJoin1 = datosUsuarioTableClass::CIUDAD_ID;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = datosUsuarioTableClass::USUARIO_ID;
            $fJoin4 = usuarioBaseTableClass::ID;
            $fJoin5 = datosUsuarioTableClass::TIPO_DOC;
            $fJoin6 = tipoDocumentoUsuarioTableClass::ID;
            $where = array(
            datosUsuarioTableClass::USUARIO_ID => request::getInstance()->getRequest(usuarioTableClass::ID)
            );
            
            
            $lines = config::getRowGrid(3);
            $this->cntPages = datosUsuarioTableClass::getAllCount($fields, true, $lines);
            $this->objDatos = datosUsuarioTableClass::getAllJoin($fields, $fields2, $fields3, $fields4,$fJoin1, $fJoin2, $fJoin3, $fJoin4,$fJoin5, $fJoin6, true, null,null,null,null, $where);
            $this->objTipoDoc = tipoDocumentoUsuarioTableClass::getAll($fields4, false);
            $this->objUsuario = usuarioTableClass::getAll($fields3, true, null, null, null, null);
            $this->objCiudad = ciudadTableClass::getAll($fields2);
            
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
