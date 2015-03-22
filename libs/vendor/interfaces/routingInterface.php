<?php

namespace mvc\interfaces {

  interface routingInterface {

    public function getUrlWeb($module, $action = null, $variables = null);

    public function getUrlImg($image);

    public function getUrlCss($css);

    public function getUrlJs($javascript);

    public function redirect($module, $action = null, $variables = null);

    public function forward($module, $action);

    public function validateRouting($routing);

    public function registerModuleAndAction($module = null, $action = null);
  }

}
