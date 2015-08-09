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
class indexClienteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = NULL;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//                validacion de datos

                if (isset($filter['telefono']) and $filter['telefono'] !== null and $filter['telefono'] !== '') {
                    $where [clienteTableClass::TEL] = $filter['telefono'];
                }
                
                if (isset($filter['nombre_completo']) and $filter['nombre_completo'] !== null and $filter['nombre_completo'] !== '') {
                    $where[clienteTableClass::NOMBRE] = $filter['nombre_completo'];
                }
                if (isset($filter['tipo_doc']) and $filter['tipo_doc'] !== null and $filter['tipo_doc'] !== '') {
                    $where[clienteTableClass::TIPO_DOC] = $filter['tipo_doc'];
                }

                session::getInstance()->setAttribute('clienteDeleteFilters', $where);
            }
            $fieldsTipoDoc = array(
                tipoDocumentoTableClass::ID,
                tipoDocumentoTableClass::DESCRIPCION
            );



            $fields = array(
                clienteTableClass::ID,
                clienteTableClass::NUMERO_DOC,
                clienteTableClass::CIUDAD,
                clienteTableClass::NOMBRE,
                clienteTableClass::TEL,
                clienteTableClass::TIPO_DOC,
                clienteTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );


            $fJoin1 = clienteTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = clienteTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;


            $orderBy = array(
                clienteTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                clienteTableClass::ID
            );

            $lines = config::getRowGrid();
            $this->cntPages = clienteTableClass::getAllCount($f, true, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }
            $this->objCliente = clienteTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objTipoDoc = tipoDocumentoTableClass::getAll($fieldsTipoDoc, false);

            $this->defineView('index', 'cliente', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
