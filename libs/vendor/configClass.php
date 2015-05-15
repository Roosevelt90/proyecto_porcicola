<?php

namespace mvc\config {

  /**
   * Description of configClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class configClass {

    private static $db_dsn;
    private static $db_driver;
    private static $db_host;
    private static $db_port;
    private static $db_name;
    private static $db_user;
    private static $db_password;
    private static $db_unix_socket;
    private static $scope;
    private static $path_absolute;
    private static $url_base;
    private static $index_file;
    private static $default_module;
    private static $default_action;
    private static $default_module_security;
    private static $default_action_security;
    private static $default_culture;
    private static $timestamp;
    private static $header_html;
    private static $header_json;
    private static $header_pdf;
    private static $header_excel_2003;
    private static $header_excel_2007;
    private static $header_xml;
    private static $header_javascript;
    private static $cookie_name_remember_me;
    private static $cookie_name_site;
    private static $cookie_path;
    private static $cookie_domain;
    private static $cookie_time;
    private static $row_grid;
    private static $default_module_permission;
    private static $default_action_permission;
    
    public static function getSohoFrameworkVersion() {
      return '1.0.10';
    }

    /**
     * Obtiene la URL base del sistema
     *
     * @return string
     */
    public static function getUrlBase() {
      return self::$url_base;
    }

    /**
     * Configuro la URL base del sistema
     * Ejemplo: http://localhost/MVC/web/
     *
     * @param string $url_base
     */
    public static function setUrlBase($url_base) {
      self::$url_base = $url_base;
    }

    /**
     * @return string
     */
    public static function getPathAbsolute() {
      return self::$path_absolute;
    }

    /**
     * @param string $path_absolute
     */
    public static function setPathAbsolute($path_absolute) {
      self::$path_absolute = $path_absolute;
    }

    /**
     * @return string
     */
    public static function getScope() {
      return self::$scope;
    }

    /**
     * @param string $scope
     */
    public static function setScope($scope) {
      self::$scope = $scope;
    }

    /**
     * @return string
     */
    public static function getDbDriver() {
      return self::$db_driver;
    }

    /**
     * @param string $db_driver
     */
    public static function setDbDriver($db_driver) {
      self::$db_driver = $db_driver;
    }

    /**
     * @return string
     */
    public static function getDbHost() {
      return self::$db_host;
    }

    /**
     * @param string $db_host
     */
    public static function setDbHost($db_host) {
      self::$db_host = $db_host;
    }

    /**
     * @return string
     */
    public static function getDbName() {
      return self::$db_name;
    }

    /**
     * @param string $db_name
     */
    public static function setDbName($db_name) {
      self::$db_name = $db_name;
    }

    /**
     * @return string
     */
    public static function getDbPassword() {
      return self::$db_password;
    }

    /**
     * @param string $db_password
     */
    public static function setDbPassword($db_password) {
      self::$db_password = $db_password;
    }

    /**
     * @return integer
     */
    public static function getDbPort() {
      return self::$db_port;
    }

    /**
     * @param integer $db_port
     */
    public static function setDbPort($db_port) {
      self::$db_port = $db_port;
    }

    /**
     * @return string
     */
    public static function getDbUser() {
      return self::$db_user;
    }

    /**
     * @param string $db_user
     */
    public static function setDbUser($db_user) {
      self::$db_user = $db_user;
    }

    /**
     * @return string
     */
    public static function getDbDsn() {
      return self::$db_dsn;
    }

    /**
     * @param string $db_dsn
     */
    public static function setDbDsn($db_dsn) {
      self::$db_dsn = $db_dsn;
    }

    public static function setIndexFile($index_file) {
      self::$index_file = $index_file;
    }

    public static function getIndexFile() {
      return self::$index_file;
    }

    public static function setDefaultModuleSecurity($default_module_security) {
      self::$default_module_security = $default_module_security;
    }

    public static function getDefaultModuleSecurity() {
      return self::$default_module_security;
    }

    public static function setDefaultActionSecurity($default_action_security) {
      self::$default_action_security = $default_action_security;
    }

    public static function getDefaultActionSecurity() {
      return self::$default_action_security;
    }

    public static function setDefaultCulture($default_culture) {
      self::$default_culture = $default_culture;
    }

    public static function getDefaultCulture() {
      return self::$default_culture;
    }

    public static function setFormatTimestamp($timestamp) {
      self::$timestamp = $timestamp;
    }

    public static function getFormatTimestamp() {
      return self::$timestamp;
    }

