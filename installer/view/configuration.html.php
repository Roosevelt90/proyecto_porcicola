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
                <div class="col-lg-8 col-lg-offset-2" style="margin-top: 100px">
                    <form action="index.php?step=4" enctype="multipart/form-data" method="POST">

                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>
                                    Cantidad de lineas en la grilla
                                </th>
                                <th>
                                    <input type="text" name="RowGrid" placeholder="Numero de lineas por regilla"><br>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Ruta del proyecto
                                </th>
                                <th>
                                    <input type="text"  name="PathAbsolute" placeholder="Dirección en servidor de la carpeta raíz"><br>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Direccion de la web
                                </th>
                                <th>
                                    <input type="text" value="http://"  name="UrlBase" placeholder="Dirección de la web"><br>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Seleccione el modo de la instalacion
                                </th>
                                <th>
                                    <select name="Scope">
                                        <option value="">...</option>
                                        <option value="dev">Desarrollo</option>
                                        <option value="prod">Producción</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Seleccione el idioma 
                                </th>
                                <th>
                                    <select name="idioma">
                                        <option value="">...</option>
                                        <option value="es">Español</option>
                                        <option value="en">English</option>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Ingrese el formato de fecha
                                </th>
                                <th>
                                    <input type="text" name="FormatTimestamp" value="Y-m-d H:i:s" placeholder="Formato de fecha y hora">(Opcional)
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Seleccione la base de datos
                                </th>
                                <th>
                                    <input type="file" name="db">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">
                                    <input type="submit" value="Instalar">
                                </th>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($_GET['error']) and $_GET['error'] === true): ?>
            <?php echo $_GET['error_message'] ?>
        <?php endif ?>
    </body>
</html>
