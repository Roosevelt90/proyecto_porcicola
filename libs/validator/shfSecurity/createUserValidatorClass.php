<?php

namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;

  /**
   * Description of shfSecurityCreateUserValidationClass
   *
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class createUserValidatorClass extends validatorClass {

    public static function validateInsert() {
      $flag = false;
      
      if (self::notBlank(request::getInstance()->getPost('inputUser'))) {
        $flag = true;
        session::getInstance()->setFlash('inputUser', true);
        session::getInstance()->setError('El nombre de usuario es requerido', 'inputUser');
      } else if (is_numeric(request::getInstance()->getPost('inputUser'))) {
        $flag = true;
        session::getInstance()->setFlash('inputUser', true);
        session::getInstance()->setError('El usuario no puede ser númerico', 'inputUser');
      } else if(strlen(request::getInstance()->getPost('inputUser')) > \usuarioTableClass::USER_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUser', true);
        session::getInstance()->setError('El usuario digitado es mayor en cantidad de caracteres a lo permitido', 'inputUser');
      } else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
        $flag = true;
        session::getInstance()->setFlash('inputUser', true);
        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
      }

      if (self::notBlank(request::getInstance()->getPost('inputPass1')) or self::notBlank(request::getInstance()->getPost('inputPass2'))) {
        $flag = true;
        session::getInstance()->setFlash('inputPass', true);
        session::getInstance()->setError('La contraseña es requerida', 'inputPass');
      } else if (request::getInstance()->getPost('inputPass1') !== request::getInstance()->getPost('inputPass2')) {
        $flag = true;
        session::getInstance()->setFlash('inputPass', true);
        session::getInstance()->setError('Las contraseñas no coinciden', 'inputPass');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputName'))) {
        $flag = true;
        session::getInstance()->setFlash('inputName', true);
        session::getInstance()->setError('El nombre del usuario es requerido', 'inputName');
      } else if (is_numeric(request::getInstance()->getPost('inputName'))) {
        $flag = true;
        session::getInstance()->setFlash('inputName', true);
        session::getInstance()->setError('El nombre no puede ser númerico', 'inputName');
      } else if (strlen(request::getInstance()->getPost('inputName')) > \datoUsuarioTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputName', true);
        session::getInstance()->setError('El nombre no puede exceder el número de caracteres permitido', 'inputName');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputLastName'))) {
        $flag = true;
        session::getInstance()->setFlash('inputLastName', true);
        session::getInstance()->setError('El apellido del usuario es requerido', 'inputLastName');
      } else if (is_numeric(request::getInstance()->getPost('inputLastName'))) {
        $flag = true;
        session::getInstance()->setFlash('inputLastName', true);
        session::getInstance()->setError('El apellido no puede ser númerico', 'inputLastName');
      } else if (strlen(request::getInstance()->getPost('inputLastName')) > \datoUsuarioTableClass::APELLIDOS_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputLastName', true);
        session::getInstance()->setError('El apellido no puede exceder el número de caracteres permitido', 'inputLastName');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputMovil'))) {
        $flag = true;
        session::getInstance()->setFlash('inputMovil', true);
        session::getInstance()->setError('El número de celular es requerido o cualquier otro número donde se le pueda contactar', 'inputMovil');
      } else if (strlen(request::getInstance()->getPost('inputMovil')) > \datoUsuarioTableClass::MOVIL_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputMovil', true);
        session::getInstance()->setError('El número de contacto no puede exceder el máximo de caracteres permitidos', 'inputMovil');
      } else if (!preg_match('/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/', trim(request::getInstance()->getPost('inputMovil')))) {
        $flag = true;
        session::getInstance()->setFlash('inputMovil', true);
        session::getInstance()->setError('El número de contacto debe cumplir uno de estos patrones: ###-###-#### o +#-###-####', 'inputMovil');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputEmail'))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El correo es obligatorio para el contacto por parte de la plataforma', 'inputEmail');
      } else if (strlen(request::getInstance()->getPost('inputEmail')) > \datoUsuarioTableClass::CORREO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El correo no puede exceder el máximo de caracteres permitidos', 'inputEmail');
      } else if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", trim(request::getInstance()->getPost('inputEmail')))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido', 'inputEmail');
      } else if(self::isUnique(\datoUsuarioTableClass::ID, true, array(\datoUsuarioTableClass::CORREO => trim(request::getInstance()->getPost('inputEmail'))), \datoUsuarioTableClass::getNameTable())) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El correo digitado ya está siendo usado', 'inputEmail');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputSexo'))) {
        $flag = true;
        session::getInstance()->setFlash('inputSexo', true);
        session::getInstance()->setError('Debes selecionar un sexo', 'inputSexo');
      } else if (!self::collection(trim(request::getInstance()->getPost('inputSexo')), array('t', 'f'))) {
        $flag = true;
        session::getInstance()->setFlash('inputSexo', true);
        session::getInstance()->setError('La respuesta dada no es correcta', 'inputSexo');
      }
      
      if (self::notBlank(request::getInstance()->getPost('inputAprendiz'))) {
        $flag = true;
        session::getInstance()->setFlash('inputAprendiz', true);
        session::getInstance()->setError('Debes responder si eres un aprendiz o no', 'inputAprendiz');
      } else if (!self::collection(trim(request::getInstance()->getPost('inputAprendiz')), array('true', 'false'))) {
        $flag = true;
        session::getInstance()->setFlash('inputAprendiz', true);
        session::getInstance()->setError('La respuesta dada no es correcta', 'inputAprendiz');
      }
      
      if (request::getInstance()->hasFile('inputFile')) {
        $type = array(
            'image/png',
            'image/jpeg',
            'image/jpg',
            'image/gif'
        );
        if(request::getInstance()->getFile('inputFile')['error'] !== 0) {
          $flag = true;
          session::getInstance()->setFlash('inputFile', true);
          session::getInstance()->setError('Ocurrio un error en la carga de la imágen, por favor vuelva a intentarlo', 'inputFile');
        } else if ((array_search(request::getInstance()->getFile('inputFile')['type'], $type) === false)) {
          $flag = true;
          session::getInstance()->setFlash('inputFile', true);
          session::getInstance()->setError('Solo se permiten imágenes del tipo jpg, png o gif', 'inputFile');
        } else if (request::getInstance()->getFile('inputFile')['size'] > config::getFileSizeAvatar()) {
          $flag = true;
          session::getInstance()->setFlash('inputFile', true);
          session::getInstance()->setError('Solo se permiten imágenes con un tamaño máximo de 150kB', 'inputFile');
        } else if ($flag === true) {
          session::getInstance()->setFlash('inputFile', true);
          session::getInstance()->setError('Debido a errores en el formulario, por favor vuelve a cargar la imagen que vas a usar', 'inputFile');
        }
      }

      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('shfSecurity', 'register');
      }
    }

  }

}