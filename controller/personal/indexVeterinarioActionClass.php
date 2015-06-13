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
class indexVeterinarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
              $where = NULL;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');
//                validacion de datos

                if (isset($filter['telefono']) and $filter['telefono'] !== null and $filter['telefono'] !== '') {
                    $where [veterinarioTableClass::TEL] = $filter['telefono'];
                }
                if (isset($filter['nombre_completo']) and $filter['nombre_completo'] !== null and $filter['nombre_completo'] !== '') {
                    $where[veterinarioTableClass::NOMBRE] = $filter['nombre_completo'];
                }
                
                session::getInstance()->setAttribute('veterinarioDeleteFilters', $where);
            }       
          
            
                
            $fields = array(
                veterinarioTableClass::ID,
                veterinarioTableClass::NUMERO_DOC,
                veterinarioTableClass::CIUDAD,
                veterinarioTableClass::NOMBRE,
                veterinarioTableClass::TEL,
                veterinarioTableClass::TIPO_DOC,
                veterinarioTableClass::DIRECCION
            );
            $fields2 = array(
                ciudadTableClass::NOMBRE
           
            );
            $fields3 = array(
                tipoDocumentoTableClass::DESCRIPCION
            );

          
            $fJoin1 = veterinarioTableClass::CIUDAD;
            $fJoin2 = ciudadTableClass::ID;
            $fJoin3 = veterinarioTableClass::TIPO_DOC;
            $fJoin4 = tipoDocumentoTableClass::ID;
            
            
             $orderBy = array(
                 veterinarioTableClass::ID
                     );
             
            $page = 0;
            if (request::getInstance()->hasGet('page')) {
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            $f = array(
                veterinarioTableClass::ID
            );
            $lines = config::getRowGrid();
            $this->cntPages = veterinarioTableClass::getAllCount($f, true, $lines);
          if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
            }else{
                $this->page = $page;
            } 
            

            $this->objVeterinario = veterinarioTableClass::getAllJoin($fields, $fields2, $fields3, null, $fJoin1, $fJoin2, $fJoin3, $fJoin4, null, null,  true, $orderBy,'ASC', config::getRowGrid(), $page, $where);
            $this->defineView('index', 'veterinario', session::getInstance()->getFormatOutput());
           } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
