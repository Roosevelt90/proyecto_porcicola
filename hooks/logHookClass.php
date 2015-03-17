<?php

namespace hook\log {

    use mvc\interfaces\hookInterface;
    use mvc\session\sessionClass as session;
    use mvc\config\configClass as config;

    /**
     * Description of logHookClass
     *
     * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
     */
    class logHookClass implements hookInterface {

        public static function hook() {
            try {
                if (session::getInstance()->hasAttribute('shfLogRegister')) {
                    $data = unserialize(session::getInstance()->getAttribute('shfLogRegister'));
                    \bitacoraTableClass::insert($data);
                    session::getInstance()->deleteAttribute('shfLogRegister');
                }
            } catch (\PDOException $exc) {
                throw $exc;
            }
        }

        /**
         * 
         * @param type $accion
         * @param type $tabla
         * @param type $observacion
         * @param type $registro
         * @param type $user_id
         */
        public static function register($accion, $tabla, $observacion = null, $registro = null, $user_id = null) {
            $data = array(
                \bitacoraTableClass::ACCION => $accion,
                \bitacoraTableClass::USUARIO_ID => (session::getInstance()->hasUserId()) ? session::getInstance()->getUserId() : $user_id,
                \bitacoraTableClass::FECHA => date(config::getFormatTimestamp()),
                \bitacoraTableClass::TABLA => $tabla
            );
            if ($observacion !== null) {
                $data[\bitacoraTableClass::OBSERVACION] = $observacion;
            }
            if ($registro !== null) {
                $data[\bitacoraTableClass::REGISTRO] = $registro;
            }
            session::getInstance()->setAttribute('shfLogRegister', serialize($data));
        }

    }

}