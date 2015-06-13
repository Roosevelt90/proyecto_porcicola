<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;

/**
 * Description of ejemploClass
 *
 * @author Roosevelt Diaz Tapias <rdiaz02@misena.edu.co>
 */
class consultarActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
//            if (request::getInstance()->hasRequest(usuarioTableClass::USER)) {
            $user = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
            $pregunta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESTAURAR_ID, true));
            $respuesta = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true));

            $where = array(
                usuarioTableClass::USER => $user
            );
            $fields = array(
                usuarioTableClass::ID,
                usuarioTableClass::USER,
                usuarioTableClass::RESTAURAR_ID,
                usuarioTableClass::RESPUESTA_SECRETA
            );
            $objUsuario = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
            if (!Empty($objUsuario)) {
                $preguntaUser = $objUsuario[0]->recuperar_id;
                $respuestaUser = $objUsuario[0]->respuesta_secreta;

                if ($pregunta == $preguntaUser and $respuesta == $respuestaUser) {
                    $id = $objUsuario[0]->id;
                    $fields = array(
                        usuarioTableClass::ID,
                        usuarioTableClass::USER,
                        usuarioTableClass::PASSWORD
                    );
                    $where = array(
                        usuarioTableClass::ID => $id
                    );

                    $fieldsRecuperar = array(
                        recuperarTableClass::ID,
                        recuperarTableClass::PREGUNTA_SECRETA
                    );

                    $this->objRecuperar = recuperarTableClass::getAll($fieldsRecuperar, false);
                    $this->objUsuario = usuarioTableClass::getAll($fields, true, null, null, null, null, $where);
                    $this->defineView('select', 'recuperar', session::getInstance()->getFormatOutput());
                } else {
                    echo 'Los datos son incorrectos por favor verificalos';
//                    routing::getInstance()->getUrlWeb('default', 'index');
                }//close if
            } else {
                echo 'El nombre de usuario' . ' ' . $user . ' ' . 'no existe';
            }//close if
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo '<br>';
            echo '<pre>';
            print_r($exc->getTrace());
            echo '</pre>';
        }
    }

}
