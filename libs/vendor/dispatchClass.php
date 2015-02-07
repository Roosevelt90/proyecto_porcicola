<?php

namespace mvc\dispatch {

    use mvc\config\configClass;
    use mvc\routing\routingClass;
    use mvc\autoload\autoLoadClass;
    use mvc\session\sessionClass;
    use mvc\i18n\i18nClass;
    use mvc\hook\hookClass;

    /**
     * Description of dispatchClass
     *
     * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
     */
    class dispatchClass {

        private static $instance;

        public function __construct() {


            if (!sessionClass::getInstance()->hasFirstCall()) {
                sessionClass::getInstance()->setFirstCall(true);
            }
        }

        /**
         *
         * 
         * @return dispatchClass
         */
        public static function getInstance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function main($module = null, $action = null) {
            try {
                i18nClass::setCulture(configClass::getDefaultCulture());
                routingClass::getInstance()->registerModuleAndAction($module, $action);
                autoLoadClass::getInstance()->loadIncludes();
                hookClass::hooksIni();
                $controller = $this->loadModuleAndAction();
                hookClass::hooksEnd();
                $controller->renderView();
            } catch (\Exception $exc) {
                echo $exc->getMessage();
                echo '<br>';
                echo '<pre>';
                print_r($exc->getTrace());
                echo '</pre>';
            }
        }

        private function checkFile($controllerFolder, $controllerFile) {
            return is_file(configClass::getPathAbsolute() . 'controller/' . $controllerFolder . '/' . $controllerFile . '.php');
        }

        private function includeFileAndInitialize($controllerFolder, $controllerFile) {
            include_once configClass::getPathAbsolute() . 'controller/' . $controllerFolder . '/' . $controllerFile . '.php';
            return new $controllerFile();
        }

        /**
         * 
         * @return \mvc\controller\controllerClass
         * @throws \Exception
         */
        private function loadModuleAndAction() {
            $controllerFolder = sessionClass::getInstance()->getModule();
            $controllerFile = $controllerFolder . 'Class';
            $action = sessionClass::getInstance()->getAction() . 'Action';
            $controllerFileAction = sessionClass::getInstance()->getAction() . 'ActionClass';
            $controller = false;
            if ($this->checkFile($controllerFolder, $controllerFile)) {
                $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFile);
                if (method_exists($controller, $action) === true) {
                    $this->executeAction($controller, $action);
                } else if ($this->checkFile($controllerFolder, $controllerFileAction)) {
                    $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFileAction);
                    $this->executeAction($controller, 'execute');
                } else {
                    throw new \Exception(i18nClass::__(00001, null, 'errors'), 00001);
                }
            } elseif ($this->checkFile($controllerFolder, $controllerFileAction)) {
                $controller = $this->includeFileAndInitialize($controllerFolder, $controllerFileAction);
                $this->executeAction($controller, 'execute');
            } else {
                throw new \Exception(i18nClass::__(00001, null, 'errors'), 00001);
            }

            return $controller;
        }

        private function executeAction($controller, $action) {
            $controller->$action();
            $controller->setArgs((array) $controller);
        }

    }

}
