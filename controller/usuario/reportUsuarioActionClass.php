<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validatorFields\validatorFieldsClass as validate;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class reportUsuarioActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
//            if (session::getInstance()->hasAttribute('animalFiltersAnimal')) {
//                $where = session::getInstance()->getAttribute('animalFiltersAnimal');
//            }

            if (request::getInstance()->hasPost('report')) {
                $report = request::getInstance()->getPost('report');
//
//                if (isset($report['edad_inicial']) and $report['edad_inicial'] !== null and $report['edad_inicial'] !== '' and isset($report['edad_fin']) and $report['edad_fin'] !== null and $report['edad_fin'] !== '') {
//                    $edad_inicial = validate::getInstance()->validateCharactersNumber($report['edad_inicial']);
//                    $edad_fin = validate::getInstance()->validateCharactersNumber($report['edad_fin']);
//                    /*echo ($edad_inicial) ? 'verdadero' : 'falso';
//                    exit();*/
//                    if ($edad_inicial == true or $edad_fin == true) {
//                        throw new PDOException(i18n::__(10007, null, 'errors'));
//                    }
//                    $where[animalTableClass::EDAD] = array(
//                        $report['edad_inicial'],
//                        $report['edad_fin']
//                    );
//                }
//
//                if (isset($report['peso_inicial']) and $report['peso_inicial'] !== null and $report['peso_inicial'] !== '' and isset($report['peso_fin']) and $report['peso_fin'] !== null and $report['peso_fin'] !== '') {
//                    $peso_inicial = validate::getInstance()->validateCharactersSpecial($report['peso_inicial']);
//                    $peso_fin = validate::getInstance()->validateCharactersSpacial($report['peso_fin']);
//                    if ($edad_inicial == true or $edad_fin == true) {
//                        throw new PDOException(i18n::__(10007, null, 'errors'));
//                    }
//                    $where[animalTableClass::PESO] = array(
//                        $report['peso_inicial'],
//                        $report['peso_fin']
//                    );
//                }

//                if (isset($report['fecha_inicial']) and $report['fecha_inicial'] !== null and $report['fecha_inicial'] !== '' and isset($report['fecha_fin']) and $report['fecha_fin'] !== null and $report['fecha_fin'] !== '') {
//                    $fecha_inicial = validate::getInstance()->validateDate($filter['fecha_inicial']);
//                    $fecha_fin = validate::getInstance()->validateDate($filter['fecha_fin']);
//                    if ($fecha_inicial == false or $fecha_fin == false) {
//                        throw new PDOException(i18n::__(10008, null, 'errors'));
//                    }
//                    $where[animalTableClass::FECHA_INGRESO] = array(
//                        date(config::getFormatTimestamp(), strtotime($report['fecha_inicial'])),
//                        date(config::getFormatTimestamp(), strtotime($report['fecha_fin']))
//                    );
//                }
                
                if (isset($report['tipo_doc']) and $report['tipo_doc'] !== null and $report['tipo_doc'] !== '' and $report['tipo_doc'] !== "default") {
                    $tipo_doc = validate::getInstance()->validateCharactersNumber($report['tipo_doc']);
                    if ($tipo_doc == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::NOMBRE] = $report['tipo_doc'];
                }
                
                
                
                if (isset($report['usuario']) and $report['usuario'] !== null and $report['usuario'] !== '' and $report['usuario'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersSpecial($report['usuario']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::TIPO_DOC] = $report['usuario'];
                }
            
                if (isset($report['usuario']) and $report['usuario'] !== null and $report['usuario'] !== '' and $report['usuario'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersSpecial($report['usuario']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::NUMERO_DOCUMENTO] = $report['usuario'];
                }
                 if (isset($report['usuario']) and $report['usuario'] !== null and $report['usuario'] !== '' and $report['usuario'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersSpecial($report['usuario']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::CIUDAD_ID] = $report['usuario'];
                }
                 if (isset($report['usuario']) and $report['usuario'] !== null and $report['usuario'] !== '' and $report['usuario'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersSpecial($report['usuario']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::TELEFONO] = $report['usuario'];
                }
                 if (isset($report['usuario']) and $report['usuario'] !== null and $report['usuario'] !== '' and $report['usuario'] !== "default") {
                    $raza = validate::getInstance()->validateCharactersSpecial($report['usuario']);
                    if ($raza == true) {
                        throw new PDOException(i18n::__(10007, null, 'errors'));
                    }
                    $where[datosUsuarioTableClass::DIRECCION] = $report['usuario'];
                }
            }
            
    

            $fields = array(
                datosUsuarioTableClass::ID,
                datosUsuarioTableClass::NOMBRE,
                datosUsuarioTableClass::APELLIDOS,
                datosUsuarioTableClass::NUMERO_DOCUMENTO,
                datosUsuarioTableClass::CIUDAD_ID,
                datosUsuarioTableClass::TELEFONO,
                datosUsuarioTableClass::DIRECCION
                
            );
            

            $orderBy = array(
                datosUsuarioTableClass::ID
            );

            $this->objDatos = datosUsuarioTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);
            $this->mensaje = 'Informe de Usuarios en Nuestro Sistema';
            $this->defineView('index', 'usuario', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
