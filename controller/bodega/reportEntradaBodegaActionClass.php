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
class reportEntradaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {


            $fields = array(
            entradaBodegaTableClass::ID,
            entradaBodegaTableClass::FECHA,
            entradaBodegaTableClass::EMPLEADO
            );
            $fieldsEmpleado = array(
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE
            );
          
           
            $fJoin1 = entradaBodegaTableClass::EMPLEADO;
            $fJoin2 = empleadoTableClass::ID;
          
            $orderBy = array(
            entradaBodegaTableClass::ID
            );
            $this->mensaje = "Informe de Entradas de Bodega";

            $this->objEntrada = entradaBodegaTableClass::getAllJoin($fields, $fieldsEmpleado, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC');
            $this->defineView('reportEntrada', 'bodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
