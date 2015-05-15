<?php

namespace mvc\request {

  use mvc\interfaces\requestInterface;

  /**
   * Description of requestClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class requestClass implements requestInterface {

    private $delete;
    private $put;
    private $post;
    private $get;
    private $request;
    private $cookie;
    private $files;
    private $server;
    private $env;
    private static $instance;

    public function __construct($post, $get, $request, $cookie, $files, $server, $env) {
      $this->post = $post;
      $this->get = $get;
      $this->request = $request;
      $this->cookie = $cookie;
      $this->files = $files;
      $this->server = $server;
      $this->env = $env;
      $this->put = array();
      $this->delete = array();
      if ($this->isMethod('PUT') or $this->isMethod('DELETE')) {
        parse_str(file_get_contents('php://input'), $vars);
        $this->setPut($vars);
      }
    }

    /**
     *
     * @return requestClass
     */
    public static function getInstance() {
      if (!isset(self::$instance)) {
        self::$instance = new self($_POST, $_GET, $_REQUEST, $_COOKIE, $_FILES, $_SERVER, $_ENV);
      }
      return self::$instance;
    }

    public function isMethod($method) {
      return ($this->getServer('REQUEST_METHOD') === $method) ? true : false;
    }

    /**
     * $param['id'] = 12
     * @param array $param
     */
    public function addParamGet($param) {
      if (is_array($param)) {
        $this->get = array_merge($this->get, $param);
      }
    }

    public function getDelete($param) {
      return $this->delete[$param];
    }

    public function getPut($param) {
      return $this->put[$param];
    }

    public function getPost($param) {
      //return $this->protectParam($this->post[$param]);
      return $this->post[$param];
    }

    public function getGet($param) {
      //return $this->protectParam($this->get[$param]);
      return $this->get[$param];
    }

    public function getRequest($param) {
      //return $this->protectParam($this->request[$param]);
      return $this->request[$param];
    }

    public function getCookie($param) {
      return $this->cookie[$param];
    }

    public function getFile($param) {
      return $this->files[$param];
    }

    public function hasServer($param) {
      return isset($this->server[$param]);
    }

    public function hasPut($param) {
      return isset($this->put[$param]);
    }

    public function hasDelete($param) {
      return isset($this->delete[$param]);
    }

    public function getServer($param) {
      return $this->server[$param];
    }

    public function getEnv($param) {
      return $this->env[$param];
    }

    public function isAjaxRequest() {
      $answer = false;
      if ($this->hasServer('HTTP_X_REQUESTED_WITH') && strtolower($this->getServer('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest') {
        $answer = true;
      }
      return $answer;
    }

    /**
     * Evita la inyección SQL
     * @param array|string $param
     * @return array|string
     */
    private function protectParam($param) {
      if (is_array($param)) {
        foreach ($param as $key => $value) {
          if (is_array($value)) {
            $answer = $this->protectParam($value);
          } else {
            $answer[$key] = addslashes($this->post[$param]);
          }
        }
      } else {
        $answer = addslashes($this->post[$param]);
      }
      return $answer;
    }

    public function hasCookie($param) {
      return isset($this->cookie[$param]);
    }

    public function hasGet($param) {
      return isset($this->get[$param]);
    }

    public function hasPost($param) {
      return isset($this->post[$param]);
    }

    public function hasRequest($param) {
      return isset($this->request[$param]);
    }

    public function setMethod($method) {
      $this->server['REQUEST_METHOD'] = $method;
    }

    public function hasFile($param) {
      return ($this->getFile($param)['error'] === 4) ? false : true;
    }

    /**
     * $param['id'] = 12
     * @param array $param
     */
    public function setPut($param) {
      if (is_array($param)) {
        $this->put = array_merge($this->put, $param);
      }
    }

    /**
     * $param['id'] = 12
     * @param array $param
     */
    public function setDelete($param) {
      if (is_array($param)) {
        $this->delete = array_merge($this->delete, $param);
      }
    }

  }

}
