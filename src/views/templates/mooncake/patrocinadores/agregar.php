<?php $registro = isset($arrData['registro'])?$arrData['registro']:array('sys_status' =>1); ?>

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
                            <label class="control-label" for="nombre_es">Nombre (es)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="nombre_es" name="registro[nombre_es]" value="<?php echo isset($registro['nombre_es']) ? $registro['nombre_es'] : ''; ?>">
                                <p class="help-block">* El Titulo es obligatorio </p>
                            </div>
                            <label class="control-label" for="nombre_en">Nombre (Ingles)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="titulo" name="registro[nombre_en]" value="<?php echo isset($registro['nombre_en']) ? $registro['nombre_en'] : ''; ?>">
                                <p class="help-block">* El Titulo es obligatorio </p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="link">Link</label>
                            <div class="controls">
                                <input type="text" class="span4" id="link" name="registro[link]" value="<?php echo isset($registro['link']) ? $registro['link'] : ''; ?>">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="imagen">Imagen</label>
                            <div class="controls">
                                <?php if(isset($registro['imagen'])): ?>
                                <div> <img src="<?php echo HOME.'../uploads/images/patrocinadores/thumb_admin_'.$registro['imagen']; ?>" /></div>
                                <?php endif; ?>
                                <input type="file" name="registro[imagen]" />
                                <p class="help-block"> Resolucion recomendada (310px X 170px)</p>
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