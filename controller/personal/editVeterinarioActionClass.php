<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try {
            if (request::getInstance()->hasRequest(veterinarioTableClass::ID)) {
                $fields = array(
                    veterinarioTableClass::ID,
                    veterinarioTableClass::NUMERO_DOC,
                    veterinarioTableClass::NOMBRE,
                    veterinarioTableClass::TEL,
                    veterinarioTableClass::CIUDAD,
                    veterinarioTableClass::DIRECCION,
                    veterinarioTableClass::TIPO_DOC
                );

                $where = array(
                    veterinarioTableClass::ID => request::getInstance()->getRequest(veterinarioTableClass::ID)
                );
                $fieldsCiudad = array(
                    ciudadTableClass::ID,
                    ciudadTableClass::NOMBRE
                );
                $fieldsTipo_doc = array(
                    tipoDocumentoTableClass::ID,
                    tipoDocumentoTableClass::DESCRIPCION
                );

                $this->objCiudad = ciudadTableClass::getAll($fieldsCiudad, true);

                $this->objTipo_documento = tipoDocumentoTableClass::getAll($fieldsTipo_doc, false);

                $this->objVeterinario = veterinarioTableClass::getAll($fields, true, null, null, null, null, $where);
                $this->defineView('edit', 'veterinario', session::getInstance()->getFormatOutput());
            } else {

                routing::getInstance()->redirect('personal', 'indexVeterinario');
          }
         
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
  }

}
