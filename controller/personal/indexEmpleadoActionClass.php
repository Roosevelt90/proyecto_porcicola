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
class indexEmpleadoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
            $where = NULL;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//                validacion de datos

                if (isset($filter['telefono']) and $filter['telefono'] !== null and $filter['telefono'] !== '') {
                    $where [empleadoTableClass::TEL] = $filter['telefono'];
                }//close if
                if (isset($filter['nombre_completo']) and $filter['nombre_completo'] !== null and $filter['nombre_completo'] !== '') {
                    $where[empleadoTableClass::NOMBRE] = $filter['nombre_completo'];
                }//close if

                session::getInstance()->setAttribute('empleadoDeleteFilters', $where);
            }//close if       

            $fields = array(
                empleadoTableClass::ID,
                empleadoTableClass::NUMERO_DOC,
                empleadoTableClass::CIUDAD,
                empleadoTableClass::NOMBRE,
                empleadoTableClass::TEL,
                empleadoTableClass::CARGO,
                empleadoTableClass::TIPO_DOC,
                empleadoTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                cargoTableClass::DESCRIPCION
            );
            $fields4 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );

            $fJoin1 = empleadoTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = empleadoTableClass::CARGO;
            $fJoin4 = cargoTableClass::ID;
            $fJoin5 = empleadoTableClass::TIPO_DOC;
            $fJoin6 = tipoDocumentoTableClass::ID;
            
             $orderBy = array(
                 empleadoTableClass::ID
                     );
             
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if
            $f = array(
                empleadoTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = empleadoTableClass::getAllCount($f, true, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            }else{
                $this->page = $page;
            }//close if

            $this->objEmpleado = empleadoTableClass::getAllJoin($fields, $fields2, $fields3, $fields4, $fJoin1, $fJoin2, $fJoin3, $fJoin4, $fJoin5, $fJoin6, true, $orderBy,'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
           } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
