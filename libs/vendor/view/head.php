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
                <a href="#"> <button class="mdl-menu__item "><?php echo i18n::__('configuracion') ?></button></a>
                <a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>"> <button class="mdl-menu__item"><?php echo i18n::__('Exit') ?></button></a>
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
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('animal', 'indexAnimal')     ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('animal') ?></button></a>
                <a onclick="location.href = '<?php  echo routing::getInstance()->getUrlWeb('animal', 'indexLote')     ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('lote') ?></button></a>
                <a onclick="location.href = '<?php  echo routing::getInstance()->getUrlWeb('animal', 'indexRaza')     ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('raza') ?></button></a>
              </ul>
            </div>
   <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span>Bodega</span>
              <div class="mdl-layout-spacer"></div>
              <button id="bodega" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="bodega">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexEntrada') ?>'" > <button class="mdl-menu__item">Entrada bodega</button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('bodega', 'indexSalida') ?>'" > <button class="mdl-menu__item">Salida bodega</button></a>
              </ul>
            </div>

              
            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('factura') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="facturacion" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="facturacion">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaCompra') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('facturaCompra') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('factura', 'indexFacturaVenta') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('facturaVenta') ?></button></a>
              </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('insumo') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="insumo" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="insumo">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('insumo', 'index') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('insumo') ?></button></a>

              </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('personal') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="personal" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="personal">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexCliente') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('cliente') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexEmpleado') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('empleado') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexProveedor') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('proveedor', null, 'proveedor') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('personal', 'indexVeterinario') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('veterinario', null, 'veterinario') ?></button></a>
              
              </ul>
            </div>

            <div class="demo-avatar-dropdown" style="margin-left: 5px">
              <span><?php echo i18n::__('vacunacion', null, 'vacunacion') ?></span>
              <div class="mdl-layout-spacer"></div>
              <button id="vacunacion" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                <i class="material-icons">arrow_drop_down</i>
              </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="vacunacion">
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('registroVacunacion', null, 'vacunacion') ?></button></a>
                <a onclick="location.href = '<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacuna') ?>'" > <button class="mdl-menu__item"><?php echo i18n::__('vacuna', null, 'detalleVacunacion') ?></button></a>
              </ul>
            </div>
            
         



            <div class="mdl-layout-spacer"></div>
            <a class="mdl-navigation__link" href="http://help.com"><i class="mdl-color-text--blue-grey-400 material-icons">help_outline</i></a>
          </nav>
        </div>
      <?php endif; ?>
      <?php if (session::getInstance()->hasUserId()): ?>   
        <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
          <div class="mdl-layout__header-row">
            <span class="mdl-layout-title"><?php echo i18n::__('granja') ?></span>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
              <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                <i class="material-icons"><?php echo i18n::__('buscar') ?></i>
              </label>
              <div class="mdl-textfield__expandable-holder">
                <input class="mdl-textfield__input" type="text" id="search" />
                <label class="mdl-textfield__label" for="search"><?php echo i18n::__('ingBusqueda') ?></label>
              </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
              <li class="mdl-menu__item"><?php echo i18n::__('sobre') ?></li>
              <li class="mdl-menu__item"><?php echo i18n::__('contacto') ?></li>
              <li class="mdl-menu__item"><?php echo i18n::__('legalInfor') ?></li>
            </ul>
          </div>
        </header>
      <?php endif; ?>
