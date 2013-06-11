<?php


/**
 * Description of ToolNuevo
 *  herramienta para la aplicacion "nuevo" boton para crear nuevos registros
 *
 * @author isai
 * 25/06/2011
 */
class ToolButton  extends Tool {

    function __construct() {
        parent::__construct();
    }

    public function generate() 
    { ?>
<div class="button" id="tool-<?php lw_echo(parent::getNombre()); ?>">
    <a href="<?php lw_echo(parent::getLinkUrl());  ?>">
    <?php if ( parent::getIcon() != null ): ?>
        <img alt="<?php lw_echo(parent::getLabel()); ?>" title="<?php lw_echo(parent::getLabel()); ?>" src="<?php lw_echo(parent::getIcon()); ?>"/>
    <?php else: ?>
        <span><?php lw_echo(parent::getLabel()); ?></span>
   <?php endif; ?>
    </a>
</div>
    <?php }

    
}

