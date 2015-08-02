<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = usuarioCredencialTableClass::ID?>
<?php $usuario_id = usuarioCredencialTableClass::USUARIO_ID ?>
<?php $credencial = usuarioCredencialTableClass::CREDENCIAL_ID ?>
<?php $countDetale = 1 ?>
<div class="container container-fluid">
    <div class="row">
        <div class="col-xs-4-offset-4 text-center">
            <h2>
                <?php  echo i18n::__('read', NULL, 'userCredencial') ?>
            </h2>
        </div>
    </div>
    <form id="frmDeleteAll" action="<?php // echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'deleteSelect') ?>" method="POST">
        <div class="row">
            <div class="col-xs-4-offset-4 text-center">
                <a id="new" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'insert') ?>" class="btn btn-sm btn-default active fa fa-plus-square"></a>
                 <div class="mdl-tooltip mdl-tooltip--large" for="new">
                    <?php echo i18n::__('registrar', null, 'ayuda') ?>
                </div>
               
                
            </div>
        </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr class="success">
                    <th><input type="checkbox" id="chkAll"></th>
                
                    <th><?php echo i18n::__('user', null, 'userCredencial') ?></th>
                    <th><?php echo i18n::__('credencial', null, 'credencial') ?></th>
                    <th><?php echo i18n::__('action') ?> </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objUsuCrede as $key): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $objUsuCrede->$id ?>"></td>
                     
                        <td><?php echo $key->$usuario_id ?></td>
                        <td><?php echo $key->$credencial ?></td>
                        <td>
                            <a id="editar<?php echo $countDetale ?>" href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'edit', array(usuarioCredencialTableClass::ID => usuarioCredencialTableClass::ID)) ?>" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">edit</i></a>
                              <div class="mdl-tooltip mdl-tooltip--large" for="editar<?php echo $countDetale ?>">
                            <?php echo i18n::__('modificar', null, 'ayuda') ?>
                        </div> 
                           
                        </td>
                    </tr>
                     <?php $countDetale++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <form id="frmDelete" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'delete') ?>" method="POST">
        <input type="hidden" id="idDelete" name="<?php echo usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true) ?>">
    </form>
</div>
