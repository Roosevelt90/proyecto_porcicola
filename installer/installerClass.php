<?php

/**
 * Description of installerClass
 *
 * @author julianlasso
 */
class installerClass {

    public function install() {
        if (isset($_GET['step']) !== true) {
            include_once 'view/index.html.php';
        } else {
            switch ($_GET['step']) {
                case 2:
                    include_once 'view/dataBase.html.php';
                    break;
                case 3:
                    try {
                        $dsn = $_POST['driver'] . ':dbname=' . $_POST['dbName'] . ';host=' . $_POST['host'] . ';port=' . $_POST['port'];
                        $usuario = $_POST['dbUser'];
                        $contrasena = $_POST['dbPass'];
                        $gbd = new PDO($dsn, $usuario, $contrasena);
                        $_SESSION['driver'] = $_POST['driver'];
                        $_SESSION['host'] = $_POST['host'];
                        $_SESSION['port'] = $_POST['port'];
                        $_SESSION['dbUser'] = $_POST['dbUser'];
                        $_SESSION['dbPass'] = $_POST['dbPass'];
                        $_SESSION['dbName'] = $_POST['dbName'];

                        include_once 'view/configuration.html.php';
                    } catch (PDOException $exc) {
                        $_GET['error'] = true;
                        $_GET['error_message'] = $exc->getMessage();
                        include_once 'view/dataBase.html.php';
                    }
                    break;
                case 4:
                    try {

                        $flag = true;

                        /*
                         * realizar las validaciones
                         */

                        if ($flag === true) {
                            $driver = $_SESSION['driver'];
                            $host = $_SESSION['host'];
                            $port = $_SESSION['port'];
                            $dbUser = $_SESSION['dbUser'];
                            $dbPass = $_SESSION['dbPass'];
                            $dbName = $_SESSION['dbName'];
                            $RowGrid = $_POST['RowGrid'];
                            $PathAbsolute = $_POST['PathAbsolute'];
                            $UrlBase = $_POST['UrlBase'];
                            $Scope = $_POST['Scope'];
                            $idioma = $_POST['idioma'];
                            $FormatTimestamp = $_POST['FormatTimestamp'];
                            $CookiePath = str_replace('http://', '', $UrlBase);
                            $CookieDomain = $UrlBase;
                            
                            $_SESSION['url'] = $UrlBase;
                            include_once 'config.php';

                            if ($RowGrid < 0 or $RowGrid == '' or ! isset($RowGrid) or ! is_numeric($RowGrid)) {
                                $error_message = "El numero ingresado para la rejilla es incorrecto";
                                throw new Exception($error_message);
                            }

                            if (!file_exists($PathAbsolute) and $PathAbsolute !== '' and isset($PathAbsolute)) {
                                $error_message = "La ruta del proyecto no existe";
                                throw new Exception($error_message);
                            }

                            if (!filter_var($UrlBase, FILTER_VALIDATE_URL)) {
                                $error_message = 'La direccion ingresada es incorrecta';
                                throw new Exception($error_message);
                            }

                            if ($Scope !== 'dev' and $Scope !== 'prod') {
                                $error_message = 'Se ha seleccionado un modo de instalacion incorrecto';
                                throw new Exception($error_message);
                            }

                            if ($idioma !== 'en' and $idioma !== 'es'){
                                $error_message = 'El idioma seleccionado no existe';
                                throw new Exception($error_message);
                            }
                            
                            
                            $fileType = pathinfo(basename($_FILES['db']['name']),PATHINFO_EXTENSION);
                            
                            if($fileType != 'sql'){
                                $error_message = 'La extension del archivo no es sql';
                                throw new Exception($error_message);
                            }
                            
                            
                            $file = fopen('../config/config.php', 'w');
                            fputs($file, $config);
                            fclose($file);
                            $driver2 = 'pgsql';
                            $dbName2 = 'prueba';
                            $host2 = 'localhost';
                            $port2 = 5432;
                            $dsn2 = $driver2 . ':dbname=' . $dbName2 . ';host=' . $host2 . ';port=' . $port2;
                            $usuario2 = 'postgres';
                            $contrasena2 = 'diaz';
                            $gbd2 = new PDO($dsn2, $usuario2, $contrasena2);


                            // aqui falta correr el archivo SQL en la base de datos
                            $file2 = $_FILES['db']['tmp_name'];
                            $sql = file_get_contents($file2);
                            
                            $gbd2->beginTransaction();
                            $gbd2->exec($sql);
                            $gbd2->commit();
                            $cc = "El proyecto ha sido instalado exitosamente /n";
                            $cc = $cc . 'En caso de error contactar con el administrador del sitio al correo rdiaz02@misena.edu.co';
                            $install = fopen('../config/installer.php', 'w');
                            fputs($install, $cc);
                            fclose($install);
                            
                            include_once 'view/felicidades.html.php';
                        } else {
                            include_once 'view/configuration.html.php';
                        }
                    } catch (Exception $exc) {
                        $_GET['error'] = true;
                        $_GET['error_message'] = $exc->getMessage();
                        include_once 'view/configuration.html.php';
                    }
                    break;
            }
        }
    }

}
