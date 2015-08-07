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
class reportRegistroPartoActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (session::getInstance()->hasAttribute('partpFiltersAnimal')) {
                $where = session::getInstance()->getAttribute('partoFiltersAnimal');
            }

            $fields = array(
                registroPartoTableClass::ID,
                registroPartoTableClass::FECHA_NACIMIENTO,
                registroPartoTableClass::HEMBRAS_NACIDAS_VIVAS,
                registroPartoTableClass::MACHOS_NACIDOS_VIVOS,
                registroPartoTableClass::NACIDOS_MUERTOS,
                registroPartoTableClass::RAZA_ID,
                registroPartoTableClass::ANIMAL_ID
            );

            $orderBy = array(
                registroPartoTableClass::ID
            );

            $this->objParto = registroPartoTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de los partos en nuestro sistema';
            $this->defineView('index', 'registroParto', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
