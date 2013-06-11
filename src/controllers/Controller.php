<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author isai
 */
class Controller {

   private $Proyect ;
   private $Load;
   protected $arrPost;
   private $bolErrorFormStatus ;
   private $arrErrorFormNames;

   public function  __construct()
   {
       $this->Proyect = Proyect::getInstance();
       $this->Load =   Loader::getInstance();
       $this->bolErrorFormStatus = true;
       $this->arrErrorFormNames = array();
       $this->catchPostParameter();
   }

   public function getAction()
   {
       $strAction = $this->Proyect->getActionActual();
       if ( isset($strAction) && !empty ($strAction) ) {
           return $this->Proyect->getActionActual();
       } else {
           return 'index';
       }
   }
   private function catchPostParameter()
    {
       $InputFilterXss = new InputFilterXss();
        if ( is_array($_POST) && count($_POST) > 0 ){
            $this->arrPost = $InputFilterXss->process($_POST);
           // $this->arrPost =$_POST;
        }
    }
    protected function getPost($strNameParameter,$strFilter = null,$bolRequired = false)
    {
        $arrNew = array();
        $bolEncontrado = strpos($strNameParameter,'.');

        if ( $bolEncontrado !== false  ){

            $arrPartes = explode('.',$strNameParameter);
            $strNameParameter = $arrPartes[1];

            if ( isset($this->arrPost[$arrPartes[0]][$arrPartes[1]])){
                $arrNew[$strNameParameter] = $this->arrPost[$arrPartes[0]] [$arrPartes[1]];
            } else {
                $arrNew[$strNameParameter] = '';
            }
        }
        if ($bolRequired){

            if ( empty($arrNew[$strNameParameter]) ){
                $this->bolErrorFormStatus = false;
                if ( empty($this->arrErrorFormNames[$strNameParameter]) ) {
                    $this->arrErrorFormNames[$strNameParameter] = 'Campo obligatorio';
                    return false;
                }
            }
            if ( Filter::evaluate($strFilter,$arrNew[$strNameParameter]) ){
                if( $strFilter == Filter::DATE_HUMAN){
                    return Date::formatBySql($arrNew[$strNameParameter]) ;
                } else {
                    return $arrNew[$strNameParameter];
                }
            } else {
                //mandar error
                $this->bolErrorFormStatus = false;
                if ( empty($this->arrErrorFormNames[$strNameParameter]))
                $this->arrErrorFormNames[$strNameParameter] = 'Informacion invalida:'.$arrNew[$strNameParameter];
                return false;
            }

        } else {  // end if ($bolRequired)
            if ( empty($arrNew[$strNameParameter]) ){
                if( $strFilter == Filter::DATE_HUMAN){
                    return Date::formatBySql($arrNew[$strNameParameter]) ;
                } else {
                    return $arrNew[$strNameParameter];
                }
            } else {
                if ( Filter::evaluate($strFilter,$arrNew[$strNameParameter]) ){
                    if( $strFilter == Filter::DATE_HUMAN){
                    return Date::formatBySql($arrNew[$strNameParameter]) ;
                } else {
                    return $arrNew[$strNameParameter];
                }
                } else {
                    //mandar error
                    $this->bolErrorFormStatus = false;
                    if ( empty($this->arrErrorFormNames[$strNameParameter]))
                    $this->arrErrorFormNames[$strNameParameter] = 'Informacion invalida:'.$arrNew[$strNameParameter];
                    return false;
                }
            }
        } // end else if ($bolRequired)
    }
   
    protected function getStatusForm()
    {
        return $this->bolErrorFormStatus;
    }
    protected function getFormError()
    {
        return $this->arrErrorFormNames;
    }

    protected function  getFormErrorString()
    {
        $strMessages = '';
            foreach($this->getFormError() as $campo => $strError ){
                $strMessages .= "{$campo}:{$strError} <br/>";
            }
         return $strMessages;
    }


    public function getLoad()
   {
       return $this->Load;
   }
   
   /**
     * @name uploadsImages
     * @description Sube las imagenes que se encuentren en el formulario al servidor
     */
    public function uploadsImages($nombreCampo,$path){
        $this->getLoad()->load('lib.ServerImage');
        $serverImage = new ServerImage();
        $nombreImagen = '';
        
        try{
            $nombreImagen = $serverImage->upload('registro',$nombreCampo,$path);
           }catch(Exception $e){
               if($e->getCode() == 2 ){
                   return '';
               }
           }
           return $nombreImagen;
    }

}
