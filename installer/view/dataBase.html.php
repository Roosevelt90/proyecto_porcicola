<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../web/css/bootstrap.css">
    </head>
    <body>
        <?php if (isset($_GET['error']) and $_GET['error'] === true): ?>
            Ocurrio un error
        <?php endif ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form action="index.php?step=3" method="POST">
                        <table class="table table-bordered table-responsive" style="margin-top: 100px">
                            <tr>
                                <th>
                                    Nombre del host
                                </th>
                                <th>
                                    <input value="<?php echo (isset($_POST['host'])) ? $_POST['host'] : '' ?>" type="text" name="host" placeholder="Inserte el host de la base de datos" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Seleccione el gestor de base de datos
                                </th>
                                <th>
                                    <select name="driver" required>
                                        <option value="">Seleccione un controlador</option>
                                        <option value="pgsql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'pgsql') ? 'selected' : '' ?>>PostgreSQL</option>
                                        <option value="mysql" <?php echo (isset($_POST['driver']) and $_POST['driver'] === 'mysql') ? 'selected' : '' ?>>MySQL</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Seleccione el puerto 
                                </th>
                                <th>
                                    <input <input value="<?php echo (isset($_POST['port'])) ? $_POST['port'] : '' ?>" type="text" name="port" placeholder="Digite el puerto" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Ingrese el nombre de la base de datos
                                </th>
                                <th>
                                    <input type="text" name="dbName" placeholder="Base de datos" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Ingrese el nombre del gestor de base de datos
                                </th>
                                <th>
                                    <input type="text" name="dbUser" placeholder="Usuario" required>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Ingrese la contraseña del gestor de base de datos
                                </th>
                                <th>
                                    <input type="password" name="dbPass" placeholder="Contraseña" required>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">
                                    <input type="submit" value="Continuar"> 
                                </th>
                            </tr>
                        </table>
                        <br>
                        <br>

                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($_GET['error']) and $_GET['error'] === true): ?>
            <?php echo $_GET['error_message'] ?>
        <?php endif ?>
    </body>
</html>
