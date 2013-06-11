<?php


/**
 * Description of Scaffold
 *
 * @author isai
 * 28/06/2011
 * updated at: 18/08/2012
 */
class Scaffold extends Controller {

    private $strTableName;
    private $strControllerName;
    private $arrColumnasMostradas;
    private $arrCamposNoVisibles;
    private $arrFilterFields = array();
    private $bolPaginate = false;
    private $pathUploads = PATH_UPLOADS ;

    private $Model;

    function __construct() {
        parent::__construct();
        if( $this->isReady() ) {
            $strAction = parent::getAction();
            if ( method_exists($this, $strAction) ) {
                $this->Model = new Model($this->strTableName);
                $this->$strAction();
                parent::getLoad()->loadView('footer');
            } else {
                Util::redirect(HOME.'not-found');
            }
        } else {
            Param::setFormError('Error Scaffold no configurado correctamente');
            parent::getLoad()->loadView('head');
            parent::getLoad()->loadView('alerts');
            
        }
    }
    private function index(){

        Param::setTitle(' Goiti | '.Util::createLabel($this->strTableName)) ;

        $objListView = new ListView('Listado de '.Util::createLabel($this->strTableName),$this->strControllerName);
        $objListView->showColumn(null, $this->arrColumnasMostradas);
        $objListView->setFields($this->Model->getFields());
        $objListView->setRegistros($this->Model->get());
        $objListView->createColumns();
        parent::getLoad()->loadView('head');
        parent::getLoad()->loadView('menu_superior');
        View::renderList($objListView);
    }

    private function nuevo(){
        Param::setTitle('Goiti | Nuevo Registro');
        $arrData = array(
            'title'  => 'Nuevo Registro de '.Util::createLabel($this->strTableName)
        );
        $objForm = new Form($this->strControllerName,HOME.$this->strControllerName.'/add','post',$this->Model->getFields());
        parent::getLoad()->loadView('head');
        parent::getLoad()->loadView('menu_superior');
        View::renderForm($objForm,$arrData);
    }

    private function add()
    {
        $arrFields = $this->getFieldsPreparated();
        $arrRegistro = array(
            'created_at'            => date('Y-m-d H:i:s')
        );
        foreach ( $arrFields as $field ){
            $arrRegistro['`'.$field->getName().'`'] = parent::getPost($this->strControllerName.'.'.$field->getName(), $field->getTypeFilter(), $field->getRequired());
            if($this->isFieldImage($field)){
                $arrRegistro['`'.$field->getName().'`'] = $this->uploadsImages($field);
            }
			if($this->isFieldFile($field)){
                $arrRegistro['`'.$field->getName().'`'] = $this->uploadsFiles($field);
            }
        }

        if ( parent::getStatusForm() ){
           if (  $this->Model->set($arrRegistro) ){
            Util::redirect(HOME.$this->strControllerName.'/index/?add=true');
           } else {
               $this->nuevo();
           }
        } else {
            Param::setFormError(parent::getFormErrorString());
            $this->nuevo();
        }
    }

    private function edit($intId=0)
    {
        Param::setTitle('Goiti | Editar registro');
        $arrData = array(
            'title'  => 'Editar Registro de '.Util::createLabel($this->strTableName),
            'pathImages' => '../uploads/images/'.$this->strTableName.'/'
        );
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $objForm = new Form($this->strControllerName,HOME.$this->strControllerName.'/update','post',$this->Model->getFields());
        $objForm->setRegistro($this->Model->getById($intId));
        $objForm->createInputForms();
        parent::getLoad()->loadView('head');
        parent::getLoad()->loadView('menu_superior');
        View::renderForm($objForm,$arrData);
    }

    private function update()
    {
        $arrFields = $this->getFieldsPreparated();
        $intId = parent::getPost($this->strControllerName.'.id', Filter::ID,true);
        $arrRegistro = array(
            'updated_at'            => date('Y-m-d H:i:s')
        );

        foreach ( $arrFields as $field ){
            $arrRegistro['`'.$field->getName().'`'] = parent::getPost($this->strControllerName.'.'.$field->getName(), $field->getTypeFilter(), $field->getRequired());
            if($this->isFieldImage($field)){
                $imagenTempName = $this->uploadsImages($field);
                if(!empty ($imagenTempName) ){
                    $arrRegistro['`'.$field->getName().'`'] = $imagenTempName;
                } else {
                    unset($arrRegistro['`'.$field->getName().'`']);
                }   
            }
			
			if($this->isFieldFile($field)){
                $fileTempName = $this->uploadsFiles($field);
                if(!empty ($fileTempName) ){
                    $arrRegistro['`'.$field->getName().'`'] = $fileTempName;
                } else {
                    unset($arrRegistro['`'.$field->getName().'`']);
                }   
            }
        }
        
        if( parent::getStatusForm() ){
            $this->Model->update($arrRegistro, $intId);
            Util::redirect(HOME.$this->strControllerName.'/index/?update=true');
        } else {
            Param::setFormError(parent::getFormErrorString());
            $this->edit($intId);
        }
    }
    
