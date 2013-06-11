
<div id="sidebar-separator"></div>

    <div id="main-content">
<div style="margin-left: 10px;">
    <a href="<?php echo go('administradores','nuevo');?>"><div class="btn btn-success icon-add-contact">&nbsp; &nbsp; Nuevo</div></a>
    <br/>
</div>
<br/>
<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Permisos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrData['usuarios'] as $user): ?>
                <tr>
                    <td><?php echo $user['usuario']; ?></td>
                    <td><?php echo $user['nombre']; ?></td>
                    <td><?php echo $user['apellidos']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><span class="badge badge-warning"><?php echo $user['permisos']; ?></span></td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('administradores','edit',array($user['administrador_id'])); ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                            <a onclick="return app.confirm('<?php echo go('administradores','delete',array($user['administrador_id'])); ?>');" href="#" class="btn btn-small"><i class="icon-trash"></i></a>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

