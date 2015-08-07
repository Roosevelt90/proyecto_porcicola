<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo \mvc\config\configClass::getUrlBase(), \mvc\config\configClass::getIndexFile() ?>">Soveuh System |</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Sistema <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index') ?>">Admin. Usuarios</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'index') ?>">Credenciales</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>">Localizacion</a></li>
            <li class="divider"></li>
            <li><a href="#">Ayuda</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empleados <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>">Empleado</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>">Cargo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'index') ?>">Tipo de Identificacion</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produccion <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Lote</a></li>
            <li><a href="#">Control de Lote</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>">Raza</a></li>
            <li class="divider"></li>
            <li><a href="#">Ambiente</a></li>
            <li><a href="#">Tipo de Ambiente</a></li>
            <li class="divider"></li>
            <li><a href="#">Postura</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bodega <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Insumo</a></li>
            <li><a href="#">Presentacion de Insumo</a></li>
            <li><a href="#">Tipo de Insumo</a></li>
            <li><a href="#">Trasportador de Insumo</a></li>
            <li><a href="">Unidad de Medida</a></li>
            <li class="divider"></li>
            <li><a href="">Requisicion</a></li>
            <li><a href="#">Salida de Bodega</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Maquinaria Y Equipos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Maquinas Y Equipos</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mano de Obra <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Alistamiento de Galpon</a></li>
            <li><a href="#">Desinfeccion</a></li>
            <li><a href="#">Tipo de Desinfeccion</a></li>
            <li><a href="#">Reparacion</a></li>
            <li><a href="#">Tipo de Reparacion</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\config\configClass::getUrlBase(). \mvc\config\configClass::getIndexFile() ?>/controlAlimento/index">Control Alimento</a></li>
            <li><a href="#">Control Roedores</a></li>
            <li><a href="#">Control Compostaje</a></li>
            <li><a href="#">Control Cucarron</a></li>
            <li class="divider"></li>
            <li><a href="#">Forma de Aplicacion</a></li>
            <li><a href="#">Cajon Compostaje</a></li>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Sesion <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Cambiar Contraseña</a></li>
            <li class="divider"></li>
            <li><a href="#">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
