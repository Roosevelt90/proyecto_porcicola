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
class viewActionClass extends controllerClass implements controllerActionInterface {
    public function execute() {
        try {
            if (request::getInstance()->hasRequest(usuarioTableClass::ID)) {
                $idUsuario = request::getInstance()->getRequest(usuarioTableClass::ID);
                $fieldsUsuario = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $orderBy = array(
                    datosUsuarioTableClass::ID
                );
                $where = array(
                    datosUsuarioTableClass::USUARIO_ID => $idUsuario
                );
                if (request::getInstance()->hasPost('filter')) {
                    $where = null;
                    $filter = request::getInstance()->getPost('filter');
                    if (isset($filter['fecha']) and $filter['fecha'] !== null and $filter['fecha'] !== '') {
                        $where[detalleVacunacionTableClass::FECHA] = $filter['fecha'];
                    }
                    if (isset($filter['vacuna']) and $filter['vacuna'] !== null and $filter['vacuna'] !== '') {
                        $where[detalleVacunacionTableClass::VACUNA] = $filter['vacuna'];
                    }
                    if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
                        $where[detalleVacunacionTableClass::DOSIS] = $filter['dosis'];
                    }
//                    if (isset($filter['accion']) and $filter['accion'] !== null and $filter['accion'] !== '') {
//                        $where[detalleVacunacionTableClass::ACCION] = $filter['accion'];
//                    }
                    $where[datosUsuarioTableClass::USUARIO_ID] = $idUsuario;
                    session::getInstance()->setAttribute('detalleVacunacionFiltersAnimal', $where);
                } elseif (session::getInstance()->hasAttribute('detalleVacunacionFiltersAnimal')) {
                    $where = session::getInstance()->getAttribute('detalleVacunacionFiltersAnimal');
                }
                $fieldsUsuario = array(
                    usuarioTableClass::ID,
                    usuarioTableClass::USER,
                );
                $whereUsuario = array(
                    usuarioTableClass::ID => $idUsuario
                );
                $fieldsdatos = array(
                    datosUsuarioTableClass::ID,
                    datosUsuarioTableClass::NOMNRE,
                    datosUsuarioTableClass::APELLIDOS,
                    datosUsuarioTableClass::DIRECCION,
                    datosUsuarioTableClass::TELEFONO,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO
                );
                $page = 0;
                if (request::getInstance()->hasGet('page')) {
                    $page = request::getInstance()->getGet('page') - 1;
                    $page = $page * config::getRowGrid();
                }
                $f = array(
                    datosUsuarioTableClass::ID
                );
                $whereCnt = array(
                    datosUsuarioTableClass::USUARIO_ID => $idUsuario
                );
                $lines = config::getRowGrid();
                $fieldsDatos = array(
                    datosUsuarioTableClass::ID,
                    datosUsuarioTableClass::NOMNRE,
                    datosUsuarioTableClass::APELLIDOS,
                    datosUsuarioTableClass::DIRECCION,
                    datosUsuarioTableClass::TELEFONO,
                    datosUsuarioTableClass::NUMERO_DOCUMENTO
                );
                $fieldsUsuario = array(
                    usuarioTableClass::USER
                );
                $fJoin1 = datosUsuarioTableClass::USUARIO_ID;
                $fJoin2 = usuarioTableClass::ID;
                $this->cntPages = datosUsuarioTableClass::getAllCount($f, true, $lines, $whereCnt);
                $this->objUsuario = usuarioTableClass::getAll($fieldsUsuario, true, null, null, null, null, $whereUsuario);
                $this->objDatos = datosUsuarioTableClass::getAllJoin($fieldsDatos, $fieldsUsuario, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
//                $this->objDetalleVacunacion = detalleVacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', 10, $page, $where);
                $this->defineView('view', 'usuario', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('usuario', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
}