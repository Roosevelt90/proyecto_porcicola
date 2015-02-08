<?php

use mvc\config\configClass as config;

config::setRowGrid(10);

config::setDbHost('127.0.0.1');
config::setDbDriver('pgsql'); // pgsql
config::setDbName('proyecto_porcicola');
config::setDbPort(5432); // 5432
config::setDbUser('postgres');
config::setDbPassword('diaz');
// Esto solo es necesario en caso de necesitar un socket para la DB
config::setDbUnixSocket(null);

if (config::getDbUnixSocket() !== null) {
  config::setDbDsn(
          config::getDbDriver()
          . ':unix_socket=' . config::getDbUnixSocket()
          . ';dbname=' . config::getDbName()
  );
} else {
  config::setDbDsn(
          config::getDbDriver()
          . ':host=' . config::getDbHost()
          . ';port=' . config::getDbPort()
          . ';dbname=' . config::getDbName()
  );
}

config::setPathAbsolute('/var/www/html/ProyectoPorcicola/');
config::setUrlBase('http://localhost/ProyectoPorcicola/web/');

config::setScope('dev'); // prod
config::setDefaultCulture('es');
config::setIndexFile('index.php');

config::setFormatTimestamp('Y-m-d H:i:s');

config::setHeaderJson('Content-Type: application/json; charset=utf-8');
config::setHeaderXml('Content-Type: application/xml; charset=utf-8');
config::setHeaderHtml('Content-Type: text/html; charset=utf-8');
config::setHeaderPdf('Content-type: application/pdf; charset=utf-8');
config::setHeaderJavascript('Content-Type: text/javascript; charset=utf-8');
config::setHeaderExcel2003('Content-Type: application/vnd.ms-excel; charset=utf-8');
config::setHeaderExcel2007('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');

config::setCookieNameRememberMe('mvcSiteRememberMe');
config::setCookieNameSite('mvcSite');
config::setCookiePath('/ProyectoPorcicola/web/' . config::getIndexFile());
config::setCookieDomain('http://127.0.0.1/');
config::setCookieTime(3600 * 8); // una hora en segundo 3600 y por 8 serían 8 horas

config::setDefaultModule('default');
config::setDefaultAction('index');

config::setDefaultModuleSecurity('shfSecurity');
config::setDefaultActionSecurity('index');
