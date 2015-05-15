<?php 
use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;


/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteCargoActionClass extends controllerClass implements controllerActionInterface {
public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::ID, true));

                $ids = array(
                    cargoTableClass::ID => $id
                );
                cargoTableClass::delete($ids, TRUE);
                
                $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                $this->defineView('deleteCargo', 'empleado', session::getInstance()->getFormatOutput());
                
            }else{
            routing::getInstance()->redirect('empleado', 'indexCargo');
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