    /**
     * @return mixed
     */
    public static function getHeaderXml() {
      return self::$header_xml;
    }

    /**
     * @param mixed $header_xml
     */
    public static function setHeaderXml($header_xml) {
      self::$header_xml = $header_xml;
    }

    /**
     * @return mixed
     */
    public static function getHeaderExcel2003() {
      return self::$header_excel_2003;
    }

    /**
     * @param mixed $header_excel_2003
     */
    public static function setHeaderExcel2003($header_excel_2003) {
      self::$header_excel_2003 = $header_excel_2003;
    }

    /**
     * @return mixed
     */
    public static function getHeaderExcel2007() {
      return self::$header_excel_2007;
    }

    /**
     * @param mixed $header_excel_2007
     */
    public static function setHeaderExcel2007($header_excel_2007) {
      self::$header_excel_2007 = $header_excel_2007;
    }

    /**
     * @return mixed
     */
    public static function getHeaderHtml() {
      return self::$header_html;
    }

    /**
     * @param mixed $header_html
     */
    public static function setHeaderHtml($header_html) {
      self::$header_html = $header_html;
    }

    /**
     * @return mixed
     */
    public static function getHeaderJavascript() {
      return self::$header_javascript;
    }

    /**
     * @param mixed $header_javascript
     */
    public static function setHeaderJavascript($header_javascript) {
      self::$header_javascript = $header_javascript;
    }

    /**
     * @return mixed
     */
    public static function getHeaderJson() {
      return self::$header_json;
    }

    /**
     * @param mixed $header_json
     */
    public static function setHeaderJson($header_json) {
      self::$header_json = $header_json;
    }

    /**
     * @return mixed
     */
    public static function getHeaderPdf() {
      return self::$header_pdf;
    }

    /**
     * @param mixed $header_pdf
     */
    public static function setHeaderPdf($header_pdf) {
      self::$header_pdf = $header_pdf;
    }

    /**
     * @return mixed
     */
    public static function getCookieNameSite() {
      return self::$cookie_name_site;
    }

    /**
     * @param mixed $cookie_name_site
     */
    public static function setCookieNameSite($cookie_name_site) {
      self::$cookie_name_site = $cookie_name_site;
    }

    /**
     * @return mixed
     */
    public static function getCookieNameRememberMe() {
      return self::$cookie_name_remember_me;
    }

    /**
     * @param mixed $cookie_name_remember_me
     */
    public static function setCookieNameRememberMe($cookie_name_remember_me) {
      self::$cookie_name_remember_me = $cookie_name_remember_me;
    }

    /**
     * @return mixed
     */
    public static function getCookieTime() {
      return self::$cookie_time;
    }

    /**
     * @param mixed $cookie_time
     */
    public static function setCookieTime($cookie_time) {
      self::$cookie_time = $cookie_time;
    }

    /**
     * @return mixed
     */
    public static function getCookieDomain() {
      return self::$cookie_domain;
    }

    /**
     * @param mixed $cookie_domain
     */
    public static function setCookieDomain($cookie_domain) {
      self::$cookie_domain = $cookie_domain;
    }

    /**
     * @return mixed
     */
    public static function getCookiePath() {
      return self::$cookie_path;
    }

    /**
     * @param mixed $cookie_path
     */
    public static function setCookiePath($cookie_path) {
      self::$cookie_path = $cookie_path;
    }

    public static function setRowGrid($row_grid) {
      self::$row_grid = $row_grid;
    }

    public static function getRowGrid() {
      return self::$row_grid;
    }

    public static function getDefaultModule() {
      return self::$default_module;
    }

    public static function getDefaultAction() {
      return self::$default_action;
    }

    public static function setDefaultModule($default_module) {
      self::$default_module = $default_module;
    }

    public static function setDefaultAction($default_action) {
      self::$default_action = $default_action;
    }

    public static function getDbUnixSocket() {
      return self::$db_unix_socket;
    }

    public static function setDbUnixSocket($db_unix_socket) {
      self::$db_unix_socket = $db_unix_socket;
    }
    
    public static function getDefaultModulePermission() {
      return self::$default_module_permission;
    }

    public static function getDefaultActionPermission() {
      return self::$default_action_permission;
    }

    public static function setDefaultModulePermission($default_module_permission) {
      self::$default_module_permission = $default_module_permission;
    }

    public static function setDefaultActionPermission($default_action_permission) {
      self::$default_action_permission = $default_action_permission;
    }
  
  }

}
