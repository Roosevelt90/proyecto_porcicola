<?php ?>
<table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($objRaza as $key): ?>
                    <tr>
                   
                        <td><?php echo $key->id ?></td>
                        <td><?php echo $key->nombre_raza ?></td>
        
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    