<?php
use mvc\routing\routingClass as routing ?>

<?php $id = datosUsuarioTableClass::ID ?>
<?php $nombre = datosUsuarioTableClass::NOMBRE ?>
<?php $apellidos = datosUsuarioTableClass::APELLIDOS ?>
<?php $cedula = datosUsuarioTableClass::CEDULA ?>
<?php $direccion = datosUsuarioTableClass::DIRECCION ?>
<?php $telefono = datosUsuarioTableClass::TELEFONO ?>
<?php $user = usuarioTableClass::USER  ?>
<?php $nom_ciudad = ciudadTableClass::NOMBRE ?>

    <?php
use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'datos') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <!--<a href="<?php // echo routing::getInstance()->getUrlWeb('dataUser', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>-->
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                         <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objDatos as $key): ?>
                    <tr>
                                                <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>                 
                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$user ?></td>
                        <td><?php echo $key->$nombre ?></td>
                        <td><?php echo $key->$apellidos ?></td>
                        <td><?php echo $key->$cedula ?></td>
                        <td><?php echo $key->$telefono ?></td>
                        <td><?php echo $key->$direccion ?></td>
                        <td><?php echo $key->$nom_ciudad ?></td>
                        <td>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'edit', array(datosUsuarioBaseTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo datosUsuarioTableClass::getNameField(datosUsuarioTableClass::ID, true) ?>">
    </form>
</div>

