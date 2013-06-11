<?php $registro = $arrData['registro']; ?>

<div id="sidebar-separator"></div>
    <div id="main-content">

        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-resize-horizontal"></i> Ingresa los datos</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-horizontal" action="<?php echo $arrData['action']; ?>" method="post" enctype="multipart/form-data" >
                        <?php if(isset($registro['pakal_imagen_id'])): ?>
                        <input type="hidden" name="registro[pakal_imagen_id]" id="administrador_id" value="<?php echo $registro['pakal_imagen_id']; ?>" />
                        <?php endif; ?>
                        <input type="hidden" name="registro[pakal_id]" value="<?php echo $arrData['pakal_id']; ?>" />
                     <div class="control-group">
                            <label class="control-label" for="titulo_es">Titulo espa&ntilde;ol:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="usuario" name="registro[titulo_es]" value="<?php echo isset($registro['titulo_es']) ? $registro['titulo_es'] : ''; ?>">
                                <p class="help-block">* Es obligatorio</p>

                            </div>
                            <label class="control-label" for="titulo_es">Titulo Ingles:</label>
                            <div class="controls">
                                <input type="text" class="span4" id="usuario" name="registro[titulo_en]" value="<?php echo isset($registro['titulo_en']) ? $registro['titulo_en'] : ''; ?>">
                                <p class="help-block"></p>
                            </div>
                        </div>
						<!--
                        <div class="control-group">
                            <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                            <div class="controls">
                                <textarea name="registro[descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php // echo isset($registro['descripcion_es']) ? $registro['descripcion_es'] : ''; ?></textarea>
                            </div>
                            <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                            <div class="controls">
                                <textarea name="registro[descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php // echo isset($registro['descripcion_en']) ? $registro['descripcion_en'] : ''; ?></textarea>
                            </div>
                        </div>
						-->
                        
                        <div class="control-group">
                            <label class="control-label" for="status">Status</label>
                            <div class="controls">
                                <select id="status" name="registro[sys_status]" class="span4 select2-select-00">
                                    <option <?php echo $registro['sys_status'] == 'ACTIVO'?'selected="selected"':''; ?> value="ACTIVO">ACTIVO</option>
                                    <option <?php echo $registro['sys_status'] == 'INACTIVO'?'selected="selected"':''; ?> value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="status">Imagen</label>
                            <div class="controls">
                                <?php if(isset($registro['imagen'])): ?>
                                <div> <img src="<?php echo HOME.'../uploads/images/pakales/thumb_admin_'.$registro['imagen']; ?>" /></div>
                                <?php endif; ?>
                                <input type="file" name="registro[imagen]" />
								<p class="help-block">280 x 300 Pixeles (muy recomendado)</p>
                            </div>
                        </div>

                        <div class="form-actions" style="float: right;">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button onclick="return cancelar();" class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        function testForm(form){
            //console.log();
            return true;
        }
        function cancelar(){
            window.location = '<?php echo go('pakal-imagenes','view',array($arrData['pakal_id'])); ?>';
            return false;
        }
    </script>