<?php

namespace mvc\interfaces {

  interface i18nInterface {

    static public function __($message, $culture = null, $dictionary = 'default');

    static public function setCulture($culture);

    static public function getCulture();
  }

}