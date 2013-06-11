<div class="forms">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="form">
        <div style="float: right;"><a href="<?php echo HOME.'bugs'; ?>">Ver Listado</a></div>
        <form action="<?php echo $arrData['action']; ?>" method="post">
            <input type="hidden" name="bug[id]" value="<?php lw_echo($arrData['bug']['id']); ?>" />
            <p>
                <label>Titulo</label>
                <input type="text" name="bug[titulo]" value="<?php lw_echo($arrData['bug']['titulo']); ?>" />
            </p>
            <p>
                <label>Seccion</label>
                <input type="text" name="bug[seccion]" value="<?php lw_echo($arrData['bug']['seccion']); ?>" />
            </p>
            <p>
                <label>Descripcion </label>
                <textarea cols="40" rows="5" name="bug[descripcion]"><?php lw_echo($arrData['bug']['descripcion']); ?></textarea>
            </p>
            <p>
                <label>Detalle </label>
                <textarea cols="50" rows="8" name="bug[detalle]"><?php lw_echo($arrData['bug']['detalle']); ?></textarea>
            </p>
            <p>
                <label>Imagen</label>
                <input type="file" name="image[imagen]"  />
            </p>
            <p>
                <input type="submit" value="Guardar" />
            </p>
        </form>
    </div>
</div>
