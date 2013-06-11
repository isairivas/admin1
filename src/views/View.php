<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author isai
 * 17/06/2011
 */
class View {
    public function  __construct() {
        
    }

    public static function renderForm(Form $formulario,$arrData=array())
    {?>
<div class="forms">
    <h1><?php lw_echo($arrData['title']); ?></h1>
    <div class="toolbar">
        <a href="javascript:history.go(-1);"> <img class="back" alt="regresar"  src="<?php echo HOME.'images/back.png'; ?>" /> </a>
    </div>
    <div class="form">
        <form name="<?php lw_echo($formulario->getName());?>" action="<?php lw_echo($formulario->getAction()); ?>" method="<?php lw_echo($formulario->getMethod()); ?>" enctype="multipart/form-data"  >
    <?php foreach($formulario->getInputs() as $input ): ?>
    <p><?php switch($input->getType()) :
         case InputForm::TYPE_TEXT: ?>
             <label for="<?php lw_echo($input->getId()); ?>"><?php lw_echo($input->getLabel()); ?></label>
             <input id="<?php lw_echo($input->getId()); ?>" type="text" name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" value="<?php lw_echo ($input->getValue()); ?>" />
            <?php break; ?>
         <?php case InputForm::TYPE_TEXTAREA: ?>
             <label for="<?php lw_echo($input->getId()); ?>"><?php lw_echo($input->getLabel()); ?></label>
             <textarea  id="<?php lw_echo($input->getId()); ?>" name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" cols="55" rows="15"><?php echo $input->getValue(); ?></textarea>
               <?php break; ?>
             <?php case InputForm::TYPE_DATE: ?>
             <label for="<?php lw_echo($input->getId()); ?>"><?php lw_echo($input->getLabel()); ?></label>
             <input  class="calendar" id="<?php lw_echo($input->getId()); ?>" type="text" name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" value="<?php echo Date::formatToHuman($input->getValue())?Date::formatToHuman($input->getValue()):date('d/m/Y'); ?>" />
             <img style="position: relative; top: -17px; margin-left: 260px; cursor: pointer;" class="date_toggler" src="<?php echo HOME; ?>images/calendar.gif">
            <?php break; ?>
             <?php case InputForm::TYPE_HIDDEN: ?>
             <input type="hidden"  name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" value="<?php lw_echo ($input->getValue()); ?>" />
             <?php break; ?>
             <?php case InputForm::TYPE_DROPDOWN: ?>
             <span> <?php lw_echo($input->getLabel()); ?>:</span> <select name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>">
                 <?php foreach($input->getOptions() as $key => $option): ?>
                 <option <?php echo $key==$input->getValue()?'selected="selected"':''; ?> value="<?php echo $key; ?>"><?php echo $option; ?></option>
                 <?php endforeach; ?>
             </select>
             <?php break; ?>
             <?php case InputForm::TYPE_IMAGE: ?>
             <label for="<?php lw_echo($input->getId()); ?>"><?php lw_echo($input->getLabel()); ?></label>
             <input id="<?php lw_echo($input->getId()); ?>" type="file" name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" value="<?php lw_echo ($input->getValue()); ?>" />
                <?php $imagen = $input->getValue(); if(!empty($imagen) ): ?>
                    <div style="margin-left: 330px;margin-top: -80px;">  
                        <img src="<?php echo HOME.$arrData['pathImages'].'thumb_admin_'.$input->getValue(); ?>" />
                    </div>
                <?php endif; ?>
             <?php break; ?>
			 <?php case InputForm::TYPE_FILE: ?>
             <label for="<?php lw_echo($input->getId()); ?>"><?php lw_echo($input->getLabel()); ?></label>
             <input id="<?php lw_echo($input->getId()); ?>" type="file" name="<?php echo $formulario->getName().'['.$input->getName().']'; ?>" value="<?php lw_echo ($input->getValue()); ?>" />
                <?php $imagen = $input->getValue(); if(!empty($imagen) ): ?>
                    <div style="margin-left: 330px;margin-top: -30px;">  
                      <a target="_blank" href="<?php echo HOME.$arrData['pathImages'].$input->getValue(); ?>">  <?php echo $input->getValue(); ?> </a>
                    </div>
                <?php endif; ?>
             <?php break; ?>
    <?php endswitch;?>
    </p>
    <?php endforeach; ?>
    <p><input type="submit" value="<?php echo $formulario->getTextInputSubmit(); ?>" /></p>
        </form>
    </div>
</div>
    <?php }

    /**
     * Renderisa una vista listado 
     * @param ListView $list
     */
    public static function renderList(ListView $list)
    { ?>
<div id="content">
    <h1><?php echo $list->getTitle() ;?></h1>
    <div class="toolbar">
        <ul>
            <?php foreach($list->getTools() as $objTool ) : ?>
            <li>
                <?php $objTool->generate(); ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <table>
        <thead>
            <tr>
                <?php foreach($list->getColumn() as $column ): ?>
                <th> <?php echo $column->getLabel(); ?> </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list->getRegistros() as $arrRegistro ): ?>
            <tr>
                <?php foreach($list->getColumn() as $column ): ?>
                <td> <a <?php echo !is_null($column->getAlert())?'onclick="return confirm(\' '.$column->getAlert().' \');"':''; ?> href="<?php echo is_null($column->getLinkURL())?HOME.$list->getControllerName().'/'.$column->getAction().'/'.$arrRegistro['id'] : $column->getLinkURL(); ?>"> <?php if(is_null($column->getIcon()) ) { echo $arrRegistro[$column->getName()]; }else{ echo "<img src=\"{$column->getIcon()} \" />"; }; ?></a> </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <?php }
    
}

