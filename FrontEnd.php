<?php

/**
 * Description of FrontEnd
 *
 * @author isai
 */
class FrontEnd {
    function __construct() {
        session_start();
        $this->initLang();
    }
    
    public function initLang(){
        define('_L', '_es');
    }
    
    public function pakales(){
        require_once 'admin/src/models/Pakal.php';
        $modelDB = new Pakal();
        $pakales = $modelDB->getAll();
        return $pakales;
    }
    
    public function detalle(){
        if(isset($_GET['id']) && is_numeric($_GET['id']) ){
            require_once 'admin/src/models/Pakal.php';
            $id = $_GET['id'];
            $modelDB = new Pakal();
            $pakales = $modelDB->getPakal($id);
        return $pakales;
        } else {
            return false;
        }
    }

}


