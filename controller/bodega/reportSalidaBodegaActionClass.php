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
class reportSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $fields = array(
            salidaBodegaTableClass::ID,
            salidaBodegaTableClass::FECHA,
            salidaBodegaTableClass::EMPLEADO
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
     
           
            $fJoin1 = salidaBodegaTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
         
            $orderBy = array(
            salidaBodegaTableClass::FECHA
            );
            $this->mensaje = "Informe de Salidas de Bodega";

            $this->objSalida = salidaBodegaTableClass::getAllJoin($fields, $fieldsEmpleado, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC');
            $this->defineView('reportSalida', 'bodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
