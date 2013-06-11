<?php
/* 
 * Nombre:Load.php
 * Descripcion: clase que se encargara de cargar modulos
 * autor:uriel isai rodriguez rivas
 * fecha de creacion:2/05/2011
 */


class Loader {

    private $arrClassLoaded;
    private static $thisInstance = null;
    private $template = '';

    private function  __construct()
    {}
    public static function getInstance()
    {
        if (is_null(self::$thisInstance) ){
            $strNameClass = __CLASS__;
            self::$thisInstance = new $strNameClass;
        }
        return self::$thisInstance;
    }
    public function  __clone() {
        throw new Exception('Esta clase no esta permitido clonarse');
    }
    public function load($strName)
    {
        $bolErr = false;
        $arrPartes = explode('.',$strName);
        if ( isset($arrPartes[1]) && !empty($arrPartes[1])  ) {
            $strPackage = $arrPartes[0];
            $strClassName = $arrPartes[1];
        } else {
            $strClassName = $arrPartes[0];
            $strPackage = null;
        }

        $strPath = Proyect::getPathHome().'/src/';
        if ( !empty($strPackage) ){
            if ( is_dir($strPath.$strPackage) ){
                $strPath = $strPath.$strPackage.'/';
            } else {
                Param::setSystemError('el paquete no existe o no es directorio:'.$strPath.$strPackage);
                $bolErr = true;
            }
        }
        if ( !$bolErr ){
            $this->loadClass($strPath, $strClassName);
        }
    }

    public function loadClass($strPath,$strClassName)
    {
        if ( file_exists($strPath.$strClassName.'.php')  ){
            if ( require_once ($strPath.$strClassName.'.php') ){
                $this->arrClassLoaded[] = $strPath.$strClassName.'.php';
            }
        } else {
            Param::setSystemError('no existe archivo:'.$strPath.$strClassName.'.php');
        }
    }

    public function loadView($strViewName,$arrData=null){
       include  Proyect::getPathView() .$this->template.$strViewName. '.php';
    }
    public function loadModel($strModelName)
    {
        if (file_exists(Proyect::getPathModel() .$strModelName. '.php') ){
            require_once  Proyect::getPathModel() .$strModelName. '.php';
            return new $strModelName();
        }
        
    }

    public function isDefaultModule()
    {

    }

    public function getClassLoaded()
    {
        return $this->arrClassLoaded;
    }

    public function isClassLoaded ($strPath,$strClassName)
    {
        
    }
    public function setTemplate($template){
        $this->template = $template;
    }
}
