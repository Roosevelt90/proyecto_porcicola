<?php
use mvc\routing\routingClass as routing ?>

<?php $id = departamentoBaseTableClass::ID ?>
<?php $nombre = departamentoBaseTableClass::NOMBRE?>
        
<?php
use mvc\i18n\i18nClass as i18n ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'depto') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('departamento', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a href="<?php echo routing::getInstance()->getUrlWeb('departamento', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion()">Borrar</a>
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="active">
                         <td><input type="checkbox" id="chkAll"></td> 
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objDepto as $key): ?>
                    <tr>
                                                <td><input type="checkbox" name="chk[]" value="<?php echo $usuario->$id ?>"></td>
                   
                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$nombre ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm disabled">Ver</a>
                            <a href="<?php echo routing::getInstance()->getUrlWeb('departamento', 'edit', array(departamentoBaseTableClass::ID => $key->$id)) ?>" class="btn btn-info  btn-sm"><?php echo i18n::__('modify', NULL, 'user') ?></a>
                            <a href="#" onclick="confirmarEliminar(<?php echo $usuario->$id ?>)" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('departamento', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo departamentoBaseTableClass::getNameField(departamentoBaseTableClass::ID, true) ?>">
    </form>
</div>
<!--    paginado-->
<div class="text-right">
    <nav>
        <ul class="pagination" id="slqPaginador">
            <li class='<?php echo (($page == 1 or $page == 0) ? "disabled" : "active" ) ?>' id="anterior"><a href="#" aria-label="Previous"onclick="paginador(1, '<?php echo routing::getInstance()->getUrlWeb('departamento', 'index') ?>')"><span aria-hidden="true">&Ll;</span></a></li>
            <?php for ($x = 1; $x <= $cntPages; $x++): ?>
                <li class='<?php echo (($page == $x) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $x ?>, '<?php echo routing::getInstance()->getUrlWeb('departamento', 'index') ?>')"><a href="#"><?php echo $x ?> <span class="sr-only">(current)</span></a></li>
                <?php $count ++ ?>        
            <?php endfor ?>
            <li class='<?php echo (($page == $count) ? "disabled" : "active" ) ?>' onclick="paginador(<?php echo $count ?>, '<?php echo routing::getInstance()->getUrlWeb('departamento', 'index') ?>')" id="anterior"><a href="#" aria-label="Previous"><span aria-hidden="true">&Gg;</span></a></li>
        </ul>
    </nav>
</div>
<form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('departamento', 'delete') ?>" method="POST">
    <input type="hidden" id="idDelete" name="<?php echo departamentoTableClass::getNameField(departamentoTableClass::ID, true) ?>">



