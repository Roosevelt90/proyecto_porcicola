<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\date\dateClass as date ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>
<div class="container container-fluid">

    <form class="form-signin" role="form" action="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'login') ?>" method="POST">
        <div class="row">
            <div class="col-lg-offset-2">
                <h2 class="form-signin-heading identificacion text-center"><?php echo i18n::__('Identificacion', null) ?></h2>
            </div>
        </div>
        <div class="row" style="margin-top: 5px">
            <div class="col-md-4 col-md-offset-0" style="margin-left: 10px">
                <div class="date text-center">
                    <h2>
                        <?php echo date::getInstance()->day() ?><br/>
                        <?php echo date("d") ?><br/>
                        <?php echo date::getInstance()->month() ?>
                    </h2>
                </div>
            </div>

            <div class="col-md-7 col-md-pull-0">
                <label for="inputUser" class="sr-only"></label>
                <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="<?php echo i18n::__('usuario') ?>" required autofocus>
                <label for="inputPassword" class="sr-only"></label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="<?php echo i18n::__('contraseña') ?>" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="true" name="chkRememberMe"> <?php echo i18n::__('Recordar mis datos', null) ?>
                    </label>
                </div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('recuperar', 'index') ?>"><h4><?php echo i18n::__('Olvidastes tu contraseña?', null) ?></h4></a>


                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo i18n::__('Entrar') ?></button>
                </form>

                <div class="left col-md-pull-8  col-md-4" style="margin-top: 5px">
                    <form id="frmTraductor" action="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'TraductorShfSecurity') ?>" method="POST">
                       
                        <select name="language" onchange="$('#frmTraductor').submit()">
                             <option value=""></option>
                            <option <?php echo(config::getDefaultCulture() == 'es') ? 'selected' : '' ?> value="es">Español</option>
                            <option <?php echo(config::getDefaultCulture() == 'en') ? 'selected' : '' ?> value="en">English</option>
                        </select>
                        <input type="hidden" name="PATH_INFO" value="<?php echo request::getInstance()->getServer('PATH_INFO') ?>">        
                    </form>
                </div>            
            </div>
        </div>

        <?php if (session::getInstance()->hasError() or session::getInstance()->hasInformation() or session::getInstance()->hasSuccess() or session::getInstance()->hasWarning()): ?>
            <?php view::includeHandlerMessage() ?>
        <?php endif//close if  ?>

</div> <!-- /container -->
