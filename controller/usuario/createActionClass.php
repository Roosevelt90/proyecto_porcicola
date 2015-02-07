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
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
                $password = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
                $repetirPassword = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::SECOND_PASSWORD, true));
                $pregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
                $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));

                if (strlen($usuario) > usuarioTableClass::USER_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuarioTableClass::USER_LENGTH)), 00001);
                }
                
                if ($password !== $repetirPassword){
                    throw new PDOException(i18n::__(00004, null , 'errors', array(':password' => usuarioTableClass::SECOND_PASSWORD)),00004);                     
                }

                $data = array(
                    usuarioTableClass::USER => $usuario,
                    usuarioTableClass::PASSWORD => md5($password),
                    usuarioTableClass::RESTAURAR_ID => $pregunta,
                    usuarioTableClass::RESPUESTA_SECRETA => $respuesta
                );
                usuarioTableClass::insert($data);
                $fields = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::CREATED_AT
                );
//$fecha = date('Y-m-d H:i');
                
                $where = array(
                usuarioTableClass::USER => $usuario
                );
//         echo $fecha;
                $this->objUsuario = usuarioTableClass::getAll($fields, true, null ,null,null,null, $where);
                              routing::getInstance()->redirect('usuario', 'index');

//                $this->defineView('insertDatos', 'usuario',  session::getInstance()->getFormatOutput());
//                 print_r($objUsuario);

//                routing::getInstance()->getUrlWeb('dataUser', 'insert', array('objUsuario' => $objUsuario));
//                echo 1;
//                routing::getInstance()->redsirect('dataUser', 'insert', $objUsuario);
            } else {
                routing::getInstance()->redirect('usuario', 'index');
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
