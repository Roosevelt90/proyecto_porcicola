<?php use mvc\routing\routingClass as routing ?>
<div>
    <form method="POST" action="../controller/config/createActionClass.php">
        <input name="1">
        <input name="2">
        <input name="3">
        <input name="4">
        <input name="5">
        <input name="6">
        <input name="7">
        <input name="8">
        <input type="submit">
    </form>
    
<!--    <form enctype="multipart/form-data" action="<?php echo routing::getInstance()->getUrlWeb('config', 'create') ?>">
        <input type="file" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
        <input type="submit">
    </form>-->
   
</div>
