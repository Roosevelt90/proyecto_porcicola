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
class editDetalleVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(detalleVacunacionTableClass::ID)) {
                $fields = array(
                    detalleVacunacionTableClass::ID,
                    detalleVacunacionTableClass::ID_REGISTRO,
                    detalleVacunacionTableClass::VACUNA,
                    detalleVacunacionTableClass::FECHA,
                    detalleVacunacionTableClass::DOSIS
                );
                $where = array(
                    detalleVacunacionTableClass::ID => request::getInstance()->getRequest(detalleVacunacionTableClass::ID)
                );

            
                $fieldsVacuna = array(
                vacunaTableClass::ID,
                vacunaTableClass::NOMBRE_VACUNA
                );
                $fieldsVacunacion = array(
                    vacunacionTableClass::ID
                );

            
                $this->objVacuna = vacunaTableClass::getAll($fieldsVacuna, true);
                $this->objVacunacion = vacunacionTableClass::getAll($fieldsVacuna, true);
                $this->objDetalleVacunacion = detalleVacunacionTableClass::getAll($fields, true, null, null, null, null, $where);
              
                $this->defineView('edit', 'detalleVacunacion', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('vacunacion', 'indexDetalleVacunacion');
            }//close if
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
