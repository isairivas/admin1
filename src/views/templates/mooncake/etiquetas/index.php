<div id="sidebar-separator"></div>

    <div id="main-content">
        
        <div class="controls" style="float: right;">
            Filtro Categoria : 
            <select id="filtroCategoria" name="registro[categoria_id]" class="span3 select2-select-00">
                <option value="-1">Todos</option>
                <?php foreach ($arrData['categorias'] as $categoria): ?>
                    <option <?php echo $arrData['filtroCategoria'] == $categoria['id']?'selected="selected"':''; ?>  value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
<div style="margin-left: 10px;">
    <a href="<?php echo go($arrData['_name'],'nuevo');?>"><div class="btn btn-success icon-plus-sign">&nbsp; &nbsp; Nuevo</div></a>
    <br/>
</div>
<br/>

<div class="widget">
    <div class="widget-content table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Valor (Espa&ntilde;ol)</th>
                    <th>Valor (ingles)</th>
                    <th>Categoria</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrData['registros'] as $item): ?>
                <tr>
                    <td><?php echo $item['clave']; ?></td>
                    <td>
                        <?php echo $item['value_es']; ?>
                    </td>
                    <td>
                        <?php echo $item['value_en']; ?>
                    </td>
                    <td>
                        <?php echo $item['nombre_categoria']; ?>
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
   
(function(){
    jQuery(document).ready(function(){
        app.etiquetas.filtroCategoria('<?php echo go($arrData['_name'],'index'); ?>');
    });
})();
</script>

