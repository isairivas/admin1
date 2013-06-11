<div id="content">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="toolbar">
        <a href="<?php echo HOME.'preguntas-frecuentes/nueva'; ?>">Nueva pregunta</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Pregunta</th>
                <th>Situacion</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $arrData['registros'] as $arrPregunta ): ?>
            <tr id="row_<?php echo $arrPregunta['id']; ?>" class="<?php echo $arrPregunta['id']%2==0?'par':'impar'; ?>" >
                <td> <a href="<?php echo Proyect::getURLHome().'preguntas-frecuentes/edit/'.$arrPregunta['id']; ?>"> <?php echo $arrPregunta['pregunta']; ?> </a></td>
                <td> <?php echo $arrPregunta['situacion']; ?> </td>
                <td align="center"> <a title="Eliminar Usuario" href="<?php echo HOME.'preguntas-frecuentes/delete/'.$arrPregunta['id']; ?>"> <img width="15" height="15" alt="Eliminar" src="<?php echo Proyect::getURLHome().'images/delete.png'; ?>"/> </a> </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

