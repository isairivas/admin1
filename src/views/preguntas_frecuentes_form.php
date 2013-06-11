<div class="forms">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="toolbar">
        <a href="<?php echo HOME.'preguntas-frecuentes'; ?>"> <img class="back" alt="regresar"  src="<?php echo HOME.'images/back.png'; ?>" /> </a>
    </div>
    <div class="form">
        <form action="<?php echo $arrData['action']; ?>" method="post">
            <input type="hidden" name="pregunta[id]" value="<?php lw_echo($arrData['pregunta']['id']); ?>" />
            <p>
                <label>Pregunta</label>
                <input type="text" name="pregunta[pregunta]" value="<?php lw_echo($arrData['pregunta']['pregunta']); ?>" />
            </p>
            
            <p>
                <label>Respuesta</label>
                <textarea cols="40" rows="5" name="pregunta[respuesta]"><?php lw_echo($arrData['pregunta']['respuesta']); ?></textarea>
            </p>
            <p>
                <input type="submit" value="Guardar" />
            </p>
        </form>
    </div>
</div>