<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class viewSalidaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            $where = null;

//      if (request::getInstance()->hasRequest(entradaBodegaTableClass::ID)) {
            $idSalida = request::getInstance()->getRequest(detalleSalidaBodegaTableClass::ID);

            $where = null;

            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['tipoInsumo']) and $filter['tipoInsumo'] !== null and $filter['tipoInsumo'] !== '') {
                    $where[detalleEntradaBodegaTableClass::TIPO_INSUMO] = $filter['tipoInsumo'];
                }//close if
                if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
                    $where[detalleEntradaBodegaTableClass::ID_INSUMO] = $filter['Insumo'];
                }//close if
                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
                    $where[detalleEntradaBodegaTableClass::CANDITDAD] = $filter['cantidad'];
                }//close if

                $where[detalleSalidaBodegaTableClass::ID_SALIDA] = $idSalida;

                session::getInstance()->setAttribute('detalleSalida', $where);
            } elseif (session::getInstance()->hasAttribute('detalleSalida')) {
                $where = session::getInstance()->getAttribute('detalleSalida');
            } else {
                $where = array(
                    detalleSalidaBodegaTableClass::ID_SALIDA => $idSalida
                );
            }//close if


            $fieldsSalida = array(
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::FECHA
            );
            $fieldsEmpleado = array(
                empleadoTableClass::NOMBRE
            );
            $whereSalida = array(
                salidaBodegaTableClass::getNameTable() . '.' . salidaBodegaTableClass::ID => $idSalida
            );
            $fJoinEntrada1 = salidaBodegaTableClass::EMPLEADO;
            $fJoinEntrada2 = empleadoTableClass::ID;


            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }//close if

            $f = array(
                detalleSalidaBodegaTableClass::ID
            );

            $whereCnt = array(
                detalleSalidaBodegaTableClass::ID_SALIDA => $idSalida
            );
            $lines = config::getRowGrid();

            $fieldsDetalleSalida = array(
                detalleSalidaBodegaTableClass::ID,
                detalleSalidaBodegaTableClass::CANDITDAD,
                detalleSalidaBodegaTableClass::ID_SALIDA,
            );

            $fieldsDetalleInsumo = array(
                insumoTableClass::NOMBRE
            );
            $fieldsDetalleTipoInsumo = array(
                tipoInsumoTableClass::DESCRIPCION
            );

            $fJoin1 = detalleSalidaBodegaTableClass::ID_INSUMO;
            $fJoin2 = insumoTableClass::ID;
            $fJoin3 = detalleSalidaBodegaTableClass::TIPO_INSUMO;
            $fJoin4 = tipoInsumoTableClass::ID;
            $fieldsInsumo = array(
                insumoTableClass::ID,
                insumoTableClass::NOMBRE
            );
            $fieldsTipoInsumo = array(
                tipoInsumoTableClass::ID,
                tipoInsumoTableClass::DESCRIPCION
            );

            $this->objTipoInsumo = tipoInsumoTableClass::getAll($fieldsTipoInsumo, false);
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true);
            $this->cntPages = detalleSalidaBodegaTableClass::getAllCount($f, true, $lines, $whereCnt);
            $this->objEntrada = salidaBodegaTableClass::getAllJoin($fieldsSalida, $fieldsEmpleado, null, null, $fJoinEntrada1, $fJoinEntrada2, null, null, null, null, true, null, null, config::getRowGrid(), $page, $whereSalida);
            $this->objDetalleEntrada = detalleSalidaBodegaTableClass::getAllJoin($fieldsDetalleSalida, $fieldsDetalleInsumo, $fieldsDetalleTipoInsumo, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null, false, null, 'ASC', config::getRowGrid(), $page, $where);
            log::register(i18n::__('ver3', null, 'bodega'), detalleSalidaBodegaTableClass::getNameTable());
            $this->defineView('view', 'salidaBodega', session::getInstance()->getFormatOutput());
//      } else {
//        session::getInstance()->setError('pailas');
//        routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
//      }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
