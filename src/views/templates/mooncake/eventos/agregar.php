<?php $registro = isset($arrData['registro'])?$arrData['registro']:array('sys_status' =>1,'tipo_evento' => '1'); ?>

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
                            <label class="control-label" for="nombre">Nombre</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="nombre" name="registro[nombre]" value="<?php echo isset($registro['nombre']) ? $registro['nombre'] : ''; ?>">
                                <p class="help-block">* El Nombre es obligatorio </p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="fecha">Fecha</label>
                            <div class="controls">
                                <input type="text"  class="span4 datepicker-basic" id="fecha" name="registro[fecha]" value="<?php echo isset($registro['fecha']) ? $registro['fecha'] : ''; ?>">
                                <p class="help-block">* La fecha es obligatoria </p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="lugar_es">Lugar (es)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="lugar_es" name="registro[lugar_es]" value="<?php echo isset($registro['lugar_es']) ? $registro['lugar_es'] : ''; ?>">
                                <p class="help-block"> </p>
                            </div>
                            <label class="control-label" for="lugar_en">Lugar (Ingles)</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="titulo" name="registro[lugar_en]" value="<?php echo isset($registro['lugar_en']) ? $registro['lugar_en'] : ''; ?>">
                                <p class="help-block"> </p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="lugar_link">Web del lugar</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="lugar_link" name="registro[lugar_link]" value="<?php echo isset($registro['lugar_link']) ? $registro['lugar_link'] : ''; ?>">
                                <p class="help-block"> </p>
                            </div>
                        </div>
                       
                            
                        <div class="control-group">
                            <label class="control-label" for="horario_es">Horario ( Espa&ntilde;ol )</label>
                            <div class="controls">
                                <textarea  name="registro[horarios_es]" class="span12" id="horario_es" rows="3"><?php echo isset($registro['horarios_es']) ? $registro['horarios_es'] : ''; ?></textarea>
                            </div>
                            <label class="control-label" for="horario_en">Horario ( Ingles )</label>
                            <div class="controls">
                                <textarea  name="registro[horarios_en]" class="span12" id="horario_en" rows="3"><?php echo isset($registro['horarios_en']) ? $registro['horarios_en'] : ''; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="descripcion_es">Descripcion ( Espa&ntilde;ol )</label>
                            <div class="controls">
                                <textarea  name="registro[descripcion_es]" class="span12" id="descripcion_es" rows="3"><?php echo isset($registro['descripcion_es']) ? $registro['descripcion_es'] : ''; ?></textarea>
                            </div>
                            <label class="control-label" for="descripcion_en">Descripcion ( Ingles )</label>
                            <div class="controls">
                                <textarea  name="registro[descripcion_en]" class="span12" id="descripcion_en" rows="3"><?php echo isset($registro['descripcion_en']) ? $registro['descripcion_en'] : ''; ?></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="control-group">
                            <label class="control-label" for="social_facebook">Facebook</label>
                            <div class="controls">
                                <input type="text"  class="span4" id="social_facebook" name="registro[social_facebook]" value="<?php echo isset($registro['social_facebook']) ? $registro['social_facebook'] : ''; ?>">
                                <p class="help-block"> </p>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label" for="tipo_evento">Tipo Evento</label>
                            <div class="controls">
                                <select id="tipo_evento" name="registro[tipo_evento]" class="span4 select2-select-00">
                                    <option <?php  echo $registro['tipo_evento'] == 'ROSA'?'selected="selected"':''; ?> value="ROSA">ROSA</option>
                                    <option <?php  echo $registro['tipo_evento'] == 'VERDE'?'selected="selected"':''; ?> value="VERDE">VERDE</option>
                                    <option <?php  echo $registro['tipo_evento'] == 'GRIS'?'selected="selected"':''; ?> value="GRIS">GRIS</option>
                                </select>
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