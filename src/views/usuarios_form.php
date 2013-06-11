<div class="forms">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="toolbar">
        <a href="<?php echo HOME.'usuarios'; ?>"> <img class="back" alt="regresar"  src="<?php echo HOME.'images/back.png'; ?>" /> </a>
    </div>
    <div class="form">
        <form action="<?php echo $arrData['action']; ?>" method="post">
            <input type="hidden" name="usuario[id]" value="<?php lw_echo($arrData['usuario']['id']); ?>" />
            <p>
                <label>Nombre</label>
                <input type="text" name="usuario[nombre]" value="<?php lw_echo($arrData['usuario']['nombre']); ?>" />
            </p>
            <p>
                <label>Apellido Paterno</label>
                <input type="text" name="usuario[apellido_paterno]" value="<?php lw_echo($arrData['usuario']['apellido_paterno']); ?>" />
            </p>
            <p>
                <label>Apellido materno</label>
                <input type="text" name="usuario[apellido_materno]" value="<?php lw_echo($arrData['usuario']['apellido_materno']); ?>" />
            </p>
            <p>
                <label>Usuario</label>
                <input type="text" name="usuario[usuario]" value="<?php lw_echo($arrData['usuario']['usuario']); ?>" />
            </p>
            <p>
                <label>Password</label>
                <input type="password" name="usuario[password]" />
            </p>
            <p>
                <label>Email</label>
                <input  type=text" name="usuario[email]" value="<?php lw_echo($arrData['usuario']['email']); ?>" />
            </p>
            <p>
                <label>Notas</label>
                <textarea cols="40" rows="5" name="usuario[notas]"></textarea>
            </p>
            <p>
                <input type="submit" value="Guardar" />
            </p>
        </form>
    </div>
</div>