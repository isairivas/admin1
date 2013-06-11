<div id="sidebar-separator"></div>

    <div id="main-content">
<div style="margin-left: 10px;">
    <a href="<?php echo go($arrData['_name'],'nuevo');?>"><div class="btn btn-success icon-plus-sign">&nbsp; &nbsp; Nuevo</div></a>
    <br/>
</div>
<br/>
<!--
<div class="control-group" >
    <label class="control-label" for="timepicker-basic">Filtro por mes</label>
    <div class="controls">
        <input id="filtro-mes" type="text" class="span2">
        <div style="display:inline;" class="btn btn-small" id="btn-filtro">Filtrar</div>
    </div>
</div>
-->
<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Tipo</th>
                    <th>Status</th>
                    <th style="text-align: center;">Imagenes</th>
                    <th style="text-align: center;">Organizadores</th>
                    <th style="text-align: center;">Patrocinadores</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrData['registros'] as $item): ?>
                <tr>
                    <td><?php echo $item['nombre']; ?></td>
                    <td><?php echo $item['fecha']; ?></td>
                    <td>
                        <?php echo $item['lugar_es'] ?>
                    </td>
                    <td><?php echo $item['tipo_evento']; ?></td>
                    <td>
                        <a href="<?php echo go($arrData['_name'], 'change', array($item['id'])); ?>">
                            <div class="btn <?php echo $item['sys_status'] == 'ACTIVO' ? 'btn-success' : 'btn-warning'; ?>">
                                <?php echo $item['sys_status']; ?> 
                            </div>
                        </a>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('evento-imagenes','view',array($item['id']));?>" class="btn btn-small"><i class="icon-pictures"></i></a>
                        </span>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('evento-organizadores','view',array($item['id']));?>" class="btn btn-small"><i class="icon-users"></i></a>
                        </span>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go('evento-patrocinadores','view',array($item['id']));?>" class="btn btn-small"><i class="icon-users"></i></a>
                        </span>
                    </td>
                    <td class="action-col">
                        <span class="btn-group">
                            <a href="<?php echo go($arrData['_name'],'edit',array($item['id'])); ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                            <a onclick="return app.confirm('<?php echo go($arrData['_name'],'delete',array($item['id'])); ?>');" href="#" class="btn btn-small"><i class="icon-trash"></i></a>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    //app.eventos.init('<?php //echo go('eventos','view'); ?>');
});
</script>