    private  function delete()
    {
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }

        if ( $this->Model->delete($intId) ){
            Util::redirect(HOME.$this->strControllerName.'/index/?delete=true');
        } else {
            Util::redirect(HOME.$this->strControllerName.'/index/?delete=false');
        }
    }
    
    /**
     * @name uploadsImages
     * @description Sube las imagenes que se encuentren en el formulario al servidor
     */
    protected function uploadsImages2($field){
        parent::getLoad()->load('lib.ServerImage');
        $serverImage = new ServerImage();
        $nombreImagen = '';
        
        try{
            $nombreImagen = $serverImage->upload($this->strTableName,$field->getName(),$this->getPathUploads());
           }catch(Exception $e){
               if($e->getCode() == 2 ){
                   return '';
               }
           }
           return $nombreImagen;
    }
	
	   /**
     * @name uploadsFiles
     * @description Sube los archivos que se encuentren en el formulario al servidor
     */
    private function uploadsFiles($field){
        parent::getLoad()->load('lib.ServerImage');
        $serverImage = new ServerImage();
        $nombreImagen = '';
        
        try{
            $nombreImagen = $serverImage->upload($this->strTableName,$field->getName(),$this->getPathUploads(),'jpg,png,gif,jpeg,pdf,doc,docx,xls,xlsx');
           }catch(Exception $e){
               if($e->getCode() == 2 ){
                   return '';
               }
           }
           return $nombreImagen;
    }
    
    private function isFieldFile($field){
        $aPartes = explode('_', $field->getName());
        if(count($aPartes) < 2){
            return FALSE;
        }
        if( $aPartes[0] == 'file' ){
            return TRUE;
        } else {
            return FALSE;
        }
    }
	private function isFieldImage($field){
        $aPartes = explode('_', $field->getName());
        if(count($aPartes) < 2){
            return FALSE;
        }
        if( $aPartes[0] == 'imagen' ){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function setTableName($strTableName){
        $this->strTableName = $strTableName;
    }

    protected function getTableName(){
        return $this->strTableName;
    }

    protected  function setControllerName($strControllerName) {
        $this->strControllerName = $strControllerName;
    }

    protected function getControllerName(){
        return $this->strControllerName;
    }

    protected function getColumnasMostradas() {
        return $this->arrColumnasMostradas;
    }

    protected function setColumnasMostradas($arrColumnasMostradas) {
        $this->arrColumnasMostradas = $arrColumnasMostradas;
    }

    protected function getCamposNoVisibles() {
        return $this->arrCamposNoVisibles;
    }

    protected function setCamposNoVisibles($arrCampos) {
        $this->arrCampos = $arrCamposNoVisibles;
    }

    protected function getPaginate() {
        return $this->bolPaginate;
    }

    protected function setPaginate($bolPaginate) {
        $this->bolPaginate = $bolPaginate;
    }

    protected function setFilterFields($arrFilterField){
        $this->arrFilterField = $arrFilterField;
    }
    protected function getFilterFields(){
        return $this->arrFilterFields;
    }

    private function getFieldsPreparated() {
        $arrFieldsNoRequeridos = array('created_at','created_by','updated_at','updated_by','id');
        $arrFields = $this->Model->getFields();
        foreach($arrFields as $key => $field ) {
            if( in_array($field->getName(), $arrFieldsNoRequeridos)) {
                unset($arrFields[$key]);
            }
        }

        foreach($this->arrFilterFields as $fieldName => $filter ) {
            foreach($arrFields as $key => $field ) {
                if( $field->getName() == $fieldName ) {
                    $field->setTypeFilter = $filter;
                }
            }
        }

        return $arrFields;
    }

    private function isReady(){
        if(is_null($this->strTableName) || empty($this->strTableName) ) {
            return false;
        }
        if(is_null($this->strControllerName) || empty($this->strControllerName) ) {
            return false;
        }
        if ( is_null($this->arrColumnasMostradas) || !is_array($this->arrColumnasMostradas) ) {
            return false;
        }

        return true;
    }
    
         
    
    protected function setPathUploads($path){
        if(is_dir($path) ){
            $this->pathUploads = $path;
        }
    }
    protected function getPathUploads(){
        return $this->pathUploads;
    }
}

