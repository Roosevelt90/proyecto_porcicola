<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {   
            
            $fields =array(
                dpVentaBaseTableClass:: ID,
                dpVentaBaseTableClass::ANIMAL_ID
            );
            $fields2= array(
            animalBaseTableClass::ID
            );
            $fields3 = array(
                usuarioBaseTableClass::ID,
                usuarioBaseTableClass::USER
            );
            $fields4 = array(
                pVentaBaseTableClass::ID
            );
            $this->objdpVenta = dpVentaTableClass::getAll($fields, false);
            $this->objAnimal = dpVentaTableClass::getAll2($fields2);
            $this->objUsuario = dpVentaTableClass::getAll3($fields3, false);
            $this->objPventa = dpVentaTableClass:: getAll4($fields4, false);
            $this->defineView('insert', 'dpVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
