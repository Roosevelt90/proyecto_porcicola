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
class reportVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasRequest('reportVeterinario')) {
                $report = request::getInstance()->getPost('reportVeterinario');
            }
             $fields = array(
                veterinarioTableClass::ID,
                veterinarioTableClass::NUMERO_DOC,
                veterinarioTableClass::CIUDAD,
                veterinarioTableClass::NOMBRE,
                veterinarioTableClass::TEL,
                veterinarioTableClass::TIPO_DOC,
                veterinarioTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
           
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );

          
            $fJoin1 = veterinarioTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = veterinarioTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;
            
            
             $orderBy = array(
                 veterinarioTableClass::ID
                     );
            

            $this->objVeterinario = veterinarioTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null,  true, $orderBy,'ASC', $where);
            $this->mensaje ='Reporte de veterinarios';
            $this->defineView('index', 'veterinario', session::getInstance()->getFormatOutput());
           } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
