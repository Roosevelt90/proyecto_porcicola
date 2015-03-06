<?php

use mvc\routing\routingClass as routing ?>
<?php $usu = usuarioTableClass::USER ?>
<?php $id = usuarioTableClass::ID ?>
<?php $creacion = usuarioBaseTableClass::CREATED_AT ?>
<?php

use mvc\i18n\i18nClass as i18n ?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
<?php echo i18n::__('read', NULL, 'user') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'deleteSelect') ?>" method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col-xs-4-offset-4 nuevo">
                    <a href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'insert') ?>" class="btn btn-success btn-xs glyphicon glyphicon-plus">Nuevo</a>
                    <a href="#" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="borrarSeleccion()">Borrar</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th>Usuario</th>
                            <th>Fecha de creacion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
<?php foreach ($objUsuarios as $usuario): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $usuario->$id ?>"></td>
                                <td><?php echo $usuario->$usu ?></td>
                                <td><?php echo $usuario->$creacion ?></td>
                                <td>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('dataUser', 'index', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="btn btn-warning btn-sm glyphicon glyphicon-user">Ver</a>
                                    <a href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'edit', array(usuarioTableClass::ID => $usuario->$id)) ?>" class="btn btn-info  btn-sm fa fa-pencil-square-o"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                                    <a href="#" onclick="confirmarEliminar(<?php echo $usuario->$id ?>)" class="disabled btn btn-danger btn-sm">Eliminar</a>
                                    <a href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $usuario->$id ?>"><?php echo i18n::__('delete', null, 'user') ?></a>
                                </td>
                            </tr>

                        <div class="modal fade" id="myModalDelete<?php echo $usuario->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete', null, 'user') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                      ¿<?php echo i18n::__('bodyDelete', null, 'user') ?> <?php echo $usuario->$usu ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $usuario->$id ?>, '<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('usuario', 'delete') ?>')">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php endforeach ?>
                    </tbody>
                </table>
            </div>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
    </form>
</div>
