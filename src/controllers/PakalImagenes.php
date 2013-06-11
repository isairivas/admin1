<?php

/**
 * Description of PakalImagenes
 *
 * @author uriel isai rodriguez rivas
 * isairivas@gmail.com
 */
class PakalImagenes extends Controller {
    
    private $_name = 'pakal-imagenes';
    private $_uploads;
    
    public function __construct() {
        parent::__construct();
        Param::setMenu('catalogos');
        Param::setSubMenu('pakales');
        Param::setTitle('Imagenes del pakal');
        $this->_uploads = PATH_UPLOADS.'images/pakales/';
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            $this->index();
        }
    }
    
    public function index()
    {
       
       $proyect = Proyect::getInstance();
       $params = $proyect->getParamsURL();
       $pakalId = isset($params[0])?$params[0]:'error';
       if(!is_numeric($pakalId)){
           Util::redirect(HOME.'pakales');
       }
       $pakalesDB = new Model('pakales', 'pakal_id');
       $pakal = $pakalesDB->getById($pakalId);
       
       Param::setTitle('Imagenes del pakal: '.$pakal['titulo_es']);
       Param::navigate(array('Home' => HOME,'Pakales' => go('pakales'),'Imagenes' => go('pakal-imagenes','view',array($pakalId)) ), 'icon-database');
       
       $modelDB = new Model('pakal_imagenes', 'pakal_imagen_id');
       $records = $modelDB->toArray($modelDB->getByColumn('pakal_id',$pakalId));
       
       $aData = array(
           'registros' => $records,
           '_name'      => $this->_name,
           'pakal_id'   => $pakalId
       ); 
        
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakal_imagenes/index',$aData);
        
        parent::getLoad()->loadView('containers/footer');
        
    }
    
    public function view(){
        $this->index();
    }
    
    public function nuevo($pakalId = 'error') {
        $proyect = Proyect::getInstance();
        if( $pakalId == 'error'){
            $params = $proyect->getParamsURL();
            $pakalId = isset($params[0]) ? $params[0] : 'error';
        }
        
        if (!is_numeric($pakalId)) {
            Util::redirect(HOME . 'pakales');
        }
        $pakalesDB = new Model('pakales', 'pakal_id');
        $pakal = $pakalesDB->getById($pakalId);
        
        
        Param::navigate(array('Home' => HOME,'Pakales' => go('pakales'),'Imagenes' => go('pakal-imagenes','view',array($pakalId)),'Nueva' => go('pakal-imagenes','nuevo',array($pakalId)) ), 'icon-database');
        Param::setTitle('Agregar nuevo Pakal');
        
        $aData = array( 
            '_name'  => $this->_name,
            'action' => go('pakal-imagenes','agregar'),
            'pakal_id' => $pakalId
            );
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakal_imagenes/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    public function agregar(){
        $camposObligatorios = array('titulo_es','sys_status','pakal_id');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['pakal_id'] = parent::getPost('registro.pakal_id', Filter::INT, TRUE);
        $dataUpdate['sys_created_at'] = date('Y-m-d H:i:s');
        $dataUpdate['imagen'] = $this->uploadsImages('imagen', $this->_uploads);
        
        $model = new Model('pakal_imagenes', 'pakal_imagen_id');
        if ( parent::getStatusForm() ){
           if ( $model->set($dataUpdate) ){
                Util::redirect(go('pakal-imagenes','view','&param1='.$dataUpdate['pakal_id'].'&add=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $this->nuevo($dataUpdate['pakal_id']);
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['add'] = 'false';
            $this->nuevo($dataUpdate['pakal_id']);
        }
    }
    
    public function edit($intId=0){
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $modelDB = new Model('pakal_imagenes', 'pakal_imagen_id');
        $record = $modelDB->getById($intId);
        $pakalId = $record['pakal_id'];
        $pakalesDB = new Model('pakales', 'pakal_id');
        $pakal = $pakalesDB->getById($pakalId);
        
        Param::navigate(array('Home' => HOME,'Pakales' => go('pakales'),'Imagenes' => go('pakal-imagenes','view',array($pakalId)),'Nueva' => go('pakal-imagenes','edit',array($intId)) ), 'icon-database');
        Param::setTitle('Editar Imagen del Pakal: '.$pakal['titulo_es']);
        
        $aData = array( 
            '_name'  => $this->_name,
            'action' => go('pakal-imagenes','save'),
            'pakal_id' => $pakalId,
            'title'  => 'Editar Imagen Pakal',
            'registro' => $record
        );
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView('pakal_imagenes/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function save(){
        $camposObligatorios = array('titulo_es','sys_status','pakal_id','pakal_imagen_id');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['titulo_es'] = parent::getPost('registro.titulo_es', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_updated_at'] = date('Y-m-d H:i:s');

        $pakalId = parent::getPost('registro.pakal_id', Filter::INT, TRUE);
        $intId = parent::getPost('registro.pakal_imagen_id',Filter::ID,true);
        $model = new Model('pakal_imagenes', 'pakal_imagen_id');
        $nuevaImagen = $this->uploadsImages('imagen', $this->_uploads);
        
        if( $nuevaImagen && !empty($nuevaImagen) ){
            $dataUpdate['imagen'] = $nuevaImagen;
            $pakal = $model->getById($intId);
            if( file_exists(PATH_UPLOADS.'images/pakales/'.$pakal['imagen']) ){
                unlink(PATH_UPLOADS.'images/pakales/'.$pakal['imagen']);
            }
            if( file_exists(PATH_UPLOADS.'images/pakales/thumb_admin_'.$pakal['imagen']) ){
                unlink(PATH_UPLOADS.'images/pakales/thumb_admin_'.$pakal['imagen']);
            }
        }
        if ( parent::getStatusForm() ){
           if ( $model->update($dataUpdate,$intId) ){
                Util::redirect(go('pakal-imagenes','view','&param1='.$pakalId.'&update=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $this->edit($dataUpdate['pakal_imagen_id']);
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['update'] = 'false';
            $this->edit($intId);
        }
    }
    
    public function delete()
    {
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $model = new Model('pakal_imagenes', 'pakal_imagen_id');
        $record = $model->getById($intId);
        if( file_exists(PATH_UPLOADS.'images/pakales/'.$record['imagen']) ){
            unlink(PATH_UPLOADS.'images/pakales/'.$record['imagen']);
        }
        if( file_exists(PATH_UPLOADS.'images/pakales/thumb_admin_'.$record['imagen']) ){
            unlink(PATH_UPLOADS.'images/pakales/thumb_admin_'.$record['imagen']);
        }
        if ( $model->delete($intId) ){
            Util::redirect(go('pakal-imagenes','view','&param1='.$record['pakal_id'].'&delete=true'));
        } else {
            Util::redirect(go('pakal-imagenes','view','&param1='.$record['pakal_id'].'&delete=false'));
        }
    }
    /**
     * @name uploadsImages
     * @description Sube las imagenes que se encuentren en el formulario al servidor
     */
    private function uploadsImages2($nombreCampo,$path){
        parent::getLoad()->load('lib.ServerImage');
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

