<div id="sidebar-separator"></div>

<div id="main-content">
    <div style="margin-left: 10px;">
        <a href="<?php echo go('pakal-imagenes','nuevo',array($arrData['pakal_id'])); ?>"><div class="btn btn-success icon-plus-sign">&nbsp; &nbsp; Nuevo</div></a>
        <br/>
    </div>
    <br/>
	<div><span class="badge badge-warning">Nota: la imagen principal ser&aacute; la primer imagen listada.</span></div>
	<br/>
    <div class="widget">
        <div class="widget-content table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Titulo (ingles)</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arrData['registros'] as $item): ?>
                        <tr>
                            <td><?php echo $item['titulo_es']; ?></td>
                            <td><?php echo $item['titulo_en']; ?></td>
                            <td class="action-col">
                                <span class="btn-group">
                                    <a href="<?php echo go('pakal-imagenes','edit',array($item['pakal_imagen_id'])); ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                                    <a onclick="return app.confirm('<?php echo go('pakal-imagenes','delete',array($item['pakal_imagen_id'])); ?> ?>');" href="#" class="btn btn-small"><i class="icon-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
