<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Global
 *
 * @author isai
 * 15/05/2011 00:03
 */
 class  Param {

    // variable donde se guardaran las opciones del header que se crean y se modifican en los controladores
    private static $dinamicHeader = array('title' => '' ,'css' => array(),'js'  => array() ,'meta'  => array(),'keyword'  => array());
    // variables para las alertas
    private static $systemErrors = array();
    private static $systemNotices = array();
    private static $systemMessages = array();
    private static $formMessages = array();
    private static $formErrors = array();
    private static $formNotices = array();
    private static $arrParamURL = array();
    private static $navigate = '';

    private static $global = array();
    

    public function  __construct() {
        
    }

    public static function setDinamicHeader($strKey,$strValue){
        switch($strKey){
            case 'title':
                self::$dinamicHeader[$strKey] = $strValue;
                break;
            case 'css':
               self::$dinamicHeader[$strKey][] = $strValue;
                break;
            case 'js':
                self::$dinamicHeader[$strKey][] = $strValue;
                break;
            case 'meta':
                self::$dinamicHeader[$strKey][] = $strValue;
                break;
            case 'keyword':
                self::$dinamicHeader[$strKey][] = $strValue;
                break;
            default:
                self::$dinamicHeader[$strKey] = $strValue;
                break;
        }
    }

    public  static function  getDinamicHeader($strKey){
        switch($strKey){
            case 'title':
                return self::$dinamicHeader[$strKey];
                break;
            case 'css':
               return self::$dinamicHeader[$strKey];
                break;
            case 'js':
                return self::$dinamicHeader[$strKey];
                break;
            case 'meta':
                return self::$dinamicHeader[$strKey];
                break;
            case 'keyword':
                return self::$dinamicHeader[$strKey];
                break;
            default:
                if ( isset(self::$dinamicHeader[$strKey]) ) {
                    return self::$dinamicHeader[$strKey];
                } else {
                    return null;
                }
                break;
        }
    }

    public static function setTitle($strTitle){
        self::setDinamicHeader('title', $strTitle);
    }
    public static function getTitle(){
        return self::getDinamicHeader('title');
    }
    public static function setCss($strFileName){
        self::setDinamicHeader('css', $strFileName);
    }
    public static function getCss(){
        return self::getDinamicHeader('css');
    }
    public static function setJs($strFileName){
        self::setDinamicHeader('js', $strFileName);
    }
    public static function getJs(){
        return self::getDinamicHeader('js');
    }

    // getters y setters para los alerts
    public static function setSystemError($strError)
    {
        self::$systemErrors[] = $strError;
    }
    public static function getSystemErrors()
    {
        return self::$systemErrors;
    }
    public static function setSystemNotice($strNotice)
    {
        self::$systemNotices[] = $strNotice;
    }
    public static function getSystemNotices()
    {
        return self::$systemNotices;
    }
    public static function setSystemMessage($strMessage)
    {
        self::$systemMessages[] = $strMessage;
    }
    public static function getSystemMessages()
    {
        return self::$systemMessages;
    }
    public static function setFormError($strError)
    {
        self::$formErrors[] = $strError;
    }
    public static function getFormErrors()
    {
        return self::$formErrors;
    }
    public static function setFormNotice($strNotice)
    {
        self::$formNotices[] = $strNotice;
    }
    public static function getFormNotices()
    {
        return self::$formNotices;
    }
    public static function setFormMessage($strMessage)
    {
        self::$formMessages[] = $strMessage;
    }
    public static function getFormMessages()
    {
        return self::$formMessages;
    }

    public static function set($strName,$strValue)
                {
        self::$global[$strName] = $strValue;
    }
    public static function isEmpty($arrAlert)
    {
        if (is_array($arrAlert) && count($arrAlert) > 0 ){
            return true;
        } else {
            return false;
        }
    }
    public static function get($strName)
    {
        if ( isset(self::$global[$strName]) ){
            return self::$global[$strName];
        } else {
            self::setSystemNotice('No se ha encontrado la variable '.$strName.', obtendra null de valor ');
            return null;
        }
    }

    public static function setParamURL($arrParamURL)
    {
        self::$arrParamURL = $arrParamURL;
    }
    public static function getParamURL()
    {
        return self::$arrParamURL;
    }
    
    public static function navigate($navigate,$icon=''){
        $html = '';
        $i = 0;
        foreach($navigate as $label => $link){
            if($i > 0 ){ $icon = '';}
            $html .= '<li>'
                  . '<i class="'.$icon.'"></i>'
                  .'<a href="'.$link.'">'.$label.'</a>'
                  . '<span class="divider">&raquo;</span>'
                  .'</li>';
            $i++;
        }
        self::$navigate = $html;
    }
    
    public static function getNavigate(){
        return self::$navigate;
    }
    
    public static function setMenu($menu){
        self::set('mooncake_menu', $menu);
    }
    public static function setSubMenu($submenu){
        self::set('mooncake_submenu', $submenu);
    }
    public static function getMenu(){
        return self::get('mooncake_menu');
    }
    public static function getSubmenu(){
        return self::get('mooncake_submenu');
    }
}
