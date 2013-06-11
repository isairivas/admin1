<?php if(count(Param::getFormErrors())): $strError = ''; ?>
    <div style="width: 800px; height: 80px;margin-left: 50px;" id="adm-content-error" >
    <br/>
    <?php foreach (Param::getFormErrors() as $error){ $strError .= '- '.$error.'<br/>'; } ?>
    <div class="alert alert-danger fade in " >
        <a href="#" onclick="$('#adm-content-error').css('display','none');" class="close" data-dismiss="alert">&times;</a>
        <strong>Errores:</strong><br>
        <?php echo $strError; ?>
    </div> 
    </div>    
    <?php endif; ?>
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <?php echo Param::getNavigate(); ?>
        </ul>

        <h1 id="main-heading">
            <?php echo Param::getTitle(); ?> <!-- <span>..</span> -->
        </h1>
    </div>