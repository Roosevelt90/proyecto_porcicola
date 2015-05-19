<?php

use mvc\routing\routingClass as routing ?>
<?php $usu = usuarioTableClass::USER ?>
<?php $id = usuarioTableClass::ID ?>
<?php $creacion = usuarioBaseTableClass::CREATED_AT ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
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
                    <a href="#" data-target="#myModalFilter" data-toggle="modal" class="btn btn-xs btn-default active">Buscar</a>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'insert') ?>" class="btn btn-success btn-xs glyphicon glyphicon-plus">Nuevo</a>
                    <a href="#" class="btn btn-danger btn-xs glyphicon glyphicon-trash" id="btnDeleteMasivo" onclick="borrarSeleccion()">Borrar</a>
                </div>
            </div>
                <?php  view::includeHandlerMessage() ?>
            <div class="table-responsive">
            
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('usuario', null, 'user') ?></th>
                            <th><?php echo i18n::__('date', null, 'user') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
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
                                    <a href="#" class="btn btn-sm btn-danger fa fa-trash-o" data-toggle="modal" data-target="#myModalDelete<?php echo $usuario->$id ?>"><?php echo i18n::__('delete', null, 'user') ?></a>
                                </td>
                            </tr>
                            <!-- WINDOWS MODAL DELETE -->
                        <div class="modal fade" id="myModalDelete<?php echo $usuario->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirmDelete', null, 'user') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        ¿<?php echo i18n::__('bodyDelete', null, 'user') ?> <?php echo $usuario->$usu ?>?
                                        <h3>Motivo por el cual desea eliminar?</h3>
                                        <textarea name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::OBSERVACION, true) ?>">
                                            
                                        </textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger fa fa-eraser" onclick="eliminar(<?php echo $usuario->$id ?>, '<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>', '<?php echo routing::getInstance()->getUrlWeb('usuario', 'delete') ?>')">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?> //close foeach
                    </tbody>
                </table>
            </div>
    </form>
    <div class="text-right">
        <nav>
            <ul class="pagination" id="slqPaginador">
                <?php $count = 0 ?>
                <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
                <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                    <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                    <?php $count ++ ?>        
                <?php endfor ?>
                <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
            </ul>
        </nav>
    </div>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
    </form>
</div>
<!-- WINDOWS MODAL FILTERS -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('usuario', 'index') ?>">
                    
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalEliminarMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmar eliminar los elementos seleccionados</h4>
      </div>
      <div class="modal-body">
        Desea eliminar los elementos seleccionados
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()">Confirmar</button>
      </div>
    </div>
  </div>
</div>
