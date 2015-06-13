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
class viewVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(vacunacionTableClass::ID)) {
                $idVacunacion = request::getInstance()->getRequest(vacunacionTableClass::ID);

                $fieldsVacuna = array(
                    vacunaTableClass::ID,
                    vacunaTableClass::NOMBRE_VACUNA
                );


                $orderBy = array(
                    detalleVacunacionTableClass::ID
                );


                $where = array(
                    detalleVacunacionTableClass::ID_REGISTRO => $idVacunacion
                );

                if (request::getInstance()->hasPost('filter')) {
                    $where = null;
                    $filter = request::getInstance()->getPost('filter');

                    if (isset($filter['fecha_inicial']) and $filter['fecha_inicial'] !== null and $filter['fecha_inicial'] !== '' and isset($filter['fecha_final']) and $filter['fecha_final'] !== null and $filter['fecha_final'] !== '') {
                        $where[detalleVacunacionTableClass::FECHA] = array(
                            date(config::getFormatTimestamp(), strtotime($filter['fecha_inicial'] . ' 00.00.00')),
                            date(config::getFormatTimestamp(), strtotime($filter['fecha_final'] . ' 23.59.59'))
                        );
                    }//close if
                    if (isset($filter['vacuna']) and $filter['vacuna'] !== null and $filter['vacuna'] !== '') {
                        $where[detalleVacunacionTableClass::VACUNA] = $filter['vacuna'];
                    }//close if
                    if (isset($filter['dosis']) and $filter['dosis'] !== null and $filter['dosis'] !== '') {
                        $where[detalleVacunacionTableClass::DOSIS] = $filter['dosis'];
                    }//close if
//                    if (isset($filter['accion']) and $filter['accion'] !== null and $filter['accion'] !== '') {
//                        $where[detalleVacunacionTableClass::ACCION] = $filter['accion'];
//                    }


                    session::getInstance()->setAttribute('facturaVentaFilter', $where);
                } elseif (session::getInstance()->hasAttribute('facturaVentaFilter')) {
                    $where = session::getInstance()->getAttribute('facturaVentaFilter');
                }//close if

                $fieldsVacunacion = array(
                    vacunacionTableClass::ID,
                    vacunacionTableClass::FECHA
                );

                $fieldsVete = array(
                    veterinarioTableClass::NOMBRE
                );

                $fieldsAni = array(
                    animalTableClass::NUMERO
                );

                $whereVacunacion = array(
                    vacunacionTableClass::getNameTable() . '.' . vacunacionTableClass::ID => $idVacunacion
                );

                $fieldsAnimal = array(
                    animalTableClass::ID,
                    animalTableClass::NUMERO
                );

                $page = 0;
                if (request::getInstance()->hasGet('page')) {
                    $page = request::getInstance()->getGet('page') - 1;
                    $page = $page * config::getRowGrid();
                }//close if

                $f = array(
                    detalleVacunacionTableClass::ID
                );

                $whereCnt = array(
                    detalleVacunacionTableClass::ID_REGISTRO => $idVacunacion
                );
                $lines = config::getRowGrid();

                $fieldsDetalleVacunacion = array(
                    detalleVacunacionTableClass::ID,
                    detalleVacunacionTableClass::ID_REGISTRO,
                    detalleVacunacionTableClass::FECHA,
                    detalleVacunacionTableClass::VACUNA,
                    detalleVacunacionTableClass::DOSIS,
                    detalleVacunacionTableClass::ACCION
                );

                $fieldsVacu = array(
                    vacunaTableClass::NOMBRE_VACUNA
                );

                $fJoin1 = detalleVacunacionTableClass::VACUNA;
                $fJoin2 = vacunaTableClass::ID;

                $fJoinVacu1 = vacunacionTableClass::VETERINARIO;
                $fJoinVacu2 = veterinarioTableClass::ID;
                $fJoinVacu3 = vacunacionTableClass::ANIMAL;
                $fJoinVacu4 = animalTableClass::ID;

                $this->objAnimal = animalTableClass::getAll($fieldsAnimal, true);
                $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
                $this->cntPages = detalleVacunacionTableClass::getAllCount($f, true, $lines, $whereCnt);
                $this->objVacunacion = vacunacionTableClass::getAllJoin($fieldsVacunacion, $fieldsVete, $fieldsAni, null, $fJoinVacu1, $fJoinVacu2, $fJoinVacu3, $fJoinVacu4, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $whereVacunacion);
                $this->objDetalleVacunacion = detalleVacunacionTableClass::getAllJoin($fieldsDetalleVacunacion, $fieldsVacu, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);
//                $this->objDetalleVacunacion = detalleVacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', 10, $page, $where);
                $this->defineView('view', 'vacunacion', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
