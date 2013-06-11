<div id="content">
    <h1><?php echo isset($arrData['title'])?$arrData['title']:''; ?></h1>
    <div class="toolbar">
        <a href="<?php echo HOME.'usuarios/nuevo'; ?>">Nuevo</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Email</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $arrData['usuarios'] as $arrUsuario ): ?>
            <tr id="row_<?php echo $arrUsuario['id']; ?>" class="<?php echo $arrUsuario['id']%2==0?'par':'impar'; ?>" >
                <td> <a href="<?php echo Proyect::getURLHome().'usuarios/edit/'.$arrUsuario['id']; ?>"> <?php echo $arrUsuario['nombre']; ?> </a></td>
                <td> <?php echo $arrUsuario['usuario']; ?> </td>
                <td> <?php echo $arrUsuario['apellido_paterno']; ?> </td>
                <td> <?php echo $arrUsuario['apellido_materno']; ?> </td>
                <td> <?php echo $arrUsuario['email']; ?> </td>
                <td align="center"> <a title="Eliminar Usuario" href="<?php echo Proyect::getURLHome().'usuarios/delete/'.$arrUsuario['id']; ?>"> <img width="15" height="15" alt="Eliminar" src="<?php echo Proyect::getURLHome().'images/delete.png'; ?>"/> </a> </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>
