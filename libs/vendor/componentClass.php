<?php

namespace mvc\component {
  
  use mvc\view\viewClass as view;

  /**
   * Description of componentClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class componentClass {

    private $view;
    private $module;
    protected $arg;

    public function __construct($args = array()) {
      if (count($args) > 0) {
        foreach ($args as $key => $value) {
          $this->$key = $value;
        }
      }
    }

    public function setArgs($args) {
      $this->arg = $args;
    }

    public function defineView($view, $module) {
      $this->view = $view;
      $this->module = $module;
    }

    public function renderComponent() {
      view::renderComponent($this->module . '/' . $this->view, $this->arg);
    }

  }

}