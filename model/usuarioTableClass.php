<?php

use mvc\model\modelClass as model;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
/**
 * Description of usuarioTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class usuarioTableClass extends usuarioBaseTableClass {

  public static function verifyUser($usuario, $password) {
    try {
      $sql = 'SELECT ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' as credencial,
	' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' as usuario,
	' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' as id_usuario
    FROM ' . usuarioTableClass::getNameTable() . ' LEFT JOIN ' . usuarioCredencialTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) . '
    LEFT JOIN ' . credencialTableClass::getNameTable() . ' ON ' . credencialTableClass::getNameField(credencialTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID) . '
    WHERE ' . usuarioTableClass::getNameField(usuarioTableClass::ACTIVED) . ' = :actived
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL
    AND ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' = :user
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::PASSWORD) . ' = :pass';
      $params = array(
          ':user' => $usuario,
          ':pass' => md5($password),
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

  public static function setRegisterLastLoginAt($id) {
    try {
      $sql = 'UPDATE ' . usuarioTableClass::getNameTable() . '
              SET ' . usuarioTableClass::LAST_LOGIN_AT . ' = :last_login_at
              WHERE ' . usuarioTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id,
          ':last_login_at' => date(config::getFormatTimestamp())
      );
      $answer = model::getInstance()->prepare($sql);
      $answer->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

 public static function validatCreate($usuario, $password, $respuesta){
     $flag = FALSE;
     $patron = "^[a-zA-Z0-9]{3,20}$";
     
     if(!ereg($patron, $usuario)){
         session::getInstance()->setError('campo usuario no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
         
     }
   
  
       if(!ereg($patron, $respuesta)){
         session::getInstance()->setError('campo respuesta no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true), true);
         
     }
     
     if($flag == true){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('usuario', 'insert');
  
         }
       
 }
 
 public static function validatUpdate($usuario, $password){
     $flag = FALSE;
     $patron = "^[a-zA-Z0-9]{3,20}$";
     
     if(!ereg($patron, $usuario)){
         session::getInstance()->setError('campo usuario no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
         
     }
   
  
       if(!ereg($patron, $respuesta)){
         session::getInstance()->setError('campo respuesta no permite carateres especiales');
         $flag = true;
         session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::RESPUESTA_SECRETA, true), true);
         
     }
     
     if($flag == true){
         request::getInstance()->setMethod('GET');
         routing::getInstance()->forward('usuario', 'edit');
  
         }
       
 }
 
// public static function validatUpdate($usuario, $password){
//     $flag = FALSE;
//     $patron = "^[a-zA-Z0-9]{3,20}$";
//     
//     if(!ereg($patron, $usuario)){
//         session::getInstance()->setError('campo usuario no permite carateres especiales');
//         $flag = true;
//         session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::USER, true), true);
//         
//     }
//   
//  
//     
//     
//     if($flag == true){
//         request::getInstance()->setMethod('GET');
//         routing::getInstance()->forward('usuario', 'update');
//  
//         }
//         if (ereg($patron, $password)){
//            session::getInstance()->setError('la contraseña excede de el limite de caracteres permitidos');
//           $flag = true;
//           session::getInstance()->setFirstCall(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true),true);
//             
         }
       
   
     
   
         
 
  
 

