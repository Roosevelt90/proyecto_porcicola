<?php

namespace mvc\interfaces {

  interface requestInterface {
    
    public function hasPost($param);
    
    public function hasGet($param);
    
    public function hasRequest($param);
    
    public function setMethod($method);

    public function isMethod($method);

    public function getPost($param);

    public function getGet($param);

    public function getRequest($param);

    public function getCookie($param);

    public function hasCookie($param);
    
    public function hasServer($param);

    public function getServer($param);

    public function getEnv($param);

    public function isAjaxRequest();

    public function addParamGet($param);
  }

}
