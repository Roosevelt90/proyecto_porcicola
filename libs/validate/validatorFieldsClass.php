<?php

namespace mvc\validatorFields {

    /**
     * Description of autoLoadClass
     *
     * @author Roosevelt Diaz <rdiaz02@misena.edu.co>
     */
    class validatorFieldsClass {

        private static $instance;

        /**
         *
         * @return validatorFieldsClass
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function validatorCharactersSpecial($fields) {
            return (ereg("^[a-zA-Z0-9]{3,20}$", $fields) ? false : true );
        }

        public function validateFieldsEmpty($datos) {
            foreach ($datos as $key => $value) {
                return (empty($value) ? false : true);
            }
        }

    }

}

