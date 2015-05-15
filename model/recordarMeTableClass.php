<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;

/**
 * Description of recordarMeTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class recordarMeTableClass extends recordarMeBaseTableClass {

  public static function deleteSession($hash, $ip_address) {
    try {
      $sql = 'DELETE FROM ' . recordarMeTableClass::getNameTable() . '
              WHERE ' . recordarMeTableClass::HASH_COOKIE . ' = :hash
              AND ' . recordarMeTableClass::IP_ADDRESS . ' = :ip_address';
      $params = array(
          ':hash' => $hash,
          ':ip_address' => $ip_address
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getUserAndPassword($ip_address, $hash) {
    try {
      $sql = 'SELECT ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' AS id_usuario,
                  ' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' AS usuario,
                  ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' AS credencial
              FROM ' . usuarioTableClass::getNameTable() . ' INNER JOIN ' . recordarMeTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . recordarMeTableClass::getNameField(recordarMeTableClass::USUARIO_ID) . '
                   INNER JOIN ' . usuarioCredencialTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) . '
                   INNER JOIN ' . credencialTableClass::getNameTable() . ' ON ' . credencialTableClass::getNameField(credencialTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID) . '
              WHERE ' . recordarMeBaseTableClass::getNameField(recordarMeTableClass::IP_ADDRESS) . ' = :ip_address
              AND ' . recordarMeBaseTableClass::getNameField(recordarMeTableClass::HASH_COOKIE) . ' = :hash
              AND ' . usuarioBaseTableClass::getNameField(usuarioBaseTableClass::DELETED_AT) . ' IS NULL
              AND ' . usuarioBaseTableClass::getNameField(usuarioBaseTableClass::ACTIVED) . ' = :actived
              AND ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
          ':ip_address' => $ip_address,
          ':hash' => $hash,
          ':actived' => ((config::getDbDriver() === 'mysql') ? 1 : 't')
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) > 0 ) ? $answer : false;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function clearSessions() {
    try {
      $sql = 'DELETE FROM ' . recordarMeTableClass::getNameTable() . ' WHERE localtimestamp(0) > (' . recordarMeTableClass::CREATED_AT . ' + INTERVAL :timeSeconds)';
      $params = array(
          ':timeSeconds' => config::getCookieTime() . ' seconds'
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
