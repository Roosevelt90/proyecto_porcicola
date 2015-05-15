<?php

namespace mvc\interfaces {

  /**
   * Description of sessionInterface
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  interface sessionInterface {

    public static function getInstance();

    public function deleteCredentials();

    public function deleteAttribute($attribute);

    public function setAttribute($attribute, $value);

    public function getAttribute($attribute);

    public function hasAttribute($attribute);

    public function setFlash($flash, $value);

    public function getFlash($flash);

    public function hasFlash($flash);

    public function isUserAuthenticated();

    public function setUserAuthenticate($authenticate);

    public function getCredentials();

    public function setCredentials($credentials);

    public function setCredential($credential);

    public function hasCredential($credential);

    public function setModule($module);

    public function getModule();

    public function setAction($action);

    public function getAction();

    public function getFormatOutput();

    public function setFormatOutput($format_output);

    public function getLoadFiles();

    public function setLoadFiles($load_files);

    public function hasError($key = null);

    public function setError($error, $key = null);

    public function getError($key = null);

    public function deleteErrorStack();

    public function hasSuccess();

    public function setSuccess($success);

    public function getSuccess();

    public function deleteSuccessStack();

    public function hasInformation();

    public function setInformation($information);

    public function getInformation();

    public function deleteInformationStack();

    public function hasWarning();

    public function setWarning($warning);

    public function getWarning();

    public function deleteWarningStack();

    public function setFirstCall($first_call);

    public function getFirstCall();

    public function hasFirstCall();

    public function setUserId($id);

    public function setUserName($name_user);

    public function getUserId();

    public function hasUserId();

    public function getUserName();

    public function setCache($cache, $value);

    public function getCache($cache);

    public function hasCache($cache);
  }

}
