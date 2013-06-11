<div id="content">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="toolbar">
        <a href="<?php echo HOME.'bugs/reportar'; ?>">Reportar Bug</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Seccion</th>
                <th>Situacion</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $arrData['registros'] as $arrBug ): ?>
            <tr id="row_<?php echo $arrBug['id']; ?>" class="<?php echo $arrBug['id']%2==0?'par':'impar'; ?>" >
                <td> <a href="<?php echo Proyect::getURLHome().'bugs/edit/'.$arrBug['id']; ?>"> <?php echo $arrBug['titulo']; ?> </a></td>
                <td> <?php echo $arrBug['seccion']; ?> </td>
                <td> <?php echo $arrBug['situacion']; ?> </td>
                <td align="center"> <a title="Eliminar Bug" href="<?php echo HOME.'bugs/delete/'.$arrBug['id']; ?>"> <img width="15" height="15" alt="Eliminar" src="<?php echo Proyect::getURLHome().'images/delete.png'; ?>"/> </a> </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
