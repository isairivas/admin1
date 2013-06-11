<?php
/* 
 * Nombre: index.php
 * descripcion: archivo index de el sitio
 *
 * autor: uriel isai rodriguez rivas
 * creado:1/05/2011
 */
session_save_path(dirname(__FILE__).'/session');
//$path = session_save_path();
//if (is_dir($path)) {
//    echo "directory exists\r\n";
//    echo (is_readable($path) ? "directory is readable\r\n" : "directory is not readable\r\n");
//    echo (is_writable($path) ? "directory is writable\r\n" : "directory is not writable\r\n");
//}
//else {echo "directory does not exist\r\n";};

session_start();
//save_path('');

error_reporting(0);
//$_SESSION['isai'] = date('y-m-d H:i:s'); 

require_once 'src/core/Proyect.php';
require_once 'config/Config.php';
require_once 'src/core/Loader.php';

$objProyect = Proyect::getInstance();
$objLoader = Loader::getInstance();

$Security = new Security();
if ( !isset($_SESSION['user'] )){
    if($objProyect->getClassActual() != 'Login'){
        
        Util::redirect(Proyect::getURLHome().'?section=login');
        //dump($_SESSION['isai']);
        //dump($_SESSION['user']);
    }
    
    //Util::redirect(Proyect::getURLHome().'?section=login');
} 
if ( ! $Security->isModelValid($objProyect->getClassActual()  ) ) {
    Util::redirect(Proyect::getURLHome().'?section=not-found');
}

if ( ! file_exists(Proyect::getPathController().$objProyect->getClassActual() .'.php') ){
    Util::redirect(Proyect::getURLHome().'not-found');
}

$objLoader->loadClass(Proyect::getPathController(), $objProyect->getClassActual());
$strNameClase = $objProyect->getClassActual();
$Object = new $strNameClase();















