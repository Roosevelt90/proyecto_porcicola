<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasRequest(dpVentaTableClass::ID)) {
                $fields = array(
                dpVentaTableClass::ID,
                dpVentaTableClass::FECHA,
                dpVentaTableClass::USUARIO_ID,
                dpVentaTableClass::ANIMAL_ID,
                dpVentaTableClass::PESO_ANIMAL,
                dpVentaTableClass::PRECIO_ANIMAL
                        
                );
                $where = array(
                dpVentaTableClass::ID => request::getInstance()->getRequest(dpVentaTableClass::ID)
                );
                $fields3 = array(
                    usuarioBaseTableClass::ID,
                    usuarioBaseTableClass::USER
                );
                $fields2 = array(
                animalBaseTableClass::ID 
                );
                $fields4 = array(
                pVentaTableClass::ID
                );
                $this->objPventa = dpVentaTableClass::getAll4($fields4, false);
                $this->objUsuario = dpVentaTableClass::getAll3($fields3, true);
                $this->objAnimal = dpVentaTableClass::getAll2($fields2, false);
                $this->objdpVenta = dpVentaTableClass::getAll($fields, false, null, null, null, null, $where);
                $this->defineView('edit', 'dpVenta', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('dpVenta', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
