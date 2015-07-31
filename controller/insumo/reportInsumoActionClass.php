<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;


// * Description of ejemploClass
// *
// * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
// */
class reportInsumoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
           

            $fields = array(
            insumoTableClass::ID,
            insumoTableClass::TIPO_INSUMO,
            insumoTableClass::NOMBRE,
            insumoTableClass::FECHA_FABRICACION,
            insumoTableClass::FECHA_VENCIMIENTO,
            insumoTableClass::VALOR
            );
            
             $fields2 = array(
             tipoInsumoTableClass::DESCRIPCION
            );

            $fJoin1 = insumoTableClass::TIPO_INSUMO;
            $fJoin2 = tipoInsumoTableClass::ID;
             
            $orderBy = array(
            insumoTableClass::ID
            );

            $this->objInsumo = insumoTableClass::getAllJoin($fields, $fields2, null, null, $fJoin1, $fJoin2, null, null, null, null, true, $orderBy, 'ASC', null);
            $this->mensaje = 'Informe de los insumos en nuestro sistema';
            log::register(i18n::__('reporte'), insumoTableClass::getNameTable());
            $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
