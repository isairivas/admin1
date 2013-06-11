
<?php $registro = isset($arrData['registro'])?$arrData['registro']:array('sys_status' =>''); ?>
<!--   -----------------------------INICIA VISTA FORMULARIO ----------------------- -->                            
<div id="sidebar-separator"></div>

    <div id="main-content">
        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-resize-horizontal"></i> Ingresa los datos</span>
                </div>
                <div class="widget-content form-container">
                    <form onsubmit="return testForm(this);" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo $arrData['action']; ?>">
                        <?php if(isset($registro['pakal_id'])): ?>
                        <input type="hidden" name="registro[pakal_id]" value="<?php echo $registro['pakal_id']; ?>" />
                        <?php endif; ?>
                        <input id="txtLatitud" type="hidden" name="registro[ubicacion_coordenadas_latitud]" value="<?php echo isset($registro['ubicacion_coordenadas_latitud'])?$registro['ubicacion_coordenadas_latitud']:''; ?>" />
                        <input id="txtLongitud" type="hidden" name="registro[ubicacion_coordenadas_longitud]" value="<?php echo isset($registro['ubicacion_coordenadas_longitud'])?$registro['ubicacion_coordenadas_longitud']:''; ?>" />
                        <input id="txtZoom" type="hidden" name="registro[ubicacion_coordenadas_zoom]" value="<?php echo isset($registro['ubicacion_coordenadas_zoom'])?$registro['ubicacion_coordenadas_zoom']:''; ?>" />
                        <fieldset>
                            <legend>Pakal</legend>

                            <div class="control-group">
                                <label class="control-label" for="titulo_es">Titulo espa&ntilde;ol:</label>
                                <div class="controls">
                                    <input required="required" type="text" class="span4" id="usuario" name="registro[titulo_es]" value="<?php echo isset($registro['titulo_es']) ? $registro['titulo_es'] : ''; ?>">
                                    <p class="help-block">* Es obligatorio</p>

                                </div>
                                <label class="control-label" for="titulo_es">Titulo Ingles:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="usuario" name="registro[titulo_en]" value="<?php echo isset($registro['titulo_en']) ? $registro['titulo_en'] : ''; ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                                <div class="controls">
                                    <textarea name="registro[descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php echo isset($registro['descripcion_es']) ? $registro['descripcion_es'] : ''; ?></textarea>
                                </div>
                                <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                                <div class="controls">
                                    <textarea name="registro[descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php echo isset($registro['descripcion_en']) ? $registro['descripcion_en'] : ''; ?></textarea>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Artista</legend>
                            <div class="control-group">
                                <label class="control-label" for="nombre">Nombre:</label>
                                <div class="controls">
                                    <input required="required" value="<?php echo isset($registro['artista_nombre']) ? $registro['artista_nombre'] : ''; ?>" type="text" class="span8" id="nombre" name="registro[artista_nombre]">
                                    <p class="help-block">* El nombre es requerido</p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                                <div class="controls">
                                    <textarea name="registro[artista_descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php echo isset($registro['artista_descripcion_es']) ? $registro['artista_descripcion_es'] : ''; ?></textarea>
                                </div>
                                <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                                <div class="controls">
                                    <textarea name="registro[artista_descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php echo isset($registro['artista_descripcion_en']) ? $registro['artista_descripcion_en'] : ''; ?></textarea>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label" for="titulo_es">Pagina:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="artista_pagina" name="registro[artista_pagina]" value="<?php echo isset($registro['artista_pagina']) ? $registro['artista_pagina'] : ''; ?>">
                                    <p class="help-block"></p>

                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Video</legend>
                            <div class="control-group">
                                <label class="control-label" for="titulo_es">Titulo espa&ntilde;ol:</label>
                                <div class="controls">
                                    <input maxlength="25" type="text" class="span4" id="usuario" name="registro[video_titulo_es]" value="<?php echo isset($registro['video_titulo_es']) ? $registro['video_titulo_es'] : ''; ?>">
                                    <p class="help-block"></p>

                                </div>
                                <label class="control-label" for="titulo_es">Titulo Ingles:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="usuario" name="registro[video_titulo_en]" value="<?php echo isset($registro['video_titulo_en']) ? $registro['video_titulo_en'] : ''; ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="titulo_es">Codigo:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="usuario" name="registro[video_codigo]" value="<?php echo isset($registro['video_codigo']) ? $registro['video_codigo'] : ''; ?>">
                                    <p class="help-block"></p>

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                                <div class="controls">
                                    <textarea name="registro[video_descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php echo isset($registro['video_descripcion_es']) ? $registro['video_descripcion_es'] : ''; ?></textarea>
                                </div>
                                <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                                <div class="controls">
                                    <textarea name="registro[video_descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php echo isset($registro['video_descripcion_en']) ? $registro['video_descripcion_en'] : ''; ?></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Ubicacion</legend>
							<!--
                            <div class="control-group">
                                <label class="control-label" for="titulo_es">Ubicacion espa&ntilde;ol:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="usuario" name="registro[ubicacion_es]" value="<?php // echo isset($registro['ubicacion_es']) ? $registro['ubicacion_es'] : ''; ?>">
                                    <p class="help-block"></p>

                                </div>
                                <label class="control-label" for="titulo_es">Ubicacion Ingles:</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="usuario" name="registro[ubicacion_en]" value="<?php // echo isset($registro['ubicacion_en']) ? $registro['ubicacion_en'] : ''; ?>">
                                    <p class="help-block"></p>
                                </div>
                            </div>
			 -->
                             <div class="control-group">
                                <label class="control-label" for="titulo_es">Ubicacion espa&ntilde;ol:</label>
                                <div class="controls">
                                    <div id="map_canvas" style="width: 600px;height: 250px;"></div>
                                    <p class="help-block"></p>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                                <div class="controls">
                                    <textarea name="registro[ubicacion_descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php echo isset($registro['ubicacion_descripcion_es']) ? $registro['ubicacion_descripcion_es'] : ''; ?></textarea>
                                </div>
                                <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                                <div class="controls">
                                    <textarea name="registro[ubicacion_descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php echo isset($registro['ubicacion_descripcion_en']) ? $registro['ubicacion_descripcion_en'] : ''; ?></textarea>
                                </div>
                            </div>
                            <!--
                            <div class="control-group">
                                <label class="control-label" for="input04">Foto Ubicacion</label>
                                <div class="controls">
                                    <?php // if(isset($registro['ubicacion_foto'])): ?>
                                    <div> <img src="<?php // echo HOME.'../uploads/images/ubicaciones/thumb_admin_'.$registro['ubicacion_foto']; ?>" /></div>
                                    <?php // endif; ?>
                                    <input type="file" name="registro[ubicacion_foto]" id="patrocinador_image" data-provide="fileinput">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            -->
                        </fieldset>

                        <fieldset>
                            <legend>Patrocinador</legend>
                            <div class="control-group">
                                <label class="control-label" for="input04">Logo Patrocinador</label>
                                <div class="controls">
                                    <?php if(isset($registro['patrocinador_logo'])): ?>
                                    <div> <img src="<?php echo HOME.'../uploads/images/patrocinadores/thumb_admin_'.$registro['patrocinador_logo']; ?>" /></div>
                                    <?php endif; ?>
                                    <input type="file" name="registro[patrocinador_imagen]" id="patrocinador_image" data-provide="fileinput">
                                    <p class="help-block">* Resolucion recomendada (300px X 100px)</p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="descripcion_es">Descripcion Espa&ntilde;ol:</label>
                                <div class="controls">
                                    <textarea maxlength="25" name="registro[patrocinador_descripcion_es]" class="span12 autosize" id="descripcion_es" rows="3"><?php echo isset($registro['patrocinador_descripcion_es']) ? $registro['patrocinador_descripcion_es'] : ''; ?></textarea>
                                </div>
                                <label class="control-label" for="descripcion_en">Descripcion Ingles:</label>
                                <div class="controls">
                                    <textarea maxlength="25" name="registro[patrocinador_descripcion_en]" class="span12 autosize" id="descripcion_en" rows="3"><?php echo isset($registro['patrocinador_descripcion_en']) ? $registro['patrocinador_descripcion_en'] : ''; ?></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>General</legend>
                            <div class="control-group">
                                <label class="control-label" for="status">Status</label>
                                <div class="controls">
                                    <select id="status" name="registro[sys_status]" class="span4 select2-select-00">
                                        <option value="ACTIVO" <?php echo $registro['sys_status']== 'ACTIVO'?'selected="selected"':''; ?>>ACTIVO</option>
                                        <option value="INACTIVO" <?php echo $registro['sys_status']== 'INACTIVO'?'selected="selected"':''; ?>>INACTIVO</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-actions" style="float: right;">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <button class="btn" onclick="return cancelar();" > Cancel </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- _______________________________ FIN DE LA VISTA FORMULARIO ADMIN _________________________________ -->

        <script type="text/javascript">
            function testForm(form){
                jQuery('#txtLatitud').val(app.maps.latitud);
                jQuery('#txtLongitud').val(app.maps.longitud);
                jQuery('#txtZoom').val(app.maps.zoom);
                
                return true;
            }
            window.onload = function(){
                //app.maps.init();
            }
            function cancelar(){
                window.location = '<?php echo go('pakales'); ?>';
                return false;
            }
            
            
            (function(){
                window.onload = function(){
                    var latitud = null;
                    var longitud = null;
                    var zoom = null;
                    
                    if(jQuery('#txtLatitud').val()!= '' && jQuery.isNumeric(jQuery('#txtLatitud').val()) ){
                        latitud = jQuery('#txtLatitud').val();
                    }
                    if(jQuery('#txtLongitud').val()!= '' && jQuery.isNumeric(jQuery('#txtLongitud').val()) ){
                        longitud = jQuery('#txtLongitud').val();
                    }
                    if(jQuery('#txtZoom').val()!= '' && jQuery.isNumeric(jQuery('#txtZoom').val()) ){
                        zoom = parseInt(jQuery('#txtZoom').val());
                    } 
                    app.maps.init('map_canvas',latitud ,longitud ,zoom);
                }
            })();
        </script>