<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap Stylesheet -->
<link rel="stylesheet" href="<?php echo HOME; ?>bootstrap/css/bootstrap.min.css" media="all">

<!-- jquery-ui Stylesheets -->
<link rel="stylesheet" href="<?php echo HOME; ?>assets/jui/css/jquery-ui.css" media="screen">
<link rel="stylesheet" href="<?php echo HOME; ?>assets/jui/jquery-ui.custom.css" media="screen">
<link rel="stylesheet" href="<?php echo HOME; ?>assets/jui/timepicker/jquery-ui-timepicker.css" media="screen">

<!-- Uniform Stylesheet -->
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/uniform/css/uniform.default.css" media="screen">

<!-- Plugin Stylsheets first to ease overrides -->

<!-- iButton -->
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/ibutton/jquery.ibutton.css" media="screen">

<!-- Circular Stat -->
<link rel="stylesheet" href="<?php echo HOME; ?>custom-plugins/circular-stat/circular-stat.css">

<!-- Fullcalendar -->
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/fullcalendar/fullcalendar.css" media="screen">
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/fullcalendar/fullcalendar.print.css" media="print">

<!-- End Plugin Stylesheets -->

<link rel="stylesheet" href="<?php echo HOME; ?>plugins/msgbox/jquery.msgbox.css" media="screen">

<!-- pnotify -->
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/pnotify/jquery.pnotify.css" media="screen">

<!-- Main Layout Stylesheet -->
<link rel="stylesheet" href="<?php echo HOME; ?>assets/css/fonts/icomoon/style.css" media="screen">
<link rel="stylesheet" href="<?php echo HOME; ?>assets/css/main-style.css" media="screen">
<link rel="stylesheet" href="<?php echo HOME; ?>plugins/zebradp/css/mooncake/zebra_datepicker.css" media="screen">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

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
<script type="text/javascript"
src="http://maps.google.com/maps/api/js?sensor=true"> </script>
<script src="<?php echo HOME; ?>assets/js/libs/jquery-1.8.2.min.js"></script>

<title> <?php echo Param::getTitle(); ?></title>

</head>

<body data-show-sidebar-toggle-button="true" data-fixed-sidebar="true">
    
    <!-- CONFIGURACION DEL TEMA DEL USUARIO
    <div id="customizer">
        <div id="showButton"><i class="icon-cogs"></i></div>
        <div id="layoutMode">
            <label class="checkbox"><input type="checkbox" class="uniform" name="layout-mode" value="boxed"> Boxed</label>
        </div>
    </div>
    <div id="style-changer"><a href="../simple/index.html"></a></div>
   -->
    <div id="wrapper">