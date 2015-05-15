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
        public function validateDate($date) {
             $pattern="/^((19|20)?[0-9]{2})[\/|-](0?[1-9]|[1][012])[\/|-](0?[1-9]|[12][0-9]|3[01])$/";
             return ((preg_match($pattern,$date)) ? true : false);

        }
        public function validateCharactersNumber($data) {
            return(is_numeric($data) ? false : true);
        }

    }

}

