<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
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
class reportDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            $idVacunacion = request::getInstance()->getRequest(vacunacionTableClass::ID);
            if (request::getInstance()->hasRequest('report')) {
                $report = request::getInstance()->getPost('report');

                if (isset($report['fecha']) and $report['fecha'] !== null and $report['fecha'] !== '') {
                    $where[detalleVacunacionTableClass::FECHA] = $report['fecha'];
                }//close if

                if (isset($report['vacuna']) and $report['vacuna'] !== null and $report['vacuna'] !== '') {
                    $where[detalleVacunacionTableClass::VACUNA] = $report['vacuna'];
                }//close if


                if (isset($report['dosis']) and $report['dosis'] !== null and $report['dosis'] !== '') {
                    $where[detalleVacunacionTableClass::DOSIS] = $report['dosis'];
                }//close if

                if (isset($report['accion']) and $report['accion'] !== null and $report['accion'] !== '') {
                    $where[detalleVacunacionTableClass::ACCION] = $report['accion'];
                }//close if
            }//close if

            $where[detalleVacunacionTableClass::ID_REGISTRO] = $idVacunacion;

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
            
            $fJoinVacunacion1 = vacunacionTableClass::VETERINARIO;
            $fJoinVacunacion2 = veterinarioTableClass::ID;
            $fJoinVacunacion3 = vacunacionTableClass::ANIMAL;
            $fJoinVacunacion4 = animalTableClass::ID;
            
            $whereVacunacion = array(
                vacunacionTableClass::getNameTable() . "." . vacunacionTableClass::ID => $idVacunacion
            );

            $this->objDetalleVacunacion = detalleVacunacionTableClass::getAllJoin($fieldsDetalleVacunacion, $fieldsVacu, null, null, $fJoin1, $fJoin2, null, null, null, null, true, null, null, null, null, $where);
            $this->objVacunacion = vacunacionTableClass::getAllJoin($fieldsVacunacion, $fieldsVete, $fieldsAni, null, $fJoinVacunacion1, $fJoinVacunacion2, $fJoinVacunacion3, $fJoinVacunacion4, null, null, true, null, null, null, null, $whereVacunacion);
            $this->mensajeDetalle = "Informe de Detalles del Control de Vacunacion";
            log::register(i18n::__('reporte'), detalleVacunacionTableClass::getNameTable());
            $this->defineView('reportDetalle', 'vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
