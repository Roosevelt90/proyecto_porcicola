<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = credencialTableClass::ID ?>
<?php $nombre = credencialTableClass::NOMBRE ?>
<?php  $countDetale = 1 ?>


<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 titulo">
            <h2>
                <?php echo i18n::__('read', NULL, 'credencial') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 nuevo">
                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'insert') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
                 <a id="deleteMasa" href="#" class="btn btn-default btn-sm fa fa-trash-o" onclick="borrarSeleccion()"></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="deleteMasa">
                    <?php echo i18n::__('eliminarMasa', null, 'ayuda') ?>
                </div>
        </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="success">
                    <td><input type="checkbox" id="chkAll"></td> 
                    <th><?php echo i18n::__('id') ?></th>
                    <th><?php echo i18n::__('name') ?></th>
                    <th><?php echo i18n::__('action') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objCredencial as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $key->$id ?>"></td>
                        <td><?php echo $key->$id ?></td>
                        <td><?php echo $key->$nombre ?></td>
                        <td>
                            <!--<a href="#" class="btn btn-warning btn-sm disabled">Ver</a>-->
                            <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'edit', array(credencialBaseTableClass::ID => $key->$id)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored"><i class="material-icons">edit</i></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                                <?php echo i18n::__('modificar', null, 'ayuda') ?>
                            </div> 
                            <a id="eliminar<?php echo $countDetale ?>" href="#" onclick="confirmarEliminar(<?php echo $key->$id ?>)" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored"><i class="material-icons">delete</i></a>
                            <div class="mdl-tooltip mdl-tooltip--large" for="eliminar<?php echo $countDetale ?>">
                                <?php echo i18n::__('eliminar', null, 'ayuda') ?>
                            </div> 
                        </td>
                    </tr>
                    <?php  $countDetale++ ?>
                <?php endforeach//close foreach  ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID, true) ?>">
    </form>
</div>

