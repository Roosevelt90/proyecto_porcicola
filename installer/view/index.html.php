<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../web/css/bootstrap.css">
    </head>
    <body>
        <div class="container" >
            <div  class="row" style="margin-top: 50px">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                 Lista de chequeo 
                </div>
            </div>
            <div class="row" style="margin-top: 50px"> 
                <div class="col-lg-8 col-lg-offset-2">
                    
        <table class="table table-bordered table-responsive">
            <tr class="active">
                <th>
                    Requerido
                </th>
                <th>
                    Instalado
                </th>
                <th>
                    Cumple
                </th>
            </tr>
            <tr>
                <th>
                    PHP 5.4 o superior              
                </th>
                <th>
                    <?php echo PHP_VERSION ?>
                </th>
                <th>
                    <?php // echo (PHP_VERSION < 5.4) ? "X" : "Y" ?>
            <?php if(PHP_VERSION > 5.4): ?>
            <div class="glyphicon  glyphicon-ok-sign color-sucess"></div>
            <?php else: ?>
            <div class="glyphicon glyphicon-remove-sign color-remove"></div>
            <?php endif; ?>
                </th>
            </tr>
            <tr>
                <th>
                    json
                </th>
                <th>
                    <?php echo get_loaded_extensions()[array_search('json', get_loaded_extensions())] ?>
                </th>
                <th>
                    <?php // echo (get_loaded_extensions()[array_search('json', get_loaded_extensions())] ? 'Y' : 'X') ?>
            <?php if(get_loaded_extensions()[array_search('json', get_loaded_extensions())] == 'json'): ?>
            <div class="glyphicon  glyphicon-ok-sign color-sucess"></div>
            <?php else: ?>
            <div class="glyphicon glyphicon-remove-sign color-remove"></div>
            <?php endif; ?>
            </tr>
            <tr>
                <th>
                    PDO
                </th>
                <th>
                    <?php echo get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] ?>
                </th>
                <th>
                    <?php // echo (get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] == 'PDO') ? 'Y' : 'X' ?>
           <?php if(get_loaded_extensions()[array_search('PDO', get_loaded_extensions())] == 'PDO'): ?>
            <div class="glyphicon  glyphicon-ok-sign color-sucess"></div>
            <?php else: ?>
            <div class="glyphicon glyphicon-remove-sign color-remove"></div>
            <?php endif; ?>
                </th>
            </tr>
            <tr>
                <th>
                    pdo_pgsql
                </th>
                <th>
                    <?php echo get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] ?>
                </th>
                <th>
                    <?php // echo (get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] == 'pdo_pgsql') ? 'Y' : 'X' ?>
               <?php if(get_loaded_extensions()[array_search('pdo_pgsql', get_loaded_extensions())] == 'pdo_pgsql'): ?>
            <div class="glyphicon  glyphicon-ok-sign color-sucess"></div>
            <?php else: ?>
            <div class="glyphicon glyphicon-remove-sign color-remove"></div>
            <?php endif; ?>
                </th>
            </tr>
            <tr>
                <th>
                    pdo_mysql
                </th>
                <th>
                    <?php echo get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] ?>  
                </th>
                <th>
                    <?php // echo (get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] == 'pdo_mysql') ? 'Y' : 'X' ?>
           <?php if (get_loaded_extensions()[array_search('pdo_mysql', get_loaded_extensions())] == 'pdo_mysql'): ?>
            <div class="glyphicon glyphicon-ok-sign color-sucess"></div>
            <?php else: ?>
            <div class="glyphicon glyphicon-remove-sign color-remove"></div>
            <?php endif; ?>
                </th>
            </tr>
        </table>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        
     
                    <a href="index.php?step=2" class=" center-block btn btn-info right">Siguiente</a>
                    </div>
                    
                </div>
            
            
        </div>
    </body>
</html>
