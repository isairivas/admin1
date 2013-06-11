<?php include 'doctype.php'; ?>
<title> 
<?php  if ( Param::getTitle() != null )
    {echo Param::getTitle();}else {echo Config::getTitle();}?> </title>
        <?php if (is_array(Config::get('css')) ) : ?>
            <?php foreach(Config::get('css') as $strNameFile ): ?>
                <link type="text/css" rel="stylesheet" href="<?php echo Proyect::getURLHome().'scripts/css/'.$strNameFile; ?>.css" />
            <?php endforeach; ?>
        <?php endif; ?>
        <?php foreach(Param::getCss() as $strNameFile ): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo Proyect::getURLHome().'scripts/css/'.$strNameFile; ?>.css" />
        <?php endforeach; ?>
       <?php if (is_array(Config::get('js')) ) : ?>
           <?php foreach(Config::get('js') as $strNameFile ): ?>
                <script type="text/javascript" src="<?php echo Proyect::getURLHome().'scripts/js/'.$strNameFile; ?>.js"></script>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php foreach(Param::getJs() as $strNameFile ): ?>
            <script type="text/javascript" src="<?php echo Proyect::getURLHome().'scripts/js/'.$strNameFile; ?>.js"></script>
        <?php endforeach; ?>
    </head>
    <body>
        <div id="main-content">

        
        
        
