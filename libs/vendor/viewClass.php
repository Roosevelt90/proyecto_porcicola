<?php

namespace mvc\view {

  use mvc\config\configClass;
  use mvc\session\sessionClass;
  use mvc\cache\cacheManagerClass;

  /**
   * Description of viewClass - vyo͞o
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class viewClass {

    static public function includeHandlerMessage() {
      include_once configClass::getPathAbsolute() . 'libs/vendor/view/handlerMessage.php';
    }

    static public function getMessageError($key) {
      include configClass::getPathAbsolute() . 'libs/vendor/view/messageError.php';
    }

    static public function includePartial($partial, $variables = null) {
      if ($variables !== null and is_array($variables) and count($variables) > 0) {
        extract($variables);
      }
      include_once configClass::getPathAbsolute() . 'view/' . $partial . '.php';
    }

    static public function includeComponent($module, $component, $variables = array()) {
      include_once configClass::getPathAbsolute() . 'controller/' . $module . '/' . $component . 'ComponentClass.php';
      $componentClass = $component . 'ComponentClass';
      $objComponent = new $componentClass($variables);
      $objComponent->component();
      $objComponent->setArgs((array) $objComponent);
      $objComponent->renderComponent();
    }

    static public function genMetas() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $metas = '';
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/view.yml', 'viewYaml');
      foreach ($includes['all']['meta'] as $include) {
        $metas .= '<meta ' . $include . '>';
      }
      if (isset($includes[$module][$action]['meta'])) {
        foreach ($includes[$module][$action]['meta'] as $include) {
          $metas .= '<meta ' . $include . '>';
        }
      }
      return $metas;
    }

    static public function genStylesheet() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $stylesheet = '';
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/view.yml', 'viewYaml');
      foreach ($includes['all']['stylesheet'] as $include) {
        $stylesheet .= '<link rel="stylesheet" href="' . configClass::getUrlBase() . 'css/' . $include . '">';
      }
      if (isset($includes[$module][$action]['stylesheet'])) {
        foreach ($includes[$module][$action]['stylesheet'] as $include) {
          $stylesheet .= '<link rel="stylesheet" href="' . configClass::getUrlBase() . 'css/' . $include . '">';
        }
      }
      return $stylesheet;
    }

    static public function genJavascript() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $javascript = '';
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/view.yml', 'viewYaml');
      foreach ($includes['all']['javascript'] as $include) {
        $javascript .= '<script src="' . configClass::getUrlBase() . 'js/' . $include . '"></script>';
      }
      if (isset($includes[$module][$action]['javascript'])) {
        foreach ($includes[$module][$action]['javascript'] as $include) {
          $javascript .= '<script src="' . configClass::getUrlBase() . 'js/' . $include . '"></script>';
        }
      }
      return $javascript;
    }

    /**
     * Funcion estatica publica que incluye un favicon en las vistas del sistema
     * @author Leonardo Betancourt Caicedo <leobetacai@gmail.com>
     * @return string
     */
    static public function genFavicon() {
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/view.yml', 'viewYaml');
      $favicon = '<link rel="icon" href="' . configClass::getUrlBase() . 'img/' . $includes['all']['favicon'] . '" type="image/x-icon">';
      return $favicon;
    }

    /**
     * Funcion diseñada para integrar un titulo a cada vista de el sistema de el portal
     * @author Leonardo Betancourt Caicedo <leobetacai@gmail.com>
     * @return string
     */
    public static function genTitle() {
      $module = sessionClass::getInstance()->getModule();
      $action = sessionClass::getInstance()->getAction();
      $title = '';
      $includes = cacheManagerClass::getInstance()->loadYaml(configClass::getPathAbsolute() . 'config/view.yml', 'viewYaml');
      if (isset($includes[$module][$action]['title'])) {
        $title = '<title>' . $includes[$module][$action]['title'] . '</title>';
      } else if (isset($includes['all']['title'])) {
        $title = '<title>' . $includes['all']['title'] . '</title>';
      }
      return $title;
    }

    static public function renderComponent($component, $arg = array()) {
      if (isset($component)) {
        if (count($arg) > 0) {
          extract($arg);
        }
        include configClass::getPathAbsolute() . "view/$component.php";
      }
    }

    static public function renderHTML($module, $template, $typeRender, $arg = array()) {
      if (isset($module) and isset($template)) {
        if (count($arg) > 0) {
          extract($arg);
        }
        switch ($typeRender) {
          case 'html':
            header(configClass::getHeaderHtml());
            include_once configClass::getPathAbsolute() . 'libs/vendor/view/head.php';
            include_once configClass::getPathAbsolute() . "view/$module/$template.html.php";
            include_once configClass::getPathAbsolute() . 'libs/vendor/view/foot.php';
            break;
          case 'json':
            header(configClass::getHeaderJson());
            include_once configClass::getPathAbsolute() . "view/$module/$template.json.php";
            break;
          case 'pdf':
            //header(configClass::getHeaderPdf());
            include_once configClass::getPathAbsolute() . "view/$module/$template.pdf.php";
            break;
          case 'javascript':
            header(configClass::getHeaderJavascript());
            include_once configClass::getPathAbsolute() . "view/$module/$template.js.php";
            break;
          case 'xml':
            header(configClass::getHeaderXml());
            include_once configClass::getPathAbsolute() . "view/$module/$template.xml.php";
            break;
          case 'excel2003':
            header(configClass::getHeaderExcel2003());
            include_once configClass::getPathAbsolute() . "view/$module/$template.xls.php";
            break;
          case 'excel2007':
            header(configClass::getHeaderExcel2007());
            include_once configClass::getPathAbsolute() . "view/$module/$template.xlsx.php";
            break;
        }
      }
    }

  }

}
