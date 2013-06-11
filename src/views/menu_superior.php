<div id="top">
    <div id="logo">
        <a href="<?php echo Proyect::getURLHome(); ?>"> 
            <img  src="<?php echo Proyect::getURLHome().'images/logo.png'; ?>" alt="goiti" title="Goiti"/>
        </a>
        
    </div>
    <div class="wrapper1">
        <div class="wrapper"  style="width:1050px;">
            <div class="nav-wrapper">
                <div class="nav-left"></div>
                <div class="nav">
                    <ul id="navigation" style="width:860px;">

                    <?php foreach(Config::getMenuElements() as $strTitle => $arrItems ): ?>
                        <li class="#">
                            <a href="" target="_self">
                                <span class="menu-left"></span>
                                <span class="menu-mid"><?php echo $strTitle; ?></span>
                                <span class="menu-right"></span>
                            </a>
                            <?php if( is_array($arrItems) ): ?>
                            <div class="sub">
                                <ul>
                                    <?php foreach($arrItems as $strTitleItem => $strLinkToURL ): ?>
                                    <?php $bolEncontrado = strpos($strLinkToURL,'|');
                                          if ( $bolEncontrado !== false ){
                                              $arrPartes = explode('|', $strLinkToURL);
                                              $strTarget = '_'.$arrPartes[0];
                                              $strLinkToURL = $arrPartes[1];
                                          } else { $strTarget = '_self';}
                                    ?>
                                    <li>
                                        <a href="<?php echo $strLinkToURL; ?>" target="<?php echo $strTarget; ?>"><?php echo $strTitleItem; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </li>
                     <?php endforeach; ?>
                       

                    </ul>
                </div>
                <div class="nav-right"></div>
                <br><br>

            </div>
        </div>
    </div>
</div>
<?php include 'alerts.php' ?>



