<?php

namespace mvc\controller {

  use mvc\view\viewClass;

  /**
   * Description of controllerClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class controllerClass {

    private $view;
    private $module;
    private $format;
    protected $arg;

    public function __construct() {
      $this->arg = array();
    }

    public function setArgs($args) {
      $this->arg = $args;
    }

    public function defineView($view, $module, $format) {
      $this->view = $view . 'Template';
      $this->module = $module;
      $this->format = $format;
    }

    public function renderView() {
      viewClass::renderHTML($this->module, $this->view, $this->format, $this->arg);
    }

  }

}
