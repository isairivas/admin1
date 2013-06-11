<?php

/**
 * Description of Categorias
 *
 * @author isai
 */
class Categorias extends Controller {
    private $_name = 'categorias';
    private $_table ='etiquetas_categorias';
    private $_uploads;
    
    function __construct() {
        parent::__construct();
        Param::setMenu('lenguaje');
        Param::setSubMenu('categorias');
        Param::setTitle('Categorias');
        $this->_uploads = PATH_UPLOADS.'images/patrocinadores/';
        $strAction = parent::getAction();
        if (method_exists($this, $strAction)) {
            $this->$strAction();
        } else {
            $this->index();
        }
    }
    
    public function index()
    {
      
       Param::navigate(array('Home' => 'index.php','Categorias' => go($this->_name)), 'icon-database');

       $modelDB = new Model($this->_table);
       $records = $modelDB->toArray($modelDB->get());
       
       $aData = array(
           'registros' => $records,
           '_name'      => $this->_name
       ); 
        
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/index',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function nuevo(){
        
        Param::navigate(array('Home' => 'index.php',$this->_name => go($this->_name),'Nuevo' => go($this->_name,'nuevo')), 'icon-database');
        Param::setTitle('Agregar nueva categoria');
        
        $aData = array('_name'  => $this->_name,'action' => go($this->_name,'agregar'));
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/agregar',$aData);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function agregar(){
        $camposObligatorios = array('nombre','sys_status');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['nombre'] = parent::getPost('registro.nombre', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_created_at'] = date('Y-m-d H:i:s');
        $model = new Model($this->_table);
        if ( parent::getStatusForm() ){
           if ( $model->set($dataUpdate) ){
                Util::redirect(go($this->_name,'index','&add=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $_GET['add'] = 'false';
                $this->nuevo();
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['add'] = 'false';
            $this->nuevo();
        } 
    }
    
    public function delete()
    {
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $model = new Model($this->_table, 'id');
        $record = $model->getById($intId);
        if( file_exists($this->_uploads.$record['imagen']) ){
            unlink($this->_uploads.$record['imagen']);
        }
        if( file_exists($this->_uploads.'thumb_admin_'.$record['imagen']) ){
            unlink($this->_uploads.'thumb_admin_'.$record['imagen']);
        }
        
        if ( $model->delete($intId) ){
            Util::redirect(go($this->_name,'index','&delete=true'));
        } else {
            Util::redirect(go($this->_name,'index','&delete=false'));
        }
    }
    
    public function change()
    {
        $error = true;
        $arrParamURL = Param::getParamURL();
        $intId = $arrParamURL[0];
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $model = new Model($this->_table, 'id');
        $record = $model->getById($intId);
        $data = array();
        if ( $record['sys_status'] == 'ACTIVO' ){
            $data = array('sys_status' => 'INACTIVO');
        } else {
            $data = array('sys_status' => 'ACTIVO');
        }
        if ($model->update($data, $intId)){
               $error = false;
           }else {
               Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
           } 
           
        if ( !$error ){
            Util::redirect(go($this->_name,'index','&update=true'));
        } else {
            $_GET['update']= false;
            $this->index();
        }
    }
    
    public function edit($intId = 0){
        if($intId == 0){
            $arrParamURL = Param::getParamURL();
            $intId = $arrParamURL[0];
        }
        if ( ! filter_var($intId,FILTER_VALIDATE_INT) ){
            Login::out();
        }
        $modelDB = new Model($this->_table,'id');
        $record = $modelDB->getById($intId);

        $arrConf = array(
            'action' => go($this->_name,'save'),
            'title'  => 'Editar',
            'registro' => $record
        );
        Param::setTitle('Editar');
        
        Param::navigate(array('home' => HOME,'categorias' => go($this->_name),'Editar' => ''), 'icon-cogs');
        parent::getLoad()->setTemplate('templates/mooncake/');
        parent::getLoad()->loadView('containers/doctype');
        parent::getLoad()->loadView('containers/header');
        parent::getLoad()->loadView('containers/menu_sidebar');
        parent::getLoad()->loadView('containers/navigation');
        parent::getLoad()->loadView($this->_name.'/agregar',$arrConf);
        
        parent::getLoad()->loadView('containers/footer');
    }
    
    public function save(){
        $intId = parent::getPost('registro.id',Filter::ID,true);
        $camposObligatorios = array('nombre_es','sys_status');
        $dataUpdate = array();
        foreach($_POST['registro'] as $field => $value ){
            if(!in_array($field, $camposObligatorios)){
                $dataUpdate[$field] = $value;
            }
        }
        $dataUpdate['nombre'] = parent::getPost('registro.nombre', Filter::STRING, TRUE);
        $dataUpdate['sys_status'] = parent::getPost('registro.sys_status', Filter::STRING, TRUE);
        $dataUpdate['sys_updated_at'] = date('Y-m-d H:i:s');
        $model = new Model($this->_table, 'id');
        
        if ( parent::getStatusForm() ){
           if ( $model->update($dataUpdate, $intId) ){
                Util::redirect(go($this->_name,'index','&update=true'));
            } else {
                Param::setFormError('Ocurrio un error en la conexion, intentalo de nuevo');
                $_GET['update'] = 'false';
                $this->edit($intId);
            } 
        } else {
            Param::setFormError(parent::getFormErrorString());
            $_GET['update'] = 'false';
            $this->edit($intId);
        }  
    }
}


