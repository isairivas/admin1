<?php $registro = isset($arrData['registro'])?$arrData['registro']:array('sys_status' =>1,'categoria_id' => 0); ?>

<div id="sidebar-separator"></div>
    <div id="main-content">

        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-resize-horizontal"></i> Ingresa los datos</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-horizontal" action="<?php echo $arrData['action']; ?>" method="post" enctype="multipart/form-data" >
                        <?php if(isset($registro['id'])): ?>
                        <input type="hidden" name="registro[id]" id="id" value="<?php echo $registro['id']; ?>" />
                        <?php endif; ?>
                        
                        <div class="control-group">
                            <label class="control-label" for="categoria">Categoria</label>
                            <div class="controls">
                                <select id="categoria" name="registro[categoria_id]" class="span4 select2-select-00">
                                    <?php foreach($arrData['categorias'] as $categoria ): ?>
                                    <option <?php  echo $registro['categoria_id'] == $categoria['id']?'selected="selected"':''; ?> value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="clave">Clave</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="nombre" name="registro[clave]" value="<?php echo isset($registro['clave']) ? $registro['clave'] : ''; ?>">
                                <p class="help-block">* La clave es obligatoria <br/>* El cambiar este contenido sin previo conocimiento del mismo puede causar algun error en el sitio </p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="value_es">Valor (Espa&ntilde;ol)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="value_es" name="registro[value_es]" value="<?php echo isset($registro['value_es']) ? $registro['value_es'] : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="value_en">Valor (Ingles)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="value_en" name="registro[value_en]" value="<?php echo isset($registro['value_en']) ? $registro['value_en'] : ''; ?>">
                            </div>
                        </div>

                        
                        <div class="control-group">
                            <label class="control-label" for="status">Status</label>
                            <div class="controls">
                                <select id="status" name="registro[sys_status]" class="span4 select2-select-00">
                                    <option <?php  echo $registro['sys_status'] == 'ACTIVO'?'selected="selected"':''; ?> value="ACTIVO">ACTIVO</option>
                                    <option <?php  echo $registro['sys_status'] == 'INACTIVO'?'selected="selected"':''; ?> value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-actions" style="float: right;">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button class="btn" onclick="return cancel();">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
        function cancel(){
            window.history.back();
            return false;
        }
        </script>