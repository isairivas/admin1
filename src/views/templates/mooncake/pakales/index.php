<div id="sidebar-separator"></div>

    <div id="main-content">
<div style="margin-left: 10px;">
    <a href="<?php echo go('pakales','nuevo');?>"><div class="btn btn-success icon-plus-sign">&nbsp; &nbsp; Nuevo</div></a>
    <br/>
</div>
<br/>
<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Titulo (ingles)</th>
                    <th>Artista</th>
                    <th>Ubicacion</th>
                    <td>Status</td>
                    <th style="text-align: center;">Imagenes</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrData['registros'] as $item): ?>
                <tr>
                    <td><?php echo $item['titulo_es']; ?></td>
                    <td><?php echo $item['titulo_en']; ?></td>
                    <td><?php echo $item['artista_nombre']; ?></td>
                    <td><?php echo $item['ubicacion_es']; ?></td>
                    <td>
                        <a href="<?php echo go($arrData['_name'], 'change', array($item['pakal_id'])); ?>">
                            <div class="btn <?php echo $item['sys_status'] == 'ACTIVO' ? 'btn-success' : 'btn-warning'; ?>">
                                <?php echo $item['sys_status']; ?> 
                            </div>
                        </a>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('pakal-imagenes','view',array($item['pakal_id']));?>" class="btn btn-small"><i class="icon-pictures"></i></a>
                        </span>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('pakales','edit',array($item['pakal_id'])); ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                            <a onclick="return app.confirm('<?php echo go('pakales','delete',array($item['pakal_id'])); ?>');" href="#" class="btn btn-small"><i class="icon-trash"></i></a>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


