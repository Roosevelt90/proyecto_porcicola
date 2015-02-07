<?php use mvc\session\sessionClass; ?>
<?php if (sessionClass::getInstance()->hasError()): ?>
  <?php foreach (sessionClass::getInstance()->getError() as $key => $error): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-remove-sign"></i> <?php echo $error ?>
    </div>
  <?php endforeach ?>
  <?php sessionClass::getInstance()->deleteErrorStack() ?>
<?php endif ?>

<?php if (sessionClass::getInstance()->hasInformation()): ?>
  <?php foreach (sessionClass::getInstance()->getInformation() as $key => $info): ?>
    <div class="alert alert-info alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-info-sign"></i> <strong>Información!</strong> <?php echo $info ?>
    </div>
  <?php endforeach ?>
  <?php sessionClass::getInstance()->deleteInformationStack() ?>
<?php endif ?>

<?php if (sessionClass::getInstance()->hasWarning()): ?>
  <?php foreach (sessionClass::getInstance()->getWarning() as $key => $warning): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-warning-sign"></i> <strong>Advertencia!</strong> <?php echo $warning ?>
    </div>
  <?php endforeach ?>
  <?php sessionClass::getInstance()->deleteWarningStack() ?>
<?php endif ?>

<?php if (sessionClass::getInstance()->hasSuccess()): ?>
  <?php foreach (sessionClass::getInstance()->getSuccess() as $key => $success): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <i class="glyphicon glyphicon-ok-sign"></i> <?php echo $success ?>
    </div>
  <?php endforeach ?>
  <?php sessionClass::getInstance()->deleteSuccessStack() ?>
<?php endif ?>