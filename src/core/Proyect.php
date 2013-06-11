<?php
/*
 * Nombre: Main.php
 * descripcion: clase principal del proyecto
 *
 * autor: uriel isai rodriguez rivas
 * creado:2/05/2011
 */


class Proyect {

    private $Config;
    private $arrPartesURL;
    private $Load;
    private static $objInstance = null;
    
    private function  __construct() {

       
        $this->Load = Loader::getInstance();
        $this->Config = Config::getInstance();
        $this->loadDefaultModules();
        $this->arrPartesURL = explode( '/', $_SERVER['REQUEST_URI']);
        Param::setParamURL($this->getParamsURL());
    }
    public static function getInstance()
    {
        if ( is_null(self::$objInstance) ){
            $strClassName = __CLASS__;
            self::$objInstance = new $strClassName;
        }
        return self::$objInstance;
    }
    public function  __clone() {
        throw new Exception('Esta clase no esta permitido clonarse');
    }
    public function setLoad(Load $load){
        $this->Load = $load;
    }
    public function getLoad(){
        return $this->Load;
    }

    public function getConfig(){
        return $this->Config;
    }
    public function loadDefaultModules(){

        $arrModules = $this->Config->getDefaultModules();
        foreach($arrModules as $module ){
            $this->Load->load($module);
        }
        
    }

    public function getClassActual(){
        if(isset($_GET['section']) && is_string($_GET['section'])){
            $strClassName = ucfirst($_GET['section']);
            $bolEncontrado = strpos($strClassName,'-');
            if ( $bolEncontrado !== false  ){
                $arrPartes = explode('-', $strClassName);
                $strClassName = '';
                foreach($arrPartes as $strParte ){
                    $strClassName .= ucfirst($strParte);
                }
            }
            return $strClassName;
        } else {
            return 'Home';
        }
    }
    public function getClassActual2(){
        if( isset($this->arrPartesURL[self::getPositionClassName()] ) && !empty($this->arrPartesURL[self::getPositionClassName()] ) ){
             $strClassName = ucfirst($this->arrPartesURL[self::getPositionClassName()]);
             $bolEncontrado = strpos($strClassName,'-');
            if ( $bolEncontrado !== false  ){
                $arrPartes = explode('-', $strClassName);
                $strClassName = '';
                foreach($arrPartes as $strParte ){
                    $strClassName .= ucfirst($strParte);
                }
            }
            return $strClassName;
        } else {
            return 'Home';
        }
    }

    public function setClassActual($strClassName){
        
    }

    public function getActionActual(){
        if(isset($_GET['action']) && is_string($_GET['action'])){
            return $_GET['action'];
        } else {
            return 'index';
        }
    }
    public function getActionActual2(){
        if( isset($this->arrPartesURL[self::getPositionClassName()+1] ) && !empty($this->arrPartesURL[self::getPositionClassName()+1] )  ){
             return $this->arrPartesURL[self::getPositionClassName()+1];
        } else {
            return 'index';
        }
    }
    public function getParamsURL(){
        $arrParams = array();
        for($i=1;$i<5;$i++){
            if(isset($_GET['param'.$i])){
                $arrParams[] = $_GET['param'.$i];
            }
        }
        return $arrParams;
    }
    public function getParamsURL2(){
        $arrParams = array();
        if ( count($this->arrPartesURL) > self::getPositionClassName()+2 ){
            for ( $intContador = 0; $intContador < (count($this->arrPartesURL) -(self::getPositionClassName()+2 ) ); $intContador++ ){
                $arrParams[] = $this->arrPartesURL[(self::getPositionClassName()+2)+$intContador];
            }

        }
        return $arrParams;
    }

    public static function getPathHome() {
        $strPath = $_SERVER['SCRIPT_FILENAME'];
        $arrPartes = explode('/', $strPath);
        unset($arrPartes[count($arrPartes) - 1]);
        $strPath = implode('/', $arrPartes) . '/';
        return $strPath;
    }

    public static function getPathController() {
        return $strURLController = self::getPathHome() . 'src/controllers/';
    }


    public static function getPathView(){
        return self::getPathHome() . 'src/views/';
    }
    public static function getPathModel(){
        return self::getPathHome() . 'src/models/';
    }

    public static function getURLHome() {
        $strURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $arrPartes = explode('/', $strURL);
        unset($arrPartes[count($arrPartes) - 1]);
        $strURL = implode('/', $arrPartes) . '/';
        return $strURL;
    }

      public static function getPositionClassName(){
       return count( explode('/',self::getURLHome() ) )-3;
    }

    

}

