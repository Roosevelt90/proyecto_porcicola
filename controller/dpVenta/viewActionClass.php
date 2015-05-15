<?php


use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

class viewActionClass extends controllerClass implements controllerActionInterface{
    
    public function execute() {
        try{
            if(request::getInstance()->hasRequest(pVentaTableClass::ID)){
                $idFactura=request::getInstance()->getRequest(pVentaTableClass::ID);
                $fields=array(
                dpVentaTableClass::NUMERO_DOCUMENTO,
                dpVentaTableClass::PESO_ANIMAL,
                dpVentaTableClass::PRECIO_ANIMAL,
                dpVentaTableClass::ANIMAL_ID
                 );
                $orderBy = array(
                dpVentaTableClass::ID
                );
                $where = array(
                dpVentaTableClass::NUMERO_DOCUMENTO=>$idFactura
                );

                $page = 0;
                if (request::getInstance()->hasGet('page')) {
                    $page = request::getInstance()->getGet('page') - 1;
                    $page = $page * config::getRowGrid();
                }

                $f = array(
                    detalleVacunacionTableClass::ID
                );
                
                $whereCnt = array(
                detalleVacunacionTableClass::ID => $id
                );
                $lines = config::getRowGrid();

                $this->cntPages = detalleVacunacionTableClass::getAllCount($f, true, $lines, $whereCnt);
                $this->objVacunacion = vacunacionTableClass::getAll($fieldsVacunacion, true, null, null, null, null, $whereVacunacion);
                $this->objDetalleVacunacion = detalleVacunacionTableClass::getAll($fields, true, $orderBy, 'ASC', 10, $page, $where);
                $this->defineView('view', 'vacunacion', session::getInstance()->getFormatOutput());
            } else {
                session::getInstance()->setError('pailas');
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}