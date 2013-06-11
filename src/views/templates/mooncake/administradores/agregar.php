<?php $registro = $arrData['usuario']; ?>

<div id="sidebar-separator"></div>
    <div id="main-content">

        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-resize-horizontal"></i> Ingresa los datos</span>
                </div>
                <div class="widget-content form-container">
                    <form class="form-horizontal" action="<?php echo $arrData['action']; ?>" method="post" >
                        <?php if(isset($registro['administrador_id'])): ?>
                        <input type="hidden" name="registro[administrador_id]" id="administrador_id" value="<?php echo $registro['administrador_id']; ?>" />
                        <?php endif; ?>
                        <div class="control-group">
                            <label class="control-label" for="usuario">Usuario</label>
                            <div class="controls">
                                <input type="text" class="span4" id="usuario" name="registro[usuario]" value="<?php echo isset($registro['usuario']) ? $registro['usuario'] : ''; ?>">
                                <p class="help-block">* El Usuario es obligatorio</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" class="span4" id="password" name="registro[password]">
                                <p class="help-block"></p>
                            </div>
                            <label class="control-label" for="repassword">Repite el Password</label>
                            <div class="controls">
                                <input type="password" class="span4" id="repassword" name="registro[repassword]">
                                <p class="help-block">Para dejar igual, dejarlo en blanco estos campos</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="nombre">Nombre</label>
                            <div class="controls">
                                <input value="<?php echo isset($registro['nombre']) ? $registro['nombre'] : ''; ?>" type="text" class="span8" id="nombre" name="registro[nombre]">
                                <p class="help-block">* El nombre es requerido</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="apellidos">Apellidos</label>
                            <div class="controls">
                                <input value="<?php echo isset($registro['apellidos']) ? $registro['apellidos'] : ''; ?>" type="text" class="span12" id="apellidos" name="registro[apellidos]">
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input value="<?php echo isset($registro['email']) ? $registro['email'] : ''; ?>" type="email" class="span4" id="email" name="registro[email]">
                                <p class="help-block">* El email es requerido</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="notas">Notas</label>
                            <div class="controls">
                                <textarea name="registro[notas]" class="span12" id="notas" rows="3"><?php echo isset($registro['notas']) ? $registro['notas'] : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="permisos">Permisos</label>
                            <div class="controls">
                                <select id="permisos" placeholder="Elige un permiso" class="span4 select2-select-00" name="registro[permisos]">
                                    <option <?php echo $registro['permisos'] == 1?'selected="selected"':''; ?> value="1">Lectura</option>
                                    <option <?php echo $registro['permisos'] == 2?'selected="selected"':''; ?> value="2">Escritura / Editar</option>
                                    <option <?php echo $registro['permisos'] == 3?'selected="selected"':''; ?> value="3">Eliminar</option>
                                    <option <?php echo $registro['permisos'] == 4?'selected="selected"':''; ?> value="4">Administrador</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="status">Status</label>
                            <div class="controls">
                                <select id="status" name="registro[status]" class="span4 select2-select-00">
                                    <option <?php echo $registro['sys_status'] == 'ACTIVO'?'selected="selected"':''; ?> value="ACTIVO">ACTIVO</option>
                                    <option <?php echo $registro['sys_status'] == 'INACTIVO'?'selected="selected"':''; ?> value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-actions" style="float: right;">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>