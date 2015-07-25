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
class indexProveedorActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = NULL;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//                validacion de datos

                if (isset($filter['telefono']) and $filter['telefono'] !== null and $filter['telefono'] !== '') {
                    $where [proveedorTableClass::TEL] = $filter['telefono'];
                }
                if (isset($filter['nombre_completo']) and $filter['nombre_completo'] !== null and $filter['nombre_completo'] !== '') {
                    $where[proveedorTableClass::NOMBRE] = $filter['nombre_completo'];
                }
                if (isset($filter['tipo_doc']) and $filter['tipo_doc'] !== null and $filter['tipo_doc'] !== '') {
                    $where[proveedorTableClass::TIPO_DOC] = $filter['tipo_doc'];
                }

                session::getInstance()->setAttribute('ProveedorDeleteFilters', $where);
            }
            $fieldsTipoDoc = array(
                tipoDocumentoTableClass::ID,
                tipoDocumentoTableClass::DESCRIPCION
            );

            $fields = array(
                proveedorTableClass::ID,
                proveedorTableClass::NUMERO_DOC,
                proveedorTableClass::CIUDAD,
                proveedorTableClass::NOMBRE,
                proveedorTableClass::TEL,
                proveedorTableClass::TIPO_DOC,
                proveedorTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );


            $fJoin1 = proveedorTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = proveedorTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;


            $orderBy = array(
                proveedorTableClass::ID
            );

            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                proveedorTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = proveedorTableClass::getAllCount($f, true, $lines);
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            } else {
                $this->page = $page;
            }

            $this->objProveedor = proveedorTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
            $this->objTipoDoc = tipoDocumentoTableClass::getAll($fieldsTipoDoc, false);
            $this->defineView('index', 'proveedor', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
