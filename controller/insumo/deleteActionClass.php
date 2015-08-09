<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;
use mvc\validatorFields\validatorFieldsClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));

                $ids = array(
                    insumoTableClass::ID => $id
                );
                  $this->arrayAjax = array(
                    'code' => 11,
                    'msg' => 'La eliminacion ha sido exitosa'
                );
                insumoTableClass::delete($ids, true);
               $this->defineView('delete', 'insumo', session::getInstance()->getFormatOutput());
           log::register(i18n::__('delete'), insumoTableClass::getNameTable());
                session::getInstance()->setSuccess(i18n::__('succesDelete', null, 'insumo'));
               }//close if
            else {
                log::register(i18n::__('delete'), insumoTableClass::getNameTable(), i18n::__('errorDeleteBitacora'));
                session::getInstance()->setError(i18n::__('errorDelete'));
                routing::getInstance()->redirect('insumo', 'index');
            }
            
          
        } catch (PDOException $exc) {
          session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
