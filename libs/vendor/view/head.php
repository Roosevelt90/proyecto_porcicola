<?php use mvc\session\sessionClass as session ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<!DOCTYPE html>
<html lang="<?php echo \mvc\config\configClass::getDefaultCulture() ?>">
  <head>
    <?php echo \mvc\view\viewClass::genTitle() ?>
    <?php echo \mvc\view\viewClass::genMetas() ?>
    <?php echo \mvc\view\viewClass::genFavicon() ?>
    <?php echo \mvc\view\viewClass::genStylesheet() ?>
    <?php echo \mvc\view\viewClass::genJavascript() ?>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <!--        <div class="saltos">
              <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
              </div>-->
      <?php if (session::getInstance()->hasUserId() == false): ?>   
        <div class="saltosLogin">
          <br/><br/><br/>
        </div>   
      <?php endif; ?>
      <?php if (session::getInstance()->hasUserId()): ?>   
        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
          <header class="demo-drawer-header">
            <img src="<?php echo routing::getInstance()->getUrlImg('diaz.jpg') ?>" class="demo-avatar">
            <div class="demo-avatar-dropdown">
              <span>main@main.com</span>
              <div class="mdl-layout-spacer"></div>

              <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons ">arrow_drop_down</i>
              </button>                            

              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
                <a href="#"> <button class="mdl-menu__item fa fa-cogs"><?php echo i18n::__('configuracion') ?></button></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>"> <button class="mdl-menu__item fa fa-sign-out"><?php echo i18n::__('Exit') ?></button></a>
              </ul>

            </div>
          </header>
          <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('animal') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="animal" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="animal">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal')     ?>'" > <button class="mdl-menu__item glyphicon glyphicon-piggy-bank"><?php echo i18n::__('cerdo', null, 'animal') ?></button></a>
                <a onclick="location.href = '<?php  echo routing::getInstance()->getUrlWeb('animal', 'indexLote')     ?>'" > <button class="mdl-menu__item fa fa-th"><?php echo i18n::__('lote') ?></button></a>
                <a onclick="location.href = '<?php  echo routing::getInstance()->getUrlWeb('animal', 'indexRaza')     ?>'" > <button class="mdl-menu__item fa fa-delicious"><?php echo i18n::__('raza') ?></button></a>

              </ul>
            </div>
   <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('bodega', null, 'bodega') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="bodega" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="bodega">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>'" > <button class="mdl-menu__item fa fa-indent"><?php echo i18n::__('RegistrosEntrada') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexSalida') ?>'" > <button class="mdl-menu__item fa fa-outdent"><?php echo i18n::__('salida', null, 'bodega') ?></button></a>
              </ul>
            </div>

              
            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('factura') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="facturacion" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="facturacion">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>'" > <button class="mdl-menu__item fa fa-list-alt"><?php echo i18n::__('facturaCompra') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>'" > <button class="mdl-menu__item fa fa-table"><?php echo i18n::__('facturaVenta') ?></button></a>
              </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('insumo') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="insumo" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="insumo">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>'" > <button class="mdl-menu__item fa fa-sitemap"><?php echo i18n::__('insumo') ?></button></a>

              </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('personal') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="personal" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="personal">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>'" > <button class="mdl-menu__item fa fa-user-md"><?php echo i18n::__('cliente') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>'" > <button class="mdl-menu__item fa fa-male"><?php echo i18n::__('empleado') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexProveedor') ?>'" > <button class="mdl-menu__item fa fa-shopping-cart"><?php echo i18n::__('proveedor', null, 'proveedor') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>'" > <button class="mdl-menu__item fa fa-stethoscope"><?php echo i18n::__('veterinario', null, 'veterinario') ?></button></a>
              
              </ul>
            </div>
              
               <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('usuario') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="personal" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="usuario">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'index') ?>'" > <button class="mdl-menu__item glyphicon glyphicon-random"><?php echo i18n::__('userCredencial') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>'" > <button class="mdl-menu__item glyphicon glyphicon-tag"><?php echo i18n::__('credencial', null, 'credencial') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('usuario', 'indexUsuario') ?>'" > <button class="mdl-menu__item glyphicon glyphicon-user"><?php echo i18n::__('usuario', null, 'user') ?></button></a>
               </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('vacunacion', null, 'vacunacion') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="vacunacion" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="vacunacion">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>'" > <button class="mdl-menu__item fa fa-medkit"><?php echo i18n::__('registroVacunacion', null, 'animal') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>'" > <button class="mdl-menu__item fa fa-eyedropper"><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></button></a>
              </ul>
            </div>
            
         



            <div class="mdl-layout-spacer"></div>
            <a onclick="location.href='<?php echo routing::getInstance()->getUrlImg('manual usuario Administrador.pdf')?>'"<i class="mdl-color-text--blue-400 material-icons">help_outline</i></a>
          </nav>
        </div>
 <?php endif; ?>
      <?php if (session::getInstance()->hasUserId()): ?>   
        <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
          <div class="mdl-layout__header-row">
            <span class="mdl-layout-title"><?php echo i18n::__('granja') ?></span>
            <div class="mdl-layout-spacer"></div>
          
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
              <li class="mdl-menu__item fa fa-laptop"><?php echo i18n::__('sobre') ?></li>
              <li class="mdl-menu__item fa fa-phone-square"><?php echo i18n::__('contacto') ?></li>
              <li class="mdl-menu__item fa fa-legal"><?php echo i18n::__('legalInfor') ?></li>
            </ul>
          </div>
        </header>
      <?php endif; ?>
